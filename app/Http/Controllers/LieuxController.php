<?php

namespace App\Http\Controllers;


use App\Models\LieuActivite;
use App\Models\Activite;
use App\Models\Lieu;
use App\Models\Quartier;
use App\Models\Recherche;
use App\Models\LieuFavori;
use Illuminate\Http\Request;
use App\Models\Ville;
use Exception;
use Illuminate\Database\QueryException;
use App\Http\Requests\LieuRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LieuxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Index()
    {
        try {
            $lieux = Lieu::where('actif', 1)->paginate(10);
            $villes = Ville::where('actif', 1)->get();
            $ville = -1;
            return view('recherche', compact('lieux', 'villes', 'ville'));
        } catch (\Exception $e) {
            Log::debug("MANUEL - Erreur lors de la récupération des lieux : " . $e->getMessage());
            return View('accueil');
        } catch (QueryException $e) {
            Log::debug("MANUEL - Erreur lors de la récupération des lieux : " . $e->getMessage());
            return View('accueil');
        }
    }

    public function Recherche(Request $request)
    {
        try
        {
            $ville      = $request->ville;
            $quartier   = $request->quartier;
            $recherche  = $request->txtRecherche;
            $lieux      = Lieu::paginate(10);



            if(isset($request->quartier)){
                $quartier   = $request->quartier;
                $lieux      = Lieu::where('quartier_id', $request->quartier)->where('actif', 1)->paginate(10);
            }



            if(isset($request->quartier) && isset($request->txtRecherche)){
                $quartier   = $request->quartier;
                $recherche  = $request->txtRecherche;
                $lieux      = Lieu::where('quartier_id', $request->quartier)->where('nomEtablissement', 'like', "%$recherche%")->where('actif', 1)->paginate(10);
            }
            
            if(isset($request->ville)){
                Log::debug("Ville : " . $request->ville);
                $ville = $request->ville;
            }

            if(isset($request->txtRecherche))
            {
                try{
                    if (preg_match('/<[^>]*>/', $request->txtRecherche)) {
                        Log::debug("MANUEL - Recherche contient un script ou une balise HTML");
                        return view('recherche', compact('ville'))->with('error', 'Une erreur est survenue lors de la recherche');
                    }
                    $recherches = Recherche::where('termeRecherche', $request->txtRecherche)->where('villeId', $ville)->where('quartierId', $quartier)->first();

                    if($recherches){
                        $recherches->nbOccurences = $recherches->nbOccurences + 1;
                        $recherches->save();
                    }
                    else{
                        Log::debug("MANUEL - Aucune recherche trouvée");

                        $nouvelleRecherche = new Recherche();
                        $nouvelleRecherche->termeRecherche = $request->txtRecherche;
                        $nouvelleRecherche->villeId = $ville;
                        $nouvelleRecherche->quartierId = $quartier;
                        $nouvelleRecherche->nbOccurences = 1;
                        $nouvelleRecherche->save();
                    }
                }
                catch(\Exception $e){
                    if($e->getMessage() == "No query results for model [App\Models\Recherche]"){
                        $nouvelleRecherche = new Recherche();
                        $nouvelleRecherche->termeRecherche = $request->txtRecherche;
                        $nouvelleRecherche->villeId = $ville;
                        $nouvelleRecherche->quartierId = $quartier;
                        $nouvelleRecherche->nbOccurences = 1;
                        $nouvelleRecherche->save();
                    }
                    else{
                        Log::debug("MANUEL - Erreur lors de l'ajout de la recherche à l'historique : " . $e->getMessage());
                    }
                }
            }
            
            $villes     = Ville::all();
            $quartiers  = Quartier::where('villeId', $ville)->where('actif', 1)->get();

            return view('recherche', compact('lieux', 'ville', 'quartier', 'recherche', 'villes', 'quartiers'));
        }
        catch(\Exception $e){
            Log::debug("MANUEL - Erreur lors de la recherche : " . $e->getMessage());
            return view('recherche', compact('ville'))->with('error', 'Une erreur est survenue lors de la recherche');
        }

    }

    public function Historique()
    {
        $recherches = Recherche::all()->sortByDesc('nbOccurences');
        $quartiers = Recherche::all()->unique('quartierId');

        $listeQuartiers = array();
        foreach($quartiers as $quartier){
            $listeQuartiers[] = Quartier::find($quartier->quartierId);
        }

        $villes = Recherche::all()->unique('villeId');

        $listeVilles = array();
        foreach($villes as $ville){
            $listeVilles[] = Ville::find($ville->villeId);
        }

        $resultatsVilles = DB::table('recherches')
            ->join('villes', 'recherches.villeId', '=', 'villes.id')
            ->select('villes.id as villeId', 'villes.nom as nomVille', DB::raw('count(*) as total'))
            ->groupBy('villes.id', 'villes.nom')
            ->groupBy('villeId')
            ->get();

        $resultatsQuartiers = DB::table('recherches')
            ->join('quartiers', 'recherches.villeId', '=', 'quartiers.id')
            ->select('quartiers.id as villeId', 'quartiers.nom as nomQuartiers', DB::raw('count(*) as total'))
            ->groupBy('quartiers.id', 'quartiers.nom')
            ->groupBy('quartierId')
            ->get();


        Log::debug("Resultats quartiers : " . $resultatsQuartiers);

        return view('historiqueRecherche', compact('recherches', 'listeQuartiers', 'listeVilles', 'villes', 'resultatsVilles', 'resultatsQuartiers'));
    }

    public function Quartiers(Request $request)
    {
        $villeId    = $request->villeId;
        $quartiers  = Quartier::where('ville_id', $villeId)->get();
        return compact('quartiers');
    }

    public function SupprimerRecherche($id)
    {
        try{
            $recherche = Recherche::findOrFail($id);
            $recherche->delete();
            return json_encode(['success' => true, 'message' => 'La recherche a été supprimée']);
        }
        catch(\Exception $e){
            Log::error("Erreur lors de la suppression de la recherche : " . $e->getMessage());
            return json_encode(['success' => false, 'message' => 'Une erreur est survenue lors de la suppression de la recherche' . $e->getMessage()]);
        }
    }

    public function AjouterUnLieu(LieuRequest $request)
    {
        try {
            $lieu = new Lieu();
            $utilisateur = auth()->user(); 
            $estAdmin = $utilisateur->role->nom === 'Admin';

            $lieu->rue = $request->rue;
            $lieu->noCivic = $request->noCivic;
            $lieu->codePostal = (strtoupper($request->codePostal));
            $lieu->nomEtablissement = $request->nomEtablissement;

            $photoCheminParDefaut = 'lieux/image_defaut.png';
            if (!Storage::disk('DevActivite')->exists($photoCheminParDefaut)) {
                Storage::disk('DevActivite')->put($photoCheminParDefaut, file_get_contents(public_path('Images/lieux/image_defaut.png')));
            }

            if ($request->hasFile('photoLieu')) {
                $file = $request->file('photoLieu');
                $chemin = $file->store('lieux', 'DevActivite');
                $lieu->photoLieu = $chemin;
            } else {
                $lieu->photoLieu = $photoCheminParDefaut;
            }

            $lieu->siteWeb = $request->siteWeb;
            $lieu->numeroTelephone = $request->numeroTelephone;
            $lieu->actif = true;
            $lieu->description = $request->description;
            $lieu->quartier_id = $request->selectQuartierLieu;
            $lieu->typeLieu_id = $request->selectTypeLieu;
            $lieu->proprietaire_id = Auth::id();
            $lieu->save();

            session()->flash('formulaireAjouterLieuValide', 'true');
            Log::debug($estAdmin);
            if($estAdmin)
                return redirect()->route('admin');
            return redirect()->route('usagerLieux.afficher');
        } catch (\Exception $e) {
            Log::error("Erreur lors de l'ajout d'un lieu: " . $e->getMessage());
            return redirect()->route('usagerLieux.afficher');
        }
    }


    /**
     * Display the specified resource.
     */
    public function ZoomLieu(string $id)
    {
        $usager = Auth::user(); 
        $lieuActuel = Lieu::findOrFail($id);
        $idActivites = LieuActivite::Where("lieu_id", $id)->pluck("activite_id");
        $activites = Activite::whereIn("id", $idActivites)->where('actif', 1)->get();

        $favoris = LieuFavori::where("lieu_id",$id)->where("usager_id", Auth::id(),)->first();  

        return view('zoomLieu', compact('usager', 'lieuActuel', 'activites', 'favoris'));
    }

    public function ObtenirUnLieu(Request $request)
    {
        $lieuId = $request->query('lieu_id');

        if (!$lieuId) {
            return response()->json([], 400);
        }

        $lieu = Lieu::find($lieuId);

        if (!$lieu) {
            return response()->json(['error' => 'Lieu non trouvé'], 404);
        }

        return response()->json($lieu);
    }

    public function ModifierUnLieu(LieuRequest $request, string $id)
    {
        Log::debug($request);
        $lieu = Lieu::findOrFail($id);
      
        $utilisateur = auth()->user();
        $estAdmin = $utilisateur->role->nom === 'Admin';
        $estProprietaire = $lieu->proprietaire_id === $utilisateur->id;
        if (!$estProprietaire && !$estAdmin) {
            return redirect()->route('usagerLieux.afficher');
        }

        try {
            $photoCheminParDefaut = 'lieux/image_defaut.png';
            if (!Storage::disk('DevActivite')->exists($photoCheminParDefaut)) {
                Storage::disk('DevActivite')->put($photoCheminParDefaut, file_get_contents(public_path('Images/lieux/image_defaut.png')));
            }
            //$lieu->actif = $request->actif;
            $lieu->rue = $request->rue;
            $lieu->noCivic = $request->noCivic;
            $lieu->codePostal = $request->codePostal;
            $lieu->nomEtablissement = $request->nomEtablissement;
            $lieu->siteWeb = $request->siteWeb;
            $lieu->numeroTelephone = $request->numeroTelephone;
            $lieu->description = $request->description;
            $lieu->quartier_id = $request->selectQuartierLieu;
            $lieu->typeLieu_id = $request->selectTypeLieu;

            if ($request->has('photoLieuSupprime') && $request->photoLieuSupprime == "1") {
                if ($lieu->photoLieu && $lieu->photoLieu !== $photoCheminParDefaut) {
                    Storage::disk('DevActivite')->delete($lieu->photoLieu);
                }
                $lieu->photoLieu = $photoCheminParDefaut; 
            }

            if ($request->hasFile('photoLieu')) {
                if ($lieu->photoLieu && $lieu->photoLieu !== $photoCheminParDefaut) {
                    Storage::disk('DevActivite')->delete($lieu->photoLieu);
                }

                $file = $request->file('photoLieu');
                $chemin = $file->store('lieux', 'DevActivite');
                $lieu->photoLieu = $chemin;
            }

            if (!$request->hasFile('photoLieu') && $lieu->photoLieu === $photoCheminParDefaut) {
                $lieu->photoLieu = $photoCheminParDefaut;
            }

            $lieu->save();

            session()->flash('formulaireModifierLieuValide', 'true');

            if($estAdmin){
                 return redirect()->route('admin');
            }
               

           return redirect()->route('usagerLieux.afficher');
        } catch (\Exception $e) {
            Log::error(__('erreur') . $e->getMessage());
            return redirect()->route('usagerLieux.afficher')->with('error',  __('erreurGenerale'));
        }
    }

    public function ChangerEtatLieu(LieuRequest $request, $id)
    {
        $lieu = Lieu::findOrFail($id);
        $utilisateur = auth()->user();
        $estAdmin = $utilisateur->role->nom === 'Admin';
        $estProprietaire = $lieu->proprietaire_id === $utilisateur->id;
        if (!$estProprietaire && !$estAdmin) {
            return response()->json(['success' => false, 'message' => __('erreur')], 403);
        }
    
        DB::beginTransaction();
        
        try {
            $lieu->update([
                'actif' => $request->boolean('actif'),
            ]);
    
            if (!$request->boolean('actif')) {
                $activites = Activite::whereHas('lieux', function ($query) use ($id) {
                    $query->where('lieux.id', $id);
                })->get();
    
                $activitesToDeactivate = $activites->filter(function ($activite) use ($id) {
                    return $activite->lieux()->where('lieux.actif', true)
                                             ->where('lieux.id', '!=', $id)
                                             ->count() === 0;
                });
                foreach ($activitesToDeactivate as $activite) {
                    $activite->actif = false;
                    $activite->save();
                }
            }
    
            DB::commit();
    
            session()->flash('formulaireModifierLieuStatutValide', 'true');
            return response()->json([
                'success' => true,
                'message' => __('succesModifier')
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(__('erreur') . $e->getMessage());
            return response()->json(["success" => false, "message" =>  __('erreurGenerale')], 500);
        }
    }
    

    public function SupprimerUnLieu($id)
    {
        $lieu = Lieu::findOrFail($id);
        $utilisateur = auth()->user();
        $estAdmin = $utilisateur->role->nom === 'Admin';
        $estProprietaire = $lieu->proprietaire_id === $utilisateur->id;
        if (!$estProprietaire && !$estAdmin) {
            return response()->json(['success' => false, 'message' =>  __('erreur')], 403);
        }
        try {

            if ($lieu->photoLieu && $lieu->photoLieu !== 'Images/lieux/image_defaut.png') {
                Storage::disk('DevActivite')->delete($lieu->photoLieu);
            }
            $lieu->delete();
            return response()->json(["success" => true, "message" => __('succesSupprimer')]);
        } catch (\Exception $e) {
            Log::error(__('erreurSuppresion') . $e->getMessage());
            return response()->json(["success" => false, "message" =>  __('erreurSuppresion')], 500);
        }
    }
}
