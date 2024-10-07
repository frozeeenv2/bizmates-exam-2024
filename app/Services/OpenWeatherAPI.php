<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class OpenWeatherAPI
{
    protected $API_KEY;

    protected $API_TYPE = '1';

    protected $SECONDS_TO_LIVE = 60;

    public function __construct()
    {
        $this->API_KEY = env('OPEN_WEATHER_API_KEY');
    }

    public function get5Days3HourForecast($identifier, $latitude, $longitude)
    {

        $data = Cache::remember($this->API_TYPE.'-'.$identifier, $this->SECONDS_TO_LIVE, function () use ($latitude, $longitude) {
            $response = Http::get('https://api.openweathermap.org/data/2.5/forecast', [
                'lat' => $latitude,
                'lon' => $longitude,
                'appid' => $this->API_KEY,
            ]);

            return json_encode($response->json());
        });

        return json_decode($data);
    }
}
