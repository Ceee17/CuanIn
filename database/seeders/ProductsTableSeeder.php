<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example data
        $products = [
            [
                'category_id' => 1,
                'product_code' => 'PRD001',
                'product_name' => 'Product One',
                'product_brand' => 'Brand A',
                'buying_price' => 100,
                'selling_price' => 150,
                'discount' => 10,
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'product_code' => 'PRD002',
                'product_name' => 'Product Two',
                'product_brand' => 'Brand B',
                'buying_price' => 200,
                'selling_price' => 250,
                'discount' => 5,
                'stock' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'product_code' => 'PRD003',
                'product_name' => 'Product Three',
                'product_brand' => 'Brand C',
                'buying_price' => 300,
                'selling_price' => 350,
                'discount' => 0,
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data into the database
        DB::table('products')->insert($products);
    }
}
