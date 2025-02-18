<?php

namespace App\Http\Controllers;

use App\Models\Lieu;
use App\Models\Quartier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Ville;


class LieuxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lieux = Lieu::all();
        $villes = Ville::all();
        $ville = -1;
        return view('recherche', compact('lieux', 'villes', 'ville'));
    }

    public function recherche(Request $request)
    {
        $ville = $request->ville;
        $quartier = $request->quartier;
        $recherche = $request->txtRecherche;

        if(isset($request->txtRecherche)){
            Log::debug("Recherche : " . $request->txtRecherche);
            $recherche = $request->txtRecherche;
            $lieux = Lieu::where('nomEtablissement', 'like', "%$recherche%")->get();
        }
        else{
            $lieux = Lieu::all();
        }

        if(isset($request->quartier)){
            Log::debug("Quartier : " . $request->quartier);
            $quartier = $request->quartier;
            $lieux = $lieux->where('quartierId', $request->quartier);
        }

        if(isset($request->ville)){
            Log::debug("Ville : " . $request->ville);
            $ville = $request->ville;
        }

        $villes = Ville::all();

        Log::debug("Ville : $ville, Quartier : $quartier, Recherche : $recherche");

        $quartiers = Quartier::where('villeId', $ville)->get();
        Log::debug("Liste des quartiers : $quartiers");

        return view('recherche', compact('lieux', 'ville', 'quartier', 'recherche', 'villes', 'quartiers'));
    }

    public function quartiers(Request $request)
    {
        $villeId = $request->villeId;
        $quartiers = Quartier::where('villeId', $villeId)->get();
        Log::debug("Liste des quartiers : $quartiers");
        return compact('quartiers');
        
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
