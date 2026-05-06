@extends('layouts.app')

@section('title', 'Dashboard · ' . config('app.name', 'Booking'))

@section('content')
    <div class="page-heading mb-4">
        <h1 class="page-title h3 mb-1">Dashboard</h1>
        <p class="text-muted mb-0">Welcome back, <span class="fw-semibold text-dark">{{ auth()->user()->name }}</span>.</p>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-tile shadow-sm border-0 h-100 overflow-hidden">
                <div class="card-body position-relative">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted small text-uppercase fw-semibold mb-1">Hotels</p>
                            <p class="stat-value display-6 mb-0">{{ number_format($totalHotels) }}</p>
                        </div>
                        <span class="rounded-3 p-2" style="background: rgba(13, 148, 136, 0.12);"><i class="bi bi-building fs-4" style="color: var(--app-primary-dark);"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-tile shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted small text-uppercase fw-semibold mb-1">Room types</p>
                            <p class="stat-value display-6 mb-0">{{ number_format($totalRooms) }}</p>
                            <p class="small text-muted mb-0 mt-2">Configured products</p>
                        </div>
                        <span class="rounded-3 p-2" style="background: rgba(13, 148, 136, 0.12);"><i class="bi bi-door-open fs-4" style="color: var(--app-primary-dark);"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-tile shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted small text-uppercase fw-semibold mb-1">Available units</p>
                            <p class="stat-value display-6 mb-0">{{ number_format($totalAvailableUnits) }}</p>
                            <p class="small text-muted mb-0 mt-2">Inventory count</p>
                        </div>
                        <span class="rounded-3 p-2" style="background: rgba(13, 148, 136, 0.12);"><i class="bi bi-stack fs-4" style="color: var(--app-primary-dark);"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-tile shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted small text-uppercase fw-semibold mb-1">Cities</p>
                            <p class="stat-value display-6 mb-0">{{ number_format($cityCount) }}</p>
                            <p class="small text-muted mb-0 mt-2">Distinct locations</p>
                        </div>
                        <span class="rounded-3 p-2" style="background: rgba(13, 148, 136, 0.12);"><i class="bi bi-geo-alt fs-4" style="color: var(--app-primary-dark);"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 border-bottom">
            <h2 class="h6 mb-0 fw-semibold"><i class="bi bi-graph-up-arrow me-2 text-primary"></i>Summary</h2>
        </div>
        <div class="card-body">
            <ul class="list-unstyled mb-0">
                <li class="d-flex flex-wrap justify-content-between gap-2 py-3 border-bottom">
                    <span class="text-muted">Average hotel rating</span>
                    <strong class="text-dark">
                        @if ($avgHotelRating !== null)
                            {{ $avgHotelRating }} <span class="text-warning">★</span> <span class="text-muted fw-normal small">/ 5</span>
                        @else
                            <span class="text-muted fw-normal">—</span>
                        @endif
                    </strong>
                </li>
                <li class="d-flex flex-wrap justify-content-between gap-2 py-3 border-bottom">
                    <span class="text-muted">Average nightly rate (all rooms)</span>
                    <strong class="text-dark">
                        @if ($avgRoomPrice !== null)
                            {{ number_format($avgRoomPrice, 2) }}
                        @else
                            <span class="text-muted fw-normal">—</span>
                        @endif
                    </strong>
                </li>
                <li class="d-flex flex-wrap justify-content-between gap-2 pt-3">
                    <span class="text-muted">Inventory snapshot</span>
                    <span class="text-end text-muted small">{{ number_format($totalHotels) }} hotels · {{ number_format($totalRooms) }} types · {{ number_format($totalAvailableUnits) }} units</span>
                </li>
            </ul>
        </div>
    </div>
@endsection
