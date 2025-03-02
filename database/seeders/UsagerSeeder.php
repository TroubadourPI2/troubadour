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
                'password'   => bcrypt('Secret1234'),
                'prenom'     => 'Admin',
                'nom'        => 'Trois-Rivières',
                'statut_id'   => 1,
                'role_id'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'courriel'   => 'user@montreal.ca',
                'password'   => bcrypt('passworD*12345678'),
                'prenom'     => 'Utilisateur',
                'nom'        => 'Montréal',
                'statut_id'   => 1, 
                'role_id'     => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'courriel'   => 'test@troisrivieres.ca',
                'password'   => bcrypt('passWord541263789*'),
                'prenom'     => 'Jo',
                'nom'        => 'Test',
                'statut_id'   => 2,
                'role_id'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'courriel'   => 'user@Quebec.ca',
                'password'   => bcrypt('PassworD*453698712'),
                'prenom'     => 'User',
                'nom'        => 'Quebec',
                'statut_id'   => 3, 
                'role_id'     => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'courriel'   => 'gestionnaire@Quebec.ca',
                'password'   => bcrypt('Secret1234'),
                'prenom'     => 'Gestionnaire',
                'nom'        => 'Quebec',
                'statut_id'   => 1, 
                'role_id'     => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'courriel'   => 'utilisateur@Quebec.ca',
                'password'   => bcrypt('Secret1234'),
                'prenom'     => 'Gestionnaire',
                'nom'        => 'Quebec',
                'statut_id'   => 1, 
                'role_id'     => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
