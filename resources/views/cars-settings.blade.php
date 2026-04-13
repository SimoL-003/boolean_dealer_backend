@extends('layouts.app')

@section('content')
    <div class="container">
        <div>

            <a href="">Car brands and models</a>
        </div>
        <div>

            <a href="{{ route('cars-settings.fuel-types.index') }}">Fuel types</a>
        </div>
        <div>

            <a href="{{ route('cars-settings.optionals.index') }}">Optionals</a>
        </div>
    </div>
@endsection
