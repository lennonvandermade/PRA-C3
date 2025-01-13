<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedstrijd extends Model
{
    use HasFactory;

    protected $table = 'wedstrijden';

    // Zorg ervoor dat match_date als string behandeld wordt
    protected $casts = [
        'match_date' => 'string', // 'match_date' is nu een string
    ];

    protected $fillable = [
        'team1_id',
        'team2_id',
        'match_date',
        'location',
    ];

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

    public function inschrijver()
    {
        return $this->belongsTo(Inschrijving::class);
    }

    // Methode om een wedstrijd aan te maken met een willekeurige dag van de week
    public static function createWithRandomDay($team1_id, $team2_id, $location)
    {
        // Definieer de dagen van de week
        $daysOfWeek = ['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag'];

        // Kies een willekeurige dag uit de array
        $randomDay = $daysOfWeek[array_rand($daysOfWeek)];

        // Maak een nieuwe wedstrijd met de willekeurige dag
        return self::create([
            'team1_id' => $team1_id,
            'team2_id' => $team2_id,
            'match_date' => $randomDay,  // Bewaar de willekeurige dag
            'location' => $location,
        ]);
    }
}
