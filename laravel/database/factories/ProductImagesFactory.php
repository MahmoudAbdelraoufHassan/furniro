<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductImages>
 */
class ProductImagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::pluck('id')->random(),
            'filename' => $this->faker->word . '.jpg', // Example: Generate a random filename with a .jpg extension
            'path' => 'https://picsum.photos/400/300', // Generate a random image URL using Lorem Picsum
        ];
    }

}
