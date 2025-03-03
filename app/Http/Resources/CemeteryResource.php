<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CemeteryResource extends JsonResource
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
            'location' => $this->location,
            'image' => $this->image ? url('uploads/cemeteryimages/' . $this->image) : null,
            'price' => $this->price,
            'creator'=>[
                'id'=>$this->user->id,
                'name'=>$this->user->name,
                'phone'=>$this->user->phone,
                ]
        ];
    }
}
