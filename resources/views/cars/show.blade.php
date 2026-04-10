@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- Back --}}
        <a href="{{ route('cars.index') }}" class="back-link">Back to cars list</a>

        {{-- Hero --}}
        <div class="car-hero">
            @if ($car->image_url)
                <div class="car-hero-img {{ $car->image_url ? '' : 'placeholder' }}">
                    <img src="{{ asset('storage/' . $car->image_url) }}" alt="{{ $car->carModel->name }}">
                </div>
            @endif
            <div class="car-hero-info">
                <div class="car-hero-brand">{{ $car->carModel->brand->name }}</div>
                <div class="car-hero-name">{{ $car->carModel->name }}</div>
                @if ($car->price)
                    <div class="car-hero-price">
                        {{ number_format($car->price, 2, '.', "'") }} €
                    </div>
                @endif
                <div><span class="badge-fuel">{{ $car->fuelType->name }}</span></div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="car-actions">
            <a href="" class="btn-gold">Edit</a>
            <form action="" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger-outline"
                    onclick="return confirm('Are you sure you want to delete this car?')">
                    Delete
                </button>
            </form>
        </div>

        {{-- Technical details --}}
        <div class="section-card">
            <div class="section-title">Technical details</div>
            <div class="specs-grid">
                <div class="spec-item">
                    <div class="spec-label">Year</div>
                    <div class="spec-value">{{ $car->year ?? '—' }}</div>
                </div>
                <div class="spec-item">
                    <div class="spec-label">Mileage</div>
                    <div class="spec-value">
                        {{ $car->km ? number_format($car->km, 0, '.', "'") . ' km' : '—' }}
                    </div>
                </div>
                <div class="spec-item">
                    <div class="spec-label">Fuel type</div>
                    <div class="spec-value">{{ $car->fuelType->name ?? '—' }}</div>
                </div>
                <div class="spec-item">
                    <div class="spec-label">Engine</div>
                    <div class="spec-value">{{ $car->engine ?? '—' }}</div>
                </div>
                <div class="spec-item">
                    <div class="spec-label">Previous owners</div>
                    <div class="spec-value">{{ $car->previous_owners ?? '—' }}</div>
                </div>
                <div class="spec-item">
                    <div class="spec-label">Plate</div>
                    <div class="spec-value">{{ $car->plate ?? '—' }}</div>
                </div>
            </div>
        </div>

        {{-- Chassis --}}
        <div class="section-card">
            <div class="section-title">Chassis</div>
            <div class="spec-item">
                <div class="spec-label">VIN / Chassis number</div>
                <div class="spec-value spec-mono">{{ $car->chassis ?? '—' }}</div>
            </div>
        </div>

        {{-- Optional --}}
        <div class="section-card">
            <div class="section-title">Optional & Accessories</div>
            <div class="optional-grid">
                @if (count($car->optionals))
                    @foreach ($car->optionals as $optional)
                        <span class="optional-badge">{{ $optional->name }}</span>
                    @endforeach
                @else
                    <span class="optional-placeholder">No details available</span>
                @endif
            </div>
        </div>

    </div>
@endsection
