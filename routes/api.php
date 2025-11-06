<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\GuideController;
use App\Http\Middleware\BookingVerification;
// API Routes for Guides
Route::get('/guides', [GuideController::class, 'index']);

Route::middleware([BookingVerification::class])->group(function ()
{
    Route::post('/bookings', [BookingController::class, 'store']);
});
