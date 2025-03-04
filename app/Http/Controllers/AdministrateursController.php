<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsagerRequest;
use App\Models\Usager;
class AdministrateursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function afficher()
    {
        return view('admin.afficher');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function UsagersPagination(Request $request)
    {

            $requete = trim($request->get('recherche'));
    
            $usagers = Usager::when($requete, function ($requetePerso) use ($requete) {
                    $requetePerso->where('nom', 'LIKE', '%' . $requete . '%')
                                 ->orWhere('prenom', 'LIKE', '%' . $requete . '%')
                                 ->orWhere('courriel', 'LIKE', '%' . $requete . '%');
                })
                ->orderByRaw("role_id = 3 DESC")   
                ->orderByRaw("statut_id = 3 DESC") 
                ->paginate(10);
    
            return response()->json($usagers);
  
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
