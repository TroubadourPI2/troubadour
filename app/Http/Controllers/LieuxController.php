<?php

namespace App\Http\Controllers;

use App\Models\Lieu;
use App\Models\Quartier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Ville;
use Exception;
use Illuminate\Database\QueryException;

class LieuxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $lieux = Lieu::paginate(10);
            $villes = Ville::all();
            $ville = -1;
            return view('recherche', compact('lieux', 'villes', 'ville'));
        }
        catch(\Exception $e){
            Log::debug("MANUEL - Erreur lors de la récupération des lieux : " . $e->getMessage());
            return View('accueil');
        }
        catch(QueryException $e){
            Log::debug("MANUEL - Erreur lors de la récupération des lieux : " . $e->getMessage());
            return View('accueil');
        }
    }

    public function recherche(Request $request)
    {
        try
        {
            $ville      = $request->ville;
            $quartier   = $request->quartier;
            $recherche  = $request->txtRecherche;
            $lieux      = Lieu::paginate(10);



            if(isset($request->quartier)){
                $quartier   = $request->quartier;
                $lieux      = Lieu::where('quartier_id', $request->quartier)->paginate(10);
            }



            if(isset($request->quartier) && isset($request->txtRecherche)){
                $quartier   = $request->quartier;
                $recherche  = $request->txtRecherche;
                $lieux      = Lieu::where('quartier_id', $request->quartier)->where('nomEtablissement', 'like', "%$recherche%")->paginate(10);
            }
            
            if(isset($request->ville)){
                Log::debug("Ville : " . $request->ville);
                $ville = $request->ville;
            }
            
            $villes     = Ville::all();
            $quartiers  = Quartier::where('ville_id', $ville)->get();

            return view('recherche', compact('lieux', 'ville', 'quartier', 'recherche', 'villes', 'quartiers'));
        }
        catch(\Exception $e){
            Log::debug("MANUEL - Erreur lors de la récupération des lieux : " . $e->getMessage());
            return view('recherche', compact('ville'))->with('error', 'Une erreur est survenue lors de la recherche');
        }

    }

    public function quartiers(Request $request)
    {
        $villeId    = $request->villeId;
        $quartiers  = Quartier::where('ville_id', $villeId)->get();
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
