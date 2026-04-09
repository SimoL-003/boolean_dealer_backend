@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- Header --}}
        <div class="d-flex align-items-center justify-content-between py-4">
            <h1 class="page-title">Our Cars</h1>
            <a href="" class="btn btn-gold">+ Add Car</a>
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
                            <td>{{ number_format($car->price, 2, '.', "'") }} €</td>
                            <td>{{ number_format($car->km, 0, '.', "'") }} km</td>
                            <td>{{ $car->year }}</td>
                            <td><span class="badge-fuel">{{ $car->fuelType->name }}</span></td>
                            <td>{{ $car->plate }}</td>
                            <td>{{ $car->previous_owners }}</td>
                            <td class="text-end">
                                <a href="{{ route('cars.show', $car) }}" class="btn-action">Details</a>
                                <a href="" class="btn-action">Edit</a>
                                <form action="" method="POST" class="d-inline">
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
