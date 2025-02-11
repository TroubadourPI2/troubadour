<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeolocalisationController extends Controller
{
    public function getUserLocation()
{
    $ip = request()->ip(); 

  
    if ($ip == "127.0.0.1") {
        $ip = "8.8.8.8"; 
    }

 
    $url = "http://ip-api.com/json/{$ip}?fields=status,message,country,regionName,city,lat,lon";
    $response = file_get_contents($url);
    $localisation = json_decode($response);

    if ($localisation && $localisation->status === "success") {
        return response()->json([
            'ville' => $localisation->city,
            'regionAdministrative' => $localisation->regionName,
            'pays' => $localisation->country,
            'latitude' => $localisation->lat,
            'longitude' => $localisation->lon,
        ]);
    }

    return response()->json(['error' => 'Impossible de récupérer la localisation'], 400);
}

}
