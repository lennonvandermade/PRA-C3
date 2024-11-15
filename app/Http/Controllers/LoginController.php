<?php

namespace App\Http\Controllers;

use App\Models\Login; // Zorg ervoor dat je het model importeert

class LoginController extends Controller
{
    public function index()
    {
        // Haal alle logins op uit de database
        $logins = Login::with('user')->get();

        // Geef de data door aan de view
        return view('login.index', compact('logins'));
    }
}
