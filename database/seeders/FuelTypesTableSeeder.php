<?php

namespace Database\Seeders;

use App\Models\FuelType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuelTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (config('fuel_types') as $fuelType) {
            $newFuelType = new FuelType();
            $newFuelType->name = $fuelType['name'];
            $newFuelType->is_electrified = $fuelType['is_electrified'];
            $newFuelType->description = $fuelType['description'];
            $newFuelType->save();
        }
    }
}
