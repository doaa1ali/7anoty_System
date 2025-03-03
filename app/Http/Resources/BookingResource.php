<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_filter([
            'id' => $this->id,
            'booking_date' => $this->booking_date,
            'user' => [
                'id' => $this->user_id,
                'name' => optional($this->user)->name,
            ],
            'duration' => [
                'id' => $this->duration_id,
                'name' => optional($this->duration)->name,
            ],
            'service' => $this->service_id ? [
                'id' => $this->service_id,
                'name' => optional($this->service)->name,
                'price' => optional($this->service)->price,
            ] : null,
            'hall' => $this->hall_id ? [
                'id' => $this->hall_id,
                'name' => optional($this->hall)->name,
                'price' => optional($this->hall)->price,
            ] : null,
            'order_id' => $this->order_id,
        ]);
    }
}
