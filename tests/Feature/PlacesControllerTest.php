<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlacesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that endpoint /api/places list the places by page
     *
     * @return void
     */
    public function testListPlacesByPage(): void
    {
        $response = $this->json('GET', '/api/places', [
            'page' => 0
        ]);

        $response->assertOk();

        $response->assertJsonStructure(['data' => ['places', 'nextPage']]);
    }
    
    /**
     * Tests that endpoint /api/places validate the parameter 'page'
     *
     * @return void
     */
    public function testListPlacesByPageWithIncorrectPage(): void
    {
        $response = $this->json('GET', '/api/places', [
            'page' => 'some-incorrect-data'
        ]);

        $response->assertUnprocessable();
    }

    /**
     * Test that you can vote for a place that no exists on the local database
     *
     * @return void
     */
    public function testLikeToPlace(): void
    {
        $response = $this->json('PUT', '/api/places/like', [
            'placeId' => Place::factory()->make()->place_id
        ]);

        $response->assertCreated();

        $response->assertJsonStructure(['place' => ['id', 'placeId', 'likes']]);

        $response->assertJsonPath('place.likes', 1);
    }


    /**
     * Test that you can vote for a place that exist on the local database
     *
     * @return void
     */
    public function testLikeToPlaceOnAPlaceCreated(): void
    {
        $place = Place::factory()->create();
        $response = $this->json('PUT', '/api/places/like', [
            'placeId' => $place->place_id
        ]);

        $response->assertOk();

        $response->assertJsonStructure(['place' => ['id', 'placeId', 'likes']]);
        
        $response->assertJsonPath('place.likes', $place->likes + 1);
    }
}
