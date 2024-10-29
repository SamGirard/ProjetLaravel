<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemandesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('demandes')->insert([
            [
                'neqFournisseur' => 1140030355,
                'etatDemande' => 'Accepter',
                'dateChangementEtat' => now(),
                'dateDeCreation' => now(),
                'dateDerniereModif' => now(),
                'numDemande' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'neqFournisseur' => 1168420345,
                'etatDemande' => 'Refusé',
                'dateChangementEtat' => now(),
                'dateDeCreation' => now(),
                'dateDerniereModif' => now(),
                'numDemande' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'neqFournisseur' => 1143313945,
                'etatDemande' => 'En attente',
                'dateChangementEtat' => now(),
                'dateDeCreation' => now(),
                'dateDerniereModif' => now(),
                'numDemande' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'neqFournisseur' => 1142249510,
                'etatDemande' => 'Réviser',
                'dateChangementEtat' => now(),
                'dateDeCreation' => now(),
                'dateDerniereModif' => now(),
                'numDemande' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'neqFournisseur' => 1168030340,
                'etatDemande' => 'Accepter',
                'dateChangementEtat' => now(),
                'dateDeCreation' => now(),
                'dateDerniereModif' => now(),
                'numDemande' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'neqFournisseur' => 1140045612,
                'etatDemande' => 'Refusé',
                'dateChangementEtat' => now(),
                'dateDeCreation' => now(),
                'dateDerniereModif' => now(),
                'numDemande' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'neqFournisseur' => 1143207234,
                'etatDemande' => 'En attente',
                'dateChangementEtat' => now(),
                'dateDeCreation' => now(),
                'dateDerniereModif' => now(),
                'numDemande' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
