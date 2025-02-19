<?php

use App\Http\Controllers\LieuxController;
use App\Http\Controllers\UsagersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeolocalisationController;

Route::get('/', function () {
    return view('Accueil');
});
Route::get('/test', function () {
    return view('test');
});


Route::get('/geolocalisation/ville', [GeolocalisationController::class, 'obtenirVilleUtilisateur']);


Route::get('/compte', [UsagersController::class, 'ObtenirDonnesAfficherLieux'])->name('usagerLieux.afficher');
Route::get('/compte/obtenirQuartiers', [UsagersController::class, 'ObtenirQuartiersParVille']);
Route::post('/compte/ajouterLieu', [UsagersController::class, 'AjouterUnLieu'])->name('usagerLieux.ajouterLieu');


