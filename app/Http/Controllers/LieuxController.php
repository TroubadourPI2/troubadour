<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lieu;
use Illuminate\Http\Request;

class LieuxController extends Controller
{
    public function index(){
        $lieux = Lieu::all();
        $villes = Lieu::all()->unique('quartierId');

        return View('recherche', compact('lieux', 'villes'));
    }
}
