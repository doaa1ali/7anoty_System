<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $totalPrice = 0;



        return array_filter([
            'id' => $this->id,
            'user' => optional($this->user)->name,
            'book_durations' => $this->bookDurations->map(function ($bookDuration) use (&$totalPrice) {

                $servicePrice = optional($bookDuration->service)->price ?? 0;
                $hallPrice = optional($bookDuration->hall)->price ?? 0;

                $totalPrice += $servicePrice + $hallPrice;

                return array_filter([
                    'book_duration_id' => $bookDuration->id,
                    'order_id' => $bookDuration->order_id,
                    'service' => optional($bookDuration->service)->name,
                    'service_price' => $servicePrice,
                    'hall' => optional($bookDuration->hall)->name,
                    'hall_price' => $hallPrice,
                ]);
            })->toArray(),
            'cemetery_name' => optional($this->cemetery)->name,
            'cemetery_price' => optional($this->cemetery)->price,

            'final_price' => $totalPrice + (optional($this->cemetery)->price ?? 0),
        ]);

    }
}
