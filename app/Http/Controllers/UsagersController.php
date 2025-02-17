<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsagersController extends Controller
{

    public function connexion(Request $request)
    {
        $request->validate([
            'courriel' => 'required|courriel',
            'password' => 'required'
        ]);

        $usager = Utilisateur::where('courriel', $request->courriel)->first();

        if ($usager && Hash::check($request->password, $usager->password)) {
            Auth::login($usager);
            return response()->json(['success' => true, 'message' => 'Connexion réussie!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Identifiants invalides.'], 401);
        }
    }

    // public function checkEmail(Request $request)
    // {
    //     $email = $request->input('email');
        
    //     $exists = Utilisateur::where('email', $email)->exists();

    //     return response()->json(['exists' => $exists]);
    // }

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
