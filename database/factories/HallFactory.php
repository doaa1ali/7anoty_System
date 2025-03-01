<?php

namespace Database\Factories;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hall>
 */
class HallFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company() . ' Hall',
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->address(),
            'lat' => $this->faker->latitude(),
            'long' => $this->faker->longitude(),
            'price' => $this->faker->randomFloat(2, 500, 5000),
            'seats' => $this->faker->numberBetween(50, 500),
            'has_buffet' => $this->faker->boolean(),
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'image' => $this->faker->imageUrl(640, 480, 'halls'),
            'user_id' => User::factory(),
        ];
    }
}
