<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaysSeeder extends Seeder
{
    public function run()
    {
        DB::table('Pays')->insert([
            ['id' => 1, 'nom' => 'Canada','actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nom' => 'États-Unis','actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nom' => 'France','actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nom' => 'Allemagne','actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'nom' => 'Italie','actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'nom' => 'Espagne','actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'nom' => 'Mexique','actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'nom' => 'Brésil','actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'nom' => 'Australie','actif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'nom' => 'Japon','actif' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
