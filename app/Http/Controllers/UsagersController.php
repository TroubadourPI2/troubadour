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
}
