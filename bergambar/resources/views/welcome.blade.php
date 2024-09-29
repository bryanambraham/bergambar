<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bergambar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body style="background-color: #1e1e2a;">
    <!-- Navbar -->
    <nav class="w-100 top-0 navbar navbar-expand-lg navbar-dark shadow-sm mb-4" style="background-color: #252539;">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/Logo.png') }}" class="img-fluid rounded" alt="Logo" style="width: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-1">
                        <a href="{{ route('artists.index') }}" class="btn btn-muted text-white {{ Request::routeIs('artists.index') ? 'fw-bold' : '' }}">
                            Artists
                        </a>
                    </li>
                    <!-- Tampilkan menu commissions hanya jika user login -->
                    @auth
                    <li class="nav-item mx-1">
                        <a href="{{ route('commissions.index') }}" class="btn btn-muted text-white {{ Request::routeIs('commissions.index') ? 'fw-bold' : '' }}">
                            Commissions
                        </a>
                    </li>
                    @endauth
                    <li class="nav-item mx-1">
                        <a href="{{ route('payments.index') }}" class="btn btn-muted text-white {{ Request::routeIs('payments.index') ? 'fw-bold' : '' }}">
                            Contact Us
                        </a>
                    </li>
                    @auth
                        <li class="nav-item mx-1">
                            <a href="{{ route('users.show', Auth::user()->id) }}" class="btn btn-muted text-white {{ Request::is('users/*') ? 'fw-bold' : '' }}">
                                Profile
                            </a>
                        </li>
                        <!-- Logout form -->
                        <li class="nav-item mx-1">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-muted text-white">Sign Out</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item mx-1">
                            <a href="{{ route('login') }}" class="btn btn-muted text-white {{ Request::routeIs('login') ? 'fw-bold' : '' }}">
                                Login
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container my-5">
        <div class="p-5 text-center rounded-3 shadow text-white" style="background-color: #5d5875;">
            <h1 class="display-4 fw-bold">Selamat Datang di Bergambar!</h1>
            <p class="lead">Seni Untuk Semua, dari Hati ke Karya</p>
            <a href="{{ route('services.index') }}" class="btn btn-primary btn-lg mt-3">Explore Our Services</a>
        </div>
    </div>

    <!-- Commission Section -->
    <div class="container my-5">
        <h2 class="text-white">Latest Commissions</h2>
        <div class="row">
            @if($commissions->isEmpty())
                <p class="text-white">No commissions available at the moment.</p>
            @else
                @foreach($commissions as $commission)
                <div class="col-md-4">
        <a href="{{ route('commissions.order', $commission->id) }}" class="text-decoration-none text-dark">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $commission->description }}</h5>
                <p class="card-text">Status: {{ $commission->status }}</p>
                <p class="card-text">Price: ${{ $commission->total_price }}</p>
                
                @if($commission->image)
                    <img src="{{ asset('storage/' . $commission->image) }}" alt="Commission Image" class="img-fluid">
                @endif
                        </div>
                    </div>
                </a>
            </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="position-fixed bottom-0 text-white py-3 mt-5 w-100" style="background-color: #252539;">
        <div class="container text-center">
            <small>&copy; 2024 Bergambar. All Rights Reserved.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
