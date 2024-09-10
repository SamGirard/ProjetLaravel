<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('infos_rbq')->insert([
            'numLicense' => 'RBQ00001',
            'neqFournisseur' => 102933194,
            'courrielFournisseur' => 'contact@example.com',
            'statut' => 'Valide',
            'typeLicense' => 'Entrepreneur',
            'Catégorie' => 'Général',
            'codeSousCategorie' => 'SousCat1',
            'travauxPermis' => 'Travaux Exemple',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
