<?php

use App\Http\Controllers\Api\PlacesController;
use App\Http\Controllers\Api\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// List places

Route::get('places', [PlacesController::class, 'index'])->name('api.places');
Route::put('places/like', [PlacesController::class, 'like'])->name('api.places.like');
Route::get('places/{placeId}/detail', [PlacesController::class, 'detail'])->name('api.places.detail');
Route::get('places/top-50', [PlacesController::class, 'top50'])->name('api.places.top-50');


Route::post('reservation', [ReservationController::class, 'store'])->name('reservation.store');
