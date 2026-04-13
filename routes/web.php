<?php

use App\Http\Controllers\Admin\CarsController;
use App\Http\Controllers\Admin\FuelTypesController;
use App\Http\Controllers\Admin\OptionalsController;
use App\Http\Controllers\ProfileController;
use App\Models\CarModel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('cars-settings')
    ->name('cars-settings.')
    ->group(function () {

        Route::get('/', function () {
            return view('cars-settings');
        })->name('index');

        Route::resource('fuel-types', FuelTypesController::class);
        Route::resource('optionals', OptionalsController::class);
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('cars', CarsController::class)->middleware(['auth', 'verified']);

Route::get('/brands/{brand}/models', function ($brandId) {
    return CarModel::where('brand_id', $brandId)->get();
});

require __DIR__ . '/auth.php';
