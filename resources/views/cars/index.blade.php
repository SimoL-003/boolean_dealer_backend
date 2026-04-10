@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- Header --}}
        <div class="d-flex align-items-center justify-content-between py-4">
            <h1 class="page-title">Our Cars</h1>
            <a href="{{ route('cars.create') }}" class="btn btn-gold">+ Add Car</a>
        </div>

        {{-- Table --}}
        <div class="card-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Model</th>
                        <th>Price</th>
                        <th>KM</th>
                        <th>Year</th>
                        <th>Fuel Type</th>
                        <th>Plate</th>
                        <th>Owners</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cars as $car)
                        <tr>
                            <td>
                                <span class="car-model">{{ $car->carModel->name }}</span>
                                <span class="car-brand">{{ $car->carModel->brand->name }}</span>
                            </td>
                            <td>{{ $car->price ? number_format($car->price, 2, '.', "'") . ' €' : 'N/D' }}</td>
                            <td>{{ $car->km ? number_format($car->km, 0, '.', "'") . ' km' : 'N/D' }}</td>
                            <td>{{ $car->year ?? 'N/D' }}</td>
                            <td><span class="badge-fuel">{{ $car->fuelType->name }}</span></td>
                            <td>{{ $car->plate ?? 'N/D' }}</td>
                            <td>{{ $car->previous_owners }}</td>
                            <td class="text-end">
                                <a href="{{ route('cars.show', $car) }}" class="btn-action">Details</a>
                                <a href="{{ route('cars.edit', $car) }}" class="btn-action">Edit</a>
                                <form action="{{ route('cars.destroy', $car) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action danger"
                                        onclick="return confirm('Delete this car?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
