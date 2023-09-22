<?php

namespace App\Services;

use App\Exceptions\ReservandonosException;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class Reservandonos
{

    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('reservandonos.url');
    }

    /**
     * Create a new instance of Reservandonos
     *
     * @return Reservandonos
     */
    public static function instance(): Reservandonos
    {
        return new Reservandonos();
    }
    /**
     * Do a get request to the endpoint sent
     *
     * @param string $uri
     * @param array $query
     * @return Collection
     */
    protected function get(string $uri, array $query = []): Collection
    {
        $response = Http::get("{$this->baseUrl}{$uri}", $query);
        if( $response->getStatusCode() == 200 )
            return collect($response->json());
        
        throw new ReservandonosException($response->json('data'));
    }

    /**
     * Get a list of places by page
     *
     * @param integer $page
     * @return Collection
     */
    public static function getPlaces(int|null $page = 0): Collection
    {
        return self::instance()->get('places/getPlacesByFilter', ['mode' => 'web', 'page' => $page]);
    }

    /**
     * Get a place details by ID
     *
     * @param integer $placeId
     * @return array
     */
    public static function getPlaceById(int $placeId):array
    {
        return self::instance()->get("places/getPlaceById/{$placeId}")->first();
    }
}
