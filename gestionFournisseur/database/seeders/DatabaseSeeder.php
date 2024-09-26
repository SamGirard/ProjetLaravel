<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            CategoriesLicencesTableSeeder::class,
            ContactsTableSeeder::class,
            DemandesTableSeeder::class,
            EmployesTableSeeders::class,
            FournisseursTableSeeder::class,
            InfosRbqTableSeeder::class,
            LicencesTableSeeder::class,
        ]);
    }
}
