<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
        session()->put('deconnexion_success', 'Déconnexion réussie!');
        return back();
    }
    
     


    public function ObtenirDonneesCompte(){
        $usager = Auth::user(); 
        $lieuxUsager = Lieu::where('proprietaire_id', $usager->id)->get();
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
    
/**​
     * Show the form for editing the specified resource.​
     *​
     *  @param  int  $id​
     *  @return \Illuminate\Http\Response​
     */
    public function ModificationUsager(Request $request, Usager $usager){
        try{
            $usager->prenom = $request->prenom;
            $usager->nom = $request->nom;
            $usager->courriel = $request->courriel;
            $usager->password =$request->password;
           

            return redirect()->route('usagers.afficher', $usager->id)
            ->with('message', "Modification de " . $usager->nom . " réussie!");
        }
        catch(\Throwable $e){
            Log::debug($e);
            return redirect()->route('usagers.edit', $usager->id)
            ->withErrors(['La modification n\'a pas fonctionné.']);
        }
       
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usager $usager){
        return view('usagers.Afficher', compact('usager'));
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
