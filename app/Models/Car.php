<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use League\Uri\Idna\Option;

class Car extends Model
{
    public function fuelType()
    {
        return $this->belongsTo(FuelType::class);
    }

    public function carModel()
    {
        return $this->belongsTo(CarModel::class);
    }

    public function optionals()
    {
        return $this->belongsToMany(Optional::class);
    }
}
