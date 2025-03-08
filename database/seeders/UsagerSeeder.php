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
            [
                'id' => 7,
                'courriel'   => 'alex@toronto.ca',
                'password'   => bcrypt('Secret1234'),
                'prenom'     => 'Alex',
                'nom'        => 'Toronto',
                'statut_id'  => 2, 
                'role_id'    => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'courriel'   => 'lucas@ottawa.ca',
                'password'   => bcrypt('Secret1234'),
                'prenom'     => 'Lucas',
                'nom'        => 'Ottawa',
                'statut_id'  => 3, 
                'role_id'    => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'courriel'   => 'sarah@lavl.ca',
                'password'   => bcrypt('Secret1234'),
                'prenom'     => 'Sarah',
                'nom'        => 'Laval',
                'statut_id'  => 1, 
                'role_id'    => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'courriel'   => 'emma@drumm.ca',
                'password'   => bcrypt('Secret1234'),
                'prenom'     => 'Emma',
                'nom'        => 'Drumm',
                'statut_id'  => 3, 
                'role_id'    => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 11,
                'courriel'   => 'jules@sherb.ca',
                'password'   => bcrypt('Secret1234'),
                'prenom'     => 'Jules',
                'nom'        => 'Sherbrooke',
                'statut_id'  => 1, 
                'role_id'    => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'courriel'   => 'nina@levis.ca',
                'password'   => bcrypt('Secret1234'),
                'prenom'     => 'Nina',
                'nom'        => 'Levis',
                'statut_id'  => 2, 
                'role_id'    => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 13,
                'courriel'   => 'leo@mascouche.ca',
                'password'   => bcrypt('Secret1234'),
                'prenom'     => 'Leo',
                'nom'        => 'Mascouche',
                'statut_id'  => 3, 
                'role_id'    => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 14,
                'courriel'   => 'zoe@long.ca',
                'password'   => bcrypt('Secret1234'),
                'prenom'     => 'Zoe',
                'nom'        => 'Longueuil',
                'statut_id'  => 1, 
                'role_id'    => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 15,
                'courriel'   => 'paul@long.ca',
                'password'   => bcrypt('Secret1234'),
                'prenom'     => 'Paul',
                'nom'        => 'Longueuil',
                'statut_id'  => 3, 
                'role_id'    => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 16,
                'courriel'   => 'pierre@tolippo.ca',
                'password'   => bcrypt('Secret1234'),
                'prenom'     => 'Pierre',
                'nom'        => 'Tolippo',
                'statut_id'  => 3, 
                'role_id'    => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 17,
                'courriel'   => 'antoine@petit.ca',
                'password'   => bcrypt('Secret1234'),
                'prenom'     => 'Antoine',
                'nom'        => 'Petit',
                'statut_id'  => 3, 
                'role_id'    => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 18,
                'courriel'   => 'felipe@carlos.ca',
                'password'   => bcrypt('Secret1234'),
                'prenom'     => 'Felipe',
                'nom'        => 'Carlos',
                'statut_id'  => 3, 
                'role_id'    => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 19,
                'courriel'   => 'eric@thibault.ca',
                'password'   => bcrypt('Secret1234'),
                'prenom'     => 'Eric',
                'nom'        => 'Thibault',
                'statut_id'  => 3, 
                'role_id'    => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 20,
                'courriel'   => 'lylo@park.ca',
                'password'   => bcrypt('Secret1234'),
                'prenom'     => 'Lylo',
                'nom'        => 'Park',
                'statut_id'  => 3, 
                'role_id'    => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 21,
                'courriel'   => 'zuko@tar.ca',
                'password'   => bcrypt('Secret1234'),
                'prenom'     => 'Zuko',
                'nom'        => 'tar',
                'statut_id'  => 2, 
                'role_id'    => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
