<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\GeolocalisationController;
use App\Http\Controllers\LieuxController;
use App\Http\Controllers\ActivitesController;
use App\Http\Middleware\VerifierRole;

Route::get('/', function () {
    return view('Accueil');
})->name('login');

Route::get('/test', function () {
    return view('test');
});

Route::post('/usagers/Connexion',
[UsagersController::class, 'Connexion'])->name('usagers.Connexion');

// Route::post('logout', 
// [UsagersController::class, 'logout'])->name('logout');

Route::get('/lieu/zoom/{id}', [LieuxController::class, 'show'])->name('Lieu.zoom');

Route::get('/activite/zoom/{id}', [ActivitesController::class, 'show'])->name('Activite.zoom');

Route::get('/geolocalisation/ville', [GeolocalisationController::class, 'obtenirVilleUtilisateur']);
Route::get('/compte', [UsagersController::class, 'ObtenirDonneesCompte'])->name('usagerLieux.afficher') ->middleware('VerifierRole:Admin,Utilisateur,Gestionnaire');
Route::get('/compte/obtenirQuartiers', [UsagersController::class, 'ObtenirQuartiersParVille']);
Route::post('/compte/ajouterLieu', [LieuxController::class, 'AjouterUnLieu'])->name('usagerLieux.ajouterLieu');
Route::get('/compte/obtenirLieu', [LieuxController::class, 'ObtenirUnLieu']);
Route::put('/compte/modifierLieu/{id}', [LieuxController::class, 'ModifierUnLieu'])->name('usagerLieux.modifierLieu');




