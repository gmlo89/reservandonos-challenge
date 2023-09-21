<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlacesControllerTest extends TestCase
{
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
}
