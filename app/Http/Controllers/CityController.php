<?php

namespace App\Http\Controllers;

use App\Services\CityService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getCities(CityService $cityService)
{
    $cities = $cityService->fetchCities();
    return response()->json($cities);
}
}
