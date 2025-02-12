<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('accueil');
});

Route::get('/compte', function () {
    return view('usagers/afficher');
});
