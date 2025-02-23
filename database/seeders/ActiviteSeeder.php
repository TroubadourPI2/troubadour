<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activite;

class ActiviteSeeder extends Seeder
{
    public function run()
    {
     
        Activite::create([
            'id'              => 1,
            'nom'             => 'Concert Rock',
            'dateDebut'       => now()->addDays(5),
            'dateFin'         => now()->addDays(5)->addHours(3),
            'description'     => 'Concert de rock en live.',
            'actif'           => true,
            'typeActivite_id' => 1,
        ]);

  
        Activite::create([
            'id'              => 2,
            'nom'             => 'Exposition d\'Art',
            'dateDebut'       => now()->addDays(10),
            'dateFin'         => now()->addDays(10)->addHours(5),
            'description'     => 'Exposition d\'art moderne.',
            'actif'           => true,
            'typeActivite_id' => 2,
        ]);


        Activite::create([
            'id'              => 3,
            'nom'             => 'Spectacle de Magie',
            'dateDebut'       => now()->addDays(15),
            'dateFin'         => now()->addDays(15)->addHours(2),
            'description'     => 'Spectacle de magie pour toute la famille.',
            'actif'           => true,
            'typeActivite_id' => 3,
        ]);


        Activite::create([
            'id'              => 4,
            'nom'             => 'Atelier de Cuisine',
            'dateDebut'       => now()->addDays(20),
            'dateFin'         => now()->addDays(20)->addHours(4),
            'description'     => 'Atelier de cuisine gastronomique.',
            'actif'           => true,
            'typeActivite_id' => 4,
        ]);
    }
}
