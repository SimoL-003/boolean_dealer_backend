<?php

namespace Database\Seeders;

use App\Models\CarModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (config('car_models') as $carModel) {
            $newCarModel = new CarModel();
            $newCarModel->name = $carModel['name'];
            $newCarModel->brand_id = $carModel['brand_id'];
            $newCarModel->save();
        }
    }
}
