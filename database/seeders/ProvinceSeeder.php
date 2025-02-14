<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Provinces')->insert([
            ['id' => 1, 'nom' => 'Ontario','actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nom' => 'Québec','actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nom' => 'Nouvelle-Écosse','actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nom' => 'Nouveau-Brunswick','actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'nom' => 'Manitoba','actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'nom' => 'Colombie-Britannique','actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'nom' => "Île-du-Prince-Édouard",'actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'nom' => 'Saskatchewan','actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'nom' => 'Alberta','actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'nom' => 'Terre-Neuve-et-Labrador','actif' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
