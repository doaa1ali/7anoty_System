<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Service;
use App\Models\Hall;
use App\Models\Duration;
use App\Models\Order;
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
        
        $order = Order::factory()->create();
        $serviceOrHall = $this->faker->randomElement(['service', 'hall']);
        $serviceId = $serviceOrHall === 'service' ? Service::factory() : null;
        $hallId = $serviceOrHall === 'hall' ? Hall::factory() : null;

        return [
            'booking_date' => $this->faker->date(),
            'user_id' => $order->user_id, 
            'service_id' => $serviceId,
            'hall_id' => $hallId,
            'duration_id' => Duration::factory(),
            'order_id' => $order->id, 
        ];
    }
}
