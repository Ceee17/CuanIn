<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpendingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example data
        $spendings = [
            [
                'description' => 'Office Supplies',
                'nominal' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Team Lunch',
                'nominal' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Software Subscription',
                'nominal' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Transport Expenses',
                'nominal' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data into the database
        DB::table('spending')->insert($spendings);
    }
}
