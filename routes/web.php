<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\GeolocalisationController;
use App\Http\Controllers\LieuxController;
use App\Http\Controllers\ActivitesController;
use App\Http\Controllers\AdministrateursController;
use App\Http\Controllers\LanguesController;
use App\Http\Middleware\Langue;
use App\Http\Middleware\VerifierRole;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

Route::get('lang/{locale}', LanguesController::class)->name('langue');

Route::middleware(Langue::class)
    ->group(function () {
        Route::get('/', function () {
            return view('Accueil');
        })->name('login');

        Route::get('/test', function () {
            return view('test');
        });

        Route::post(
            '/usagers/Connexion',
            [UsagersController::class, 'Connexion']
        )->name('usagers.Connexion');

        Route::post(
            '/Deconnexion',
            [UsagersController::class, 'Deconnexion']
        )->name('usagers.Deconnexion')->middleware('auth');


        Route::get('/lieu/zoom/{id}', [LieuxController::class, 'show'])->name('Lieu.zoom');

        Route::get('/activite/zoom/{id}', [ActivitesController::class, 'show'])->name('Activite.zoom');

        Route::get('/geolocalisation/ville', [GeolocalisationController::class, 'obtenirVilleUtilisateur']);



        Route::get('/compte', [UsagersController::class, 'ObtenirDonneesCompte'])->name('usagerLieux.afficher')->middleware('VerifierRole:Admin,Utilisateur,Gestionnaire');
        Route::get('/compte/obtenirQuartiers', [UsagersController::class, 'ObtenirQuartiersParVille']);
        Route::post('/compte/ajouterLieu', [LieuxController::class, 'AjouterUnLieu'])->name('usagerLieux.ajouterLieu')->middleware('VerifierRole:Gestionnaire');
        Route::get('/compte/obtenirLieu', [LieuxController::class, 'ObtenirUnLieu']);
        Route::put('/compte/modifierLieu/{id}', [LieuxController::class, 'ModifierUnLieu'])->name('usagerLieux.modifierLieu')->middleware('VerifierRole:Gestionnaire');
        Route::delete('/compte/supprimerLieu/{id}', [LieuxController::class, 'SupprimerUnLieu'])->middleware('VerifierRole:Gestionnaire');

        Route::post('/compte/ajouterActivite', [ActivitesController::class, 'AjouterUneActivite'])->name('usagerActivites.ajouterActivite');

        Route::post('/compte/ajouterActivite', [ActivitesController::class, 'AjouterUneActivite'])->name('usagerActivites.ajouterActivite')->middleware('VerifierRole:Admin,Gestionnaire');;

        Route::get('/recherche', [LieuxController::class, 'index'])->name('lieux.recherche');

        Route::post('/recherche', [LieuxController::class, 'recherche'])->name('lieux.recherche2');

        Route::get('/quartiers', [LieuxController::class, 'quartiers'])->name('lieux.quartiers');

        Route::get('/admin', [AdministrateursController::class, 'afficher'])->name('admin')->middleware('VerifierRole:Admin');
    });
