<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        $now = Carbon::now();

        $categories = [
            [
                'name' => 'Laptops',
                'description' => 'All types of laptops.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Adapters',
                'description' => 'Laptop power adapters.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Keyboards',
                'description' => 'External keyboards for laptops.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Batteries',
                'description' => 'Laptop batteries.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Screens',
                'description' => 'Laptop screens and displays.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Mice',
                'description' => 'External mice for laptops.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
