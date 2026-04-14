@extends('layouts.app')

@section('content')
    <div class="container">

        <a href="{{ route('cars-settings.models.index') }}" class="back-link">Back to models list</a>
        <h1 class="page-title">Edit {{ $model->brand->name }} {{ $model->name }}</h1>
        <p class="required-note">Fields marked with * are required.</p>

        <form action="{{ route('cars-settings.models.update', $model) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="section-card">
                <div class="section-title">Optional Info</div>
                <div class="row g-3">

                    {{-- Brand --}}
                    <div class="col-md-6">
                        <label for="brand" class="form-label">Brand</label>
                        <select class="form-select" name="brand" id="brand">
                            <option value="">Select a country</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $model->brand->id == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Name --}}
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Ferrari" value="{{ $model->name }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Actions --}}
            <div class="d-flex gap-2 mb-4">
                <button type="submit" class="btn-gold">Update Model</button>
                <a href="{{ route('cars-settings.models.index') }}" class="btn-cancel">Cancel</a>
            </div>

        </form>
    </div>
@endsection
