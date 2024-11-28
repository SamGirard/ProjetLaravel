<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BrochureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brochures')->insert([
            ['id' => 1, 'Type' => 'doc', 'nom' => 'docu.doc', 'fournisseur_id' => '1'],
            ['id' => 2, 'Type' => 'doc', 'nom' => 'docu2.doc', 'fournisseur_id' => '1'],
            ['id' => 3, 'Type' => 'pdf', 'nom' => 'pédéhèf.pdf', 'fournisseur_id' => '2'],
            ['id' => 4, 'Type' => 'pdf', 'nom' => 'pédéhèf.pdf2', 'fournisseur_id' => '2'],
            ['id' => 5, 'Type' => 'xls', 'nom' => 'excel.xls', 'fournisseur_id' => '3'],
            ['id' => 6, 'Type' => 'xls', 'nom' => 'excel2.xls', 'fournisseur_id' => '3'],

        ]);
    }
}
