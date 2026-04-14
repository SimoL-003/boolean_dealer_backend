@extends('layouts.app')

@section('content')
    <div class="container">

        <a href="{{ route('cars-settings.models.index') }}" class="back-link">Back to models list</a>
        <h1 class="page-title">Add New Model</h1>
        <p class="required-note">Fields marked with * are required.</p>

        <form action="{{ route('cars-settings.models.store') }}" method="POST">
            @csrf

            <div class="section-card">
                <div class="section-title">Model Info</div>
                <div class="row g-3">

                    {{-- Brand --}}
                    <div class="col-md-6">
                        <label for="brand" class="form-label">Brand *</label>
                        <select class="form-select" name="brand" id="brand" required>
                            <option>Select a brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Name --}}
                    <div class="col-md-6">
                        <label for="name" class="form-label">Model Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Golf" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>



                </div>
            </div>

            {{-- Actions --}}
            <div class="d-flex gap-2 mb-4">
                <button type="submit" class="btn-gold">Add Model</button>
                <a href="{{ route('cars-settings.models.index') }}" class="btn-cancel">Cancel</a>
            </div>

        </form>
    </div>
@endsection
