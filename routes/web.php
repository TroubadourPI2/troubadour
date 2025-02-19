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

// Route::get('/compte', function () {
//     return view('usagers/afficher');
// });

Route::get('/compte', [UsagersController::class, 'ObtenirLieuxUsager'])->name('usagerLieux.afficher');

Route::get('/recherche', [LieuxController::class, 'index'])->name('lieux.recherche');

Route::post('/recherche', [LieuxController::class, 'recherche'])->name('lieux.recherche2');

Route::get('/quartiers', [LieuxController::class, 'quartiers'])->name('lieux.quartiers');