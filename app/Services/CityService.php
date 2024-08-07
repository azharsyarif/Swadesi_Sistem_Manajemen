<?php

namespace App\Services;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;

class CityService
{
    /**
     * Create a new class instance.
     */
    // public function __construct()
    // {
    //     //
    // }
    public function fetchCities()
    {
        $cachedCities = Cache::get('cities');

        if (!$cachedCities) {
            $client = new Client();
            $response = $client->request('GET', 'https://api.rajaongkir.com/starter/city', [
                'headers' => [
                    'key' => '5bd72d3502cdc7393c3f801f97384614'
                ]
            ]);

            $cities = json_decode($response->getBody(), true)['rajaongkir']['results'];
            Cache::put('cities', $cities, now()->addHours(6)); // Cache for 6 hours
        } else {
            $cities = $cachedCities;
        }

        return $cities;
    }
}
