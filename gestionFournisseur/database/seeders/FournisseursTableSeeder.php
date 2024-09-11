<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FournisseursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fournisseurs')->insert([
            'neq' => 102933194,
            'courriel' => 'contact@example.com',
            'password' => bcrypt('password123'), // Assurez-vous d'utiliser bcrypt pour les mots de passe
            'nomEntreprise' => 'Entreprise Exemple',
            'num_rbq' => 'RBQ00001',
            'numCivique' => '1234',
            'rue' => 'Rue Exemple',
            'bureau' => 'Bureau 567',
            'ville' => 'Ville Exemple',
            'province' => 'Québec',
            'codePostal' => 'A1B2C3',
            'siteInternet' => 'http://www.exemple.com',
            'régionAdministrative' => 'Région Exemple',
            'TypeNumTelephone' => 'Bureau',
            'numéroTelephone' => 1234567890,
            'poste' => '123',
            'courrielContact' => 'contact@exemple.com',
            'numTPS' => 123456789,
            'numTVQ' => 987654321,
            'conditionPaiement' => '30 jours net',
            'devise' => 'CAD',
            'modeCommunication' => 'mode Cellulaire' // Assurez-vous que ce champ correspond à votre logique
        ]);
    }
}
