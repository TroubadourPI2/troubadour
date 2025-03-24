<?php

namespace Tests\Unit;

use App\Http\Controllers\LieuxController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Requests\LieuRequest;
use App\Models\Lieu;
use App\Models\Usager;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SupprimerLieuTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste qu'un gestionnaire ne peut pas supprimer un lieu qui ne lui appartient pas.
     */
    public function testSupprimerLieuNonAutorise()
    {
        $this->seed();

        $gestionnaire = Usager::where('role_id', '!=', 1)->first();
        $lieu = Lieu::where('proprietaire_id', '!=', $gestionnaire->id)->first();

        $this->actingAs($gestionnaire);

        $controller = new LieuxController();
        $response = $controller->SupprimerUnLieu($lieu->id);

        $this->assertEquals(403, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $data = json_decode($response->getContent(), true);
        $this->assertFalse($data['success']);
        $this->assertEquals(__('erreur403Texte'), $data['message']);
    }

    /**
     * Teste que lorsqu'un lieu est supprimé la photo associée est également supprimée.
     */
    public function testSiSupprimeLieuSupprimePhoto()
    {
        $this->seed();

        Storage::fake('DevActivite');

        $gestionnaire = Usager::findOrFail(5);

        $lieu = new Lieu();
        $lieu->proprietaire_id = $gestionnaire->id;
        $lieu->nomEtablissement = 'Lieu Test Suppression Photo';
        $lieu->rue = '123 Rue Test';
        $lieu->noCivic = '456';
        $lieu->codePostal = 'H1H 1H1';
        $lieu->quartier_id = 1;
        $lieu->typeLieu_id = 1;
        $lieu->numeroTelephone = '514-555-1234';
        $lieu->photoLieu = 'lieux/test_photo.jpg';
        $lieu->save();

        Storage::disk('DevActivite')->put($lieu->photoLieu, 'contenu_fictif');

        $response = $this->actingAs($gestionnaire)->delete(route('usagerLieux.supprimerLieu', $lieu->id));

        $response->assertStatus(200); 
        Storage::disk('DevActivite')->assertMissing($lieu->photoLieu);
        $this->assertDatabaseMissing('lieux', ['id' => $lieu->id]); 
    }
}
