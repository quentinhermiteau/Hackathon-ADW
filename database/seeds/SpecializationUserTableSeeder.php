<?php

use App\SpecializationUser;
use Illuminate\Database\Seeder;

class SpecializationUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specializationsUsers = [
            ['agent_id' => 2, 'specialization_id' => 1],
            ['agent_id' => 3, 'specialization_id' => 1]
        ];

        foreach ($specializationsUsers as $specializationUser) {
            SpecializationUser::create($specializationUser);
        }
    }
}
