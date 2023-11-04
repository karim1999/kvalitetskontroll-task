<?php

namespace Database\Factories;

use App\Models\Category;
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
            'name' => $this->faker->name,
            'category_id' => Category::factory(),
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 0, 10000),
            'stock' => $this->faker->randomNumber(),
        ];
    }
}
