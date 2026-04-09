<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (config('brands') as $brand) {
            $newBrand = new Brand();
            $newBrand->name = $brand['name'];
            $newBrand->country_of_origin = $brand['country_of_origin'];
            $newBrand->save();
        }
    }
}
