<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Booking App'))</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --app-primary: #0d9488;
            --app-primary-dark: #0f766e;
            --app-primary-rgb: 13, 148, 136;
            --bs-primary: var(--app-primary);
            --bs-primary-rgb: var(--app-primary-rgb);
            --app-surface: #f8fafc;
            --app-elevated: #ffffff;
        }

        body {
            font-family: 'DM Sans', system-ui, -apple-system, sans-serif;
            font-optical-sizing: auto;
        }

        .app-shell--guest {
            min-height: 100vh;
            background: radial-gradient(ellipse 120% 80% at 50% -20%, rgba(13, 148, 136, 0.35), transparent),
                        linear-gradient(165deg, #042f2e 0%, #0f766e 45%, #115e59 100%);
        }

        .app-shell--auth {
            min-height: 100vh;
            background: linear-gradient(180deg, #ecfdf5 0%, var(--app-surface) 28%, #f1f5f9 100%);
        }

        .navbar-app {
            background: linear-gradient(90deg, #0f766e 0%, #0d9488 50%, #14b8a6 100%) !important;
            box-shadow: 0 0.25rem 1rem rgba(15, 118, 110, 0.25);
        }

        .navbar-app .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .navbar-app .nav-link {
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem !important;
            margin: 0 0.125rem;
            transition: background-color 0.15s ease, color 0.15s ease;
        }

        .navbar-app .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.12);
        }

        .navbar-app .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            font-weight: 600;
        }

        .card {
            border: 1px solid rgba(15, 23, 42, 0.06);
        }

        .card.shadow-sm {
            box-shadow: 0 0.125rem 0.5rem rgba(15, 23, 42, 0.06) !important;
        }

        .table thead th {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            font-weight: 600;
            color: #64748b;
            border-bottom-width: 1px;
        }

        .stat-tile .stat-value {
            color: #0f766e;
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        .page-heading .page-title {
            font-weight: 700;
            letter-spacing: -0.03em;
            color: #0f172a;
        }

        .app-footer {
            border-top: 1px solid rgba(15, 23, 42, 0.08);
            margin-top: auto;
        }
    </style>
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100 {{ auth()->check() ? 'app-shell--auth' : 'app-shell--guest' }}">
@auth
    <nav class="navbar navbar-expand-lg navbar-dark navbar-app mb-4">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
                <i class="bi bi-building-fill-check fs-5"></i>
                <span>{{ config('app.name', 'Booking') }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-1"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('hotels.*') ? 'active' : '' }}" href="{{ route('hotels.index') }}"><i class="bi bi-building me-1"></i>Hotels</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}" href="{{ route('rooms.index') }}"><i class="bi bi-door-open me-1"></i>Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('search.*') ? 'active' : '' }}" href="{{ route('search.index') }}"><i class="bi bi-search me-1"></i>Search</a>
                    </li>
                </ul>
                <form method="POST" action="{{ route('logout') }}" class="d-flex">
                    @csrf
                    <button type="submit" class="btn btn-light btn-sm px-3"><i class="bi bi-box-arrow-right me-1"></i>Logout</button>
                </form>
            </div>
        </div>
    </nav>
@endauth

<main class="container pb-5 flex-grow-1">
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @yield('content')
</main>

@auth
    <footer class="app-footer py-4 mt-auto bg-white">
        <div class="container small text-muted text-center">
            {{ config('app.name', 'Booking App') }} · Inventory &amp; search
        </div>
    </footer>
@endauth

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
