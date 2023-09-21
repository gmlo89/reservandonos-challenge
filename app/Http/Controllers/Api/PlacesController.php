<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlacesRequest;
use App\Http\Resources\PlaceCollection;
use App\Services\Reservandonos;
use Illuminate\Http\Request;

class PlacesController extends Controller
{

    /**
     * List pages of places
     *
     * @param Request $request
     * @return PlaceCollection
     */
    public function __invoke(PlacesRequest $request): PlaceCollection
    {
        return new PlaceCollection(Reservandonos::getPlaces($request->page));
    }
}
