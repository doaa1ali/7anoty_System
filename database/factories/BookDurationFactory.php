<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Service;
use App\Models\Hall;
use App\Models\Duration;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookDuration>
 */
class BookDurationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_date' => $this->faker->date(),
            'final_price' => $this->faker->randomFloat(2, 50, 1000),
            'user_id' => User::factory(),
            'service_id' => Service::factory(),
            'hall_id' => Hall::factory(),
            'duration_id' => Duration::factory(),
        ];
    }
}
