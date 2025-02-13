<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeLieuSeeder extends Seeder
{
    public function run()
    {
        DB::table('TypeLieu')->insert([
            ['id' => 1, 'nom' => 'Restaurant', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nom' => 'Café',       'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nom' => 'Hôtel',      'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
