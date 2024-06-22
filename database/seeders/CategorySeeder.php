<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'Electronics',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Clothing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Home Appliances',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Books',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data into the database
        DB::table('product_category')->insert($categories);
    }
}
