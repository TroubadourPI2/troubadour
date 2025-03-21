<?php

namespace Tests\Unit;


use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ActiviteRequest;
use App\Models\Activite;
use Illuminate\Support\Facades\Storage;


class AjouterActiviteTest extends TestCase
{   
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
        $this->seed();
        
    }
}
