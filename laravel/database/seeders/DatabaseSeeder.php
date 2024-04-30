<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(20)->create();
         \App\Models\Order::factory(50)->create();
        \App\Models\Payment::factory(10)->create();
       \App\Models\Supplier::factory(15)->create();

        $this->call([
            CategorySeeder::class,
        ]);

       \App\Models\Product::factory(15)->create();
       \App\Models\ProductImages::factory(50)->create();
       \App\Models\Review::factory(50)->create();
       \App\Models\ShoppingCart::factory(50)->create();
       \App\Models\ShippingInformation::factory(50)->create();
       \App\Models\CustomerWishlist::factory(150)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);



    }
}
