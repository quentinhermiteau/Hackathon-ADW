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
            SpecializationsTableSeeder::class,
            UsersTableSeeder::class,
            ReviewsTableSeeder::class,
            SkillsTableSeeder::class,
            ProjectsTableSeeder::class,
            ProjectSpecializationTableSeeder::class,
            RequirementsTableSeeder::class,
            RequirementUsersTableSeeder::class
        ]);
    }
}
