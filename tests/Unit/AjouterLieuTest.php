<?php

namespace Tests\Unit;

use Tests\TestCase; // Utiliser le TestCase de Laravel
use App\Models\Usager;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LieuRequest;
use App\Models\Quartier;
use App\Models\TypeLieu;

class AjouterLieuTest extends TestCase
{
    use RefreshDatabase;

    public function TestValidationDesDonneesValides()
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
}
