<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Manager 1',
            'email' => 'manager1@example.com',
            'password' => bcrypt('password'),
            'role' => 'manager',
        ]);

        User::create([
            'name' => 'Manager 2',
            'email' => 'manager2@example.com',
            'password' => bcrypt('password'),
            'role' => 'editor',
        ]);

        User::create([
            'name' => 'Manager 3',
            'email' => 'manager3@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
