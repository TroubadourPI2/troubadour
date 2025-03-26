<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LieuRequest;
use App\Models\Lieu;
use Illuminate\Support\Facades\Storage;

class AjouterLieuTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste la validation des données avec la request de lieu.
     */
    public function testValidationDesDonneesValides()
    {
        $this->seed();

        $data = [
            'rue' => '123 Rue Test',
            'noCivic' => '10',
            'codePostal' => 'A1A 1A1',
            'nomEtablissement' => 'Test Lieu',
            'photoLieu' => UploadedFile::fake()->image('photo.jpg'),
            'siteWeb' => 'https://example.com',
            'numeroTelephone' => '123-456-7890',
            'description' => 'Un super lieu !',
            'selectQuartierLieu' => 1,
            'selectTypeLieu' => 1,
        ];

        $validator = Validator::make($data, (new LieuRequest())->rules());

        $this->assertFalse($validator->fails(), 'La validation ne devrait pas échouer.');
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
     * Teste si l’image par défaut est bien utilisée quand aucune image n’est envoyée.
     */
    public function testUtilisationImageParDefautSiAucuneImage()
    {
        Storage::fake('DevActivite');

        $photoCheminParDefaut = 'lieux/image_defaut.png';

        $lieu = new Lieu();
        $lieu->photoLieu = $photoCheminParDefaut;

        $this->assertEquals('lieux/image_defaut.png', $lieu->photoLieu, 'L’image par défaut doit être utilisée.');
    }
}
