<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuartierSeeder extends Seeder
{
    public function run()
    {
        DB::table('Quartiers')->insert([
            ['id' => 1, 'nom' => 'Centre-ville', 'actif' => true, 'ville_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nom' => 'Plateau Mont-Royal', 'actif' => true, 'ville_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nom' => 'Bas-du-cap', 'actif' => true, 'ville_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
