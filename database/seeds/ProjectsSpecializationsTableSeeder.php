<?php

use Illuminate\Database\Seeder;
use App\ProjectSpecialization;

class ProjectsSpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectSpecialization::create(['project_id' => 1, 'specialization_id' => 1]);
    }
}
