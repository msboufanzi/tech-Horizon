<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //* Create the editor
        User::create([
            'name' => 'Mr editor',
            'email' => 'editor@gmail.com',
            'password' => Hash::make('editor123'),
            'role' => 'editor',
        ]);

        //* Create 6 managers
        for ($i = 1; $i <= 6; $i++) {
            User::create([
                'name' => 'Mr manager',
                'email' => "manager{$i}@gmail.com",
                'password' => Hash::make('manager123'),
                'role' => 'manager',
            ]);
        }

        //* Create the subscriber
        User::create([
            'name' => 'Mr subscriber',
            'email' => 'subscriber@gmail.com',
            'password' => Hash::make('subscriber123'),
            'role' => 'subscriber',
        ]);
    }
}