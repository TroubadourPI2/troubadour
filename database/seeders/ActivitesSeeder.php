<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitesSeeder extends Seeder
{

    public function run()
    {
        DB::table('Activites')->insert([
        ['id' => 1, 'nom' => 'Randonné en forêt',         'dateDebut' => '2025-04-01', 'dateFin' => '2025-08-12', 'actif' => 1, 'description' => 'Une randonné', 'typeActivite_id' => 1,  'created_at' => now(), 'updated_at' => now()],
        ['id' => 2, 'nom' => 'Demi-Marathon Promutuel',   'dateDebut' => '2025-08-12', 'dateFin' => '2025-08-13', 'actif' => 1, 'description' => 'Un marathon',  'typeActivite_id' => 2,  'created_at' => now(), 'updated_at' => now()],
        ['id' => 3, 'nom' => 'Kinipi Spa',                'dateDebut' => '2025-01-01', 'dateFin' => '2025-12-31', 'actif' => 1, 'description' => 'Un spa',       'typeActivite_id' => 3,  'created_at' => now(), 'updated_at' => now()],
    ]);
    }
}
