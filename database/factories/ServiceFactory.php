<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company() . ' Service',
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 100, 5000),
            'location' => $this->faker->address(),
            'lat' => $this->faker->latitude(),
            'long' => $this->faker->longitude(),
            'is_discount' => $this->faker->boolean(),
            'discount' => $this->faker->randomFloat(2, 10, 500),
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'image' => $this->faker->imageUrl(640, 480, 'services'),
        ];
    }
}
