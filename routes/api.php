<?php

use App\Http\Controllers\TeamController;
use App\Http\Controllers\WedstrijdController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('teams', [TeamController::class, 'getAllTeams']);

Route::get('/teams/{id}', [TeamController::class, 'getTeamById']);

Route::get('/wedstrijden', [WedstrijdController::class, 'getAllWedstrijden']);

Route::get('/wedstrijden/{id}', [WedstrijdController::class, 'getWedstrijdById']);
