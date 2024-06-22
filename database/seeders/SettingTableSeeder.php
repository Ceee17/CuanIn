<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('setting')->insert([
            'setting_id' => 1,
            'company_name' => 'CuanIn',
            'address' => 'Jalan jalan.com',
            'phone_number' => '08123456789',
            'note_type' => 1, // kecil kalau 2 gede
            'discount' => 5,
            'logo_path' => '/assets/Designer.png',
            'card_member_path' => '/assets/card_background.png',
        ]);
    }
}
