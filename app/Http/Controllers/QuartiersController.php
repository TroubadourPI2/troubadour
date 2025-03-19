<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuartierRequest;
use Illuminate\Http\Request;
use App\Models\Quartier;
use Illuminate\Support\Facades\Log;


class QuartiersController extends Controller
{
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
    public function AjouterUnQuartier(QuartierRequest $request)
    {

            $quartier = Quartier::create([
                'nom' => $request->nom,
                'actif' => $request->actif,
                'ville_id' => $request->ville_id,
            ]);
    
            return redirect()->back(); 
    }

    /**
     * Display the specified resource.
     */
    public function obtenirQuartier(string $quartierId)
    {
        try {
         
            $quartier = Quartier::findOrFail($quartierId);
    
            return response()->json([
                'success' => true,
                'data'    => $quartier
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Erreur lors de la récupération de l'activité : " . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function ModifierQuartier(QuartierRequest $request)
    {
        Log::info('Received request:', $request->all());
        $quartier = Quartier::where('id', $request->id)->firstOrFail();
        try{
                $quartier->nom = $request->nom;
                $quartier->actif = $request->actif;
                $quartier->ville_id = $request->ville_id;

                $quartier->save();
                return redirect()->route('admin'); 
            }
            catch(\Throwable $e){
                log::debug($e);
            }
            return redirect()->back(); 
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
    public function SupprimerQuartier(QuartierRequest $request)
    {
        $quartier = Quartier::find($request->id); // Utilisation de find() pour récupérer directement l'élément
    
        if (!$quartier) {
            return response()->json(['message' => __('validations.quartierNonTrouve')], 404);
        }
    
        $quartier->delete();
    
        return response()->json(['message' => __('strings.succesSupprimer')], 200);
    }
    
}
