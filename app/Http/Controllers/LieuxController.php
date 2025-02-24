<?php

namespace App\Http\Controllers;

use App\Models\Lieu;
use App\Models\Quartier;
use Illuminate\Http\Request;
use App\Http\Requests\LieuRequest;
use App\Http\Requests\LieuModifierRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LieuxController extends Controller
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
    public function AjouterUnLieu(LieuRequest $request)
    {
        try {
            $lieu = new Lieu();
            $lieu->rue = $request->rue;
            $lieu->noCivic = $request->noCivic;
            $lieu->codePostal = (strtoupper($request->codePostal));
            $lieu->nomEtablissement = $request->nomEtablissement;
            //TODO Trouver comment stocker les images
            if ($request->hasFile('photoLieu')) {
                $file = $request->file('photoLieu');

                if ($file->isValid()) {
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time() . '_' . Str::slug($originalName) . '.' . $extension;

                    $file->move(public_path('Images/lieux'), $fileName);

                    $lieu->photoLieu = 'Images/lieux/' . $fileName;
                }
            } else {
                $lieu->photoLieu = 'Images/lieux/image_defaut.png';
            }

            $lieu->siteWeb = $request->siteWeb;
            $lieu->numeroTelephone = $request->numeroTelephone;
            $lieu->actif = true;
            $lieu->description = $request->description;
            $lieu->quartier_id = $request->selectQuartierLieu;
            $lieu->typeLieu_id = $request->selectTypeLieu;
            $lieu->proprietaire_id = Auth::id();
            $lieu->save();

            session()->flash('formulaireValide', 'true');
            return redirect()->route('usagerLieux.afficher');
        } catch (\Exception $e) {
            Log::error("Erreur lors de l'ajout d'un lieu: " . $e->getMessage());
            return redirect()->route('usagerLieux.afficher');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lieuActuel = Lieu::findOrFail($id);
        return view('zoomLieu', compact('lieuActuel'));
    }

    public function ObtenirUnLieu(Request $request)
    {
        $lieuId = $request->query('lieu_id'); 

        if (!$lieuId) {
            return response()->json([], 400); 
        }

        $lieu = Lieu::find($lieuId); 

        if (!$lieu) {
            return response()->json(['error' => 'Lieu non trouvé'], 404); 
        }

        return response()->json($lieu); 
    }


    /**
     * Update the specified resource in storage.
     */
    public function ModifierUnLieu(LieuRequest $request, string $id)
    {
        $lieu = Lieu::findOrFail($id);
        try {
            $lieu->rue = $request->rue;
            $lieu->noCivic = $request->noCivic;
            $lieu->codePostal = $request->codePostal;
            $lieu->nomEtablissement = $request->nomEtablissement;
             //TODO Trouver comment stocker les images
            if ($request->hasFile('photoLieu')) {
                $file = $request->file('photoLieu');
    
                if ($file->isValid()) {
                    if ($lieu->photoLieu && $lieu->photoLieu !== 'Images/lieux/image_defaut.png' && file_exists(public_path($lieu->photoLieu))) {
                        unlink(public_path($lieu->photoLieu));
                    }
    
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time() . '_' . Str::slug($originalName) . '.' . $extension;
    
                    $file->move(public_path('Images/lieux'), $fileName);
    
                    $lieu->photoLieu = 'Images/lieux/' . $fileName;
                }
            }
            $lieu->siteWeb = $request->siteWeb;
            $lieu->numeroTelephone = $request->numeroTelephone;
            $lieu->description = $request->description;
            $lieu->quartier_id = $request->selectQuartierLieu;
            $lieu->typeLieu_id = $request->selectTypeLieu;
           $lieu->save();

            session()->flash('formulaireModifierValide', 'true');
            return redirect()->route('usagerLieux.afficher');
        } catch (\Exception $e) {
            Log::error("Erreur lors de la modification d'un lieu: " . $e->getMessage());
            return redirect()->route('usagerLieux.afficher');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
