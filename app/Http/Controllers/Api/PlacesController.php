<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LikeToPlaceRequest;
use App\Http\Requests\PlacesRequest;
use App\Http\Resources\PlaceCollection;
use App\Http\Resources\PlaceDetailResource;
use App\Models\Place;
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
    public function index(PlacesRequest $request): PlaceCollection
    {
        return new PlaceCollection(Reservandonos::getPlaces($request->page));
    }

    /**
     * Add a new like to a place
     *
     * @param LikeToPlaceRequest $request
     * @return PlaceDetailResource
     */
    public function like(LikeToPlaceRequest $request): PlaceDetailResource
    {
        $place = Place::addLike($request->placeId);
        return new PlaceDetailResource($place);
    }
}
