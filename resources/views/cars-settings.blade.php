@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex align-items-start flex-column mb-4 pt-4">
            <h1 class="page-title">Cars Settings</h1>
            <p class="page-subtitle">Manage brands, models, fuel types and optionals</p>
        </div>

        <div class="row g-3">

            <div class="col-md-3">
                <a href="{{ route('cars-settings.brands.index') }}" class="settings-card">
                    <div class="settings-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5z" />
                            <path d="M2 17l10 5 10-5" />
                            <path d="M2 12l10 5 10-5" />
                        </svg>
                    </div>
                    <div class="settings-card-title">Brands</div>
                    <div class="settings-card-desc">Manage the car brands available in the dealership.</div>
                    <span class="settings-card-arrow">Manage →</span>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('cars-settings.models.index') }}" class="settings-card">
                    <div class="settings-icon">
                        <svg viewBox="0 0 24 24">
                            <rect x="2" y="7" width="20" height="14" rx="2" />
                            <path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2" />
                        </svg>
                    </div>
                    <div class="settings-card-title">Models</div>
                    <div class="settings-card-desc">Manage car models grouped by their respective brand.</div>
                    <span class="settings-card-arrow">Manage →</span>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('cars-settings.fuel-types.index') }}" class="settings-card">
                    <div class="settings-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M3 3h7v7H3zM14 3h7v7h-7zM14 14h7v7h-7zM3 14h7v7H3z" />
                        </svg>
                    </div>
                    <div class="settings-card-title">Fuel Types</div>
                    <div class="settings-card-desc">Define fuel types such as petrol, diesel, electric or hybrid.</div>
                    <span class="settings-card-arrow">Manage →</span>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('cars-settings.optionals.index') }}" class="settings-card">
                    <div class="settings-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 20h9" />
                            <path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z" />
                        </svg>
                    </div>
                    <div class="settings-card-title">Optionals</div>
                    <div class="settings-card-desc">Configure optional accessories assignable to any car.</div>
                    <span class="settings-card-arrow">Manage →</span>
                </a>
            </div>

        </div>
    </div>
@endsection
