<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LieuActivitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('LieuActivites')->insert([
            ['id' => 1,  'lieu_id' => 1, 'activite_id' => 1,  'created_at' => now(), 'updated_at' => now()],
            ['id' => 2,  'lieu_id' => 2, 'activite_id' => 2,  'created_at' => now(), 'updated_at' => now()],
            ['id' => 3,  'lieu_id' => 3, 'activite_id' => 3,  'created_at' => now(), 'updated_at' => now()],
            ['id' => 4,  'lieu_id' => 1, 'activite_id' => 3,  'created_at' => now(), 'updated_at' => now()],
            ['id' => 5,  'lieu_id' => 1, 'activite_id' => 2,  'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
