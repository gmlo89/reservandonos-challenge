<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;

class ReservationController extends Controller
{
    /**
     * Store a new reservation
     *
     * @param  StoreReservationRequest  $request
     * @return ReservationResource
     */
    public function store(StoreReservationRequest $request): ReservationResource
    {
        $reservation = Reservation::createNew($request->name, $request->lastName, $request->date('date'), $request->time, $request->placeId);

        return new ReservationResource($reservation);
    }
}
