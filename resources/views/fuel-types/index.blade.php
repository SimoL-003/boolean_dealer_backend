@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('cars-settings.index') }}" class="back-link">Back to cars settings</a>
        <div class="d-flex align-items-center justify-content-between pb-4 pt-2">
            <h1 class="page-title">Fuel types available in our cars</h1>
            <a href="{{ route('cars-settings.fuel-types.create') }}" class="btn btn-gold">+ Add Type</a>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card-table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Is electrified</th>
                        <th scope="col">Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fuelTypes as $fuelType)
                        <tr>
                            <td scope="row">{{ $fuelType->name }}</td>
                            <td>{{ $fuelType->is_electrified ? 'Yes' : 'No' }}</td>
                            <td>{{ $fuelType->description }}</td>
                            <td class="text-end">
                                <a href="{{ route('cars-settings.fuel-types.edit', $fuelType) }}"
                                    class="btn-action">Edit</a>
                                <form action="{{ route('cars-settings.fuel-types.destroy', $fuelType) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action danger"
                                        onclick="return confirm('Delete this fuel type?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
