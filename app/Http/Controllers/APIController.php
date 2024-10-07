<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getWeather(Request $request, int $id)
    {
        $city = City::where('id', $id)->firstOrFail();

        $openWeatherAPI = new \App\Services\OpenWeatherAPI;
        $forecastData = $openWeatherAPI->get5Days3HourForecast($city->id, $city->latitude, $city->longitude);

        return $forecastData;
    }

    public function getSpots(Request $request, int $id)
    {
        $city = City::where('id', $id)->firstOrFail();

        $fourSquareAPI = new \App\Services\FourSquareAPI;
        $touristSpotsData = $fourSquareAPI->getTouristSpots($city->id, $city->latitude, $city->longitude);

        return $touristSpotsData;
    }
}
