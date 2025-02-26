<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lieu;
use App\Models\Photo;
use App\Models\Activite;
use App\Models\TypeActivite;
use App\Models\LieuActivite;
use App\Http\Requests\ActiviteRequest;
class ActivitesController extends Controller
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

    public function AjouterUneActivite(ActiviteRequest $request)
    {

        try {
        
            $validated = $request->validated();
    
          
            $activite = Activite::create([
                'nom'                => $validated['nom'],
                'descriptionActivite'=> $validated['descriptionActivite'] ?? null,
                'typeActivite_id'    => $validated['typeActivite_id'],
                'lieu_id'            => $validated['lieu_id'],
                'trip_start'         => $validated['trip-start'],
                'trip_end'           => $validated['trip-end'],
            ]);
    
        
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $index => $photo) {
              
                    $path = $photo->store('activites', 'DevActivite');
    
                   
              
                    $position = $validated['positions'][$index] ?? null;
    
                    $activite->photos()->create([
                        'path'     => $path,
                        'position' => $position,
                    ]);
                }
            }
    
            return redirect()->route('activites.index')->with('success', 'Activité ajoutée avec succès !');
        } catch (\Exception $e) {
          
            return redirect()->back()->with('error', "Erreur lors de l'ajout de l'activité : " . $e->getMessage());
        }
    }
    public function store()
    {
    }
    
    /**
     * Store a newly created resource in storage.
     */
 
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('zoomActivite');
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
