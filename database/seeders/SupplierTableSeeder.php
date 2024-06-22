<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example data
        $suppliers = [
            [
                'name' => 'Supplier One',
                'address' => '1234 Market St, San Francisco, CA 94103',
                'telepon' => '123-456-7890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Supplier Two',
                'address' => '5678 Main St, Los Angeles, CA 90001',
                'telepon' => '098-765-4321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Supplier Three',
                'address' => '9101 Broadway, New York, NY 10001',
                'telepon' => '555-555-5555',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Supplier Four',
                'address' => '1122 Elm St, Houston, TX 77001',
                'telepon' => '444-444-4444',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data into the database
        DB::table('supplier')->insert($suppliers);
    }
}
