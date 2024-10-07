<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class FourSquareAPI
{
    protected $API_KEY;

    protected $API_TYPE = '2';

    protected $SECONDS_TO_LIVE = 60 * 60 * 24;

    public function __construct()
    {
        $this->API_KEY = env('FOURSQUARE_API_KEY');
    }

    public function getTouristSpots($identifier, $latitude, $longitude)
    {

        $data = Cache::remember($this->API_TYPE.'-'.$identifier, $this->SECONDS_TO_LIVE, function () use ($latitude, $longitude) {
            $response = Http::get('https://api.geoapify.com/v2/places', [
                'categories' => 'tourism',
                'filter' => 'circle:'.$longitude.','.$latitude.',10000',
                'bias' => 'proximity:'.$longitude.','.$latitude,
                'limit' => '20',
                'apiKey' => $this->API_KEY,
                'lang' => 'en',
            ]);

            return json_encode($response->json());
        });

        return json_decode($data);
    }
}
