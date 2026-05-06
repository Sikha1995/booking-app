@extends('layouts.app')

@section('title', 'Sign in · ' . config('app.name', 'Booking'))

@section('content')
    <div class="row justify-content-center align-items-center py-5">
        <div class="col-md-5 col-lg-4">
            <div class="text-center text-white mb-4">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white bg-opacity-10 p-3 mb-3">
                    <i class="bi bi-building-fill-check display-5"></i>
                </div>
                <h1 class="h3 fw-bold mb-1">{{ config('app.name', 'Booking') }}</h1>
                <p class="text-white-50 small mb-0">Sign in to manage hotels and availability</p>
            </div>

            <div class="card border-0 shadow-lg">
                <div class="card-body p-4 p-md-5">
                    <h2 class="h5 fw-semibold mb-4">Login</h2>

                    <form method="POST" action="{{ url('/login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" required autofocus placeholder="you@example.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                                <input id="password" type="password" name="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" required placeholder="••••••••">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input id="remember" type="checkbox" name="remember" value="1" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="form-check-label">Remember me</label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Sign in
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
