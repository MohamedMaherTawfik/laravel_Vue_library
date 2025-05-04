<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users=
        [
            [
                'first_name' => 'Mohamed',
                'last_name' => 'Maher',
                'email' => 'm7mdellham77@gmail.com',
                'username' => 'm7mdmaher106',
                'phone' => '01024328382',
                'role' => 'admin',
                'password' => bcrypt('M7mdmaher11'),
            ],
            [
                'first_name' => 'Ahmed',
                'last_name' => 'Maher',
                'email' => 'AhmedMaher@gmail.com',
                'username' => 'ahmedmaher114',
                'phone' => '01007352061',
                'role' => 'user',
                'password' => bcrypt('M7mdmaher11'),
            ],

        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
