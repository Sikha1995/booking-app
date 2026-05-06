<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'hotel_id' => $this->hotel_id,
            'name' => $this->name,
            'price_per_night' => (float) $this->price_per_night,
            'max_occupancy' => $this->max_occupancy,
            'available_rooms' => $this->available_rooms,
            'total_price' => isset($this->total_price) ? (float) $this->total_price : null,
        ];
    }
}
