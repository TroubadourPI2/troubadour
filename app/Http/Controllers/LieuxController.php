<?php

namespace App\Http\Controllers;

use App\Models\Lieu;
use App\Models\LieuActivite;
use App\Models\Activite;
use Illuminate\Http\Request;
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
        $lieuActuel = Lieu::Where("id", $id)->first();
        $quartier = $lieuActuel->quartier->first();
        $type = $lieuActuel->typeLieu->first();
        $activites = LieuActivite::Where("lieu_id", $id)->get();
        

        Log::debug($activites);

        return view('zoomLieu', compact('lieuActuel', 'quartier', 'type', 'activites'));
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
