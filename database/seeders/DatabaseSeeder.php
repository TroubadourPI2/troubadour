<?php

namespace Database\Seeders;

use App\Models\LieuActivite;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PaysSeeder::class,
            ProvinceSeeder::class,
            RegionAdministrativeSeeder::class,
            VilleSeeder::class,
            QuartierSeeder::class,
            StatutSeeder::class,
            RoleUsagerSeeder::class,
            UsagerSeeder::class,
            TypeLieuSeeder::class,
            LieuSeeder::class,
            TypeActivitesSeeder::class,
            ActivitesSeeder::class,
            LieuActivitesSeeder::class,
        ]);
    }
}
