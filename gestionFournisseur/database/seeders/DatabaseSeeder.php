<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            FournisseursTableSeeder::class,
            CategoriesLicencesTableSeeder::class,
            ContactsTableSeeder::class,
            DemandesTableSeeder::class,
            EmployesTableSeeders::class,
            InfosRbqTableSeeder::class,
            LicencesTableSeeder::class,
            RoleCourrielSeeder::class,
            ModeleCourrielSeeder::class,
            ParametreSeeder::class,
        ]);
    }
}
