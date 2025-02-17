<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Utilisateur;

class UtilisateursController extends Controller
{


    public function connexion(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mdp' => 'required'
        ]);

        $usager = Utilisateur::where('email', $request->email)->first();

        if ($usager && Hash::check($request->mdp, $usager->mdp)) {
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
}
