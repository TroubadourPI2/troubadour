<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LieuSeeder extends Seeder
{
    public function run()
    {
        DB::table('Lieu')->insert([
            // Lieux pour Trois-Rivières (quartierId = 1)
            [
                'id' => 1,
                'rue' => 'Rue Principale TR',
                'noCivic' => 101,
                'codePostal' => 'G8T 1A1',
                'nomEtablissement' => 'Restaurant TR 1',
                'photoLieu' => 'Images/logos/logo1.png',
                'siteWeb' => 'http://tr1.ca',
                'numeroTelephone' => '8191111111',
                'actif' => true,
                'description' => 'Restaurant réputé de Trois-Rivières 1',
                'quartierId' => 1,
                'typeLieuId' => 1,
                'proprietaireId' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'rue' => 'Avenue du Centre TR',
                'noCivic' => 102,
                'codePostal' => 'G8T 1A2',
                'nomEtablissement' => 'Café TR 2',
                'photoLieu' => 'Images/logos/logo2.png',
                'siteWeb' => 'http://tr2.ca',
                'numeroTelephone' => '8191111112',
                'actif' => true,
                'description' => 'Café chaleureux de Trois-Rivières 2',
                'quartierId' => 1,
                'typeLieuId' => 2,
                'proprietaireId' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'rue' => 'Boulevard TR',
                'noCivic' => 103,
                'codePostal' => 'G8T 1A3',
                'nomEtablissement' => 'Hôtel TR 3',
                'photoLieu' => 'Images/logos/logo3.png',
                'siteWeb' => 'http://tr3.ca',
                'numeroTelephone' => '8191111113',
                'actif' => true,
                'description' => 'Hôtel de luxe de Trois-Rivières 3',
                'quartierId' => 1,
                'typeLieuId' => 3,
                'proprietaireId' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'rue' => 'Rue de la Gare TR',
                'noCivic' => 104,
                'codePostal' => 'G8T 1A4',
                'nomEtablissement' => 'Restaurant TR 4',
                'photoLieu' => 'Images/logos/logo4.png',
                'siteWeb' => 'http://tr4.ca',
                'numeroTelephone' => '8191111114',
                'actif' => true,
                'description' => 'Restaurant Trois-Rivières 4 description',
                'quartierId' => 1,
                'typeLieuId' => 1,
                'proprietaireId' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'rue' => 'Rue des Écoles TR',
                'noCivic' => 105,
                'codePostal' => 'G8T 1A5',
                'nomEtablissement' => 'Café TR 5',
                'photoLieu' => 'Images/logos/logo1.png',
                'siteWeb' => 'http://tr5.ca',
                'numeroTelephone' => '8191111115',
                'actif' => true,
                'description' => 'Café Trois-Rivières 5 description',
                'quartierId' => 1,
                'typeLieuId' => 2,
                'proprietaireId' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'rue' => 'Rue Saint-Jean TR',
                'noCivic' => 106,
                'codePostal' => 'G8T 1A6',
                'nomEtablissement' => 'Hôtel TR 6',
                'photoLieu' => 'Images/logos/logo2.png',
                'siteWeb' => 'http://tr6.ca',
                'numeroTelephone' => '8191111116',
                'actif' => true,
                'description' => 'Hôtel Trois-Rivières 6 description',
                'quartierId' => 1,
                'typeLieuId' => 3,
                'proprietaireId' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'rue' => 'Avenue du Parc TR',
                'noCivic' => 107,
                'codePostal' => 'G8T 1A7',
                'nomEtablissement' => 'Restaurant TR 7',
                'photoLieu' => 'Images/logos/logo3.png',
                'siteWeb' => 'http://tr7.ca',
                'numeroTelephone' => '8191111117',
                'actif' => true,
                'description' => 'Restaurant Trois-Rivières 7 description',
                'quartierId' => 1,
                'typeLieuId' => 1,
                'proprietaireId' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'rue' => 'Rue des Fleurs TR',
                'noCivic' => 108,
                'codePostal' => 'G8T 1A8',
                'nomEtablissement' => 'Café TR 8',
                'photoLieu' => 'Images/logos/logo4.png',
                'siteWeb' => 'http://tr8.ca',
                'numeroTelephone' => '8191111118',
                'actif' => true,
                'description' => 'Café Trois-Rivières 8 description',
                'quartierId' => 1,
                'typeLieuId' => 2,
                'proprietaireId' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'rue' => 'Boulevard des Arts TR',
                'noCivic' => 109,
                'codePostal' => 'G8T 1A9',
                'nomEtablissement' => 'Hôtel TR 9',
                'photoLieu' => 'Images/logos/logo1.png',
                'siteWeb' => 'http://tr9.ca',
                'numeroTelephone' => '8191111119',
                'actif' => true,
                'description' => 'Hôtel Trois-Rivières 9 description',
                'quartierId' => 1,
                'typeLieuId' => 3,
                'proprietaireId' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'rue' => 'Rue du Port TR',
                'noCivic' => 110,
                'codePostal' => 'G8T 1B0',
                'nomEtablissement' => 'Restaurant TR 10',
                'photoLieu' => 'Images/logos/logo2.png',
                'siteWeb' => 'http://tr10.ca',
                'numeroTelephone' => '8191111120',
                'actif' => true,
                'description' => 'Restaurant Trois-Rivières 10 description',
                'quartierId' => 1,
                'typeLieuId' => 1,
                'proprietaireId' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Lieux pour Montréal (quartierId = 2)
            [
                'id' => 11,
                'rue' => 'Rue Principale Montréal',
                'noCivic' => 201,
                'codePostal' => 'H1A 1B1',
                'nomEtablissement' => 'Restaurant Montréal 1',
                'photoLieu' => 'Images/logos/logo1.png',
                'siteWeb' => 'http://mtl1.ca',
                'numeroTelephone' => '5142222211',
                'actif' => true,
                'description' => 'Restaurant réputé de Montréal 1',
                'quartierId' => 2,
                'typeLieuId' => 1,
                'proprietaireId' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'rue' => 'Avenue du Centre Montréal',
                'noCivic' => 202,
                'codePostal' => 'H1A 1B2',
                'nomEtablissement' => 'Café Montréal 2',
                'photoLieu' => 'Images/logos/logo2.png',
                'siteWeb' => 'http://mtl2.ca',
                'numeroTelephone' => '5142222212',
                'actif' => true,
                'description' => 'Café chaleureux de Montréal 2',
                'quartierId' => 2,
                'typeLieuId' => 2,
                'proprietaireId' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 13,
                'rue' => 'Boulevard Montréal',
                'noCivic' => 203,
                'codePostal' => 'H1A 1B3',
                'nomEtablissement' => 'Hôtel Montréal 3',
                'photoLieu' => 'Images/logos/logo3.png',
                'siteWeb' => 'http://mtl3.ca',
                'numeroTelephone' => '5142222213',
                'actif' => true,
                'description' => 'Hôtel de luxe de Montréal 3',
                'quartierId' => 2,
                'typeLieuId' => 3,
                'proprietaireId' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 14,
                'rue' => 'Rue de la Gare Montréal',
                'noCivic' => 204,
                'codePostal' => 'H1A 1B4',
                'nomEtablissement' => 'Restaurant Montréal 4',
                'photoLieu' => 'Images/logos/logo4.png',
                'siteWeb' => 'http://mtl4.ca',
                'numeroTelephone' => '5142222214',
                'actif' => true,
                'description' => 'Restaurant Montréal 4 description',
                'quartierId' => 2,
                'typeLieuId' => 1,
                'proprietaireId' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 15,
                'rue' => 'Rue des Écoles Montréal',
                'noCivic' => 205,
                'codePostal' => 'H1A 1B5',
                'nomEtablissement' => 'Café Montréal 5',
                'photoLieu' => 'Images/logos/logo1.png',
                'siteWeb' => 'http://mtl5.ca',
                'numeroTelephone' => '5142222215',
                'actif' => true,
                'description' => 'Café Montréal 5 description',
                'quartierId' => 2,
                'typeLieuId' => 2,
                'proprietaireId' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 16,
                'rue' => 'Rue Saint-Jean Montréal',
                'noCivic' => 206,
                'codePostal' => 'H1A 1B6',
                'nomEtablissement' => 'Hôtel Montréal 6',
                'photoLieu' => 'Images/logos/logo2.png',
                'siteWeb' => 'http://mtl6.ca',
                'numeroTelephone' => '5142222216',
                'actif' => true,
                'description' => 'Hôtel Montréal 6 description',
                'quartierId' => 2,
                'typeLieuId' => 3,
                'proprietaireId' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 17,
                'rue' => 'Avenue du Parc Montréal',
                'noCivic' => 207,
                'codePostal' => 'H1A 1B7',
                'nomEtablissement' => 'Restaurant Montréal 7',
                'photoLieu' => 'Images/logos/logo3.png',
                'siteWeb' => 'http://mtl7.ca',
                'numeroTelephone' => '5142222217',
                'actif' => true,
                'description' => 'Restaurant Montréal 7 description',
                'quartierId' => 2,
                'typeLieuId' => 1,
                'proprietaireId' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 18,
                'rue' => 'Rue des Fleurs Montréal',
                'noCivic' => 208,
                'codePostal' => 'H1A 1B8',
                'nomEtablissement' => 'Café Montréal 8',
                'photoLieu' => 'Images/logos/logo4.png',
                'siteWeb' => 'http://mtl8.ca',
                'numeroTelephone' => '5142222218',
                'actif' => true,
                'description' => 'Café Montréal 8 description',
                'quartierId' => 2,
                'typeLieuId' => 2,
                'proprietaireId' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 19,
                'rue' => 'Boulevard des Arts Montréal',
                'noCivic' => 209,
                'codePostal' => 'H1A 1B9',
                'nomEtablissement' => 'Hôtel Montréal 9',
                'photoLieu' => 'Images/logos/logo1.png',
                'siteWeb' => 'http://mtl9.ca',
                'numeroTelephone' => '5142222219',
                'actif' => true,
                'description' => 'Hôtel Montréal 9 description',
                'quartierId' => 2,
                'typeLieuId' => 3,
                'proprietaireId' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 20,
                'rue' => 'Rue du Port Montréal',
                'noCivic' => 210,
                'codePostal' => 'H1A 1C0',
                'nomEtablissement' => 'Restaurant Montréal 10',
                'photoLieu' => 'Images/logos/logo2.png',
                'siteWeb' => 'http://mtl10.ca',
                'numeroTelephone' => '5142222220',
                'actif' => true,
                'description' => 'Restaurant Montréal 10 description',
                'quartierId' => 2,
                'typeLieuId' => 1,
                'proprietaireId' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
