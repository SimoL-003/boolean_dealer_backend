<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('name')->get();
        return view('brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $newBrand = new Brand();
        $newBrand->name = $data['name'];
        $newBrand->country_of_origin = $data['country_of_origin'];
        $newBrand->save();
        return Redirect::route('cars-settings.brands.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $data = $request->all();
        $brand->name = $data['name'];
        $brand->country_of_origin = $data['country_of_origin'];
        $brand->update();
        return Redirect::route('cars-settings.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if ($brand->CarModels()->exists()) {
            return Redirect::route('cars-settings.brands.index')
                ->with('error', 'Cannot delete this brand because it is associated with one or more cars.');
        }
        $brand->delete();

        return Redirect::route('cars-settings.brands.index');
    }
}
