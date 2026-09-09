<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Knowledge Hub Mini')</title>

    <link href="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('startbootstrap-sb-admin-2-gh-pages/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
            font-family: Arial, sans-serif;
            color: #2d3748;
        }

        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 16px;
        }

        .topbar {
            background: #2d3748;
            border-bottom: 1px solid rgba(255,255,255,.1);
        }

        .navbar-brand {
            font-size: 1.08rem;
            font-weight: 700;
        }

        .nav-link {
            font-size: .9rem;
        }

        .card {
            border: 1px solid #e3e6f0;
            border-radius: 12px;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
        }

        .page-subtitle {
            color: #6c757d;
            margin-top: 4px;
        }

        footer {
            background: #fff;
            border-top: 1px solid #e3e6f0;
            padding: 16px 0;
            color: #6c757d;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark topbar shadow-sm">
        <div class="container-fluid main-container">
            <a class="navbar-brand mr-3" href="{{ route('dashboard') }}">
                <i class="fas fa-book mr-2"></i>Coba Knowledge Jevon
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.*') ? 'active' : '' }}" href="{{ route('public.index') }}">Publik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('informasi.*') ? 'active' : '' }}" href="{{ route('informasi.index') }}">Informasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}" href="{{ route('kategori.index') }}">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('barang.*') ? 'active' : '' }}" href="{{ route('barang.index') }}">Barang</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main-container py-4">
        @if(session('sukses'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle mr-2"></i>{{ session('sukses') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="text-center small">
        <div class="main-container">
            © {{ date('Y') }} Knowledge Hub Mini
        </div>
    </footer>

    <script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @yield('scripts')
</body>
</html>

