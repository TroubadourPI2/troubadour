<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

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
        ]);
    }
}
