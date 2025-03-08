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


        Route::get('/lieu/zoom/{id}', [LieuxController::class, 'ZoomLieu'])->name('Lieu.zoom');

        Route::get('/activite/zoom/{id}/{idLieu}', [ActivitesController::class, 'ZoomActivite'])->name('Activite.zoom');

        Route::post('/ajoutFavoriLieu', [UsagersController::class, 'AjouterFavorisLieu'])->name('ajouter.favoris.lieu');  
        Route::post('/ajoutFavoriActivite', [UsagersController::class, 'AjouterFavorisActivite'])->name('ajouter.favoris.activite');  

        Route::post('/deleteFavoriLieu/{id}', [UsagersController::class, 'SupprimerFavorisLieu'])->name('delete.favoris.lieu');        
        Route::post('/deleteFavoriActivite/{id}', [UsagersController::class, 'SupprimerFavorisActivite'])->name('delete.favoris.activite');        

        Route::get('/geolocalisation/ville', [GeolocalisationController::class, 'ObtenirVilleUtilisateur']);

        Route::get('/compte', [UsagersController::class, 'ObtenirDonneesCompte'])->name('usagerLieux.afficher')->middleware('VerifierRole:Admin,Utilisateur,Gestionnaire');
        Route::patch('/compte/{usager}/modifier', [UsagersController::class, 'ModificationUsager'])->name('usagers.modifier')->middleware('VerifierRole:Admin,Utilisateur,Gestionnaire');
        Route::patch('/compte/{usager}/suppression', [UsagersController::class, 'Suppression'])->name('usagers.suppression')->middleware('VerifierRole:Admin,Utilisateur,Gestionnaire');

        //LIEUX (GESTIONNAIRE)
        Route::get('/compte/obtenirQuartiers', [UsagersController::class, 'ObtenirQuartiersParVille']);
        Route::post('/compte/ajouterLieu', [LieuxController::class, 'AjouterUnLieu'])->name('usagerLieux.ajouterLieu')->middleware('VerifierRole:Admin,Gestionnaire');
        Route::get('/compte/obtenirLieu', [LieuxController::class, 'ObtenirUnLieu']);
        Route::put('/compte/modifierLieu/{id}', [LieuxController::class, 'ModifierUnLieu'])->name('usagerLieux.modifierLieu')->middleware('VerifierRole:Admin,Gestionnaire');
        Route::delete('/compte/supprimerLieu/{id}', [LieuxController::class, 'SupprimerUnLieu'])->middleware('VerifierRole:Admin,Gestionnaire');
        Route::patch('/compte/changerEtatLieu/{id}', [LieuxController::class, 'ChangerEtatLieu'])->name('usagerLieux.changerEtatLieu')->middleware('VerifierRole:Admin,Gestionnaire');

        //ACTIVITES
        Route::post('/compte/ajouterActivite', [ActivitesController::class, 'AjouterUneActivite'])->name('usagerActivites.ajouterActivite')->middleware('VerifierRole:Admin,Gestionnaire');
        Route::delete('/compte/supprimerActivites/{id}', [ActivitesController::class, 'SupprimerActivite'])->name('usagerActivites.supprimerActivite')->middleware('VerifierRole:Admin,Gestionnaire');
        Route::put('/compte/modifierActivites/{id}', [ActivitesController::class, 'ModifierActivite'])->name('usagerActivites.modifierActivite')->middleware('VerifierRole:Admin,Gestionnaire');
        Route::get('/compte/obtenirActivite/{activiteId}', [ActivitesController::class, 'ObtenirActivite'])->name('compte.obtenirActivite')->middleware('VerifierRole:Admin,Gestionnaire');
        Route::patch('compte/activite/statut/{id}', [ActivitesController::class, 'ModifierStatutActivite'])->name('usagerActivites.modifierStatutActivite')->middleware('VerifierRole:Admin,Gestionnaire');

        Route::get('/recherche', [LieuxController::class, 'index'])->name('lieux.recherche');

        Route::post('/recherche', [LieuxController::class, 'recherche'])->name('lieux.recherche2');

        Route::get('/quartiers', [LieuxController::class, 'quartiers'])->name('lieux.quartiers');


        //ADMIN
        Route::get('/admin', [AdministrateursController::class, 'Afficher'])->name('admin')->middleware('VerifierRole:Admin');
        Route::get('/admin/rechercheUsagers', [AdministrateursController::class, 'usagersPagination'])->name('admin.rechercheUsagers')->middleware('VerifierRole:Admin');
        Route::post('/admin/usagers/modifier/{id}', [AdministrateursController::class, 'modifierUsagers'])->name('admin.ModifierUsagers')->middleware('VerifierRole:Admin');
        Route::get('/admin/obtenirRoleStatut', [AdministrateursController::class, 'ObtenirRolesEtStatuts'])->middleware('VerifierRole:Admin');

        Route::get('/admin/recherche/lieux', [AdministrateursController::class, 'Recherche'])->name('adminLieux.recherche')->middleware('VerifierRole:Admin');
     

        Route::fallback(function () {
            return response()->view('Redirection.404', [], 404);
          });

       Route::get('/admin/429', [AdministrateursController::class, 'erreur'])->name('admin.erreur')->middleware('VerifierRole:Admin');

      
    });