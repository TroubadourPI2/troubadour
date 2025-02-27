<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\LieuActivite;
use App\Models\Lieu;
use App\Models\Photo;
use Illuminate\Http\Request;

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
        $activite = Activite::findOrFail($id);
        $idLieu = LieuActivite::Where("lieu_id", $id)->pluck("lieu_id");
        $lieu = Lieu::whereIn("id", $idLieu)->where('actif', 1)->first();
        $photo = Photo::where("activite_id", $id)->pluck("chemin")->first();


        return view('zoomActivite', compact('activite', 'lieu', 'photo'));
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
