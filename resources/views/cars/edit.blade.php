@extends('layouts.app')

@section('content')
    <div class="container">

        <a href="{{ route('cars.index') }}" class="back-link">Back to cars list</a>

        <h1 class="page-title">Update {{ $car->carModel->brand->name }} {{ $car->carModel->name }}</h1>
        <p class="required-note">Fields marked with * are required.</p>

        <form action="{{ route('cars.update', compact('car')) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Vehicle identity --}}
            <div class="section-card">
                <div class="section-title">Vehicle identity</div>
                <div class="row g-3">
                    {{-- Brand --}}
                    <div class="col-md-6">
                        <label for="brand" class="form-label">Brand *</label>
                        <select class="form-select @error('brand') is-invalid @enderror" id="brand" name="brand"
                            required>
                            <option value="">Select a brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ $car->carModel->brand_id == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Model --}}
                    <div class="col-md-6">
                        <label for="model" class="form-label">Model *</label>
                        <select class="form-select @error('model') is-invalid @enderror" id="model" name="model"
                            required>
                            <option value="">Select a model</option>
                        </select>
                        @error('model')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Details --}}
            <div class="section-card">
                <div class="section-title">Details</div>
                <div class="row g-3">
                    {{-- Price --}}
                    <div class="col-md-4">
                        <label for="price" class="form-label">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">€</span>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                                id="price" name="price" value="{{ $car->price }}" placeholder="0.00">
                        </div>
                        @error('price')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Kilometers --}}
                    <div class="col-md-4">
                        <label for="km" class="form-label">Kilometers</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('km') is-invalid @enderror" id="km"
                                name="km" value="{{ $car->km }}" placeholder="0">
                            <span class="input-group-text">km</span>
                        </div>
                        @error('km')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Year --}}
                    <div class="col-md-4">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" class="form-control @error('year') is-invalid @enderror" id="year"
                            name="year" value="{{ $car->year }}" placeholder="2001">
                        @error('year')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Fuel type --}}
                    <div class="col-md-4">
                        <label for="fuel_type" class="form-label">Fuel Type *</label>
                        <select class="form-select @error('fuel_type') is-invalid @enderror" id="fuel_type" name="fuel_type"
                            required>
                            <option value="">Select a fuel type</option>
                            @foreach ($fuelTypes as $fuelType)
                                <option value="{{ $fuelType->id }}"
                                    {{ $car->fuelType->id == $fuelType->id ? 'selected' : '' }}>
                                    {{ $fuelType->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('fuel_type')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Previous owners --}}
                    <div class="col-md-4">
                        <label for="previous_owners" class="form-label">Previous Owners</label>
                        <input type="number" class="form-control @error('previous_owners') is-invalid @enderror"
                            id="previous_owners" name="previous_owners" value="{{ $car->previous_owners }}">
                        @error('previous_owners')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Registration --}}
            <div class="section-card">
                <div class="section-title">Registration</div>
                <div class="row g-3">
                    {{-- Plate --}}
                    <div class="col-md-6">
                        <label for="plate" class="form-label">Licence Plate</label>
                        <input type="text" class="form-control @error('plate') is-invalid @enderror" id="plate"
                            name="plate" minlength="7" maxlength="7" placeholder="AB123CD" value="{{ $car->plate }}">
                        @error('plate')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Chassis --}}
                    <div class="col-md-6">
                        <label for="chassis" class="form-label">VIN / Chassis</label>
                        <input type="text" class="form-control @error('chassis') is-invalid @enderror" id="chassis"
                            name="chassis" minlength="17" maxlength="17" placeholder="ZFF79ALB000123456"
                            value="{{ $car->chassis }}" style="font-family: monospace;">
                        @error('chassis')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Media --}}
            <div class="section-card">
                <div class="section-title">Media</div>
                <div class="d-flex justify-content-between gap-5">
                    <div class="w-100">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                            name="image" accept="image/*">
                        @error('image')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    @if ($car->image_url)
                        <img src="{{ asset('storage/' . $car->image_url) }}" alt="{{ $car->carModel->name }}"
                            class="w-25">
                    @endif
                </div>
            </div>

            {{-- Optionals --}}
            <div class="section-card">
                <div class="section-title">Optional & Accessories</div>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($optionals as $optional)
                        <label class="optional-tag">
                            <input type="checkbox" name="optionals[]" value="{{ $optional->id }}"
                                {{ $car->optionals->contains($optional->id) ? 'checked' : '' }}>
                            {{ $optional->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Actions --}}
            <div class="d-flex gap-2 mb-4">
                <button type="submit" class="btn-gold">Update Car</button>
                <a href="{{ route('cars.index') }}" class="btn-cancel">Cancel</a>
            </div>

        </form>
    </div>

    <script>
        const brandSelect = document.getElementById('brand');
        const modelSelect = document.getElementById('model');

        // Current model ID
        const currentModelId = {{ $car->car_model_id }};

        function loadModels(brandId, selectedModelId = null) {
            if (!brandId) return;

            modelSelect.innerHTML = '<option value="">Loading...</option>';

            fetch(`/brands/${brandId}/models`)
                .then(response => response.json())
                .then(data => {
                    modelSelect.innerHTML = '<option value="">Select a model</option>';
                    data.forEach(model => {
                        const selected = model.id == selectedModelId ? 'selected' : '';
                        modelSelect.innerHTML +=
                            `<option value="${model.id}" ${selected}>${model.name}</option>`;
                    });
                });
        }

        // Current brand models
        loadModels(brandSelect.value, currentModelId);

        // On change, new models
        brandSelect.addEventListener('change', function() {
            loadModels(this.value);
        });
    </script>
@endsection
