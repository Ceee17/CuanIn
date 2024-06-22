<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'test',
                'email_verified_at' => now(),
                'password' => Hash::make('test123'), // Hash the password
                'level' => 0,
            ]
        );

        \App\Models\User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'admin',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'), // Hash the password
                'level' => 1,
            ]
        );
    }
}
