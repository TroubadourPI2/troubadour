<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LieuSeeder extends Seeder
{
    public function run()
    {
        DB::table('Lieux')->insert([
            // Lieux pour Trois-Rivières (quartier_id = 1)
            [
                'id' => 1,
                'rue' => 'avenue des Draveurs',
                'noCivic' => 200,
                'codePostal' => 'G9A 5H3',
                'nomEtablissement' => 'Boréalis',
                'photoLieu' => '',
                'siteWeb' => 'https://www.borealis3r.ca/',
                'numeroTelephone' => '8193724633',
                'actif' => true,
                'description' => 'Une grande saga industrielle',
                'quartier_id' => 1,
                'typeLieu_id' => 4,
                'proprietaire_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'rue' => 'place de l\'Hôtel-de-Ville',
                'noCivic' => 1425,
                'codePostal' => 'G9A 5H3',
                'nomEtablissement' => 'Centre d\'exposition Raymond-Lasnier',
                'photoLieu' => '',
                'siteWeb' => 'https://www.culture3r.com/lieux/centre-dexposition-raymond-lasnier/',
                'numeroTelephone' => '8193724611',
                'actif' => true,
                'description' => 'Centre d\'exposition',
                'quartier_id' => 1,
                'typeLieu_id' => 4,
                'proprietaire_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'rue' => 'rue Fusey',
                'noCivic' => 150,
                'codePostal' => 'G8T 2V8',
                'nomEtablissement' => 'Espace Pauline-Julien',
                'photoLieu' => '',
                'siteWeb' => 'http://tr3.ca',
                'numeroTelephone' => '8191111113',
                'actif' => true,
                'description' => 'Présentation d\'artistes professionnels et de la relève.',
                'quartier_id' => 3,
                'typeLieu_id' => 4,
                'proprietaire_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'rue' => 'Rue de la Gare TR',
                'noCivic' => 104,
                'codePostal' => 'G8T 1A4',
                'nomEtablissement' => 'Restaurant TR 4',
                'photoLieu' => 'Images/Logos/logoC1.svg',
                'siteWeb' => 'http://tr4.ca',
                'numeroTelephone' => '8191111114',
                'actif' => true,
                'description' => 'Restaurant Trois-Rivières 4 description',
                'quartier_id' => 1,
                'typeLieu_id' => 1,
                'proprietaire_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'rue' => 'Rue des Écoles TR',
                'noCivic' => 105,
                'codePostal' => 'G8T 1A5',
                'nomEtablissement' => 'Café TR 5',
                'photoLieu' => 'Images/Logos/logoC1.svg',
                'siteWeb' => 'http://tr5.ca',
                'numeroTelephone' => '8191111115',
                'actif' => true,
                'description' => 'Café Trois-Rivières 5 description',
                'quartier_id' => 1,
                'typeLieu_id' => 2,
                'proprietaire_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'rue' => 'Rue Saint-Jean TR',
                'noCivic' => 106,
                'codePostal' => 'G8T 1A6',
                'nomEtablissement' => 'Hôtel TR 6',
                'photoLieu' => 'Images/Logos/logoC1.svg',
                'siteWeb' => 'http://tr6.ca',
                'numeroTelephone' => '8191111116',
                'actif' => true,
                'description' => 'Hôtel Trois-Rivières 6 description',
                'quartier_id' => 1,
                'typeLieu_id' => 3,
                'proprietaire_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'rue' => 'Avenue du Parc TR',
                'noCivic' => 107,
                'codePostal' => 'G8T 1A7',
                'nomEtablissement' => 'Restaurant TR 7',
                'photoLieu' => 'Images/Logos/logoC1.svg',
                'siteWeb' => 'http://tr7.ca',
                'numeroTelephone' => '8191111117',
                'actif' => true,
                'description' => 'Restaurant Trois-Rivières 7 description',
                'quartier_id' => 1,
                'typeLieu_id' => 1,
                'proprietaire_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'rue' => 'Rue des Fleurs TR',
                'noCivic' => 108,
                'codePostal' => 'G8T 1A8',
                'nomEtablissement' => 'Café TR 8',
                'photoLieu' => 'Images/Logos/logoC1.svg',
                'siteWeb' => 'http://tr8.ca',
                'numeroTelephone' => '8191111118',
                'actif' => true,
                'description' => 'Café Trois-Rivières 8 description',
                'quartier_id' => 1,
                'typeLieu_id' => 2,
                'proprietaire_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'rue' => 'Boulevard des Arts TR',
                'noCivic' => 109,
                'codePostal' => 'G8T 1A9',
                'nomEtablissement' => 'Hôtel TR 9',
                'photoLieu' => 'Images/Logos/logoC1.svg',
                'siteWeb' => 'http://tr9.ca',
                'numeroTelephone' => '8191111119',
                'actif' => true,
                'description' => 'Hôtel Trois-Rivières 9 description',
                'quartier_id' => 1,
                'typeLieu_id' => 3,
                'proprietaire_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'rue' => 'Rue du Port TR',
                'noCivic' => 110,
                'codePostal' => 'G8T 1B0',
                'nomEtablissement' => 'Restaurant TR 10',
                'photoLieu' => 'Images/Logos/logoC1.svg',
                'siteWeb' => 'http://tr10.ca',
                'numeroTelephone' => '8191111120',
                'actif' => true,
                'description' => 'Restaurant Trois-Rivières 10 description',
                'quartier_id' => 2,
                'typeLieu_id' => 1,
                'proprietaire_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Lieux pour Montréal (quartier_id = 2)
            [
                'id' => 11,
                'rue' => 'Rue Principale Montréal',
                'noCivic' => 201,
                'codePostal' => 'H1A 1B1',
                'nomEtablissement' => 'Restaurant Montréal 1',
                'photoLieu' => 'Images/Logos/logoC1.svg',
                'siteWeb' => 'http://mtl1.ca',
                'numeroTelephone' => '5142222211',
                'actif' => true,
                'description' => 'Restaurant réputé de Montréal 1',
                'quartier_id' => 2,
                'typeLieu_id' => 1,
                'proprietaire_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'rue' => 'Avenue du Centre Montréal',
                'noCivic' => 202,
                'codePostal' => 'H1A 1B2',
                'nomEtablissement' => 'Café Montréal 2',
                'photoLieu' => 'Images/Logos/logoC1.svg',
                'siteWeb' => 'http://mtl2.ca',
                'numeroTelephone' => '5142222212',
                'actif' => true,
                'description' => 'Café chaleureux de Montréal 2',
                'quartier_id' => 2,
                'typeLieu_id' => 2,
                'proprietaire_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 13,
                'rue' => 'Boulevard Montréal',
                'noCivic' => 203,
                'codePostal' => 'H1A 1B3',
                'nomEtablissement' => 'Hôtel Montréal 3',
                'photoLieu' => 'Images/Logos/logoC1.svg',
                'siteWeb' => 'http://mtl3.ca',
                'numeroTelephone' => '5142222213',
                'actif' => true,
                'description' => 'Hôtel de luxe de Montréal 3',
                'quartier_id' => 2,
                'typeLieu_id' => 3,
                'proprietaire_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 14,
                'rue' => 'Rue de la Gare Montréal',
                'noCivic' => 204,
                'codePostal' => 'H1A 1B4',
                'nomEtablissement' => 'Restaurant Montréal 4',
                'photoLieu' => 'Images/Logos/logoC1.svg',
                'siteWeb' => 'http://mtl4.ca',
                'numeroTelephone' => '5142222214',
                'actif' => true,
                'description' => 'Restaurant Montréal 4 description',
                'quartier_id' => 2,
                'typeLieu_id' => 1,
                'proprietaire_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 15,
                'rue' => 'Rue des Écoles Montréal',
                'noCivic' => 205,
                'codePostal' => 'H1A 1B5',
                'nomEtablissement' => 'Café Montréal 5',
                'photoLieu' => 'Images/Logos/logoC1.svg',
                'siteWeb' => 'http://mtl5.ca',
                'numeroTelephone' => '5142222215',
                'actif' => true,
                'description' => 'Café Montréal 5 description',
                'quartier_id' => 2,
                'typeLieu_id' => 2,
                'proprietaire_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 16,
                'rue' => 'Rue Saint-Jean Montréal',
                'noCivic' => 206,
                'codePostal' => 'H1A 1B6',
                'nomEtablissement' => 'Hôtel Montréal 6',
                'photoLieu' => 'Images/Logos/logoC1.svg',
                'siteWeb' => 'http://mtl6.ca',
                'numeroTelephone' => '5142222216',
                'actif' => true,
                'description' => 'Hôtel Montréal 6 description',
                'quartier_id' => 2,
                'typeLieu_id' => 3,
                'proprietaire_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 17,
                'rue' => 'Avenue du Parc Montréal',
                'noCivic' => 207,
                'codePostal' => 'H1A 1B7',
                'nomEtablissement' => 'Restaurant Montréal 7',
                'photoLieu' => 'Images/Logos/logoC1.svg',
                'siteWeb' => 'http://mtl7.ca',
                'numeroTelephone' => '5142222217',
                'actif' => true,
                'description' => 'Restaurant Montréal 7 description',
                'quartier_id' => 2,
                'typeLieu_id' => 1,
                'proprietaire_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 18,
                'rue' => 'Rue des Fleurs Montréal',
                'noCivic' => 208,
                'codePostal' => 'H1A 1B8',
                'nomEtablissement' => 'Café Montréal 8',
                'photoLieu' => 'Images/Logos/logoC1.svg',
                'siteWeb' => 'http://mtl8.ca',
                'numeroTelephone' => '5142222218',
                'actif' => true,
                'description' => 'Café Montréal 8 description',
                'quartier_id' => 2,
                'typeLieu_id' => 2,
                'proprietaire_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 19,
                'rue' => 'Boulevard des Arts Montréal',
                'noCivic' => 209,
                'codePostal' => 'H1A 1B9',
                'nomEtablissement' => 'Hôtel Montréal 9',
                'photoLieu' => 'Images/Logos/logoC1.svg',
                'siteWeb' => 'http://mtl9.ca',
                'numeroTelephone' => '5142222219',
                'actif' => true,
                'description' => 'Hôtel Montréal 9 description',
                'quartier_id' => 2,
                'typeLieu_id' => 3,
                'proprietaire_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 20,
                'rue' => 'Rue du Port Montréal',
                'noCivic' => 210,
                'codePostal' => 'H1A 1C0',
                'nomEtablissement' => 'Restaurant Montréal 10',
                'photoLieu' => 'Images/Logos/logoC1.svg',
                'siteWeb' => 'http://mtl10.ca',
                'numeroTelephone' => '5142222220',
                'actif' => true,
                'description' => 'Restaurant Montréal 10 description',
                'quartier_id' => 2,
                'typeLieu_id' => 1,
                'proprietaire_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
