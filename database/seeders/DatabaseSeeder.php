<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
            CountrySeeder::class,
            CourseSeeder::class,
            RequiremtnListSeeder::class,
            FormSeeder::class,
        ]);
    }
}
