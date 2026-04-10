<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\FuelType;
use App\Models\Optional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $brands = Brand::orderBy('name')->get();
        $carModels = CarModel::orderBy('name')->get();
        $fuelTypes = FuelType::orderBy('name')->get();
        $optionals = Optional::orderBy('name')->get();
        return view('cars.create', compact('brands', 'carModels', 'fuelTypes', 'optionals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'model' => ['required', 'exists:car_models,id'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'km' => ['nullable', 'numeric', 'min:0'],
            'plate' => ['nullable', 'string', 'size:7', Rule::unique('cars', 'plate')->whereNotNull('plate')],
            'chassis' => ['nullable', 'string', Rule::unique('cars', 'chassis')->whereNotNull('chassis')],
            'year' => ['nullable', 'integer', 'min:1900', 'max:' . date('Y')],
            'fuel_type' => ['required', 'exists:fuel_types,id'],
            'previous_owners' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $data = $request->all();
        $newCar = new Car();
        $newCar->car_model_id = $data['model'];
        $newCar->price = $data['price'];
        $newCar->km = $data['km'];
        $newCar->plate = $data['plate'] ? strtoupper($data['plate']) : null;
        $newCar->chassis = $data['chassis'] ? strtoupper($data['chassis']) : null;
        $newCar->year = $data['year'];
        $newCar->fuel_type_id = $data['fuel_type'];
        $newCar->previous_owners = $data['previous_owners'];

        if (array_key_exists('image', $data)) {
            $image_url = Storage::putFile('car_images', $data['image']);
            $newCar->image_url = $image_url;
        }

        $newCar->save();

        if (array_key_exists('optionals', $data)) {
            $newCar->optionals()->attach($data['optionals']);
        }

        return Redirect::to(route('cars.show', $newCar));
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car): View
    {
        return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car): View
    {
        $brands = Brand::orderBy('name')->get();
        $fuelTypes = FuelType::orderBy('name')->get();
        $optionals = Optional::orderBy('name')->get();
        return view('cars.edit', compact('car', 'brands', 'fuelTypes', 'optionals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car): RedirectResponse
    {
        $request->validate([
            'model' => ['required', 'exists:car_models,id'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'km' => ['nullable', 'numeric', 'min:0'],
            'plate' => ['nullable', 'string', 'size:7', Rule::unique('cars', 'plate')->ignore($car->id)->whereNotNull('plate')],
            'chassis' => ['nullable', 'string', Rule::unique('cars', 'chassis')->ignore($car->id)->whereNotNull('chassis')],
            'year' => ['nullable', 'integer', 'min:1900', 'max:' . date('Y')],
            'fuel_type' => ['required', 'exists:fuel_types,id'],
            'previous_owners' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $data = $request->all();
        $car->car_model_id = $data['model'];
        $car->price = $data['price'];
        $car->km = $data['km'];
        $car->plate = $data['plate'] ? strtoupper($data['plate']) : null;
        $car->chassis = $data['chassis'] ? strtoupper($data['chassis']) : null;
        $car->year = $data['year'];
        $car->fuel_type_id = $data['fuel_type'];
        $car->previous_owners = $data['previous_owners'];

        if (array_key_exists('image', $data)) {
            if ($car->image_url) {
                Storage::delete($car->image_url);
            }
            $car->image_url = Storage::putFile('car_images', $data['image']);
        }

        $car->update();

        if (array_key_exists('optionals', $data)) {
            $car->optionals()->sync($data['optionals']);
        } else {
            $car->optionals()->detach();
        }



        return Redirect::route('cars.show', $car);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car): RedirectResponse
    {
        if ($car->image_url) {
            Storage::delete($car->image_url);
        }
        $car->optionals()->detach();
        $car->delete();

        return Redirect::route('cars.index');
    }
}
