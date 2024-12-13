<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\InschrijvingController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('homepage'); // Je homepage view
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/schema', function () {
    return view('schema');
})->name('schema');
// Route voor Inschrijven
Route::get('/inschrijven', function () {
    return view('inschrijven');
});

// Route voor Inzetten
Route::get('/inzetten', function () {
    return view('inzetten');
});

// Route voor Informatie
Route::get('/informatie', function () {
    return view('informatie');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');  // Dit is de route voor de index
Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');  // Dit is de route voor het formulier
Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');  // Dit is de route voor het opslaan van het team
Route::get('/schema', [TeamController::class, 'index'])->name('schema');  // Route naar schema.blade.php

// Toon het formulier om een nieuw team aan te maken
Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');

// Verwerk het formulier om het nieuwe team toe te voegen
Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');

Route::get('/teams', [TeamController::class, 'index'])->name('teams.edit');  // Dit is de route voor de index
Route::get('/teams/edit', [TeamController::class, 'edit'])->name('teams.edit');  // Dit is de route voor het formulier
Route::delete('/teams/{id}', [TeamController::class, 'destroy'])->name('teams.destroy');//destroy route
Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');  // Dit is de route voor het opslaan van het team
Route::get('/schema', [TeamController::class, 'index'])->name('schema');

Route::get('/teams/{id}/edit', [TeamController::class, 'edit'])->name('teams.edit');//edit route
Route::put('/teams/{id}', [TeamController::class, 'update'])->name('teams.update');//edit update






//Wachtwoord vergeten route
Route::post('reset-password-direct', [LoginController::class, 'resetPasswordDirectly'])->name('password.direct-reset');

//
Route::get('/inschrijven', [InschrijvingController::class, 'showForm'])->name('inschrijven.form');
Route::middleware(['auth'])->group(function () {
    // Route voor het opslaan van inschrijving (beschermd met middleware 'auth')
    Route::post('/inschrijven', [InschrijvingController::class, 'store'])->name('inschrijven.store');
});
