@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('cars-settings.index') }}" class="back-link">Back to cars settings</a>
        <div class="d-flex align-items-center justify-content-between pb-4 pt-2">
            <h1 class="page-title">Car Models</h1>
            <a href="{{ route('cars-settings.models.create') }}" class="btn btn-gold">+ Add Model</a>
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
                        <th scope="col">Brand</th>
                        <th scope="col">Model</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carModels as $model)
                        <tr>
                            <td>{{ $model->brand->name }}</td>
                            <td scope="row">{{ $model->name }}</td>
                            <td class="text-end">
                                <a href="{{ route('cars-settings.models.edit', $model) }}" class="btn-action">Edit</a>
                                <form action="{{ route('cars-settings.models.destroy', $model) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action danger"
                                        onclick="return confirm('Delete this model?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
