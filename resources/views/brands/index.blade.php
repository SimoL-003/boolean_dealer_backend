@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('cars-settings.index') }}" class="back-link">Back to cars settings</a>
        <div class="d-flex align-items-center justify-content-between pb-4 pt-2">
            <h1 class="page-title">Car Brands</h1>
            <a href="{{ route('cars-settings.brands.create') }}" class="btn btn-gold">+ Add Brand</a>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card-table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Country of Origin</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <td scope="row">{{ $brand->name }}</td>
                            <td>{{ $brand->country_of_origin }}</td>
                            <td class="text-end">
                                <a href="{{ route('cars-settings.brands.edit', $brand) }}" class="btn-action">Edit</a>
                                <form action="{{ route('cars-settings.brands.destroy', $brand) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action danger"
                                        onclick="return confirm('Delete this optional?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
