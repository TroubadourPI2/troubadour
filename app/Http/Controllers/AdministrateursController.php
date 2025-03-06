<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lieu;
use App\Models\Ville;
use App\Models\TypeLieu;
use Illuminate\Support\Facades\Log;

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
        $villeId  = $request->get('villeId');
        $quartierId = $request->get('quartierId');
        $rechercheNom = $request->get('rechercheNom');
        $actif = $request->get('actif');
        $parPage = $request->get('parPage', 10);
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
                'photoLieu' => $lieu->photoLieu,
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
    }
}
