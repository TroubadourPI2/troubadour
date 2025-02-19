<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usager;
use App\Models\Lieu;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UsagersController extends Controller
{

    public function Connexion(Request $request)
    {
        $usager = Usager::where('courriel', $request->courriel)->where('statutId', 1)->first();

        
        if ($usager && Hash::check($request->password, $usager->password)) {
            session(['ID_Usager' => $usager->id]);

            return response()->json(['success' => true, 'ID_Usager' => $usager->id]);
        }
      
        
        return response()->json(['success' => false]);
    }

    public function ObtenirLieuxUsager(){
        //TODO Changer la fonction pour variable selon id du responsable connecté
        $lieuxUsager = Lieu::where('proprietaireId', 1)->get();

        return View('usagers.afficher', compact('lieuxUsager'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
