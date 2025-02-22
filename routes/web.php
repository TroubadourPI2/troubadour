<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\GeolocalisationController;
use App\Http\Controllers\LieuxController;
use App\Http\Middleware\VerifierRole;

Route::get('/', function () {
    return view('Accueil');
})->name('login');

Route::get('/test', function () {
    return view('test');
});

Route::post('/usagers/Connexion',
[App\Http\Controllers\UsagersController::class, 'Connexion'])->name('usagers.Connexion');

// Route::post('logout', 
// [App\Http\Controllers\UsagersController::class, 'logout'])->name('logout');

Route::get('/lieu/zoom/{id}', [LieuxController::class, 'show'])->name('Lieu.zoom');

Route::get('/geolocalisation/ville', [GeolocalisationController::class, 'obtenirVilleUtilisateur']);
Route::get('/compte', [UsagersController::class, 'ObtenirDonneesCompte'])->name('usagerLieux.afficher') ->middleware('VerifierRole:Admin,Utilisateur,Gestionnaire');
Route::get('/compte/obtenirQuartiers', [UsagersController::class, 'ObtenirQuartiersParVille']);
Route::post('/compte/ajouterLieu', [LieuxController::class, 'AjouterUnLieu'])->name('usagerLieux.ajouterLieu');




