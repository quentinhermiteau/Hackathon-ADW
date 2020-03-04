<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $birthday = \DateTime::createFromFormat('Y-m-d', '2000-01-01');

        $users = [
            [
                'firstname' => 'admin',
                'lastname' => 'admin',
                'email' => 'admin@admin.fr',
                'password' => Hash::make('password'),
                'birthday' => $birthday,
                'description' => '',
                'role' => 'ADMIN'
            ],
            [
                'firstname' => 'agent1',
                'lastname' => 'test',
                'email' => 'agent1@test.fr',
                'password' => Hash::make('password'),
                'birthday' => $birthday,
                'description' => 'Amoureux du PHP',
                'role' => 'AGENT'
            ],
            [
                'firstname' => 'agent2',
                'lastname' => 'test',
                'email' => 'agent2@test.fr',
                'password' => Hash::make('password'),
                'birthday' => $birthday,
                'description' => 'Amoureux du JS',
                'role' => 'AGENT'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
