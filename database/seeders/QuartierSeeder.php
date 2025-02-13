<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuartierSeeder extends Seeder
{
    public function run()
    {
        DB::table('Quartier')->insert([
            ['id' => 1, 'nom' => 'Centre-ville',      'actif' => true, 'quartierId' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nom' => 'Plateau Mont-Royal', 'actif' => true, 'quartierId' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
