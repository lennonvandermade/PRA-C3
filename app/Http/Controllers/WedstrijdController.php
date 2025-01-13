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
}
