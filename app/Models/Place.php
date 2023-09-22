<?php

namespace App\Models;

use App\Services\Reservandonos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Place extends Model
{
    use HasFactory;


    protected $fillable = [
        'place_id'
    ];

    public array $detailData;

    /**
     * get all the reservations of this place
     *
     * @return HasMany
     */
    public function reservations():HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Add a like to a place
     *
     * @param integer $placeId
     * @return Place
     */
    public static function addLike(int $placeId): Place
    {
        $place = self::findByPlaceIdOrCreate($placeId);
        $place->increment('likes');
        return $place;
    }

    /**
     * Find or create a place on the database
     *
     * @param integer $placeId
     * @return Place
     */
    public static function findByPlaceIdOrCreate(int $placeId): Place
    {
        return Place::firstOrCreate([
            'place_id' => $placeId
        ]);
    }

    /**
     * set details data
     *
     * @param array $data
     * @return void
     */
    public function setDetails(array $data): void
    {
        $this->detailData = $data;
    }
}
