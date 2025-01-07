<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Serie;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Brand::factory()->count(5)->create();
        Serie::factory()->count(5)->create();
    }
}
