<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;


    protected $fillable = [
        'place_id'
    ];

    /**
     * Add a like to a place
     *
     * @param integer $placeId
     * @return Place
     */
    public static function addLike(int $placeId): Place
    {
        $place = Place::firstOrCreate([
            'place_id' => $placeId
        ]);
        $place->increment('likes');
        return $place;
    }
}
