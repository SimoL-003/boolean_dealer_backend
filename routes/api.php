<?php

use App\Http\Controllers\Api\CarsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/cars', [CarsController::class, 'index'])/* ->middleware('auth:sanctum') */ ;
Route::get('/cars/{id}', [CarsController::class, 'show']);