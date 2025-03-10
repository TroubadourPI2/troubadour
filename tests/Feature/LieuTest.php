<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Lieu;
use App\Models\Quartier;
use App\Models\TypeLieu;
use App\Models\Usager;

class LieuTest extends TestCase
{
    //refait la bd
    use RefreshDatabase;

    public function test_creer_nouveau_lieu(): void
    {
        //créer les seeders
        $this->seed(DatabaseSeeder::class);
        
        $quartier = Quartier::find(1); 
        $typeLieu = TypeLieu::find(1); 
        $proprietaire = Usager::find(1);
        
        $this->assertNotNull($quartier, "Le quartier avec l'ID spécifié n'existe pas dans la base de données de test");
        $this->assertNotNull($typeLieu, "Le type de lieu avec l'ID spécifié n'existe pas dans la base de données de test");
        $this->assertNotNull($proprietaire, "L'usager avec l'ID spécifié n'existe pas dans la base de données de test");
        

        $response = $this->post('/compte/ajouterLieu', [
            'nomEtablissement' => 'Testeur',
            'rue' => 'Soleil',
            'codePostal' => 'G0X 2M0',
            'noCivic' => 222,
            'numeroTelephone' => '111-111-1112',
            'quartier_id' => $quartier->id,
            'typeLieu_id' => $typeLieu->id,
            'proprietaire_id' => $proprietaire->id,
        ]);
        
        $this->assertDatabaseHas('Lieux', [
            'nomEtablissement' => 'Testeur',
            'numeroTelephone' => '111-111-1112',
        ]);
    }

    public function test_validation_regles_lieu(): void
    {
        
    
        $this->seed(DatabaseSeeder::class); // Seed la base de données
    
        $quartier = Quartier::first();  // Assurez-vous que le quartier existe
        $typeLieu = TypeLieu::first();  // Assurez-vous que le type de lieu existe
        $proprietaire = Usager::find(1);
        // Requête avec des données invalides
        $response = $this->post('/lieux/ajouterLieu', [
            'nomEtablissement' => '', // Données invalides
            'rue' => 'Soleil',
            'codePostal' => 'INVALID',
            'noCivic' => 'non-numérique', 
            'numeroTelephone' => '111-1111111',
            'quartier_id' => $quartier->id,
            'typeLieu_id' => $typeLieu->id,
            'proprietaire_id' => $proprietaire->id,
        ]);
    
        // Vérifier que les erreurs de validation sont présentes dans la session
        $response->assertSessionHasErrors([
            'nomEtablissement', 
            'codePostal', 
            'noCivic',
            'numeroTelephone'
        ]);
    
        // Vérifier que le lieu n'a pas été ajouté à la base de données
        $this->assertDatabaseMissing('Lieux', [
            'rue' => 'Soleil'
        ]);
    }
    
    
}
