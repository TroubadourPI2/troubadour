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
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\PostTooLargeException;

class LieuxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Index()
    {
        try {
            
            if(session()->has('idQuartier')) {
                return redirect()->route('lieux.recherchePrecis', session('idQuartier'));
            } else {
                $villes = Ville::where('actif', 1)->orderBy('nom', 'ASC')->get();
                $lieux = Lieu::where('actif', 1)->orderBy('nomEtablissement', 'ASC')->paginate(10);
                $villes = Ville::where('actif', 1)->orderBy('nom', 'ASC')->get();
    
    
                $villesInactives = Ville::where('actif', 0)->get();
                $quartiersInactifs = Quartier::where('actif', 0)->get();
                $lieuxFinaux = [];
    
                $lieux = Lieu::where('actif', 1)->whereHas('quartier', function($query) {
                    $query->where('actif', 1)  // Ensure the quartier is actif
                        ->whereHas('ville', function($query) {
                            $query->where('actif', 1);  // Ensure the ville is actif
                        });
                })->paginate(8);
    
                $ville = -1;
                $quartier = -1;
                return view('recherche', compact('lieux', 'villes', 'ville', 'quartier'));
            }

        } catch (\Exception $e) {
            Log::debug("MANUEL - Erreur lors de la récupération des lieux : " . $e->getMessage());
            return View('accueil');
        } catch (QueryException $e) {
            Log::debug("MANUEL - Erreur lors de la récupération des lieux : " . $e->getMessage());
            return View('accueil');
        }
    }

    public function Reset(){
        session()->forget('lieux');
        session()->forget('recherche');
        session()->forget('ville');
        session()->forget('quartier');
        session()->forget('villes');
        session()->forget('quartiers');
        session()->forget('idQuartier');

        
        return redirect()->route('lieux.recherche');
    }

    public function IndexPrecis($idQuartier)
    {
        $idQuartier = intval($idQuartier);


        Log::debug("Recherche précise" . " quartier: " . $idQuartier);
        try {
            $lieux      = Lieu::where('actif', 1)->where('quartier_id', $idQuartier)->orderBy('nomEtablissement', 'ASC')->paginate(8);
            $villes     = Ville::where('actif', 1)->orderBy('nom', 'ASC')->get();
            $quartier   = $idQuartier;
            $ville      = Ville::where('id', Quartier::where('id', $idQuartier)->first()->ville_id)->where('actif', 1)->first()->id;
            $quartiers  = Quartier::where('ville_id', $ville)->where('actif', 1)->orderBy('nom', 'ASC')->get();

            session(['idQuartier' => $idQuartier]);


            return view('recherche', compact('lieux', 'villes', 'ville', 'quartier', 'quartiers'));
        } catch (\Exception $e) {
            Log::debug("MANUEL - Erreur lors de la récupération des lieux : " . $e->getMessage());
            return redirect()->route('lieux.rechercheReset');
        } catch (QueryException $e) {
            Log::debug("MANUEL - Erreur lors de la récupération des lieux : " . $e->getMessage());
            return redirect()->route('lieux.rechercheReset');
        }
    }

    public function Recherche(Request $request)
    {
        try
        {

            if($request->txtRecherche !== session('recherche'))
            {
                session()->forget('lieux');
                session()->forget('recherche');
                session()->forget('ville');
                session()->forget('quartier');
                session()->forget('villes');
                session()->forget('quartiers');
            }

            $ville      = $request->ville;
            $villes     = Ville::where('actif', 1)->get();
            Log::Debug("Villes : " . $villes);
            $quartier   = $request->quartier;
            $recherche  = $request->txtRecherche;
            $lieux      = Lieu::where('actif', 1)->paginate(8);




            if (isset($request->quartier)) {
                $quartier   = $request->quartier;
                $lieux      = Lieu::where('quartier_id', $request->quartier)->where('actif', 1)->paginate(8);
            }



            if (isset($request->quartier) && isset($request->txtRecherche)) {
                $quartier   = $request->quartier;
                $rechercheSecurisee = trim($request->txtRecherche);
                $rechercheSecurisee = addslashes($rechercheSecurisee);
                $rechercheSecurisee = htmlspecialchars($rechercheSecurisee, ENT_NOQUOTES, 'UTF-8');

                $lieux      = Lieu::where('quartier_id', $request->quartier)->where('nomEtablissement', 'like', "%$rechercheSecurisee%")->where('actif', 1)->paginate(8);
            }

            if (isset($request->ville)) {
                Log::debug("Ville : " . $request->ville);
                $ville = $request->ville;
            }

            if (isset($request->txtRecherche)) {
                $rechercheSecurisee = trim($request->txtRecherche);
                $rechercheSecurisee = addslashes($rechercheSecurisee);
                $rechercheSecurisee = htmlspecialchars($rechercheSecurisee, ENT_NOQUOTES, 'UTF-8');
                session(['recherche' => $rechercheSecurisee]);

                try {
                    if (preg_match('/<[^>]*>/', $rechercheSecurisee)) {
                        Log::debug("MANUEL - Recherche contient un script ou une balise HTML");
                        return view('recherche', compact('ville'))->with('error', 'Une erreur est survenue lors de la recherche');
                    }

                    $recherches = Recherche::where('termeRecherche', $rechercheSecurisee)->first();

                    if ($recherches) {
                        $recherches->nbOccurences = $recherches->nbOccurences + 1;
                        $recherches->save();
                    } else {
                        $nouvelleRecherche = new Recherche();
                        $nouvelleRecherche->termeRecherche = $rechercheSecurisee;
                        $nouvelleRecherche->nbOccurences = 1;
                        $nouvelleRecherche->save();
                    }
                } catch (\Exception $e) {
                    if ($e->getMessage() == "No query results for model [App\Models\Recherche]") {
                        $nouvelleRecherche = new Recherche();
                        $nouvelleRecherche->termeRecherche = $rechercheSecurisee;
                        $nouvelleRecherche->nbOccurences = 1;
                        $nouvelleRecherche->save();
                    } else {
                        Log::debug("MANUEL - Erreur lors de l'ajout de la recherche à l'historique : " . $e->getMessage());
                    }
                }
            }

            $quartiers  = Quartier::where('ville_id', $ville)->where('actif', 1)->get();

            if (session()->has('villes')) {
                $villes = session()->get('villes');
            } else {
                // $villes = Ville::where('actif', 1)->get();
                session(['villes' => $villes]);
            }

            if (session()->has('quartiers')) {
                $quartiers = session()->get('quartiers');
            } else {
                // $quartiers = Quartier::where('ville_id', $ville)->where('actif', 1)->get();
                session(['quartiers' => $quartiers]);
            }

            if (session()->has('ville')) {
                $ville = session()->get('ville');
            } else if ($ville != -1) {
                session(['ville' => $ville]);
            }

            if (session()->has('quartier')) {
                $quartier = session()->get('quartier');
            } else {
                session(['quartier' => $quartier]);
            }

            if (session()->has('recherche')) {
                $recherche = session()->get('recherche');
            } else {
                session(['recherche' => $recherche]);
            }

            if (session()->has('lieux')) {
                $lieux = session()->get('lieux');
            } else {
                session(['lieux' => $lieux]);
            }

            return view('recherche', compact('lieux', 'ville', 'quartier', 'recherche', 'villes', 'quartiers'));
        } catch (\Exception $e) {
            Log::debug("MANUEL - Erreur lors de la recherche : " . $e->getMessage());
            return view('recherche', compact('ville'))->with('error', 'Une erreur est survenue lors de la recherche');
        }
    }

    public function Historique()
    {
        $recherches = Recherche::all()->sortByDesc('nbOccurences');

        return view('historiqueRecherche', compact('recherches'));
    }

    public function Quartiers(Request $request)
    {
        $villeId    = $request->villeId;
        $quartiers  = Quartier::where('ville_id', $villeId)->get()->sortByDesc('nom');
        return compact('quartiers');
    }

    public function SupprimerRecherche($id)
    {
        try {
            $recherche = Recherche::findOrFail($id);
            $recherche->delete();
            session()->flash('formulaireSupprimerRechercheValide', 'true');
            return response()->json(['success' => true, 'message' => 'La recherche a été supprimée']);
        } catch (\Exception $e) {
            Log::error("Erreur lors de la suppression de la recherche : " . $e->getMessage());
            return json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function AjouterUnLieu(LieuRequest $request)
    {
        try {
            $lieu = new Lieu();
            $utilisateur = auth()->user();
            $estAdmin = $utilisateur->role->nom === 'Admin';
            $lieu->rue =  $request->rue;
            $lieu->noCivic = $request->noCivic;
            $lieu->codePostal = (strtoupper($request->codePostal));
            $lieu->nomEtablissement = htmlspecialchars($request->nomEtablissement, ENT_NOQUOTES, 'UTF-8');


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
            $lieu->description = htmlspecialchars($request->description, ENT_NOQUOTES, 'UTF-8');
            $lieu->quartier_id = $request->selectQuartierLieu;
            $lieu->typeLieu_id = $request->selectTypeLieu;
            $lieu->proprietaire_id = Auth::id();
            $lieu->save();

            session()->flash('formulaireAjouterLieuValide', 'true');
            if ($estAdmin)
                return redirect()->route('admin');
            return redirect()->route('usagerLieux.afficher');
        } catch (PostTooLargeException $e) {
            // Intercepter l'erreur et rediriger avec un message personnalisé
            return redirect()->back()
                ->withErrors(['photoLieu' => __('validation.photoLieuMax')])
                ->withInput();
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

        $favoris = LieuFavori::where("lieu_id", $id)->where("usager_id", Auth::id(),)->first();

        return view('zoomLieu', compact('usager', 'lieuActuel', 'activites', 'favoris'));
    }

    public function ObtenirUnLieu(Request $request)
    {
        try {
            $lieuId = $request->query('lieu_id');
            $utilisateur = auth()->user();
            $estAdmin = $utilisateur->role->nom === 'Admin';

            if (!$lieuId) {
                return response()->json([], 400);
            }

            $lieu = $lieu = Lieu::findOrFail($lieuId);

            $estProprietaire = $lieu->proprietaire_id === $utilisateur->id;
            if (!$estProprietaire && !$estAdmin) {
                return response()->json([
                    'success' => false,
                    'message' => __('erreur403Texte')
                ], 403);
            }

            return response()->json([
                'success' => true,
                'data' => $lieu
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => __('lieuIntrouvable')
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Erreur lors de la récupération du lieu : " . $e->getMessage()
            ], 500);
        }
    }

    public function ModifierUnLieu(LieuRequest $request, string $id)
    {

        $lieu = Lieu::findOrFail($id);

        $utilisateur = auth()->user();
        $estAdmin = $utilisateur->role->nom === 'Admin';
        $estProprietaire = $lieu->proprietaire_id === $utilisateur->id;

        if (!$estProprietaire && !$estAdmin) {
            return response()->json([
                'success' => false,
                'message' => __('erreur403Texte')
            ], 403);
        }

        try {
            $photoCheminParDefaut = 'lieux/image_defaut.png';
            if (!Storage::disk('DevActivite')->exists($photoCheminParDefaut)) {
                Storage::disk('DevActivite')->put($photoCheminParDefaut, file_get_contents(public_path('Images/lieux/image_defaut.png')));
            }

            $lieu->rue = $request->rue;
            $lieu->noCivic = $request->noCivic;
            $lieu->codePostal = (strtoupper($request->codePostal));
            $lieu->nomEtablissement =  htmlspecialchars($request->nomEtablissement, ENT_NOQUOTES, 'UTF-8');
            $lieu->siteWeb = $request->siteWeb;
            $lieu->numeroTelephone = $request->numeroTelephone;
            $lieu->description = htmlspecialchars($request->description, ENT_NOQUOTES, 'UTF-8');
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

            if ($estAdmin) {
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
            return response()->json([
                'success' => false,
                'message' => __('erreur403Texte')
            ], 403);
        }

        DB::beginTransaction();

        try {
            $lieu->update([
                'actif' => $request->boolean('actif'),
            ]);

            if (!$request->boolean('actif')) {
                $activites = Activite::whereHas('Lieux', function ($query) use ($id) {
                    $query->where('Lieux.id', $id);
                })->get();

                $activitesToDeactivate = $activites->filter(function ($activite) use ($id) {
                    return $activite->lieux()->where('Lieux.actif', true)
                        ->where('Lieux.id', '!=', $id)
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
        try {
            $lieu = Lieu::findOrFail($id);
            $utilisateur = auth()->user();
            $estAdmin = $utilisateur->role->nom === 'Admin';
            $estProprietaire = $lieu->proprietaire_id === $utilisateur->id;

            if (!$estProprietaire && !$estAdmin) {
                return response()->json([
                    'success' => false,
                    'message' => __('erreur403Texte')
                ], 403);
            }
            if ($lieu->photoLieu && $lieu->photoLieu !== 'Images/lieux/image_defaut.png') {
                Storage::disk('DevActivite')->delete($lieu->photoLieu);
            }
            $lieu->delete();
            return response()->json(["success" => true, "message" => __('succesSupprimer')]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => __('lieuIntrouvable')
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Erreur lors de la récupération du lieu : " . $e->getMessage()
            ], 500);
        }
    }


}
