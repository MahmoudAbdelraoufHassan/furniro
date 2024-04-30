<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::all()->random()->id,
            'amount' => fake()->numberBetween(100 , 1000),
            'payment_method' => fake()->randomElement(['credit card', 'PayPal', 'cash on delivery']),
            'status' => fake()->randomElement(['pending' , 'processing', 'shipped', 'delivered']),
            'payment_type' => fake()->randomElement(['full payment' , 'partial payment', 'deposit']),
            'payment_date' => fake()->date(),
            'payment_details' => fake()->text(),
            'payment_details' => fake()->text(),

        ];
    }
}
