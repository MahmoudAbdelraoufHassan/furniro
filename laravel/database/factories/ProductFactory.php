<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Supplier;
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
        return [
            'title' => fake()->name,
            'description' => fake()->text(70),
            'thumbnail' => fake()->imageUrl,
            'discountPercentage' => fake()->numberBetween(10, 200),
            'rating' => fake()->numberBetween(1, 5),
            'price' => fake()->numberBetween(1, 100),
            'stock' => fake()->numberBetween(1, 100),
            'dimensions' => fake()->numberBetween(100, 200),
            'category_id' => Category::all()->random()->id,
            'supplier_id' => Supplier::all()->random()->id,
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
