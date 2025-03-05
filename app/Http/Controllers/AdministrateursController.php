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

        return View('admin.Afficher', compact('lieux', 'villes', 'typesLieu'));
    }

    public function Recherche(Request $request)
{
    Log::debug($request);
    
    // Créer une requête pour filtrer les lieux
    $query = Lieu::query();

    // Filtrer par ville via le quartier
    if ($request->ville) {
        $query->whereHas('quartier', function ($q) use ($request) {
            $q->where('ville_id', $request->ville);
        });
    }

    // Filtrer par quartier
    if ($request->quartier) {
        $query->where('quartier_id', $request->quartier);
    }

    // Filtrer par nom de lieu
    if ($request->rechercheNomLieu) {
        $query->where('nom_etablissement', 'like', '%' . $request->rechercheNomLieu . '%');
    }

    // Filtrer par actif ou inactif
    if ($request->actif !== null) {
        $query->where('actif', $request->actif);
    }

    // Charger les relations quartier et ville
    $lieux = $query->with(['quartier', 'quartier.ville'])->get();

    // Compter le nombre de lieux trouvés
    $count = $lieux->count();

    // Si aucun lieu trouvé
    if ($count === 0) {
        return response()->json(['message' => 'Aucun lieu trouvé pour les critères de recherche.']);
    }

    Log::debug($lieux);

    // Format de la réponse avec les informations de quartier et de ville
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
        ];
    });
    Log::debug($lieuxWithDetails);
    // Retourner les lieux au format JSON avec quartier et ville
    return response()->json($lieuxWithDetails);
}

    
}
