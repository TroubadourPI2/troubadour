<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\GeolocalisationController;
use App\Http\Controllers\LieuxController;

Route::get('/', function () {
    return view('Accueil');
});
Route::get('/test', function () {
    return view('test');
});

Route::post('/usagers/Connexion',
[App\Http\Controllers\UsagersController::class, 'Connexion'])->name('usagers.Connexion');

// Route::post('logout', 
// [App\Http\Controllers\UsagersController::class, 'logout'])->name('logout');


Route::get('/lieu/zoom/{id}', [LieuxController::class, 'show'])->name('Lieu.zoom');

Route::get('/geolocalisation/ville', [GeolocalisationController::class, 'obtenirVilleUtilisateur']);

Route::get('/compte', [UsagersController::class, 'ObtenirLieuxUsager'])->name('usagerLieux.afficher');

Route::get('/recherche', [LieuxController::class, 'index'])->name('lieux.recherche');

Route::post('/recherche', [LieuxController::class, 'recherche'])->name('lieux.recherche2');

Route::get('/quartiers', [LieuxController::class, 'quartiers'])->name('lieux.quartiers');
