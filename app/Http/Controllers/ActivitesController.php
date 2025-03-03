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
                ->with('success');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', "Erreur lors de l'ajout de l'activité : " . $e->getMessage());
        }
    }


    public function SupprimerActivite(string $id)
    {
    try {
        $activite = Activite::findOrFail($id);
        $utilisateur = auth()->user(); 
        $estAdmin = $utilisateur->role->nom === 'admin';
        $estProprietaire = $activite->lieux()->where('proprietaire_id', $utilisateur->id)->exists();
        if (!$estProprietaire && !$estAdmin) {
            return response()->json(['success' => false, 'message' => 'Accès refusé.'], 403);
        }
        // TODO CHANGER POUR PROD ACTIVITE
        foreach ($activite->photos as $photo) {
            \Storage::disk('DevActivite')->delete($photo->chemin);
        }

 
        $activite->delete();

        return response()->json(['success' => true,]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
    }

    public function ModifierActivite(ActiviteRequest $request, string $id)
    {
        try {
            $activite = Activite::findOrFail($id);
            $utilisateur = auth()->user(); 
            $estAdmin = $utilisateur->role->nom === 'admin';
            $estProprietaire = $activite->lieux()->where('proprietaire_id', $utilisateur->id)->exists();
            if (!$estProprietaire && !$estAdmin) {
                return response()->json(['success' => false, 'message' => 'Accès refusé.'], 403);
            }
            $activite->update([
                'nom'             => $request->nomActivite,
                'description'     => $request->descriptionActivite,
                'typeActivite_id' => $request->typeActivite_id,
                'dateDebut'       => $request->dateDebut,
                'dateFin'         => $request->dateFin,
           
            ]);

     
            if ($request->has('lieu_id')) {
                $activite->lieux()->sync($request->lieu_id);
            }

        
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $index => $photoFile) {
                
                    $chemin = $photoFile->store('activites', 'DevActivite');
                    $position = $request->input("photos.$index.position", null);

                    Photo::create([
                        'chemin'      => $chemin,
                        'position'    => $position,
                        'activite_id' => $activite->id,
                        'nom'         => $photoFile->getClientOriginalName(),
                    ]);
                }
            }

            if ($request->has('positionsActuelles')) {
                foreach ($request->positionsActuelles as $photoId => $nouvellePosition) {
                    $photo = Photo::find($photoId);
                    if ($photo) {
                        $photo->update(['position' => $nouvellePosition]);
                    }
                }
            }

       
            if ($request->has('photos_a_supprimer')) {
                $photosASupprimer = $request->photos_a_supprimer;
                foreach ($photosASupprimer as $photoId) {
                    $photo = Photo::find($photoId);
                    if ($photo) {
                        \Storage::disk('DevActivite')->delete($photo->chemin);
                        $photo->delete();
                    }
                }
            }

            session()->flash('formulaireModifierActiviteValide', 'true');
            return redirect()->route('usagerLieux.afficher')
                ->with('success',);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', "Erreur lors de la modification de l'activité : " . $e->getMessage());
        }
    }
    public function ObtenirActivite(string $activiteId)
    {
        try {
         
            $activite = Activite::with(['photos', 'lieux', 'typeActivite'])->findOrFail($activiteId);
    
            return response()->json([
                'success' => true,
                'data'    => $activite
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Erreur lors de la récupération de l'activité : " . $e->getMessage()
            ], 500);
        }
    }

    public function ModifierStatutActivite(ActiviteRequest $request, string $id)
{
    try {
   
        $activite = Activite::findOrFail($id);
        $utilisateur = auth()->user(); 
        $estAdmin = $utilisateur->role->nom === 'admin';
        $estProprietaire = $activite->lieux()->where('proprietaire_id', $utilisateur->id)->exists();
        if (!$estProprietaire && !$estAdmin) {
            return response()->json(['success' => false, 'message' => 'Accès refusé.'], 403);
        }

        $activite->update([
            'actif' => $request->boolean('actif'),
        ]);

        session()->flash('formulaireModifierActiviteStatutValide', 'true');
        return response()->json(['success' => true,]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => "Erreur lors de la mise à jour du statut de l'activité : " . $e->getMessage()
        ], 500);
    }

}


public function show(string $id, string $idLieu)
{
    $activite = Activite::findOrFail($id);
    $lieu = Lieu::findOrFail($idLieu);

    return view('zoomActivite', compact('activite', 'lieu'));
}
}