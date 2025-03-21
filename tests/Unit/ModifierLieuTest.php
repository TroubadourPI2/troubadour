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

    /**
     * Teste si l'image est bien ajoutée au stockage et dans le bon dossier.
     */
    public function testAjoutImageFournie()
    {
        Storage::fake('DevActivite');

        $file = UploadedFile::fake()->image('photo.jpg');

        $lieu = new Lieu();
        $lieu->photoLieu = $file->store('lieux', 'DevActivite');

        Storage::disk('DevActivite')->assertExists($lieu->photoLieu);

        $this->assertStringStartsWith('lieux/', $lieu->photoLieu, 'L’image doit être stockée dans le bon dossier.');
    }

    /**
     * Teste si la photo supprimée est bien retirée du stockage et remplacée par la photo par défaut.
     */
    public function test_suppression_photo_met_photo_par_defaut()
    {
        // Charger les données existantes
        $this->seed();

        // Configuration du stockage fictif
        Storage::fake('DevActivite');

        // Récupérer l'usager #5 existant
        $user = Usager::findOrFail(5);

        // Créer un nouveau lieu spécifique pour le test
        $lieu = new Lieu();
        $lieu->proprietaire_id = $user->id;
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
        Storage::disk('DevActivite')->put('lieux/image_defaut.png', 'contenu_defaut');

        $response = $this->actingAs($user)->put(route('usagerLieux.modifierLieu', $lieu->id), [
            'photoLieuSupprime' => '1',
            'rue' => $lieu->rue,
            'noCivic' => $lieu->noCivic,
            'codePostal' => $lieu->codePostal,
            'nomEtablissement' => $lieu->nomEtablissement,
            'siteWeb' => $lieu->siteWeb ?? '',
            'numeroTelephone' => $lieu->numeroTelephone ?? '',
            'description' => $lieu->description ?? '',
            'selectQuartierLieu' => $lieu->quartier_id,
            'selectTypeLieu' => $lieu->typeLieu_id,
        ]);

        $lieu->refresh();

        Storage::disk('DevActivite')->assertMissing('lieux/test_photo.jpg');
        Storage::disk('DevActivite')->assertExists('lieux/image_defaut.png');
        $this->assertEquals('lieux/image_defaut.png', $lieu->photoLieu);
    }
}
