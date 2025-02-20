<?php

use App\Http\Controllers\LieuxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\GeolocalisationController;

Route::get('/', function () {
    return view('Accueil');
});
Route::get('/test', function () {
    return view('test');
});

Route::post('/usagers/Connexion',
[App\Http\Controllers\UsagersController::class, 'Connexion'])->name('usagers.Connexion');


Route::post('/Deconnexion', 
[App\Http\Controllers\UsagersController::class, 'Deconnexion'])->name('usagers.Deconnexion');


Route::get('/geolocalisation/ville', [GeolocalisationController::class, 'obtenirVilleUtilisateur']);


Route::get('/compte', [UsagersController::class, 'ObtenirLieuxUsager'])->name('usagerLieux.afficher');


