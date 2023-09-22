<?php

namespace App\Http\Resources\Top50;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
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
            'likes' => $this->likes,
            'name' => $this->name,
            'placeId' => $this->place_id,
            'reservationsCount' => $this->reservations_count,
            'preferredCustomerName' => $this->preferredCustomer()->fullName
        ];
    }
}
