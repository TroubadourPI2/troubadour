<?php

namespace App\Http\Controllers;

use App\Models\Lieu;
use App\Models\Quartier;
use Illuminate\Http\Request;
use App\Http\Requests\LieuRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //$lieu = Lieu::all();
        $lieuActuel = Lieu::findOrFail($id);


        return view('zoomLieu', compact('lieuActuel'));
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
    public function ModificationUnLieu(LieuRequest $request, string $id)
    {
        $lieu = Lieu::where('id', $id)->firstorFail();
        try {
            $lieu->rue = $request->rue;
            $lieu->noCivic = $request->noCivic;
            $lieu->codePostal = $request->codePostal;
            $lieu->nomEtablissement = $request->nomEtablissement;
            //TODO Trouver comment stocker les images
            $lieu->photoLieu = 'Images/lieux/image_defaut.png';
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
