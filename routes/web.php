<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateursController;


Route::get('/', function () {
    return view('accueil');
});

// Route::post('/check-email', [UtilisateursController::class, 'checkEmail']);

Route::post('/connexion', [UtilisateurController::class, 'connexion'])->name('connexion');
