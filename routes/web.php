<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeolocalisationController;

Route::get('/', function () {
    return view('Accueil');
});
Route::get('/test', function () {
    return view('test');
});


Route::get('/zoom', function () {
    return view('zoomLieu');
});

//! [LieuxControlleur::class, 'zoom'])->name('Lieu.zoom');
Route::get('/geolocalisation/ville', [GeolocalisationController::class, 'obtenirVilleUtilisateur']);
