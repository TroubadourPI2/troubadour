<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Lieu;
use App\Http\Requests\LieuRequest;
use Illuminate\Support\Facades\Log;

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
        $lieu = new Lieu();
        $lieu->rue = $request->rue;
        $lieu->noCivic = $request->noCivic;
        $lieu->codePostal = $request->codePostal;
        $lieu->nomEtablissement = $request->nomEtablissement;
        $lieu->photoLieu = $request->photoLieu;
        $lieu->siteWeb = $request->siteWeb;
        $lieu->numeroTelephone = $request->numeroTelephone;
        $lieu->actif = true;
        $lieu->description = $request->description;
        $lieu->quartier_id = $request->selectQuartierLieu;
        $lieu->typeLieu_id = $request->selectTypeLieu;
        //TODO aller chercher le id de l'usager connecté
        $lieu->proprietaire_id = 1;
        $lieu->save();
        
        //TODO doit rediriger vers la page d'affichage des lieux
        return redirect()->route('usagerLieux.afficher');
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
