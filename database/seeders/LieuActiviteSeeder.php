<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LieuActiviteSeeder extends Seeder
{
    public function run()
    {
        DB::table('LieuActivites')->insert([
        
            [
                'lieu_id'      => 1,
                'activite_id'  => 1,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'lieu_id'      => 1,
                'activite_id'  => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'lieu_id'      => 1,
                'activite_id'  => 4,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'lieu_id'      => 2,
                'activite_id'  => 1,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
     
            [
                'lieu_id'      => 3,
                'activite_id'  => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'lieu_id'      => 4,
                'activite_id'  => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        
            [
                'lieu_id'      => 5,
                'activite_id'  => 3,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'lieu_id'      => 6,
                'activite_id'  => 3,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
         
            [
                'lieu_id'      => 7,
                'activite_id'  => 4,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'lieu_id'      => 8,
                'activite_id'  => 4,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'lieu_id'      => 9,
                'activite_id'  => 4,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'lieu_id'      => 10,
                'activite_id'  => 4,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
