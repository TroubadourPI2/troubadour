<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VilleSeeder extends Seeder
{
    public function run()
    {
        DB::table('Villes')->insert([
            ['id' => 1, 'nom' => 'Trois-Rivières','actif' => true, 'region_id' => null, 'pays_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nom' => 'Montréal','actif' => false, 'region_id' => 2, 'pays_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
