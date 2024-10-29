<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfosUnspscTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('infos_unspsc')->insert([
            [
                'code' => 22101605,
                'neqFournisseur' => 1140030355, 
                'name' => 'Finisseurs d\'asphalte',
            ],
            [
                'code' => 30121601,
                'neqFournisseur' => 1140030355, 
                'name' => 'Asphalte',
            ],
            [
                'code' => 22101605,
                'neqFournisseur' => 1168420345, 
                'name' => 'Finisseurs d\'asphalte',
            ],
            [
                'code' => 22101615,
                'neqFournisseur' => 1168420345, 
                'name' => 'Brise-béton',
            ],
            [
                'code' => 22101615,
                'neqFournisseur' => 1143313945, 
                'name' => 'Brise-béton',
            ],
            [
                'code' => 22101711,
                'neqFournisseur' => 1143313945, 
                'name' => 'Outils et accessoires pour brise-béton',
            ],
        ]);
    }
}
