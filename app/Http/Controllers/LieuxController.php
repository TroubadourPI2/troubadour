<?php

namespace App\Http\Controllers;


use App\Models\LieuActivite;
use App\Models\Activite;
use App\Models\Lieu;
use App\Models\Quartier;
use App\Models\Recherche;
use Illuminate\Http\Request;
use App\Models\Ville;
use Exception;
use Illuminate\Database\QueryException;
use App\Http\Requests\LieuRequest;
use App\Http\Requests\LieuModifierRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class LieuxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $lieux = Lieu::where('actif', 1)->paginate(10);
            $villes = Ville::where('actif', 1)->get();
            $ville = -1;
            return view('recherche', compact('lieux', 'villes', 'ville'));
        }
        catch(\Exception $e){
            Log::debug("MANUEL - Erreur lors de la récupération des lieux : " . $e->getMessage());
            return View('accueil');
        }
        catch(QueryException $e){
            Log::debug("MANUEL - Erreur lors de la récupération des lieux : " . $e->getMessage());
            return View('accueil');
        }
    }

    public function recherche(Request $request)
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
                    $nouvelleRecherche = new Recherche();
                    $nouvelleRecherche->terme_recherche = $request->txtRecherche;
                    $nouvelleRecherche->ville_id = $ville;
                    $nouvelleRecherche->quartier_id = $quartier;
                    $nouvelleRecherche->save();
                }
                catch(\Exception $e){
                    Log::debug("MANUEL - Erreur lors de l'ajout de la recherche : " . $e->getMessage());
                }
            }
            
            $villes     = Ville::all();
            $quartiers  = Quartier::where('ville_id', $ville)->where('actif', 1)->get();

            return view('recherche', compact('lieux', 'ville', 'quartier', 'recherche', 'villes', 'quartiers'));
        }
        catch(\Exception $e){
            Log::debug("MANUEL - Erreur lors de la récupération des lieux : " . $e->getMessage());
            return view('recherche', compact('ville'))->with('error', 'Une erreur est survenue lors de la recherche');
        }

    }

    public function quartiers(Request $request)
    {
        $villeId    = $request->villeId;
        $quartiers  = Quartier::where('ville_id', $villeId)->get();
        return compact('quartiers');
    }

    public function historique()
    {
        $recherches = Recherche::all();
        return view('historiqueRecherche', compact('recherches'));
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
    public function AjouterUnLieu(LieuRequest $request)
    {
        try {
            $lieu = new Lieu();
            $lieu->rue = $request->rue;
            $lieu->noCivic = $request->noCivic;
            $lieu->codePostal = (strtoupper($request->codePostal));
            $lieu->nomEtablissement = $request->nomEtablissement;
            //TODO Trouver comment stocker les images
            if ($request->hasFile('photoLieu')) {
                $file = $request->file('photoLieu');

                if ($file->isValid()) {
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time() . '_' . Str::slug($originalName) . '.' . $extension;

                    $file->move(public_path('Images/lieux'), $fileName);

                    $lieu->photoLieu = 'Images/lieux/' . $fileName;
                }
            } else {
                $lieu->photoLieu = 'Images/lieux/image_defaut.png';
            }

            $lieu->siteWeb = $request->siteWeb;
            $lieu->numeroTelephone = $request->numeroTelephone;
            $lieu->actif = true;
            $lieu->description = $request->description;
            $lieu->quartier_id = $request->selectQuartierLieu;
            $lieu->typeLieu_id = $request->selectTypeLieu;
            $lieu->proprietaire_id = Auth::id();
            $lieu->save();

            session()->flash('formulaireValide', 'true');
            return redirect()->route('usagerLieux.afficher');
        } catch (\Exception $e) {
            Log::error("Erreur lors de l'ajout d'un lieu: " . $e->getMessage());
            return redirect()->route('usagerLieux.afficher');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $lieuActuel = Lieu::findOrFail($id);
        $idActivites = LieuActivite::Where("lieu_id", $id)->pluck("activite_id");
        $activites = Activite::whereIn("id", $idActivites)->where('actif', 1)->get();

        return view('zoomLieu', compact('lieuActuel', 'activites'));

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


    /**
     * Update the specified resource in storage.
     */
    public function ModifierUnLieu(LieuRequest $request, string $id)
    {
        $lieu = Lieu::findOrFail($id);
        try {
            $lieu->rue = $request->rue;
            $lieu->noCivic = $request->noCivic;
            $lieu->codePostal = $request->codePostal;
            $lieu->nomEtablissement = $request->nomEtablissement;
             //TODO Trouver comment stocker les images
            if ($request->hasFile('photoLieu')) {
                $file = $request->file('photoLieu');
    
                if ($file->isValid()) {
                    if ($lieu->photoLieu && $lieu->photoLieu !== 'Images/lieux/image_defaut.png' && file_exists(public_path($lieu->photoLieu))) {
                        unlink(public_path($lieu->photoLieu));
                    }
    
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time() . '_' . Str::slug($originalName) . '.' . $extension;
    
                    $file->move(public_path('Images/lieux'), $fileName);
    
                    $lieu->photoLieu = 'Images/lieux/' . $fileName;
                }
            }
            $lieu->siteWeb = $request->siteWeb;
            $lieu->numeroTelephone = $request->numeroTelephone;
            $lieu->description = $request->description;
            $lieu->quartier_id = $request->selectQuartierLieu;
            $lieu->typeLieu_id = $request->selectTypeLieu;
           $lieu->save();

            session()->flash('formulaireModifierValide', 'true');
            return redirect()->route('usagerLieux.afficher');
        } catch (\Exception $e) {
            Log::error("Erreur lors de la modification d'un lieu: " . $e->getMessage());
            return redirect()->route('usagerLieux.afficher');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
