<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedstrijd extends Model
{
    use HasFactory;

    // Als je tabelnaam niet standaard de meervoudsvorm van je model is,
    // kun je de naam van de tabel handmatig instellen.
    protected $table = 'wedstrijden'; // Pas de naam aan indien nodig
    protected $casts = [
        'match_date' => 'datetime',  // Zorg ervoor dat match_date wordt behandeld als een datetime
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
}


