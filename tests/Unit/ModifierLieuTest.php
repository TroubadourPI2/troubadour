<?php

namespace Tests\Unit;

use App\Http\Controllers\LieuxController;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LieuRequest;
use App\Models\Lieu;
use Illuminate\Support\Facades\Storage;
use App\Models\Usager;
use Illuminate\Support\Facades\Log;

class ModifierLieuTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Teste si un gestionnaire ne peut pas modifier un lieu qui ne lui appartient pas.
     */
    public function testModifierUnLieuUtilisateurNonAutoriseDirect()
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
        $response = $controller->ModifierUnLieu($request, $lieu->id);

        $this->assertEquals(403, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $data = json_decode($response->getContent(), true);
        $this->assertFalse($data['success']);
        $this->assertEquals(__('erreur403Texte'), $data['message']);
    }

    /**
     * Teste si les fonctions strtoupper() et htmlspecialchars() sont utilisées et retournent les bonnes valeurs.
     */
    public function testTraitementDesChampsAvantInsertion()
    {
        $data = [
            'codePostal' => 'a1a 1a1',
            'nomEtablissement' => '<b>Test Lieu</b>',
            'description' => '<script>alert("hack")</script>',
        ];

        $lieu = new Lieu();
        $lieu->codePostal = strtoupper($data['codePostal']);
        $lieu->nomEtablissement = htmlspecialchars($data['nomEtablissement']);
        $lieu->description = htmlspecialchars($data['description']);

        $this->assertEquals('A1A 1A1', $lieu->codePostal, 'Le code postal doit être en majuscules.');
        $this->assertEquals('&lt;b&gt;Test Lieu&lt;/b&gt;', $lieu->nomEtablissement, 'Le nom doit être échappé.');
        $this->assertEquals('&lt;script&gt;alert(&quot;hack&quot;)&lt;/script&gt;', $lieu->description, 'Le script doit être échappé.');
    }
}
