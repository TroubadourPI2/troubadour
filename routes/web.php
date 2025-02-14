<?php

use App\Http\Controllers\LieuxController;
use App\Http\Controllers\UsagersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('accueil');
});

// Route::get('/compte', function () {
//     return view('usagers/afficher');
// });

Route::get('/compte', [UsagersController::class, 'ObtenirLieuxUsager'])->name('usagerLieux.afficher');
