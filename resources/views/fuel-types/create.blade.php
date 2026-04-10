@extends('layouts.app')

@section('content')
    <div class="container">

        <a href="{{ route('cars-settings.fuel-types.index') }}" class="back-link">Back to types list</a>
        <h1 class="page-title">Add New Type</h1>
        <p class="required-note">Fields marked with * are required.</p>

        <form action="" method="POST">
            @csrf

            {{-- Registration --}}
            <div class="section-card">
                <div class="section-title">Type Info</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="plate" class="form-label">Fuel Type</label>
                        <input type="text" class="form-control @error('plate') is-invalid @enderror" id="plate"
                            name="plate" minlength="7" maxlength="7" placeholder="AB123CD" value="{{ old('plate') }}">
                        @error('plate')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="chassis" class="form-label">Description</label>
                        <input type="text" class="form-control @error('chassis') is-invalid @enderror" id="chassis"
                            name="chassis" minlength="17" maxlength="17" placeholder="ZFF79ALB000123456"
                            value="{{ old('chassis') }}" style="font-family: monospace;">
                        @error('chassis')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="d-flex gap-2 mb-4">
                <button type="submit" class="btn-gold">Add Type</button>
                <a href="{{ route('cars-settings.fuel-types.index') }}" class="btn-cancel">Cancel</a>
            </div>

        </form>
    </div>
@endsection
