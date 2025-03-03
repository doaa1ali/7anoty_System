<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DurationResource extends JsonResource
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
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            
            'service' => $this->service ? [
                'id' => $this->service->id,
                'name' => $this->service->name,
            ] : null,

            'hall' => $this->hall ? [
                'id' => $this->hall->id,
                'name' => $this->hall->name,
            ] : null,

        ], function ($value) {
            return $value !== null;
        });
    }
}
