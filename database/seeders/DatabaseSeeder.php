<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Serie;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $categories = [
            [
                'name' => 'Laptops',
                'description' => 'All types of laptops.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Adapters',
                'description' => 'Laptop power adapters.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Keyboards',
                'description' => 'External keyboards for laptops.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Batteries',
                'description' => 'Laptop batteries.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Screens',
                'description' => 'Laptop screens and displays.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mice',
                'description' => 'External mice for laptops.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($categories);
        Brand::factory()->count(5)->create();
        Serie::factory()->count(10)->create();
        Product::factory()->count(50)->create();
    }
}
