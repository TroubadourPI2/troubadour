<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatutSeeder extends Seeder
{
    public function run()
    {
        DB::table('Statut')->insert([
            ['id' => 1, 'statut' => 'Actif','created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'statut' => 'Inactif','created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'statut' => 'En Attente','created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
