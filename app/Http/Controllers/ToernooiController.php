<?php

namespace App\Http\Controllers;

use App\Models\Toernooi;
use App\Models\Team;
use App\Models\Wedstrijd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ToernooiController extends Controller
{
    // Functie om alle toernooien te tonen
    public function index()
    {
        // Haal het toernooi op met de bijbehorende wedstrijden
        $toernooien = Toernooi::with('wedstrijden')->get();

        // De 'toernooien' wordt nu doorgegeven naar de view
        return view('toernooi.index', compact('toernooien'));
    }

    // Functie om een toernooi te starten
    public function startToernooi($id)
    {
        // Haal het toernooi op
        $toernooi = Toernooi::findOrFail($id);

        // Controleer of het toernooi al gestart is
        if ($toernooi->status === 'bezig') {
            return redirect()->back()->with('error', 'Het toernooi is al gestart.');
        }

        // Haal alle teams op die gekoppeld zijn aan het toernooi
        $teams = Team::where('toernooi_id', $toernooi->id)->get();

        // Controleer of er genoeg teams zijn om een toernooi te starten
        if ($teams->count() < 2) {
            return redirect()->back()->with('error', 'Er zijn niet genoeg teams om het toernooi te starten.');
        }

        // Start het toernooi door de status te updaten
        $toernooi->status = 'bezig';
        $toernooi->save();

        // Genereer de wedstrijden voor het toernooi
        $this->genereerWedstrijden($teams, $toernooi);

        return redirect()->route('toernooi.index')->with('success', 'Het toernooi is gestart en de wedstrijden zijn gegenereerd.');
    }

    // Genereer wedstrijden voor het toernooi
    private function genereerWedstrijden($teams, $toernooi)
    {
        // Shuffle de teams zodat ze willekeurig worden gepaard
        $shuffledTeams = $teams->shuffle();

        // Groepeer de teams in paren van twee
        $teamPairs = $shuffledTeams->chunk(2);

        foreach ($teamPairs as $pair) {
            if ($pair->count() === 2) {
                $team1 = $pair->get(0);
                $team2 = $pair->get(1);

                // Maak een nieuwe wedstrijd voor elk paar teams
                Wedstrijd::create([
                    'team1_id' => $team1->id,
                    'team2_id' => $team2->id,
                    'match_date' => 'TBD', // Pas deze datum aan, of kies willekeurige datum
                    'location' => 'Locatie ' . random_int(1, 10), // Pas locatie aan als nodig
                    'toernooi_id' => $toernooi->id, // Koppel het aan het toernooi
                ]);
            }
        }
    }
}
