<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            CategoriesLicencesTableSeeder::class,
            ContactsTableSeeder::class,
            EmployesTableSeeders::class,
            LicencesTableSeeder::class,
            RoleCourrielSeeder::class,
            ModeleCourrielSeeder::class,
            ParametreSeeder::class,
            ServicesTableSeeder::class,
        ]);
    }

    public function down(): void {
        $this->call([
            UsersTableSeeder::class,
            CategoriesLicencesTableSeeder::class,
            ContactsTableSeeder::class,
            EmployesTableSeeders::class,
            LicencesTableSeeder::class,
            RoleCourrielSeeder::class,
            ModeleCourrielSeeder::class,
            ParametreSeeder::class,
            ServicesTableSeeder::class,
        ]);
    }
}
