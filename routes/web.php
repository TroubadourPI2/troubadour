<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('accueil');
});

Route::get('/zoom', function () {
    return view('zoomLieu');
});

//! [LieuxControlleur::class, 'zoom'])->name('Lieu.zoom');