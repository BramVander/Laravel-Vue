<?php

use App\Models\Bookable;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\BookableController;
use App\Http\Controllers\Api\BookableReviewController;
use App\Http\Controllers\Api\BookableAvailabilityController;
use App\Http\Controllers\Api\BookingByReviewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/bookables', [BookableController::class, 'index']);
// Route::get('/bookables/{id}', [BookableController::class, 'show']);

// instead we can group the routes under a resource like so

Route::resource('bookables', BookableController::class)->only(['index', 'show']);
Route::resource('reviews', ReviewController::class)->only(['show', 'store']);

Route::get('bookables/{bookable}/availability', BookableAvailabilityController::class)->name('bookable.availability.show');
Route::get('bookables/{bookable}/reviews', BookableReviewController::class)->name('bookable.reviews.index');
Route::get('booking-by-review/{reviewKey}', BookingByReviewController::class)->name('booking.by-review.show');