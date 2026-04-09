@extends('layouts.app')

@section('content')
    <main>
        <div class="container">
            <h1>Our Cars</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Model</th>
                        <th scope="col">Price</th>
                        <th scope="col">KM</th>
                        <th scope="col">Year</th>
                        <th scope="col">Fuel Type</th>
                        <th scope="col">Plate</th>
                        <th scope="col">Chassis</th>
                        <th scope="col">Previous Owners</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cars as $car)
                        <tr>
                            <th scope="row">{{ $car->carModel->brand->name }} {{ $car->carModel->name }}</th>
                            <td>{{ number_format($car->price, 2, '.', "'") }} €</td>
                            <td>{{ number_format($car->km, 2, '.', "'") }} km</td>
                            <td>{{ $car->year }}</td>
                            <td>{{ $car->fuelType->name }}</td>
                            <td>{{ $car->plate }}</td>
                            <td>{{ $car->chassis }}</td>
                            <td>{{ $car->previous_owners }}</td>
                            <td><a href="">Details</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
