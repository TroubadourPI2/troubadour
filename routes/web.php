<?php

use App\Http\Controllers\LieuxController;
use App\Http\Controllers\UsagersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeolocalisationController;
use App\Http\Controllers\LieuxController;

Route::get('/', function () {
    return view('Accueil');
});

Route::get('/lieu/zoom/{id}', [LieuxController::class, 'show'])->name('Lieu.zoom');

Route::get('/geolocalisation/ville', [GeolocalisationController::class, 'obtenirVilleUtilisateur']);

// Route::get('/compte', function () {
//     return view('usagers/afficher');
// });

Route::get('/compte', [UsagersController::class, 'ObtenirLieuxUsager'])->name('usagerLieux.afficher');
