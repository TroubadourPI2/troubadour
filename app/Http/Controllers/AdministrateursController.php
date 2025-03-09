<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lieu;
use App\Models\Ville;
use App\Models\TypeLieu;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UsagerRequest;
use App\Models\Usager;
use App\Models\RoleUsager;
use App\Models\Statut;
class AdministrateursController extends Controller
{
    public function Afficher()
    {
        $villes = Ville::all();
        $typesLieu = TypeLieu::all();

        return view('admin.Afficher', compact('villes', 'typesLieu'));
    }

    public function Recherche(Request $request)
    {
        $validationDonnees = $request->validate([
            'villeId' => 'nullable|integer|exists:villes,id',
            'quartierId' => 'nullable|integer|exists:quartiers,id',
            'rechercheNom' => 'nullable|string|max:255',
            'actif' => 'nullable|boolean',
            'parPage' => 'nullable|integer|in:10,25,50,100',
        ]);
        $villeId  = $validationDonnees['villeId'] ?? null;
        $quartierId = $validationDonnees['quartierId'] ?? null;
        $rechercheNom = $validationDonnees['rechercheNom'] ?? null;
        $actif = $validationDonnees['actif'] ?? null;
        $parPage = $validationDonnees['parPage'] ?? 10;
    
        $lieux = Lieu::when($villeId, function ($query) use ($villeId) {
            $query->whereHas('quartier', function ($q) use ($villeId) {
                $q->where('ville_id', $villeId);
            });
        })
            ->when($quartierId, function ($query) use ($quartierId) {
                $query->where('quartier_id', $quartierId);
            })
            ->when($rechercheNom, function ($query) use ($rechercheNom) {
                $query->where('nomEtablissement', 'like', '%' . $rechercheNom . '%');
            })
            ->when(isset($actif), function ($query) use ($actif) {
                $query->where('actif', $actif);
            })
            ->with(['quartier.ville.region.province', 'quartier.ville.pays', 'typeLieu'])
            ->paginate($parPage);


        if ($lieux->isEmpty()) {
            return response()->json(['message' => __('aucunLieuTrouve')]);
        }

        $lieuxWithDetails = $lieux->map(function ($lieu) {
            return [
                'id' => $lieu->id,
                'rue' => $lieu->rue,
                'noCivic' => $lieu->noCivic,
                'codePostal' => $lieu->codePostal,
                'nomEtablissement' => $lieu->nomEtablissement,
                'photoLieu' =>  $lieu->photo_lieu_url,
                'siteWeb' => $lieu->siteWeb,
                'numeroTelephone' => $lieu->numeroTelephone,
                'actif' => $lieu->actif,
                'description' => $lieu->description,
                'typeLieu' => $lieu->typeLieu->nom,
                'quartier' => $lieu->quartier ? [
                    'id' => $lieu->quartier->id,
                    'nom' => $lieu->quartier->nom,
                ] : null,
                'ville' => $lieu->quartier && $lieu->quartier->ville ? [
                    'id' => $lieu->quartier->ville->id,
                    'nom' => $lieu->quartier->ville->nom,
                ] : null,
                'region' => ($lieu->quartier && $lieu->quartier->ville && $lieu->quartier->ville->region) ? [
                    'id' => $lieu->quartier->ville->region->id,
                    'nom' => $lieu->quartier->ville->region->nom,
                ] : null,
                'province' => ($lieu->quartier && $lieu->quartier->ville && $lieu->quartier->ville->region && $lieu->quartier->ville->region->province) ? [
                    'id' => $lieu->quartier->ville->region->province->id,
                    'nom' => $lieu->quartier->ville->region->province->nom,
                ] : null,
                'pays' => ($lieu->quartier && $lieu->quartier->ville && $lieu->quartier->ville->pays) ? [
                    'id' => $lieu->quartier->ville->pays->id,
                    'nom' => $lieu->quartier->ville->pays->nom,
                ] : null,
            ];
        });

        return response()->json([
            'lieux' => $lieuxWithDetails,
            'pagination' => [
                'current_page' => $lieux->currentPage(),
                'per_page' => $lieux->perPage(),
                'total' => $lieux->total(),
                'last_page' => $lieux->lastPage(),
                'from' => $lieux->firstItem(),
                'to' => $lieux->lastItem(),
                'prev_page_url' => $lieux->previousPageUrl(),
                'next_page_url' => $lieux->nextPageUrl(),
            ],
        ]);
  
    
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
    

    
    public function ModifierUsagers(UsagerRequest $request, $id)
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
}
