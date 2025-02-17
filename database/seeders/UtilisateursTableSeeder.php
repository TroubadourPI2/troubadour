<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UtilisateursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('utilisateurs')->insert
        ([
            [
                'prenom' => 'Ju',
                'nom' => 'Test',
                'email' => 'JuTest@email.com',
                'mdp' => Hash::make('testTest*'),
                // 'role' => 'Administrateurs'
            ]
        ]);
    }
}
