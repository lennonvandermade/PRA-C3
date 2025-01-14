<?php
namespace App\Http\Controllers;

use App\Models\Wedstrijd;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WedstrijdController extends Controller
{
    // Functie om alle wedstrijden te tonen
    public function index()
    {
        // Haal alle wedstrijden op, inclusief de bijbehorende teams
        $wedstrijden = Wedstrijd::with(['team1', 'team2'])->get();

        return view('wedstrijden.index', compact('wedstrijden'));
    }

    public function generateWedstrijden(Request $request)
    {
        // Haal alle teams op
        $teams = Team::all();

        // Controleer of er genoeg teams zijn om wedstrijden te maken
        if ($teams->count() < 2) {
            return redirect()->back()->with('error', 'Niet genoeg teams om wedstrijden te genereren.');
        }

        // Sorteer de teams willekeurig, zodat de paren niet steeds hetzelfde zijn
        $shuffledTeams = $teams->shuffle();

        // Groepeer de teams in paren van 2
        $teamPairs = $shuffledTeams->chunk(2);

        foreach ($teamPairs as $pair) {
            // Controleer of het paar precies twee teams bevat
            if ($pair->count() === 2) {
                $team1 = $pair->get(0); // Haal het eerste team
                $team2 = $pair->get(1); // Haal het tweede team

                // Controleer of beide teams bestaan
                if (!$team1 || !$team2) {
                    Log::error('Een van de teams in het paar is null.', [
                        'pair' => $pair,
                    ]);
                    continue; // Sla dit paar over
                }

                // Controleer of er al een wedstrijd is tussen deze twee teams
                $existingMatch = Wedstrijd::where(function ($query) use ($team1, $team2) {
                    $query->where('team1_id', $team1->id)
                          ->where('team2_id', $team2->id);
                })->orWhere(function ($query) use ($team1, $team2) {
                    $query->where('team1_id', $team2->id)
                          ->where('team2_id', $team1->id);
                })->first();

                // Alleen een nieuwe wedstrijd maken als deze nog niet bestaat
                if (!$existingMatch) {
                    // Gebruik de aangepaste methode die een willekeurige dag kiest
                    Wedstrijd::createWithRandomDay(
                        $team1->id,
                        $team2->id,
                        'Locatie ' . random_int(1, 10) // Locatie voorbeeld
                    );
                }

            } else {
                // Log incomplete paren (oneven aantal teams)
                Log::warning('Onvolledig paar gevonden: minder dan twee teams.', [
                    'pair' => $pair,
                ]);
            }
        }

        return redirect()->route('wedstrijden.index')->with('success', 'Wedstrijden succesvol gegenereerd.');
    }

    // Functie om een wedstrijd te starten
    public function startWedstrijd($id)
    {
        // Haal de wedstrijd op
        $wedstrijd = Wedstrijd::find($id);

        // Controleer of de wedstrijd bestaat
        if (!$wedstrijd) {
            return redirect()->route('wedstrijden.index')->with('error', 'Wedstrijd niet gevonden.');
        }

        // Zet de status van de wedstrijd op "Wedstrijd Bezig"
        $wedstrijd->status = 'Wedstrijd Bezig';

        // Zet de score van beide teams naar 0
        $wedstrijd->score_team1 = 0;
        $wedstrijd->score_team2 = 0;

        // Sla de wijzigingen op
        $wedstrijd->save();

        // Retourneer naar de wedstrijden lijst met een succesmelding
        return redirect()->route('wedstrijden.index');
    }

    public function stopWedstrijd($id)
    {
        // Haal de wedstrijd op
        $wedstrijd = Wedstrijd::find($id);

        if (!$wedstrijd) {
            return redirect()->route('wedstrijden.index')->with('error', 'Wedstrijd niet gevonden.');
        }

        // Zet de status van de wedstrijd terug naar "Wacht op start"
        $wedstrijd->status = 'Wacht op start';
        $wedstrijd->score_team1 = 0; // Zet de score van team 1 naar 0
        $wedstrijd->score_team2 = 0; // Zet de score van team 2 naar 0
        $wedstrijd->save();

        return redirect()->route('wedstrijden.index')->with('success', 'Wedstrijd gestopt en status gereset.');
    }

    public function getAllWedstrijden()
    {
        // Haal alle teams op uit de database
        $wedstrijden = Wedstrijd::all();  // Gebruik Eloquent om alle teams op te halen

        // Stuur de teams terug als JSON (of als een view als je een frontend hebt)
        return response()->json($wedstrijden);
    }

    public function getWedstrijdById($id){
        $wedstrijd = Wedstrijd::find($id);

        if (!$wedstrijd) {
            return response()->json(['error' => 'Team niet gevonden']);
        }

        return response()->json($wedstrijd);
    }

    public function startToernooi(Request $request)
    {
        // Haal alle teams op
        $teams = Team::all();

        if ($teams->count() < 2) {
            return redirect()->route('wedstrijden.index')->with('error', 'Niet genoeg teams voor het toernooi.');
        }

        // Shuffle de teams om willekeurige tegenstanders te genereren
        $shuffledTeams = $teams->shuffle();

        // Maak een array om de wedstrijden op te slaan
        $wedstrijden = [];

        // Verdeel de teams in paren en maak wedstrijden
        for ($i = 0; $i < $shuffledTeams->count(); $i += 2) {
            if (isset($shuffledTeams[$i + 1])) {
                $wedstrijd = Wedstrijd::create([
                    'team1_id' => $shuffledTeams[$i]->id,
                    'team2_id' => $shuffledTeams[$i + 1]->id,
                    'status' => 'Wacht op start',  // Status is "Wacht op start" bij toernooistart
                    'score_team1' => 0,
                    'score_team2' => 0,
                    'match_date' => now()->addDays(1), // Je kunt hier de datum aanpassen voor je schema
                    'location' => 'Locatie ' . random_int(1, 10),  // Locatie instellen (kan worden aangepast)
                ]);
                $wedstrijden[] = $wedstrijd;
            }
        }

        // Return naar de wedstrijden index met een succesmelding
        return redirect()->route('wedstrijden.index')->with('success', 'Toernooi gestart, wedstrijden zijn aangemaakt.');
    }

    public function stopToernooi()
    {
        // Haal alle wedstrijden op die tijdens het toernooi zijn aangemaakt
        $wedstrijden = Wedstrijd::all();  // Je kunt dit ook filteren op een specifieke toernooi_id

        // Zet de toernooi_status op 'gestopt' voor alle wedstrijden
        foreach ($wedstrijden as $wedstrijd) {
            $wedstrijd->status = 'Wacht op start';
            $wedstrijd->score_team1 = 0;
            $wedstrijd->score_team2 = 0;
            $wedstrijd->toernooi_status = 'gestopt'; // Zet de toernooi_status naar gestopt
            $wedstrijd->save();
        }

        return redirect()->route('wedstrijden.index')->with('success', 'Toernooi gestopt en alle wedstrijden gereset.');
    }

}
