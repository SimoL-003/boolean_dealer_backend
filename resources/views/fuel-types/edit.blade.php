@extends('layouts.app')

@section('content')
    @extends('layouts.app')

@section('content')
    <div class="container">

        <a href="{{ route('cars-settings.fuel-types.index') }}" class="back-link">Back to types list</a>
        <h1 class="page-title">Edit {{ $fuelType->name }}</h1>
        <p class="required-note">Fields marked with * are required.</p>

        <form action="{{ route('cars-settings.fuel-types.update', $fuelType) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="section-card">
                <div class="section-title">Type Info</div>
                <div class="row g-3">

                    {{-- Name --}}
                    <div class="col-md-6">
                        <label for="name" class="form-label">Fuel Type *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ $fuelType->name }}">
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="col-md-6">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror"
                            id="description" name="description" value="{{ $fuelType->description }}">
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Is Electrified --}}
                    <div class="col-md-12">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input @error('is_electrified') is-invalid @enderror"
                                id="is_electrified" name="is_electrified" value="1"
                                {{ $fuelType->is_electrified ? 'checked' : '' }}>
                            <label for="is_electrified" class="form-check-label">Electrified vehicle</label>
                        </div>
                        @error('is_electrified')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Actions --}}
            <div class="d-flex gap-2 mb-4">
                <button type="submit" class="btn-gold">Update Type</button>
                <a href="{{ route('cars-settings.fuel-types.index') }}" class="btn-cancel">Cancel</a>
            </div>

        </form>
    </div>
@endsection

@endsection
