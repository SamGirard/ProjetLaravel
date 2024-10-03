<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ParametreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('parametre')->insert([
            'courrielAppro' => 'approvisionnement@v3r.net',
            'delaiRevision' => 24,
            'tailleMaxFichiers' => 75,
            'courrielFinance' => 'finances@v3r.net'
        ]);
    }
}
