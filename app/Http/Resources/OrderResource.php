<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $totalPrice = 0;

        return [
            'id' => $this->id, 
            'user' => $this->user->name,  
            'book_durations' => $this->bookDurations->map(function ($bookDuration) use (&$totalPrice) {

                $servicePrice = $bookDuration->service->price ?? 0;
                $hallPrice = $bookDuration->hall->price ?? 0;

                $totalPrice += $servicePrice + $hallPrice;

                return [
                    'book_duration_id' => $bookDuration->id, 
                    'order_id' => $bookDuration->order_id,  
                    'service' => optional($bookDuration->service)->name,
                    'service_price' => $servicePrice,
                    'hall' => optional($bookDuration->hall)->name,
                    'hall_price' => $hallPrice,
                ];
            })->toArray(),
            'cemetery_name'=>$this->cemetery->name,
            'cemetery_price'=>$this->cemetery->price,

            'final_price' => $totalPrice + ($this->cemetery ? $this->cemetery->price : 0),
        ];
    }
}
