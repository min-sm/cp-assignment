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
            ['name' => 'Laptops', 'description' => 'All types of laptops.'],
            ['name' => 'Adapters', 'description' => 'Laptop power adapters.'],
            ['name' => 'Keyboards', 'description' => 'External keyboards for laptops.'],
            ['name' => 'Batteries', 'description' => 'Laptop batteries.'],
            ['name' => 'Screens', 'description' => 'Laptop screens and displays.'],
            ['name' => 'Mice', 'description' => 'External mice for laptops.'],
        ];

        DB::table('categories')->insert($categories);
    }
}
