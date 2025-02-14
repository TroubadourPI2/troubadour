<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsagerSeeder extends Seeder
{
    public function run()
    {
        DB::table('Usagers')->insert([
            [
                'id' => 1,
                'courriel'   => 'admin@troisrivieres.ca',
                'password'   => bcrypt('password12345678'),
                'prenom'     => 'Admin',
                'nom'        => 'Trois-Rivières',
                'statutId'   => 1,
                'roleId'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'courriel'   => 'user@montreal.ca',
                'password'   => bcrypt('password12345678'),
                'prenom'     => 'Utilisateur',
                'nom'        => 'Montréal',
                'statutId'   => 1, 
                'roleId'     => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
