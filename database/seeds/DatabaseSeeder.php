<?php

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
            UsersTableSeeder::class,
            ReviewsTableSeeder::class,
            SpecializationsTableSeeder::class,
            SkillsTableSeeder::class,
            ProjectsTableSeeder::class,
            AgentsSpecializationsTableSeeder::class,
            ProjectsSpecializationsTableSeeder::class
        ]);
    }
}
