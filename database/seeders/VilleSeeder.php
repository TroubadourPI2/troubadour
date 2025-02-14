<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VilleSeeder extends Seeder
{
    public function run()
    {
        DB::table('Villes')->insert([
            ['id' => 1, 'nom' => 'Trois-Rivières','actif' => true, 'regionId' => 1, 'paysId' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nom' => 'Montréal','actif' => false, 'regionId' => 2, 'paysId' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
