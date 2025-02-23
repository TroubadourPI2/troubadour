<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeActiviteSeeder extends Seeder
{
    public function run()
    {
        DB::table('TypeActivites')->insert([
            [
                'nom' => 'Concert',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Exposition',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Spectacle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Atelier',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
