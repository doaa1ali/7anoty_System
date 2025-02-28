<?php

namespace Database\Factories;
use App\Models\Service;
use App\Models\Hall;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Duration>
 */
class DurationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'service_id' => Service::factory(),
            'hall_id' => Hall::factory(),
        ];
    }
}
