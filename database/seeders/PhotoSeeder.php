<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhotoSeeder extends Seeder
{
    public function run()
    {
        // Pour l'activité 1
        $positions1 = [1, 2, 3];
        shuffle($positions1);
        DB::table('Photos')->insert([
            [
                'id'          => 1,
                'nom'         => '1.jpg',
                'position'    => $positions1[0],
                'chemin'      => 'Images/Activites/1.jpg',
                'activite_id' => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id'          => 2,
                'nom'         => '2.jpg',
                'position'    => $positions1[1],
                'chemin'      => 'Images/Activites/2.jpg',
                'activite_id' => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id'          => 3,
                'nom'         => '3.jpg',
                'position'    => $positions1[2],
                'chemin'      => 'Images/Activites/3.jpg',
                'activite_id' => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);

        // Pour l'activité 2
        $positions2 = [1, 2, 3];
        shuffle($positions2);
        DB::table('Photos')->insert([
            [
                'id'          => 4,
                'nom'         => '1.jpg',
                'position'    => $positions2[0],
                'chemin'      => 'Images/Activites/1.jpg',
                'activite_id' => 2,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id'          => 5,
                'nom'         => '2.jpg',
                'position'    => $positions2[1],
                'chemin'      => 'Images/Activites/2.jpg',
                'activite_id' => 2,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id'          => 6,
                'nom'         => '3.jpg',
                'position'    => $positions2[2],
                'chemin'      => 'Images/Activites/3.jpg',
                'activite_id' => 2,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);

        // Pour l'activité 3
        $positions3 = [1, 2, 3];
        shuffle($positions3);
        DB::table('Photos')->insert([
            [
                'id'          => 7,
                'nom'         => '1.jpg',
                'position'    => $positions3[0],
                'chemin'      => 'Images/Activites/1.jpg',
                'activite_id' => 3,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id'          => 8,
                'nom'         => '2.jpg',
                'position'    => $positions3[1],
                'chemin'      => 'Images/Activites/2.jpg',
                'activite_id' => 3,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id'          => 9,
                'nom'         => '3.jpg',
                'position'    => $positions3[2],
                'chemin'      => 'Images/Activites/3.jpg',
                'activite_id' => 3,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);

        // Pour l'activité 4
        $positions4 = [1, 2, 3];
        shuffle($positions4);
        DB::table('Photos')->insert([
            [
                'id'          => 10,
                'nom'         => '1.jpg',
                'position'    => $positions4[0],
                'chemin'      => 'Images/Activites/1.jpg',
                'activite_id' => 4,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id'          => 11,
                'nom'         => '2.jpg',
                'position'    => $positions4[1],
                'chemin'      => 'Images/Activites/2.jpg',
                'activite_id' => 4,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id'          => 12,
                'nom'         => '3.jpg',
                'position'    => $positions4[2],
                'chemin'      => 'Images/Activites/3.jpg',
                'activite_id' => 4,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
