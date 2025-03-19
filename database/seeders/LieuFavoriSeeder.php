<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LieuFavoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('LieuFavoris')->insert([
            [
                'lieu_id' => 20,
                'usager_id' => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'lieu_id' => 16,
                'usager_id' => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'lieu_id' => 8,
                'usager_id' => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'lieu_id' => 3,
                'usager_id' => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'lieu_id' => 1,
                'usager_id' => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'lieu_id' => 2,
                'usager_id' => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            
        ]);
    }
}
