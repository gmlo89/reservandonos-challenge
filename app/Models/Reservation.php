<?php

namespace App\Models;

use App\Exceptions\DuplicateReservationException;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_id',
        'customer_id',
        'date',
        'time',
    ];

    /**
     * Store a new reservation
     *
     * @param  string  $name
     * @param  string  $lastName
     * @param  Carbon  $date
     * @param  string  $time
     * @param  string  $placeId
     * @return Reservation
     */
    public static function createNew(string $name, string $lastName, Carbon $date, string $time, string $placeId): Reservation
    {
        $place = Place::findOrFail($placeId);

        if ($place->reservations()->whereDate('date', $date)->where('time', $time)->first()) {
            throw new DuplicateReservationException('No se encuenta disponible esta fecha y hora de reservación');
        }

        $customer = Customer::firstOrCreate([
            'name' => $name,
            'last_name' => $lastName,
        ]);

        return $place->reservations()->create([
            'customer_id' => $customer->id,
            'date' => $date,
            'time' => $time,
        ]);
    }
}
