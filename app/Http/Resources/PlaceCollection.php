<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PlaceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $nextPage = null;
        if ($this->collection['showMore']) {
            $nextPage = route('api.places', ['page' => ($this->collection['page'] + 1)]);
        }

        return [
            'places' => $this->collection['data'] ?? [],
            'nextPage' => $nextPage,
        ];
    }
}
