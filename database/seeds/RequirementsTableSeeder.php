<?php

use App\Requirement;
use Illuminate\Database\Seeder;

class RequirementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requirements = [
            ['name' => 'Laravel', 'link' => 'https://laravel.com/docs/master', 'specialization_id' => 4],
            ['name' => 'Symfony', 'link' => 'https://symfony.com/doc/current/index.html', 'specialization_id' => 4],
            ['name' => 'VueJs', 'link' => 'https://vuejs.org/v2/guide/', 'specialization_id' => 4],
            ['name' => 'ReactJs', 'link' => 'https://fr.reactjs.org/docs/getting-started.html', 'specialization_id' => 4],
            ['name' => 'Angular', 'link' => 'https://angular.io/docs', 'specialization_id' => 4],
            ['name' => 'GitHub', 'link' => 'https://help.github.com/en/github/getting-started-with-github/set-up-git', 'specialization_id' => 4],
            ['name' => 'Docker', 'link' => 'https://docs.docker.com/', 'specialization_id' => 4],
            ['name' => 'HTML', 'link' => 'https://developer.mozilla.org/fr/docs/Web/HTML', 'specialization_id' => 4],
            ['name' => 'CSS', 'link' => 'https://developer.mozilla.org/fr/docs/Web/CSS', 'specialization_id' => 4],
            ['name' => 'JS', 'link' => 'https://developer.mozilla.org/fr/docs/Web/JavaScript', 'specialization_id' => 4],
        ];

        foreach ($requirements as $requirement) {
            Requirement::create($requirement);
        }
    }
}
