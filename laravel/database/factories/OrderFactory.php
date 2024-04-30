<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::pluck('id')->random(),
            'total_amount' => fake()->randomFloat(2, 10, 1000),
            'status' => fake()->randomElement(['pending', 'processing', 'shipped', 'delivered']),
            'payment_method' => fake()->randomElement(['credit card', 'PayPal', 'cash on delivery']),
            'payment_status' => fake()->randomElement(['paid', 'pending', 'failed']),
            'shipping_address' => fake()->address,
            'currency' => fake()->currencyCode,
            'notes' => fake()->text,
            'coupon_code' => fake()->optional()->word,
            'discount_amount' => fake()->randomFloat(2, 0, 100),
            'tax_amount' => fake()->optional()->randomFloat(2, 0, 50),
        ];
    }
}
