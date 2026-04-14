@extends('layouts.app')

@section('content')
    <div class="container">

        <a href="{{ route('cars-settings.brands.index') }}" class="back-link">Back to brands list</a>
        <h1 class="page-title">Add New Brand</h1>
        <p class="required-note">Fields marked with * are required.</p>

        <form action="{{ route('cars-settings.brands.store') }}" method="POST">
            @csrf

            <div class="section-card">
                <div class="section-title">Brand Info</div>
                <div class="row g-3">

                    {{-- Name --}}
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Ferrari" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Country of Origin --}}
                    <div class="col-md-6">
                        <label for="country_of_origin" class="form-label">Country of Origin</label>
                        <select class="form-select" name="country_of_origin" id="country_of_origin">
                            <option value="">Select a country</option>
                            @foreach (config('countries') as $country)
                                <option value="{{ $country }}"
                                    {{ old('country_of_origin') == $country ? 'selected' : '' }}>
                                    {{ $country }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>

            {{-- Actions --}}
            <div class="d-flex gap-2 mb-4">
                <button type="submit" class="btn-gold">Add Brand</button>
                <a href="{{ route('cars-settings.brands.index') }}" class="btn-cancel">Cancel</a>
            </div>

        </form>
    </div>
@endsection
