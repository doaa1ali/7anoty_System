<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'location' => $this->location,
            'start_time'=>$this->start_time,
            'end_time'=>$this->end_time,
            'image' => $this->image ? url('uploads/cemeteryimages/' . $this->image) : null,
            'creator' => $this->users()->first() ? [
                'id' => $this->users()->first()->id,
                'name' => $this->users()->first()->name,
                'phone' => $this->users()->first()->phone,
            ] : null,
        ];
    }
}
