<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeolocalisationController;

Route::get('/', function () {
    return view('Accueil');
});

Route::get('/geolocalisation/ville', [GeolocalisationController::class, 'obtenirVilleUtilisateur']);
