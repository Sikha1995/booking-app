@extends('layouts.app')

@section('title', 'Search · ' . config('app.name', 'Booking'))

@section('content')
    <div class="page-heading mb-4">
        <h1 class="page-title h3 mb-1">Search availability</h1>
        <p class="text-muted mb-0">Find hotels with rooms that fit your dates and party size.</p>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-bottom">
            <h2 class="h6 mb-0 fw-semibold"><i class="bi bi-calendar-range me-2 text-primary"></i>Your stay</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('search.submit') }}" class="row g-3 align-items-end">
                @csrf
                <div class="col-lg-3 col-md-6">
                    <label for="city" class="form-label">City</label>
                    <input type="text" name="city" id="city" value="{{ old('city') }}" class="form-control @error('city') is-invalid @enderror" required placeholder="e.g. Lisbon">
                    @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-2 col-md-6">
                    <label for="checkin_date" class="form-label">Check-in</label>
                    <input type="date" name="checkin_date" id="checkin_date" value="{{ old('checkin_date') }}" class="form-control @error('checkin_date') is-invalid @enderror" required>
                    @error('checkin_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-2 col-md-6">
                    <label for="checkout_date" class="form-label">Check-out</label>
                    <input type="date" name="checkout_date" id="checkout_date" value="{{ old('checkout_date') }}" class="form-control @error('checkout_date') is-invalid @enderror" required>
                    @error('checkout_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-2 col-md-6">
                    <label for="guests" class="form-label">Guests</label>
                    <input type="number" name="guests" id="guests" value="{{ old('guests', 2) }}" min="1" class="form-control @error('guests') is-invalid @enderror" required>
                    @error('guests')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search me-2"></i>Search</button>
                </div>
            </form>
        </div>
    </div>

    @if ($results->isEmpty())
        <div class="card border-0 shadow-sm bg-white">
            <div class="card-body text-center py-5 px-4">
                <div class="d-inline-flex rounded-circle p-4 mb-3" style="background: rgba(13, 148, 136, 0.1);">
                    <i class="bi bi-compass fs-1" style="color: var(--app-primary-dark);"></i>
                </div>
                <p class="text-muted mb-0">Run a search above to see hotels and rooms for your trip.</p>
            </div>
        </div>
    @else
        <p class="small text-muted mb-3"><i class="bi bi-info-circle me-1"></i>{{ $results->count() }} {{ $results->count() === 1 ? 'hotel' : 'hotels' }} matched</p>
        @foreach ($results as $hotel)
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2 py-3 border-bottom">
                    <h2 class="h5 mb-0 fw-semibold"><i class="bi bi-building me-2 text-primary"></i>{{ $hotel->name }}</h2>
                    <span class="badge rounded-pill bg-light text-dark border"><i class="bi bi-geo-alt me-1"></i>{{ $hotel->city }}</span>
                </div>
                <div class="card-body">
                    @if ($hotel->rooms->isEmpty())
                        <p class="text-muted mb-0"><i class="bi bi-dash-circle me-1"></i>No matching rooms for this stay.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-0">Room</th>
                                        <th class="text-end">Max guests</th>
                                        <th class="text-end">Price / night</th>
                                        <th class="text-end pe-0">Stay total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hotel->rooms as $room)
                                        <tr>
                                            <td class="ps-0 fw-medium">{{ $room->name }}</td>
                                            <td class="text-end">{{ $room->max_occupancy }}</td>
                                            <td class="text-end font-monospace">{{ number_format((float) $room->price_per_night, 2) }}</td>
                                            <td class="text-end pe-0 fw-semibold text-primary font-monospace">{{ number_format((float) ($room->total_price ?? 0), 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
@endsection
