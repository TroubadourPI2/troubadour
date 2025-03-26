<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActiviteFavoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ActiviteFavoris')->insert([
            [
                'activite_id' => 1,
                'usager_id' => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'activite_id' => 2,
                'usager_id' => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'activite_id' => 3,
                'usager_id' => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'activite_id' => 4,
                'usager_id' => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            
        ]);
    }
}
