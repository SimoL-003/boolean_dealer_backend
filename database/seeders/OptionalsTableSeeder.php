<?php

namespace Database\Seeders;

use App\Models\Optional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (config('car_optionals') as $optional) {
            $newOptional = new Optional();
            $newOptional->name = $optional['name'];
            $newOptional->description = $optional['description'];
            $newOptional->save();
        }
    }
}
