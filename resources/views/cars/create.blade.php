@extends('layouts.app')

@section('content')
    <div class="container">

        <a href="{{ route('cars.index') }}" class="back-link">Back to cars list</a>
        <h1 class="page-title">Add New Car</h1>
        <p class="required-note">Fields marked with * are required.</p>

        <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Vehicle identity --}}
            <div class="section-card">
                <div class="section-title">Vehicle identity</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="brand" class="form-label">Brand *</label>
                        <select class="form-select @error('brand') is-invalid @enderror" id="brand" name="brand"
                            required>
                            <option value="">Select a brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
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
                    <div class="col-md-4">
                        <label for="price" class="form-label">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">€</span>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                                name="price" value="{{ old('price') }}" placeholder="0.00">
                        </div>
                        @error('price')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="km" class="form-label">Kilometers</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('km') is-invalid @enderror" id="km"
                                name="km" value="{{ old('km') }}" placeholder="0">
                            <span class="input-group-text">km</span>
                        </div>
                        @error('km')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" class="form-control @error('year') is-invalid @enderror" id="year"
                            name="year" value="{{ old('year') }}" placeholder="2001">
                        @error('year')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="fuel_type" class="form-label">Fuel Type *</label>
                        <select class="form-select @error('fuel_type') is-invalid @enderror" id="fuel_type" name="fuel_type"
                            required>
                            <option value="">Select a fuel type</option>
                            @foreach ($fuelTypes as $fuelType)
                                <option value="{{ $fuelType->id }}"
                                    {{ old('fuel_type') == $fuelType->id ? 'selected' : '' }}>
                                    {{ $fuelType->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('fuel_type')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="previous_owners" class="form-label">Previous Owners</label>
                        <input type="number" class="form-control @error('previous_owners') is-invalid @enderror"
                            id="previous_owners" name="previous_owners" value="{{ old('previous_owners', 1) }}">
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
                    <div class="col-md-6">
                        <label for="plate" class="form-label">Licence Plate</label>
                        <input type="text" class="form-control @error('plate') is-invalid @enderror" id="plate"
                            name="plate" minlength="7" maxlength="7" placeholder="AB123CD" value="{{ old('plate') }}">
                        @error('plate')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="chassis" class="form-label">VIN / Chassis</label>
                        <input type="text" class="form-control @error('chassis') is-invalid @enderror" id="chassis"
                            name="chassis" minlength="17" maxlength="17" placeholder="ZFF79ALB000123456"
                            value="{{ old('chassis') }}" style="font-family: monospace;">
                        @error('chassis')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Media --}}
            <div class="section-card">
                <div class="section-title">Media</div>
                <label for="image" class="form-label">Image</label>
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                    name="image" accept="image/*">
                @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Optionals --}}
            <div class="section-card">
                <div class="section-title">Optional & Accessories</div>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($optionals as $optional)
                        <label class="optional-tag">
                            <input type="checkbox" name="optionals[]" value="{{ $optional->id }}"
                                {{ in_array($optional->id, old('optionals', [])) ? 'checked' : '' }}>
                            {{ $optional->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Actions --}}
            <div class="d-flex gap-2 mb-4">
                <button type="submit" class="btn-gold">Add Car</button>
                <a href="{{ route('cars.index') }}" class="btn-cancel">Cancel</a>
            </div>

        </form>
    </div>

    <script>
        // Toggle optional tags
        // document.querySelectorAll('.optional-tag').forEach(tag => {
        //     tag.addEventListener('click', () => {
        //         tag.classList.toggle('checked');
        //     });
        // });

        // Dynamic model loading
        document.getElementById('brand').addEventListener('change', function() {
            const brandId = this.value;
            const modelSelect = document.getElementById('model');

            modelSelect.innerHTML = '<option value="">Loading...</option>';

            fetch(`/brands/${brandId}/models`)
                .then(response => response.json())
                .then(data => {
                    modelSelect.innerHTML = '<option value="">Select a model</option>';
                    data.forEach(model => {
                        modelSelect.innerHTML += `<option value="${model.id}">${model.name}</option>`;
                    });
                });
        });
    </script>
@endsection
