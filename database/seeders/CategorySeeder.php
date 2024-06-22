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
            [
                'category_name' => 'Toys',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Sports',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Health & Beauty',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Automotive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Jewelry',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Furniture',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Garden & Outdoors',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Music',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Movies',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Office Supplies',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Pet Supplies',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Tools & Home Improvement',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Groceries',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Footwear',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Travel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Art & Crafts',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data into the database
        DB::table('product_category')->insert($categories);
    }
}
