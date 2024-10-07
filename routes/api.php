<?php

use App\Http\Controllers\APIController;
use Illuminate\Support\Facades\Route;

Route::get('/weather/{id}', [APIController::class, 'getWeather']);
Route::get('/spots/{id}', [APIController::class, 'getSpots']);
