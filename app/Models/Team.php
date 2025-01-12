<?php
// app/Models/Team.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'inschrijver_naam',
        'teamnaam',
        'telefoonnummer',
        'niveau',
    ];
    public function inschrijvingen()
    {
        return $this->hasMany(Inschrijving::class);
    }
    public function wedstrijden()
    {
        return $this->hasMany(Wedstrijd::class);
    }
}
