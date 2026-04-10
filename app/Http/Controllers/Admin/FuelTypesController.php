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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FuelType $fuelType)
    {
        //
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

        return Redirect::route('cars-settings.fuel-types.index')
            ->with('success', 'Fuel type deleted successfully.');
    }
}
