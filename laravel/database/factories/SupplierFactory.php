<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company,
            'contact_name' => fake()->name,
            'email' => fake()->email,
            'phone' => fake()->phoneNumber,
            'address' => fake()->address,
            'city' => fake()->city,
            'state' => fake()->state,
            'country' => fake()->country,
            'postal_code' => fake()->postcode,
            'website' => fake()->url,
            'tax_id' => fake()->numerify('##-#######'),
            'notes' => fake()->text,
        ];
    }
}
