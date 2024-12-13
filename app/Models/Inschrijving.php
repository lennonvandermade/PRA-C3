<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;

class Inschrijving extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'team_id'];
    protected $table = 'inschrijvingen';

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
