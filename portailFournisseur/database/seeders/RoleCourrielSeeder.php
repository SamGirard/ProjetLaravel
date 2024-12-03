<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RoleCourrielSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role_Courriel')->insert([
            'role' => 'Accusé de réception'
        ]);
        DB::table('role_Courriel')->insert([
            'role' => 'Approbation'
        ]);
        DB::table('role_Courriel')->insert([
            'role' => 'Refus'
        ]);
    }
}
