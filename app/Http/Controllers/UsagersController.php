<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UsagerRequest;
use App\Http\Requests\LieuFavoriRequest;
use App\Http\Requests\ActiviteFavoriRequest;
use App\Models\Usager;
use App\Models\Lieu;
use App\Models\LieuFavori;
use App\Models\Ville;
use App\Models\Quartier;
use App\Models\TypeLieu;
use App\Models\Activite;
use App\Models\ActiviteFavori;
use App\Models\TypeActivite;
use Illuminate\Support\Facades\Log;

class UsagersController extends Controller
{
    public function Connexion(Request $request)
    {
        $credentials = [
            'courriel'  => $request->courriel,
            'password'  => $request->password,
            'statut_id' => 1
        ];
     
        if (Auth::attempt($credentials)) {
            return response()->json(['success' => true]);
        }
     
        return response()->json(['success' => false]);
    }

    public function Deconnexion (){
        Auth::logout();
        session()->flush();
        session()->put('deconnexionSucces', 'Déconnexion réussie!');
        return back();
    }

    public function ObtenirDonneesCompte(){
        $usager = Auth::user(); 
        $lieuxUsager = Lieu::where('proprietaire_id', $usager->id)
        ->orderByDesc('actif') 
        ->get();
        $villes = Ville::all();
        $typesLieu = TypeLieu::all();
        $activites = $usager->lieu->pluck('activites')->flatten()->unique('id');
        $typesActivite = TypeActivite::all();
        $favorisActivites = ActiviteFavori::where('usager_id', $usager->id)->pluck('activite_id')->toArray();
        $favorisLieux = LieuFavori::where('usager_id', $usager->id)->pluck('lieu_id')->toArray();
       
        return View('usagers.Afficher', compact('usager', 'lieuxUsager', 'villes', 'typesLieu','activites','typesActivite', 'favorisActivites', 'favorisLieux'));
    }

   public function ObtenirQuartiersParVille(Request $request)
    {
        $villeId = $request->ville_id;
        if (!$villeId) 
            return response()->json([], 400); 

        $quartiers = Quartier::where('ville_id', $villeId)->get();
        return response()->json($quartiers);
    }

    public function AjouterFavorisLieu(LieuFavoriRequest $request)
    {

        $favoris = LieuFavori::create([
            'lieu_id' => $request->idLieu,
            'usager_id' => Auth::id(),
        ]);

        return redirect()->back(); 

    }


    public function SupprimerFavorisLieu(LieuFavoriRequest $request)
    {
        $favoris = LieuFavori::where("id",$request->id)->first();
        $favoris->delete();


        return redirect()->back(); 

    }

    public function AjouterFavorisActivite(ActiviteFavoriRequest $request)
    {

        $favoris = ActiviteFavori::create([
            'activite_id' => $request->idActivite,
            'usager_id' => Auth::id(),
        ]);

        return redirect()->back(); 

    }


    public function SupprimerFavorisActivite(ActiviteFavoriRequest $request)
    {
        $favoris = ActiviteFavori::where("id",$request->id)->first();
        $favoris->delete();


        return redirect()->back(); 

    }
    
    public function ModificationUsager(UsagerRequest $request, Usager $usager){
        try{

            if (auth()->user()->id !== $usager->id && auth()->user()->role_id !== 1) {
                return redirect()->route('usagerLieux.afficher')
                    ->withErrors(['Vous n\'êtes pas autorisé à modifier cet utilisateur.']);
            }

            $usager->prenom = $request->prenom;
            $usager->nom = $request->nom;
            $usager->courriel = $request->courriel;

            if ($request->filled('password')) {
                $usager->password = bcrypt($request->password);
            }
            
    
            $usager->save();
            session()->flash('formulaireModifierUValide', 'true');
            return redirect()->route('usagerLieux.afficher')
                ->with('message', "Modification de " . $usager->nom . " réussie!");
        }
        catch(\Throwable $e){
            Log::debug($e);
            return redirect()->route('usagerLieux.afficher')
                ->withErrors(['La modification n\'a pas fonctionné.']);
        }
    }
    
    public function Suppression(Request $request, Usager $usager) {
        $authUser = Auth::user();
    
        if (!$authUser) {
            return response()->json(['success' => false, 'message' => 'Utilisateur introuvable.'], 404);
        }

        if ($authUser->id !== $usager->id) {
            return response()->json(['success' => false, 'message' => 'Action non autorisée.'], 403);
        }

        try {
            $usager->statut_id = 2;
            $usager->updated_at = now();
            $usager->save();

            if ($authUser->id === $usager->id) {
                auth()->logout();
            }
    
            return response()->json(['success' => true, 'message' => 'Utilisateur désactivé avec succès.', 'usager' => $usager], 200);
    } catch (\Exception $e) {
        Log::error("Erreur lors de la suppression de l'utilisateur: " . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Une erreur est survenue lors de la désactivation.'], 500);
        }
    }

}
