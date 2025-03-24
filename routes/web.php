<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\GeolocalisationController;
use App\Http\Controllers\LieuxController;
use App\Http\Controllers\ActivitesController;
use App\Http\Controllers\AdministrateursController;
use App\Http\Controllers\LanguesController;
use App\Http\Controllers\QuartiersController;
use App\Http\Middleware\Langue;
use App\Http\Middleware\VerifierRole;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
Route::get('lang/{locale}', LanguesController::class)->name('langue');

Route::middleware(Langue::class)
    ->group(function () {
        Route::get('/', function () {
            return view('accueil');
        })->name('login');


        Route::post(
            '/Deconnexion',
            [UsagersController::class, 'Deconnexion']
        )->name('usagers.Deconnexion')->middleware('auth');

        Route::get('/geolocalisation/ville', [GeolocalisationController::class, 'ObtenirVilleUtilisateur']);


        //USAGERS
        Route::get('/compte', [UsagersController::class, 'ObtenirDonneesCompte'])->name('usagerLieux.afficher')->middleware('VerifierRole:Admin,Utilisateur,Gestionnaire');
        Route::put('/compte/{usager}/modifier', [UsagersController::class, 'ModificationUsager'])->name('usagers.modifier')->middleware('VerifierRole:Admin,Utilisateur,Gestionnaire');
        Route::patch('/compte/{usager}/suppression', [UsagersController::class, 'Suppression'])->name('usagers.suppression')->middleware('VerifierRole:Admin,Utilisateur,Gestionnaire');
        Route::post('/ajoutFavoriLieu', [UsagersController::class, 'AjouterFavorisLieu'])->name('ajouter.favoris.lieu');  
        Route::post('/ajoutFavoriActivite', [UsagersController::class, 'AjouterFavorisActivite'])->name('ajouter.favoris.activite');  
        Route::post('/deleteFavoriLieu/{id}', [UsagersController::class, 'SupprimerFavorisLieu'])->name('delete.favoris.lieu');        
        Route::post('/deleteFavoriActivite/{id}', [UsagersController::class, 'SupprimerFavorisActivite'])->name('delete.favoris.activite');  
        Route::post('/usagers/Connexion',[UsagersController::class, 'Connexion'])->name('usagers.Connexion')->middleware(['guest', 'throttle:10,15']);
        Route::post('/usagers', [UsagersController::class, 'CreationUsager'])->name('usagers.CreationUsager')->middleware(['guest', 'throttle:10,20']);      

       

        //LIEUX (GESTIONNAIRE)
        Route::get('/compte/obtenirQuartiers', [UsagersController::class, 'ObtenirQuartiersParVille']);
        Route::post('/compte/ajouterLieu', [LieuxController::class, 'AjouterUnLieu'])->name('usagerLieux.ajouterLieu')->middleware('VerifierRole:Admin,Gestionnaire')->middleware('throttle:10,30');
        Route::get('/compte/obtenirLieu', [LieuxController::class, 'ObtenirUnLieu']);
        Route::get('/lieu/zoom/{id}', [LieuxController::class, 'ZoomLieu'])->name('Lieu.zoom');
        Route::put('/compte/modifierLieu/{id}', [LieuxController::class, 'ModifierUnLieu'])->name('usagerLieux.modifierLieu')->middleware('VerifierRole:Admin,Gestionnaire')->middleware('throttle:10,30');
        Route::delete('/compte/supprimerLieu/{id}', [LieuxController::class, 'SupprimerUnLieu'])->middleware('VerifierRole:Admin,Gestionnaire');
        Route::patch('/compte/changerEtatLieu/{id}', [LieuxController::class, 'ChangerEtatLieu'])->name('usagerLieux.changerEtatLieu')->middleware('VerifierRole:Admin,Gestionnaire');

        //ACTIVITES
        Route::post('/compte/ajouterActivite', [ActivitesController::class, 'AjouterUneActivite'])->name('usagerActivites.ajouterActivite')->middleware('VerifierRole:Admin,Gestionnaire')->middleware('throttle:10,30');
        Route::delete('/compte/supprimerActivites/{id}', [ActivitesController::class, 'SupprimerActivite'])->name('usagerActivites.supprimerActivite')->middleware('VerifierRole:Admin,Gestionnaire');
        Route::put('/compte/modifierActivites/{id}', [ActivitesController::class, 'ModifierActivite'])->name('usagerActivites.modifierActivite')->middleware('VerifierRole:Admin,Gestionnaire')->middleware('throttle:10,30');;
        Route::get('/compte/obtenirActivite/{activiteId}', [ActivitesController::class, 'ObtenirActivite'])->name('compte.obtenirActivite')->middleware('VerifierRole:Admin,Gestionnaire');
        Route::patch('compte/activite/statut/{id}', [ActivitesController::class, 'ModifierStatutActivite'])->name('usagerActivites.modifierStatutActivite')->middleware('VerifierRole:Admin,Gestionnaire');
        Route::get('/activite/zoom/{id}/{idLieu}', [ActivitesController::class, 'ZoomActivite'])->name('Activite.zoom');


        // RECHERCHE ( + HISTORIQUE)
        Route::get('/recherche', [LieuxController::class, 'Index'])->name('lieux.recherche');
        Route::get('/recherche/reset', [LieuxController::class, 'Reset'])->name('lieux.rechercheReset');
        Route::get('/recherche/{idQuartier}', [LieuxController::class, 'IndexPrecis'])->name('lieux.recherchePrecis')->middleware(('throttle:10,1'));
        Route::delete('/recherche/supprimer/{id}', [LieuxController::class, 'supprimerRecherche'])->name('recherche.supprimer')->middleware('VerifierRole:Admin, throttle:10,1');
        Route::post('/recherche', [LieuxController::class, 'Recherche'])->name('lieux.recherche2');
        Route::get('/quartiers', [LieuxController::class, 'Quartiers'])->name('lieux.quartiers');

        //ADMIN
        Route::get('/admin', [AdministrateursController::class, 'Afficher'])->name('admin')->middleware('VerifierRole:Admin');
        Route::get('/admin/rechercheUsagers', [AdministrateursController::class, 'usagersPagination'])->name('admin.rechercheUsagers')->middleware('VerifierRole:Admin');
        Route::post('/admin/usagers/modifier/{id}', [AdministrateursController::class, 'modifierUsagers'])->name('admin.ModifierUsagers')->middleware('VerifierRole:Admin');
        Route::get('/admin/obtenirRoleStatut', [AdministrateursController::class, 'ObtenirRolesEtStatuts'])->middleware('VerifierRole:Admin');
        Route::get('/admin/villes', [AdministrateursController::class, 'ObtenirVille'])->name('admin.Villes')->middleware('VerifierRole:Admin');
        Route::get('/admin/quartiers', [AdministrateursController::class, 'ObtenirQuartier'])->name('admin.Quartiers')->middleware('VerifierRole:Admin');
        Route::get('/admin/recherche/lieux', [AdministrateursController::class, 'Recherche'])->name('adminLieux.recherche')->middleware('VerifierRole:Admin');

        //QUARTIER
        Route::post('/admin/ajouterQuartier', [QuartiersController::class, 'AjouterUnQuartier'])->name('ajouter.quartier')->middleware('VerifierRole:Admin');
        Route::patch('/admin/modifierQuartier', [QuartiersController::class, 'ModifierQuartier'])->name('modifier.quartier')->middleware('VerifierRole:Admin');
        Route::delete('/admin/supprimerQuartier', [QuartiersController::class, 'SupprimerQuartier'])->name('supprimer.quartier')->middleware('VerifierRole:Admin');  
        Route::get('/compte/obtenirQuartier/{quartierId}', [QuartiersController::class, 'ObtenirQuartier'])->name('compte.obtenirQuartier')->middleware('VerifierRole:Admin,Gestionnaire');
     
        Route::get('/debug-proxy', function () {
            return response()->json(['remote_addr' => $_SERVER['REMOTE_ADDR']]);
        });
        Route::get('/debug-headers', function (Request $request) {
            dd($request->headers->all());
        });
        // Route::fallback(function () {
        //     return response()->view('Redirection.404', [], 404);
        //   });
    });