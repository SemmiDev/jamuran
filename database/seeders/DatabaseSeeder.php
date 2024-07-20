<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'role' => User::ROLE_ADMIN,
            'password' => bcrypt('password'),
        ]);

        \App\Models\User::create([
            'name' => 'Finda',
            'email' => 'finda@gmail.com',
            'username' => 'finda',
            'role' => User::ROLE_USER,
            'password' => bcrypt('password'),
        ]);

        \App\Models\Address::create([
            'user_id' => 2,
            'address' => 'Talu, Pasaman Barat',
        ]);
    }
}
