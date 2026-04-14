<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CarModelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carModels = CarModel::orderBy('brand_id')->get();
        return view('models.index', compact('carModels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        return view('models.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $newCarModel = new CarModel();
        $newCarModel->name = $data['name'];
        $newCarModel->brand_id = $data['brand'];
        $newCarModel->save();
        return Redirect::route('cars-settings.models.index');
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
    public function edit(CarModel $model)
    {
        $brands = Brand::orderBy('name')->get();
        return view('models.edit', compact('model', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarModel $model)
    {
        $data = $request->all();
        $model->name = $data['name'];
        $model->brand_id = $data['brand'];
        $model->update();
        return Redirect::route('cars-settings.models.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarModel $model)
    {
        if ($model->cars()->exists()) {
            return Redirect::route('cars-settings.models.index')
                ->with('error', 'Cannot delete this fuel type because it is associated with one or more cars.');
        }
        $model->delete();
        return Redirect::route('cars-settings.models.index');
    }
}
