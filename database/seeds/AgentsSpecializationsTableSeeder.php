<?php

use Illuminate\Database\Seeder;
use App\AgentSpecialization;

class AgentsSpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agentsSpeacializations = [
            ['agent_id' => 2, 'specialization_id' => 1],
            ['agent_id' => 3, 'specialization_id' => 1]
        ];

        foreach ($agentsSpeacializations as $agentSpecialization) {
            AgentSpecialization::create($agentSpecialization);
        }
    }
}
