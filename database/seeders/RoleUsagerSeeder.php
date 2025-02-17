<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUsagerSeeder extends Seeder
{
    public function run()
    {
        DB::table('RoleUsagers')->insert([
            ['id' => 1, 'nom' => 'Admin','created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nom' => 'Utilisateur','created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nom' => 'Gestionnaire','created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
