<?php

namespace Tests\Unit;


use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ActiviteRequest;
use App\Models\Activite;
use App\Models\Usager;
use Illuminate\Support\Facades\Storage;


class AjouterActiviteTest extends TestCase
{   
    use RefreshDatabase;
    public function testActiviteAvecDonneesValides()
    {
        $this->seed();

        
        $donnee = [
            'nomActivite'         => 'Atelier harmonica',
            'dateDebut'           => now()->addDay()->toDateString(),
            'dateFin'             => now()->addDays(2)->toDateString(),
            'descriptionActivite' => 'Test Lieu',
            'lieu_id'             => [2],
            'typeActivite_id'     => 1,
            'photos' => [
                [
                    'files' => UploadedFile::fake()->image('photo.jpg'),
                    'position' => 1,
                ]
            ]
        ];
        
    
        $validator = Validator::make($donnee, (new ActiviteRequest())->rules());



        $this->assertFalse($validator->fails(), 'La validation ne devrait pas échouer.');
    }
    

} 




