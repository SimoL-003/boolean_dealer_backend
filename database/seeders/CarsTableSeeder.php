<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (config('cars') as $car) {
            $newCar = new Car();
            $newCar->car_model_id = $car['car_model_id'];
            $newCar->price = $car['price'];
            $newCar->km = $car['km'];
            $newCar->plate = $car['plate'];
            $newCar->chassis = $car['chassis'];
            $newCar->year = $car['year'];
            $newCar->fuel_type_id = $car['fuel_type_id'];
            $newCar->previous_owners = $car['previous_owners'];
            $newCar->save();
        }
    }
}
