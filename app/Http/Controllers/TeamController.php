<?php
namespace App\Http\Controllers;

use App\Models\Inschrijving;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    // Toon een lijst van alle teams (weergave op schema pagina)
    public function index(Request $request)
{
    // Haal alle teams op uit de database
    $teams = Team::all();

    // Controleer of het verzoek om JSON vraagt
    if ($request->wantsJson()) {
        // Geef de gegevens als JSON terug
        return response()->json($teams);
    }

    // Anders geef de view terug
    return view('schema', compact('teams'));
}


    // Toon het formulier om een nieuw team aan te maken
    public function create()
    {
        return view('teams.teamcreate');
    }

    // Verwerk het formulier en sla het nieuwe team op
    public function store(Request $request)
    {
        // Valideer de invoer
        $validated = $request->validate([
            'inschrijver_naam' => 'required|string|max:255',
            'teamnaam' => 'required|string|max:255',
            'telefoonnummer' => 'required|string|max:15',
            'niveau' => 'required|string|max:255',
        ]);

        // Maak een nieuw team en sla het op
        Team::create($validated);

        // Redirect terug naar de schema pagina met een succesbericht
        return redirect()->route('schema')->with('success', 'Nieuw team is toegevoegd!');
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id); // Haal het team op, of geef een 404 als het niet bestaat
        return view('teams.teamedit', compact('team')); // Stuur het team naar de edit view
    }
    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        $team->update([
            'inschrijver_naam' => $request->inschrijver_naam,
            'teamnaam' => $request->teamnaam,
            'telefoonnummer' => $request->telefoonnummer,
            'niveau' => $request->niveau,
        ]);

        return redirect()->route('schema')->with('success', 'Team succesvol bijgewerkt!');
    }


    public function destroy($id)
    {
        $team = Team::findOrFail($id);

        // Verwijder gerelateerde inschrijvingen
        Inschrijving::where('team_id', $team->id)->delete();

        // Verwijder het team
        $team->delete();

        return redirect()->back()->with('success', 'Team en gerelateerde inschrijvingen verwijderd!');
    }

    public function show($id)
    {
        // Haal het team op door zijn ID
        $team = Team::find($id);

        if ($team) {
            // Toon de teamnaam
            return response()->json(['teamnaam' => $team->teamnaam]);
        }

        return response()->json(['message' => 'Team niet gevonden'], 404);
    }

    public function getAllTeams()
    {
        // Haal alle teams op uit de database
        $teams = Team::all();  // Gebruik Eloquent om alle teams op te halen

        // Stuur de teams terug als JSON (of als een view als je een frontend hebt)
        return response()->json($teams);
    }
    public function getTeamById($id){
        $team = Team::find($id);

        if (!$team) {
            return response()->json(['error' => 'Team niet gevonden']);
        }

        return response ()->json($team);
    }
}
