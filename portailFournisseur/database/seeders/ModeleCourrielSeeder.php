<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ModeleCourrielSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('modele_Courriel')->insert(
            [
            'objet' => 'Bonjour',
            'message' => 'Message concernant les fournisseurs',
            'role' => 'Approbation',
            'raison' => '',
        ]);
        DB::table('modele_Courriel')->insert(
            [
                'objet' => 'Reception',
                'message' => 'Message concernant les fournisseurs',
                'role' => 'message',
                'raison' => '',
            ]);
    }
}
