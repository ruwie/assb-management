<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;    

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    User::create([
        'name' => 'Admin User',
        'username' => 'admin',
        'password' => Hash::make('password'),
        'role' => 'admin',
    ]);

    User::create([
        'name' => 'PWD User',
        'username' => 'pwd',
        'password' => Hash::make('password'),
        'role' => 'pwd',
    ]);

    User::create([
        'name' => 'AICS User',
        'username' => 'aics',
        'password' => Hash::make('password'),
        'role' => 'aics',
    ]);

    User::create([
        'name' => 'Senior Citizen User',
        'username' => 'senior',
        'password' => Hash::make('password'),
        'role' => 'senior',
    ]);

    User::create([
        'name' => 'Solo Parent User',
        'username' => 'solo',
        'password' => Hash::make('password'),
        'role' => 'solo_parent',
    ]);
}
}
