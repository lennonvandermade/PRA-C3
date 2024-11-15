<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;

class LoginController extends Controller
{
    // Toon het inlogformulier
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Verwerk het inlogverzoek
    public function login(Request $request)
    {
        // Validatie van de invoer
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Poging om in te loggen
        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirect naar dashboard na succesvolle inlog
            return redirect()->intended('/');
        }

        // Foutmelding bij mislukte inlogpoging
        return back()->withErrors([
            'email' => 'De inloggegevens zijn onjuist.',
        ]);
    }

    // Uitlogfunctionaliteit
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
