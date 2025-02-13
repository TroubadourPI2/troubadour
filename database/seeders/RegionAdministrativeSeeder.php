<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionAdministrativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('RegionAdministrative')->insert([
            ['id' => 1, 'nom' => 'Mauricie et Centre-du-Québec','actif' => true, 'provinceId' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nom' => 'Montréal','actif' => true, 'provinceId' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
