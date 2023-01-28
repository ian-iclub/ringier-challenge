<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition()
    {
        return [
            'title' => fake()->sentence(3),
            'slug' => Str::slug(fake()->sentence(4)),
            'description' => fake()->sentence(10),
            'date_online' => fake()->dateTime,
            'date_offline' => fake()->dateTime,
            'price' => fake()->numberBetween(1, 3000),
            'user_id' => fake()->numberBetween(1,4),
            'category_id' => fake()->numberBetween(1,4),
            'currency_id' => 1
        ];
    }
}
