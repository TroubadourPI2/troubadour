<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuartierSeeder extends Seeder
{
    public function run()
    {
        DB::table('Quartiers')->insert([
            ['id' => 1, 'nom' => 'Centre-ville', 'actif' => true, 'villeId' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nom' => 'Plateau Mont-Royal', 'actif' => true, 'villeId' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
