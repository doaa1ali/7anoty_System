<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Service;
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
            'final_price' => $this->faker->randomFloat(2, 100, 5000),
            'user_id' => User::factory(),
            'service_id' => Service::factory(),
        ];
    }
}
