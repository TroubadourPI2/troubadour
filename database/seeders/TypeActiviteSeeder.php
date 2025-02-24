<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeActiviteSeeder extends Seeder
{
    public function run()
    {
        DB::table('TypeActivites')->insert([
            [   'id'=> 1,   
                'nom' => 'Concert',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   'id'=> 2,  
                'nom' => 'Exposition',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   'id'=> 3,  
                'nom' => 'Spectacle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   'id'=> 4,  
                'nom' => 'Atelier',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
