<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ville;
use App\Models\Lieu;
use Illuminate\Support\Facades\Log;

class GeolocalisationController extends Controller
{
    public function ObtenirVilleUtilisateur(Request $request)
    {
        $validated = $request->validate([
            'ip' => 'required|ip'
        ]);
    
        $ip = $validated['ip'];
        Log::debug($ip);
        //TODO A RETIRER UNE FOIS EN PROD Tester en developpement local
        // if ($ip === "127.0.0.1") {
        //     $ip = "205.151.69.245"; 
        // }
        //205.151.69.245 TR
        //62.210.111.58  Paris
        //207.134.102.142 MTL
        //62.210.189.175 toulouse pas dans la bd

      
        $url = "http://ip-api.com/json/{$ip}?fields=status,city,country&lang=fr";
        $response = file_get_contents($url);
        $localisation = json_decode($response);
        error_log(print_r($localisation, true));

        if ($localisation && $localisation->status === "success") {

           
            $ville = Ville::where('nom', $localisation->city)
                          ->where('actif', true)
                          ->first();

            if ($ville) {
            
                $lieux = Lieu::join('Quartiers', 'Lieux.quartier_id', '=', 'Quartiers.id')
                    ->join('Villes', 'Quartiers.ville_id', '=', 'Villes.id')
                    ->where('Villes.id', $ville->id)
                    ->where('Lieux.actif', true)
                    ->orderBy('Lieux.created_at', 'desc')
                    ->select('Lieux.*')
                    ->take(9)
                    ->get();

                return response()->json([
                    'ville' => $ville->nom,
                    'lieux' => $lieux,
                ]);
            } else {
              
                return response()->json([
                    'message' => "Voir d'autres villes"
                ]);
            }
        }

        return response()->json(['error' => 'Impossible de récupérer la localisation'], 400);
    }
}
