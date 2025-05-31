<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
{
    DB::table('users')->insert([
        [
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ],
        [
            'username' => 'aics',
            'password' => Hash::make('aics123'),
            'role' => 'aics',
        ],
        [
            'username' => 'senior',
            'password' => Hash::make('senior123'),
            'role' => 'senior',
        ],
        [
            'username' => 'solo',
            'password' => Hash::make('solo123'),
            'role' => 'solo',
        ],
        [
            'username' => 'pwd',
            'password' => Hash::make('pwd123'),
            'role' => 'pwd',
        ],
    ]);
}
    
}
