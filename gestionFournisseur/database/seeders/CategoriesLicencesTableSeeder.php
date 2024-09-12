<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesLicencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories_licences')->insert([
            ['Id' => 1, 'Titre' => 'Entrepreneur général (Annexe I)'],
            ['Id' => 2, 'Titre' => 'Entrepreneur spcéialisé (Annexe II)'],
            ['Id' => 3, 'Titre' => 'Entrepreneur spcéialisé (Annexe III)']
    ]);
    }
}
