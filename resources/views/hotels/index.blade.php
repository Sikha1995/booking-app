@extends('layouts.app')

@section('title', 'Hotels · ' . config('app.name', 'Booking'))

@section('content')
    <div class="page-heading mb-4">
        <h1 class="page-title h3 mb-1">Hotels</h1>
        <p class="text-muted mb-0">Filter your directory and add new properties.</p>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-bottom">
            <h2 class="h6 mb-0 fw-semibold"><i class="bi bi-funnel me-2 text-primary"></i>Filter</h2>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('hotels.index') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="filter_city" class="form-label">City</label>
                    <input type="text" name="city" id="filter_city" value="{{ $filters['city'] ?? '' }}" class="form-control" placeholder="Contains…">
                </div>
                <div class="col-md-3">
                    <label for="filter_rating" class="form-label">Rating</label>
                    <select name="rating" id="filter_rating" class="form-select">
                        <option value="">Any</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ ($filters['rating'] ?? '') == (string) $i ? 'selected' : '' }}>{{ $i }} stars</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-5">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check2-circle me-1"></i>Apply</button>
                    <a href="{{ route('hotels.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-counterclockwise me-1"></i>Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-bottom">
            <h2 class="h6 mb-0 fw-semibold"><i class="bi bi-plus-circle me-2 text-primary"></i>Add hotel</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('hotels.store') }}" class="row g-3">
                @csrf
                <div class="col-md-4">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" name="city" id="city" value="{{ old('city') }}" class="form-control @error('city') is-invalid @enderror" required>
                    @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" name="country" id="country" value="{{ old('country') }}" class="form-control @error('country') is-invalid @enderror">
                    @error('country')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label for="rating" class="form-label">Rating</label>
                    <select name="rating" id="rating" class="form-select @error('rating') is-invalid @enderror" required>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('rating', '3') == (string) $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                    @error('rating')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success"><i class="bi bi-plus-lg me-1"></i>Create hotel</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h2 class="h6 mb-0 fw-semibold"><i class="bi bi-list-ul me-2 text-primary"></i>All hotels</h2>
            <span class="badge rounded-pill bg-light text-dark border">{{ $hotels->total() }} total</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Name</th>
                            <th>City</th>
                            <th>Country</th>
                            <th class="text-end pe-4">Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($hotels as $hotel)
                            <tr>
                                <td class="ps-4 fw-medium">{{ $hotel->name }}</td>
                                <td>{{ $hotel->city }}</td>
                                <td class="text-muted">{{ $hotel->country ?? '—' }}</td>
                                <td class="text-end pe-4"><span class="badge rounded-pill text-bg-warning">{{ $hotel->rating }} ★</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted text-center py-5">
                                    <i class="bi bi-inbox d-block fs-2 mb-2 opacity-50"></i>
                                    No hotels yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($hotels->hasPages())
                <div class="card-body border-top bg-light py-3">
                    {{ $hotels->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
