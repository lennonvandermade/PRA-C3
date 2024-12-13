<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Inschrijving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InschrijvingController extends Controller
{
    // Toon het formulier met beschikbare teams
    public function showForm()
    {
        $teams = Team::all();
        return view('inschrijven', compact('teams'));
    }

    // Verwerk het inschrijven
    public function store(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
        ]);

        // Sla de inschrijving op
        Inschrijving::create([
            'user_id' => Auth::id(),
            'team_id' => $request->team_id,
        ]);

        // Toon een bevestiging
        $team = Team::findOrFail($request->team_id);
        return view('inschrijfbevestiging', compact('team'));

    }
}
