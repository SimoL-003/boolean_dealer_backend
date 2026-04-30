<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function index()
    {
        $cars = Car::with('fuelType', 'carModel', 'optionals', 'carModel.brand')->get();
        return response()->json([
            'success' => true,
            'results' => $cars
        ]);
    }

    public function show($id)
    {
        $car = Car::with('fuelType', 'carModel', 'optionals', 'carModel.brand')->find($id);
        return response()->json([
            'success' => true,
            'results' => $car
        ]);
    }
}
