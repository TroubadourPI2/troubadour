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
        $roles = RoleUsager::all(); 
        $statuts = Statut::all();
    
        return view('admin.afficher', compact('roles', 'statuts'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function UsagersPagination(Request $request)
    {
        $rechercheTexte  = trim($request->get('recherche'));
        $rechercheRole   = $request->get('rechercheRole');
        $rechercheStatut = $request->get('rechercheStatut');
        $perPage = $request->get('per_page', 10);
    
        $usagers = Usager::when($rechercheTexte, function ($query) use ($rechercheTexte) {
                        $query->where(function($q) use ($rechercheTexte) {
                            $q->where('nom', 'LIKE', '%' . $rechercheTexte . '%')
                              ->orWhere('prenom', 'LIKE', '%' . $rechercheTexte . '%')
                              ->orWhere('courriel', 'LIKE', '%' . $rechercheTexte . '%');
                        });
                    })
                    ->when($rechercheRole, function ($query) use ($rechercheRole) {
                        $query->where('role_id', $rechercheRole);
                    })
                    ->when($rechercheStatut, function ($query) use ($rechercheStatut) {
                        $query->where('statut_id', $rechercheStatut);
                    })
                    ->orderByRaw("role_id = 3 DESC")  
                    ->orderByRaw("statut_id = 3 DESC") 
                    ->paginate($perPage); 
    
        return response()->json($usagers);
    }
    

    
    public function modifierUtilisateur(UsagerRequest $request, $id)
{
   
    $usager = Usager::findOrFail($id);


    $request->validate([
        'role_id' => 'sometimes|exists:RoleUsagers,id',
        'statut_id' => 'sometimes|exists:Statuts,id',
    ]);

 
    $usager->update([
        'role_id' => $request->role_id,
        'statut_id' => $request->statut_id,
    ]);

    return response()->json(['success' => true]);
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
