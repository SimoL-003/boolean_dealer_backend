@extends('layouts.app')

@section('content')
    <div class="container">

        <a href="{{ route('cars-settings.optionals.index') }}" class="back-link">Back to optionals list</a>
        <h1 class="page-title">Add New Optional</h1>
        <p class="required-note">Fields marked with * are required.</p>

        <form action="{{ route('cars-settings.optionals.store') }}" method="POST">
            @csrf

            <div class="section-card">
                <div class="section-title">Optional Info</div>
                <div class="row g-3">

                    {{-- Name --}}
                    <div class="col-md-6">
                        <label for="name" class="form-label">Optional Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Cruise Control" value="{{ old('name') }}">
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="col-md-6">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror"
                            id="description" name="description" placeholder="Enter a description"
                            value="{{ old('description') }}">
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Actions --}}
            <div class="d-flex gap-2 mb-4">
                <button type="submit" class="btn-gold">Add Optional</button>
                <a href="{{ route('cars-settings.optionals.index') }}" class="btn-cancel">Cancel</a>
            </div>

        </form>
    </div>
@endsection
