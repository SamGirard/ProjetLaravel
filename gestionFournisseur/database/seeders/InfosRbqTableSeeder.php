<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfosRbqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('infos_rbq')->insert([
            [
                'numLicense' => '1000000000',
                'neqFournisseur' => 1140030355, 
                'courrielFournisseur' => 'info@cirquedusoleil.com',
                'statut' => 'Valide',
                'typeLicense' => 'Entrepreneur',
                'Catégorie' => 'Général',
                'codeSousCategorie' => '1.1.1',
                'travauxPermis' => 'Entrepreneur en bâtiments résidentiels neufs visés à un plan de garantie, classe 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'numLicense' => '1000000001',
                'neqFournisseur' => 1140030355, 
                'courrielFournisseur' => 'info@cirquedusoleil.com',
                'statut' => 'Valide',
                'typeLicense' => 'Entrepreneur',
                'Catégorie' => 'Général',
                'codeSousCategorie' => '1.1.2',
                'travauxPermis' => 'Entrepreneur en bâtiments résidentiels neufs visés à un plan de garantie, classe 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'numLicense' => '1000000002',
                'neqFournisseur' => 1168420345, 
                'courrielFournisseur' => 'info@cascades.com',
                'statut' => 'Valide',
                'typeLicense' => 'Entrepreneur',
                'Catégorie' => 'Général',
                'codeSousCategorie' => '1.2',
                'travauxPermis' => 'Entrepreneur en petits bâtiments',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'numLicense' => '1000000003',
                'neqFournisseur' => 1168420345, 
                'courrielFournisseur' => 'info@cascades.com',
                'statut' => 'Valide',
                'typeLicense' => 'Entrepreneur',
                'Catégorie' => 'Général',
                'codeSousCategorie' => '1.10',
                'travauxPermis' => 'Entrepreneur en remontées mécaniques',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'numLicense' => '1000000004',
                'neqFournisseur' => 1143313945, 
                'courrielFournisseur' => 'contact@bombardier.com',
                'statut' => 'Valide',
                'typeLicense' => 'Spécialisé',
                'Catégorie' => 'Général',
                'codeSousCategorie' => '2.4',
                'travauxPermis' => 'Entrepreneur en systèmes d’assainissement autonome',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'numLicense' => '1000000005',
                'neqFournisseur' => 1143313945, 
                'courrielFournisseur' => 'contact@bombardier.com',
                'statut' => 'Valide',
                'typeLicense' => 'Spécialisé',
                'Catégorie' => 'Général',
                'codeSousCategorie' => '2.5',
                'travauxPermis' => 'Entrepreneur en excavation et terrassement',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
