<?php

use App\RequirementUser;
use Illuminate\Database\Seeder;

class RequirementUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requirementUsers = [
            ['requirement_id' => 1, 'user_id' => 2],
            ['requirement_id' => 2, 'user_id' => 2],
            ['requirement_id' => 3, 'user_id' => 2],
            ['requirement_id' => 4, 'user_id' => 2],
            ['requirement_id' => 5, 'user_id' => 2],
            ['requirement_id' => 6, 'user_id' => 2],
            ['requirement_id' => 7, 'user_id' => 2],
            ['requirement_id' => 8, 'user_id' => 2],
            ['requirement_id' => 9, 'user_id' => 2],
            ['requirement_id' => 10, 'user_id' => 2],
        ];

        foreach ($requirementUsers as $requirementUser) {
            RequirementUser::create($requirementUser);
        }
    }
}
