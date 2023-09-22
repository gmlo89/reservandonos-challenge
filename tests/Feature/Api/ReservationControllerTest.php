<?php

namespace Tests\Feature\Api;

use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservationControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that create a reservation successfully
     *
     * @return void
     */
    public function testStoreNewReservation(): void
    {
        $place = Place::factory()->create();

        $response = $this->json('POST', '/api/reservation', [
            'name' => fake()->name,
            'lastName' => fake()->lastName,
            'date' => now()->addDay()->toDateString(),
            'time' => now()->toTimeString(),
            'placeId' => $place->id,
        ]);

        $response->assertCreated();
    }

    /**
     * Test that create a reservation with errors
     *
     * @return void
     */
    public function testStoreNewReservationWithErrors(): void
    {

        $response = $this->json('POST', '/api/reservation', [
            'name' => fake()->name,
            'lastName' => fake()->lastName,
            'date' => now()->addDay()->toDateString(),
            'time' => now()->toTimeString(),
            'placeId' => fake()->randomNumber(1),
        ]);

        $response->assertUnprocessable();
    }
}
