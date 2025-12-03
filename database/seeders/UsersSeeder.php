<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sample Writer',
                'email' => 'writer@example.com',
                'password' => Hash::make('password'),
                'role' => 'writer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular Reader',
                'email' => 'reader@example.com',
                'password' => Hash::make('password'),
                'role' => 'reader',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
