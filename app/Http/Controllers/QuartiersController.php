<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuartierRequest;
use Illuminate\Http\Request;
use App\Models\Quartier;

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
