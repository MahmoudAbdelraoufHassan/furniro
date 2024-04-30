<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Factory $factory): void
    {
        $cat =
            [
                [
                'name' => 'furniture',
                'description' => fake()->text(50),
                'status' => 'active',
                    'thumbnail' => fake()->imageUrl,
            ], [
            'name' => 'Office Furniture',
            'description' => fake()->text(50),
            'status' => 'active',
                'thumbnail' => fake()->imageUrl,
        ], [
            'name' => 'Lighting',
            'description' => fake()->text(50),
            'status' => 'active',
                'thumbnail' => fake()->imageUrl,
        ], [
            'name' => 'Fabric & Bedding',
            'description' => fake()->text(50),
            'status' => 'active',
                'thumbnail' => fake()->imageUrl,
        ], [
            'name' => 'Kitchen & Bathroom',
            'description' => fake()->text(50),
            'status' => 'active',
                'thumbnail' => fake()->imageUrl,
        ], [
                'name' => 'Appliances',
                'description' => fake()->text(50),
                'status' => 'active',
                'thumbnail' => fake()->imageUrl,
            ]];
        foreach ($cat as $categoryData) {
            Category::create($categoryData);
        }

    }
}
