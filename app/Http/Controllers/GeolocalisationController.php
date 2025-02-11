<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeolocalisationController extends Controller
{
    public function obtenirVilleUtilisateur()
{
    $ip = request()->ip(); 

  
    if ($ip == "127.0.0.1") {
        $ip = "205.151.69.245"; 
    }

 
    $url = "http://ip-api.com/json/{$ip}?fields=status,city";
    $response = file_get_contents($url);
    $localisation = json_decode($response);

    if ($localisation && $localisation->status === "success") {
        return response()->json([
            'ville' => $localisation->city,
        ]);
    }

    return response()->json(['error' => 'Impossible de récupérer la localisation'], 400);
}

}
