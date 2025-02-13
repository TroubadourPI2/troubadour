<?php

use App\Http\Controllers\LieuxController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('accueil');
});

Route::get('/recherche', 
[LieuxController::class, 'index']);