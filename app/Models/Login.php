<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    public function index(){

    }
    protected $table = 'logins';

    // Voeg de vulbare velden toe
    protected $fillable = ['user_id', 'login_at',];

    // Relatie naar de User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
?>
