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
            'status' => $this->faker->randomElement(OrderStatuses::getStringValues()),
            'customer_name' => $this->faker->name,
        ];
    }

    /**
     * @return Factory
     */
    public function pending(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => OrderStatuses::PENDING,
            ];
        });
    }
}
