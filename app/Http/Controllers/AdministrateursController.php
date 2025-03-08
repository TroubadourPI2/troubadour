<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsagerRequest;
use App\Models\Usager;
use App\Models\RoleUsager;
use App\Models\Statut;
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
        $validationDonnee = $request->validate([
            'recherche'        => 'nullable|string|max:64',
            'rechercheRole'    => 'nullable|integer|exists:RoleUsagers,id',
            'rechercheStatut'  => 'nullable|integer|exists:statuts,id',
            'per_page'         => 'nullable|integer|in:10,25,50,100',
        ]);
    
        $rechercheTexte  = trim($validationDonnee['recherche'] ?? '');
        $rechercheRole   = $validationDonnee['rechercheRole'] ?? null;
        $rechercheStatut = $validationDonnee['rechercheStatut'] ?? null;
        $perPage         = $validationDonnee['per_page'] ?? 10;
    
        $usagers = Usager::when($rechercheTexte, function ($requete) use ($rechercheTexte) {
                            $requete->where(function($q) use ($rechercheTexte) {
                                $q->where('nom', 'LIKE', '%' . $rechercheTexte . '%')
                                  ->orWhere('prenom', 'LIKE', '%' . $rechercheTexte . '%')
                                  ->orWhere('courriel', 'LIKE', '%' . $rechercheTexte . '%');
                            });
                        })
                        ->when($rechercheRole, function ($requete) use ($rechercheRole) {
                            $requete->where('role_id', $rechercheRole);
                        })
                        ->when($rechercheStatut, function ($requete) use ($rechercheStatut) {
                            $requete->where('statut_id', $rechercheStatut);
                        })
                        ->orderByRaw("role_id = 3 DESC")
                        ->orderByRaw("statut_id = 3 DESC")
                        ->paginate($perPage);
    
        return response()->json($usagers);
    }
    

    
    public function modifierUtilisateur(UsagerRequest $request, $id)
    {
   
    $usager = Usager::findOrFail($id);
    $usager->update([
        'role_id' => $request->role_id,
        'statut_id' => $request->statut_id,
    ]);

    return response()->json(['success' => true]);
    }

    public function ObtenirRolesEtStatuts()
    {
    $roles = RoleUsager::all();
    $statuts = Statut::all();

    return response()->json([
        'roles' => $roles,
        'statuts' => $statuts,
    ]);
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
