<?php

namespace Database\Factories;

use App\Constants\OrderStatuses;
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
            'user_id' => $this->faker->numberBetween(1, 100),
            'total_price' => $this->faker->randomFloat(2, 1, 1000),
            'status' => $this->faker->randomElement(OrderStatuses::getStringValues()),
            'customer_name' => $this->faker->name,
        ];
    }
}
