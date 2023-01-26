<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run()
    {

        $users =  [
            [
                'name' => 'ArionoS',
                'email' => 'admin@gmail.com',
                'username' => 'Admin',
                'phone' => '6582123533955',
                'password' => Hash::make('admin'),
                'is_admin' => true,
                'image' => 'images/adminDefault.jpg',
            ],
            [
                'name' => 'Saf',
                'email' => 'admin1@gmail.com',
                'username' => 'Admin1',
                'phone' => '65255464132135',
                'password' => Hash::make('admin'),
                'is_admin' => true,
                'image' => 'images/adminDefault.jpg',
            ],
        ];

        User::insert($users);
    }
}
