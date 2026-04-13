<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FuelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FuelTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fuelTypes = FuelType::orderBy('name')->get();
        return view('fuel-types.index', compact('fuelTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fuel-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $newFuelType = new FuelType();
        $newFuelType->name = $data['name'];
        $newFuelType->description = $data['description'];
        if (array_key_exists('is_electrified', $data)) {
            $newFuelType->is_electrified = $data['is_electrified'];
        } else {
            $newFuelType->is_electrified = false;
        }
        $newFuelType->save();

        return Redirect::route('cars-settings.fuel-types.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(FuelType $fuelType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FuelType $fuelType)
    {
        return view('fuel-types.edit', compact('fuelType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FuelType $fuelType)
    {
        $data = $request->all();
        $fuelType->name = $data['name'];
        $fuelType->description = $data['description'];
        if (array_key_exists('is_electrified', $data)) {
            $fuelType->is_electrified = true;
        } else {
            $fuelType->is_electrified = false;
        }
        $fuelType->update();

        return Redirect::route('cars-settings.fuel-types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FuelType $fuelType)
    {
        if ($fuelType->cars()->exists()) {
            return Redirect::route('cars-settings.fuel-types.index')
                ->with('error', 'Cannot delete this fuel type because it is associated with one or more cars.');
        }

        $fuelType->delete();

        return Redirect::route('cars-settings.fuel-types.index');
    }
}
