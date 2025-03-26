<?php

namespace Tests\Unit;

use App\Http\Controllers\LieuxController;
use App\Http\Requests\LieuRequest;
use App\Models\Activite;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Lieu;
use App\Models\RoleUsager;
use App\Models\Usager;
use Illuminate\Support\Facades\Log;

class ChangerEtatLieuTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste si un gestionnaire ne peut pas modifier un lieu qui ne lui appartient pas.
     */
    public function testSeulGestionnaireProprietairePeutChangerEtat()
    {
        $this->seed();

        $user = Usager::where('role_id', '!=', 1)->first();
        $lieu = Lieu::where('proprietaire_id', '!=', $user->id)->first();

        $this->actingAs($user);
        $request = new LieuRequest();
        $request->replace([
            'rue' => 'Nouvelle Rue',
        ]);

        $controller = new LieuxController();
        $response = $controller->ChangerEtatLieu($request, $lieu->id);

        $this->assertEquals(403, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $data = json_decode($response->getContent(), true);
        $this->assertFalse($data['success']);
        $this->assertEquals(__('erreur403Texte'), $data['message']);
    }

    /**
     * Teste si l'état change bien (par un gestionnaire).
     */
    public function testChangerEtatParGestionnaire()
    {
        $this->seed();

        $gestionnaire = Usager::where('role_id', 2)->first();
        $lieu = Lieu::where('proprietaire_id', '=', $gestionnaire->id)
            ->where('actif', true)
            ->firstOrFail();
        $this->actingAs($gestionnaire);

        $request = new LieuRequest();
        $request->replace(['actif' => 0]);

        $controller = new LieuxController();
        $response = $controller->ChangerEtatLieu($request, $lieu->id);

        $lieuActualise = $lieu->fresh();

        $this->assertEquals(200, $response->getStatusCode(), 'Statut HTTP incorrect');
        $this->assertEquals(0, $lieuActualise->actif, 'Le lieu devrait être désactivé');
        $this->assertJson($response->getContent(), 'La réponse devrait être en JSON');
    }

    /**
     * Teste si le statut de l'activité change bien si elle a seulement un lieu d'associé.
     */
    public function testDesactivationActiviteSiUnSeulLieuAssocie()
    {
        $this->seed();
    
        $gestionnaire = Usager::where('role_id', 2)->first();
        $this->actingAs($gestionnaire);
        $lieu = Lieu::where('proprietaire_id', '=', $gestionnaire->id)
            ->where('actif', true)
            ->firstOrFail();
    
        $activite = Activite::create([
            'nom' => 'Activité Test Unique',
            'description' => 'Description activité test',
            'actif' => 1,
            'dateDebut' => '2025-03-21',
            'typeActivite_id' => 1
        ]);
        
        $activite->lieux()->attach($lieu->id);
        
    
        $this->assertCount(1, $activite->lieux);
        $this->assertDatabaseHas('LieuActivites', [
            'lieu_id' => $lieu->id,
            'activite_id' => $activite->id
        ]);
    
        $request = new LieuRequest();
        $request->replace(['actif' => 0]);
        $controller = new LieuxController();
        $response = $controller->ChangerEtatLieu($request, $lieu->id);
    
        $this->assertEquals(0, $lieu->fresh()->actif);
        $this->assertEquals(0, $activite->fresh()->actif); 
        $this->assertTrue($activite->lieux()->exists()); 
    }

}
