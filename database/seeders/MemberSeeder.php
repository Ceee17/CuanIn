<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate dummy data for members
        $members = [
            [
                'member_code' => 'M00001',
                'name' => 'John Doe',
                'address' => '123 Main St, Anytown',
                'phone_number' => '123-456-7890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'member_code' => 'M00002',
                'name' => 'Jane Smith',
                'address' => '456 Elm St, Othertown',
                'phone_number' => '987-654-3210',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more members as needed
        ];

        // Insert data into the members table
        DB::table('member')->insert($members);
    }
}
