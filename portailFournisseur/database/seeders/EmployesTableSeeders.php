<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EmployesTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employes')->insert([
            'courriel' => 'admin@email.com',
            'role' => 'Administrateur',
        ]);

        DB::table('employes')->insert([
            'courriel' => 'commis@email.com',
            'role' => 'Commis',
        ]);

        DB::table('employes')->insert([
            'courriel' => 'responsable@email.com',
            'role' => 'Responsable',
        ]);
    }
}
