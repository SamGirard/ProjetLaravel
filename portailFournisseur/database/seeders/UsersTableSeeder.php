<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'neq' => 1140030355,
                'email' => 'info@cirquedusoleil.com',
                'password' => bcrypt('password123'),
                'nomEntreprise' => 'Cirque du Soleil',
                'numCivique' => '8400',
                'rue' => '2e Avenue',
                'bureau' => '',
                'ville' => 'Montréal',
                'province' => 'Québec',
                'codePostal' => 'H1Z4M6',
                'siteInternet' => 'http://www.cirquedusoleil.com',
                'regionAdministrative' => 'Montréal',
                'typeNumTelephone' => json_encode(['Bureau']),
                'numeroTelephone' => json_encode([5141234567]),
                'poste' => json_encode(['101']),
                'etatDemande' => 'En attente',
                'numTPS' => 123456789,
                'numTVQ' => 987654321,
                'conditionPaiement' => '30 jours net',
                'devise' => 'CAD',
                'modeCommunication' => 'Courriel',
                'code_administratif' => 'ADM001',
            ],
            [
                'neq' => 1168420345,
                'email' => 'info@cascades.com',
                'password' => bcrypt('password123'),
                'nomEntreprise' => 'Cascades Canada ULC',
                'numCivique' => '772',
                'rue' => 'Sherbrooke Est',
                'bureau' => 'Bureau 400',
                'ville' => 'Kingsey Falls',
                'province' => 'Québec',
                'codePostal' => 'J0A1B0',
                'siteInternet' => 'http://www.cascades.com',
                'regionAdministrative' => 'Centre-du-Québec',
                'typeNumTelephone' => json_encode(['Bureau']),
                'numeroTelephone' => json_encode([8191234567]),
                'poste' => json_encode(['201']),
                'etatDemande' => 'En attente',
                'numTPS' => 234567891,
                'numTVQ' => 876543219,
                'conditionPaiement' => '60 jours net',
                'devise' => 'CAD',
                'modeCommunication' => 'Téléphone',
                'code_administratif' => 'ADM002',
            ],
            [
                'neq' => 1143313945,
                'email' => 'contact@bombardier.com',
                'password' => bcrypt('password123'),
                'nomEntreprise' => 'Bombardier Inc.',
                'numCivique' => '800',
                'rue' => 'René-Lévesque Blvd W',
                'bureau' => 'Bureau 2900',
                'ville' => 'Montréal',
                'province' => 'Québec',
                'codePostal' => 'H3B1Y8',
                'siteInternet' => 'http://www.bombardier.com',
                'regionAdministrative' => 'Montréal',
                'typeNumTelephone' => json_encode(['Bureau']),
                'numeroTelephone' => json_encode([5148767900]),
                'poste' => json_encode(['301']),
                'etatDemande' => 'En attente',
                'numTPS' => 345678912,
                'numTVQ' => 765432198,
                'conditionPaiement' => '45 jours net',
                'devise' => 'CAD',
                'modeCommunication' => 'Courriel',
                'code_administratif' => 'ADM003',
            ],
            [
                'neq' => 1142249510,
                'email' => 'support@loblaw.ca',
                'password' => bcrypt('password123'),
                'nomEntreprise' => 'Les Compagnies Loblaw Ltée',
                'numCivique' => '1',
                'rue' => 'Avenue Président-Kennedy',
                'bureau' => '',
                'ville' => 'Montréal',
                'province' => 'Québec',
                'codePostal' => 'H2X3Y5',
                'siteInternet' => 'http://www.loblaw.ca',
                'regionAdministrative' => 'Montréal',
                'typeNumTelephone' => json_encode(['Bureau']),
                'numeroTelephone' => json_encode([5149874000]),
                'poste' => json_encode(['401']),
                'etatDemande' => 'En attente',
                'numTPS' => 456789123,
                'numTVQ' => 654321987,
                'conditionPaiement' => '30 jours net',
                'devise' => 'CAD',
                'modeCommunication' => 'Téléphone',
                'code_administratif' => 'ADM004',
            ],
            [
                'neq' => 1168030340,
                'email' => 'contact@cae.com',
                'password' => bcrypt('password123'),
                'nomEntreprise' => 'CAE Inc.',
                'numCivique' => '8585',
                'rue' => 'Côte-de-Liesse',
                'bureau' => 'Bureau 100',
                'ville' => 'Deschaillons-sur-Saint-Laurent',
                'province' => 'Québec',
                'codePostal' => 'H4T1G6',
                'siteInternet' => 'http://www.cae.com',
                'regionAdministrative' => 'Montréal',
                'typeNumTelephone' => json_encode(['Bureau']),
                'numeroTelephone' => json_encode([5143416789]),
                'poste' => json_encode(['501']),
                'etatDemande' => 'En attente',
                'numTPS' => 567891234,
                'numTVQ' => 543219876,
                'conditionPaiement' => '60 jours net',
                'devise' => 'CAD',
                'modeCommunication' => 'Téléphone',
                'code_administratif' => 'ADM005',
            ],
            [
                'neq' => 1140045612,
                'email' => 'info@videotron.com',
                'password' => bcrypt('password123'),
                'nomEntreprise' => 'Vidéotron Ltée',
                'numCivique' => '612',
                'rue' => 'Rue Saint-Jacques',
                'bureau' => '',
                'ville' => 'Montréal',
                'province' => 'Québec',
                'codePostal' => 'H3B1B7',
                'siteInternet' => 'http://www.videotron.com',
                'regionAdministrative' => 'Montréal',
                'typeNumTelephone' => json_encode(['Bureau']),
                'numeroTelephone' => json_encode([5143804666]),
                'poste' => json_encode(['601']),
                'etatDemande' => 'En attente',
                'numTPS' => 678912345,
                'numTVQ' => 432198765,
                'conditionPaiement' => '30 jours net',
                'devise' => 'CAD',
                'modeCommunication' => 'Courriel',
                'code_administratif' => 'ADM006',
            ],
            [
                'neq' => 1143207234,
                'email' => 'contact@bell.ca',
                'password' => bcrypt('password123'),
                'nomEntreprise' => 'Bell Canada',
                'numCivique' => '1',
                'rue' => 'Rue Carillon',
                'bureau' => '',
                'ville' => 'Montréal',
                'province' => 'Québec',
                'codePostal' => 'H1N3B7',
                'siteInternet' => 'http://www.bell.ca',
                'regionAdministrative' => 'Montréal',
                'typeNumTelephone' => json_encode(['Bureau']),
                'numeroTelephone' => json_encode([5148704000]),
                'poste' => json_encode(['701']),
                'etatDemande' => 'En attente',
                'numTPS' => 789123456,
                'numTVQ' => 321987654,
                'conditionPaiement' => '30 jours net',
                'devise' => 'CAD',
                'modeCommunication' => 'Téléphone',
                'code_administratif' => 'ADM007',
            ],
        ]);
    }
}
