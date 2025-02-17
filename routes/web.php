<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateursController;

use App\Http\Controllers\GeolocalisationController;

Route::get('/', function () {
    return view('Accueil');
});


Route::post('/connexion', [UtilisateurController::class, 'connexion'])->name('connexion');
Route::get('/geolocalisation/ville', [GeolocalisationController::class, 'obtenirVilleUtilisateur']);
