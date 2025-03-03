<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\LieuActivite;
use App\Models\Lieu;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Models\TypeActivite;
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
        
            $activite = Activite::create([
                'nom'             => $request->nomActivite,
                'description'     => $request->descriptionActivite,
                'typeActivite_id' => $request->typeActivite_id,
                'dateDebut'       => $request->dateDebut,
                'dateFin'         => $request->dateFin,
                'actif'           => true, 
            ]);

        
            if ($request->has('lieu_id')) {
                foreach ($request->lieu_id as $lieuId) {
                    LieuActivite::create([
                        'activite_id' => $activite->id,
                        'lieu_id'     => $lieuId,
                    ]);
                }
            }

    
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $index => $photoFile) {

                //TODO REMPLACER PAR ProdActivite 
                    $chemin = $photoFile->store('activites', 'DevActivite');
                

                
                    $position = $request->input("photos.$index.position", null);
        

                    
                    $photoCreated = Photo::create([
                        'chemin'      => $chemin,
                        'position'    => $position,
                        'activite_id' => $activite->id,
                        'nom'         => $photoFile->getClientOriginalName(), 
                    ]);
            
                }
            }
            session()->flash('formulaireAjoutActiviteValide', 'true');
            return redirect()->route('usagerLieux.afficher')
                ->with('success', 'Activité ajoutée avec succès !');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', "Erreur lors de l'ajout de l'activité : " . $e->getMessage());
        }
    }

    public function show(string $id, string $idLieu)
    {
        $activite = Activite::findOrFail($id);
        $lieu = Lieu::findOrFail($idLieu);

        return view('zoomActivite', compact('activite', 'lieu'));
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
