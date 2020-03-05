<?php

use Illuminate\Database\Seeder;
use App\Project;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
            'name' => 'Nom de projet',
            'description' => 'Un exemple de projet',
            'realisation_date' => (new \DateTime())->modify('+1 week'),
            'client_name' => 'Nom du client',
            'contact_firstname' => 'Prénom du contact',
            'contact_lastname' => 'Nom du contact',
            'contact_phone_number' => 'Numéro du contact',
            'budget_min' => 1,
            'budget_max' => 10,
            'agent_id' => 2,
            'referent_id' => 1
        ]);
    }
}
