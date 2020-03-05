<?php

use Illuminate\Database\Seeder;
use App\Specialization;

class SpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specializations = [
            ['name' => 'Conseil', 'description' => 'Accompagnement & pilotage, audit...'],
            ['name' => 'Créatif', 'description' => 'Tous supports'],
            ['name' => 'Content', 'description' => 'Storytelling & brand'],
            ['name' => 'Digital', 'description' => 'Web & app'],
            ['name' => 'Acquisition', 'description' => 'Notoriété, seo, sea, sem, social'],
            ['name' => 'Event', 'description' => 'Concept, message, réalisation'],
        ];

        foreach ($specializations as $specialization) {
            Specialization::create($specialization);
        }

    }
}
