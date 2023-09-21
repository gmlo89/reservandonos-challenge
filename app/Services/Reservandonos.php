<?php

namespace App\Services;

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
        return collect(Http::get("{$this->baseUrl}{$uri}", $query)->json());
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
}
