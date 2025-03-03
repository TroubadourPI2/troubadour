<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UsagerRequest;
use App\Models\Usager;
use App\Models\Lieu;
use App\Models\Ville;
use App\Models\Quartier;
use App\Models\TypeLieu;
use App\Models\Activite;
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
        ->orderByDesc('actif') // Place les lieux actifs en premier
        ->get();
        $villes = Ville::all();
        $typesLieu = TypeLieu::all();
        $activites = $usager->lieu->pluck('activites')->flatten()->unique('id');
        $typesActivite = TypeActivite::all();
        return View('usagers.Afficher', compact('usager', 'lieuxUsager', 'villes', 'typesLieu','activites','typesActivite'));
    }

   public function ObtenirQuartiersParVille(Request $request)
    {
        $villeId = $request->ville_id;
        if (!$villeId) 
            return response()->json([], 400); 

        $quartiers = Quartier::where('ville_id', $villeId)->get();
        return response()->json($quartiers);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    
    public function Suppression(Request $request){
        $usager = Auth::user();
    
        if (!$usager) {
            return response()->json(['success' => false, 'message' => 'Utilisateur introuvable.'], 404);
        }
    
        if (auth()->user()->id !== $usager->id && auth()->user()->role_id !== 1) {
            return response()->json(['success' => false, 'message' => 'Vous n\'êtes pas autorisé à désactiver cet utilisateur.'], 403);
        }

        try {
            $usager->statut_id = 2;
            $usager->updated_at = now();
            $usager->save();

            if (auth()->user()->id === $usager->id) {
                auth()->logout();
            }
    
            return response()->json(['success' => true, 'message' => 'Utilisateur désactivé avec succès.'], 200);
    
        } catch (\Exception $e) {
            Log::error("Erreur lors de la suppression de l'utilisateur: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Une erreur est survenue lors de la désactivation.'], 500);
        }
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
