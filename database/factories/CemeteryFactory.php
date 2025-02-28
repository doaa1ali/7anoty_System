<?php

namespace Database\Factories;
use App\Models\Cemetery;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cemetry>
 */
class CemeteryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Cemetery::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . ' Cemetery',
            'description' => $this->faker->sentence(10),
            'location' => $this->faker->address(),
            'lat' => $this->faker->randomFloat(8, -90, 90),
            'long' => $this->faker->randomFloat(8, -180, 180),
            'size' => $this->faker->randomFloat(2, 100, 10000),
            'image' => $this->faker->imageUrl(640, 480, 'cemetery'),
            'price' => $this->faker->randomFloat(2, 5000, 50000),
            'is_discount' => $this->faker->boolean(30),
            'discount' => fn (array $attributes) => $attributes['is_discount'] ? $this->faker->randomFloat(2, 500, 5000) : null,
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
