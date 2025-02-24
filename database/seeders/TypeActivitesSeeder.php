<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeActivitesSeeder extends Seeder
{

    public function run()
    {
        DB::table('TypeActivites')->insert([
            ['id' => 1, 'nom' => 'Plein air',  'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nom' => 'Sportive',   'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nom' => 'Relaxation', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
