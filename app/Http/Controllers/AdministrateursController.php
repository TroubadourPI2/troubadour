<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lieu;
use App\Models\Ville;
use App\Models\Quartier;
use App\Models\TypeLieu;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class AdministrateursController extends Controller
{
    public function Afficher()
    {
        $lieux = Lieu::orderByDesc('actif')->get();
        $villes = Ville::all();
        $typesLieu = TypeLieu::all();

        return view('admin.Afficher', compact('lieux', 'villes', 'typesLieu'));
    }

    public function Recherche(Request $request)
{
    $villeId  = $request->get('villeId');
    $quartierId = $request->get('quartierId');
    $rechercheNom = $request->get('rechercheNom');

    // Construire la requête de manière fluide
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
                        // Si aucun filtre n'est sélectionné, on retourne tous les lieux
                        ->when(!$villeId && !$quartierId && !$rechercheNom, function ($query) {
                            $query->select('*'); // Sélectionne tous les lieux
                        })
                        ->with(['quartier', 'quartier.ville'])
                        ->get();

    // Vérification du nombre de résultats
    $count = $lieux->count();

    if ($count === 0) {
        return response()->json(['message' => 'Aucun lieu trouvé pour les critères de recherche.']);
    }
    Log::debug($request);
    // Transformation des résultats pour les envoyer au front-end
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

    return response()->json($lieuxWithDetails);
}


}
