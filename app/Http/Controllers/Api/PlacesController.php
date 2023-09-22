<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\PlaceDontFound;
use App\Http\Controllers\Controller;
use App\Http\Requests\LikeToPlaceRequest;
use App\Http\Requests\PlacesRequest;
use App\Http\Resources\PlaceCollection;
use App\Http\Resources\PlaceDetailResource;
use App\Http\Resources\Top50\PlaceCollection as Top50PlaceCollection;
use App\Models\Place;
use App\Services\Reservandonos;
use Illuminate\Http\JsonResponse;
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

    /**
     * Get all details from a place by ID
     *
     * @param integer $placeId
     * @return PlaceDetailResource|JsonResponse
     */
    public function detail(string $placeId): PlaceDetailResource|JsonResponse
    {
        $detailData = Reservandonos::getPlaceById((int)$placeId);

        $place = Place::findByPlaceIdOrCreate((int)$placeId);
        $place->setDetails($detailData);
        

        return new PlaceDetailResource($place);
    }

    /**
     * List the top 50 of places
     *
     * @return Top50PlaceCollection
     */
    public function top50():Top50PlaceCollection
    {
        return new Top50PlaceCollection(Place::top50());
    }
}
