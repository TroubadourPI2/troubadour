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


    public function SupprimerActivite(string $id)
    {
    try {
        $activite = Activite::findOrFail($id);

        // TODO CHANGER POUR PROD ACTIVITE
        foreach ($activite->photos as $photo) {
            \Storage::disk('DevActivite')->delete($photo->chemin);
        }

 
        $activite->delete();

        return response()->json(['success' => true, 'message' => 'Activité supprimée avec succès.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
    }


}
