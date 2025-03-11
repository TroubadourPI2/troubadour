<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeLieuSeeder extends Seeder
{
    public function run()
    {
        DB::table('TypeLieux')->insert([
            ['id' => 1, 'nom' => 'Restaurant', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nom' => 'Café',       'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nom' => 'Hôtel',      'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nom' => 'Musée',      'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'nom' => 'Parc',       'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'nom' => 'Bar',        'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'nom' => 'Bibliothèque', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'nom' => 'Cinéma',     'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'nom' => 'Épicerie',   'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'nom' => 'Pharmacie', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'nom' => 'Hôpital',   'created_at' => now(), 'updated_at' => now()],
            ['id' => 12, 'nom' => 'École',     'created_at' => now(), 'updated_at' => now()],
            ['id' => 13, 'nom' => 'Université', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 14, 'nom' => 'Bureau de poste', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 15, 'nom' => 'Boutique',  'created_at' => now(), 'updated_at' => now()],
            ['id' => 16, 'nom' => 'Boulangerie', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 17, 'nom' => 'Pâtisserie', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 18, 'nom' => 'Pizzeria',  'created_at' => now(), 'updated_at' => now()],
            ['id' => 19, 'nom' => 'Fast-food', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 20, 'nom' => 'Boucherie', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
