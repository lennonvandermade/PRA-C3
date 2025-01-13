<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toernooi extends Model
{
    use HasFactory;
    protected $table = 'toernooien';

    // Relatie naar de wedstrijden
   

    protected $fillable = ['naam', 'status'];

    public function wedstrijden()
    {
        return $this->hasMany(Wedstrijd::class);
    }
    // Methode om de status van het toernooi te veranderen naar 'bezig'
    public function startToernooi()
    {
        $this->status = 'bezig';
        $this->save();
    }

    // Methode om wedstrijden te genereren voor het toernooi
    public function genereerWedstrijden()
    {
        // Haal alle teams op voor dit toernooi
        $teams = $this->teams;

        // Controleer of er genoeg teams zijn om wedstrijden te maken
        if ($teams->count() < 2) {
            return false;  // Niet genoeg teams om wedstrijden te genereren
        }

        // Sorteer de teams willekeurig
        $shuffledTeams = $teams->shuffle();

        // Maak de wedstrijden aan
        foreach ($shuffledTeams->chunk(2) as $pair) {
            if ($pair->count() === 2) {
                // Haal de twee teams uit het paar
                $team1 = $pair->get(0);
                $team2 = $pair->get(1);

                // Maak de wedstrijd aan
                Wedstrijd::createWithRandomDay(
                    $team1->id,
                    $team2->id,
                    'Locatie ' . random_int(1, 10)
                );
            }
        }

        return true;  // Wedstrijden succesvol gegenereerd
    }
}
