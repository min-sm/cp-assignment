<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Serie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $serie = Serie::inRandomOrder()->first();
        return [
            'model' => $this->faker->unique()->word, // Generates a unique model name
            'series_id' => $serie->id, // Associates with a Series (creates one if none exists)
            'brand_id' => $serie->brand->id,
            'category_id' => Category::inRandomOrder()->first()->id, // Associates with a Category (creates one if none exists)
            'description' => $this->faker->paragraph, // Generates a random description
            'price' => $this->faker->randomFloat(2, 10, 1000), // Generates a price between 10 and 1000
            'stock_quantity' => $this->faker->numberBetween(0, 100), // Generates a stock quantity between 0 and 100
        ];
    }
}
