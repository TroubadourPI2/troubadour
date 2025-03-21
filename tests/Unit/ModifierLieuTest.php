<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LieuRequest;
use App\Models\Lieu;
use Illuminate\Support\Facades\Storage;
use App\Models\Usager;

class ModifierLieuTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function testModifierUnLieu_UtilisateurNonAutorise()
    {
        $this->seed();
    
        $user = Usager::where('role_id', '!=', 1)->first(); 
        $lieu = Lieu::where('proprietaire_id', '!=', $user->id)->first();
    
        $this->actingAs($user);
    
        $response = $this->putJson("/compte/modifierLieu/{$lieu->id}", [
            'rue' => 'Nouvelle Rue',
        ]);
    
        $response->assertStatus(403);
        $response->assertJson(['success' => false]);
    }
}
