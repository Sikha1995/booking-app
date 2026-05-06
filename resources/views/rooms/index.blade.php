@extends('layouts.app')

@section('title', 'Rooms · ' . config('app.name', 'Booking'))

@section('content')
    <div class="page-heading mb-4">
        <h1 class="page-title h3 mb-1">Rooms</h1>
        <p class="text-muted mb-0">Attach room types to hotels and manage nightly pricing.</p>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-bottom">
            <h2 class="h6 mb-0 fw-semibold"><i class="bi bi-plus-circle me-2 text-primary"></i>Add room</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('rooms.store') }}" class="row g-3">
                @csrf
                <div class="col-md-4">
                    <label for="hotel_id" class="form-label">Hotel</label>
                    <select name="hotel_id" id="hotel_id" class="form-select @error('hotel_id') is-invalid @enderror" required>
                        <option value="">Select hotel…</option>
                        @foreach ($hotels as $hotel)
                            <option value="{{ $hotel->id }}" {{ (string) old('hotel_id') === (string) $hotel->id ? 'selected' : '' }}>{{ $hotel->name }} — {{ $hotel->city }}</option>
                        @endforeach
                    </select>
                    @error('hotel_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="name" class="form-label">Room name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="price_per_night" class="form-label">Price / night</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text bg-light">$</span>
                        <input type="number" name="price_per_night" id="price_per_night" value="{{ old('price_per_night') }}" step="0.01" min="0" class="form-control @error('price_per_night') is-invalid @enderror" required>
                        @error('price_per_night')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="max_occupancy" class="form-label">Max guests</label>
                    <input type="number" name="max_occupancy" id="max_occupancy" value="{{ old('max_occupancy') }}" min="1" class="form-control @error('max_occupancy') is-invalid @enderror" required>
                    @error('max_occupancy')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="available_rooms" class="form-label">Available units</label>
                    <input type="number" name="available_rooms" id="available_rooms" value="{{ old('available_rooms') }}" min="0" class="form-control @error('available_rooms') is-invalid @enderror" required>
                    @error('available_rooms')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success"><i class="bi bi-door-open me-1"></i>Create room</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h2 class="h6 mb-0 fw-semibold"><i class="bi bi-grid me-2 text-primary"></i>All rooms</h2>
            <span class="badge rounded-pill bg-light text-dark border">{{ $rooms->total() }} total</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Hotel</th>
                            <th>Room</th>
                            <th class="text-end">Price / night</th>
                            <th class="text-end">Max guests</th>
                            <th class="text-end pe-4">Available</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rooms as $room)
                            <tr>
                                <td class="ps-4 fw-medium">{{ $room->hotel->name }}</td>
                                <td>{{ $room->name }}</td>
                                <td class="text-end font-monospace">{{ number_format((float) $room->price_per_night, 2) }}</td>
                                <td class="text-end">{{ $room->max_occupancy }}</td>
                                <td class="text-end pe-4"><span class="badge rounded-pill bg-primary bg-opacity-10 text-primary">{{ $room->available_rooms }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted text-center py-5">
                                    <i class="bi bi-inbox d-block fs-2 mb-2 opacity-50"></i>
                                    No rooms yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($rooms->hasPages())
                <div class="card-body border-top bg-light py-3">
                    {{ $rooms->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
