<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en" style="scroll-behavior:smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bergambar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-light shadow-sm mb-4">
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
                        <a href="{{ route('artists.index') }}" class="btn btn-muted">Artists</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a href="{{ route('services.index') }}" class="btn btn-muted">Services</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a href="{{ route('commissions.index') }}" class="btn btn-muted">Commissions</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a href="{{ route('payments.index') }}" class="btn btn-muted">Orders</a>
                    </li>
                     <!-- Tampilkan profil pengguna yang sedang login -->
                    @auth
                        <li class="nav-item mx-1">
                            <a href="{{ route('users.show', Auth::user()->id) }}" class="btn btn-muted fw-semibold">
                                Profile
                            </a>
                        </li>
                        <!-- Logout form -->
                        <li class="nav-item mx-1">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-muted">Sign Out</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item mx-1">
                            <a href="{{ route('login') }}" class="btn btn-muted">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container my-5">
        <div class="p-5 text-center bg-light rounded-3 shadow">
            <h1 class="display-4 fw-bold">Selamat Datang di Bergambar!</h1>
            <p class="lead">Seni Untuk Semua, dari Hati ke Karya</p>
            <a href="{{ route('services.index') }}" class="btn btn-primary btn-lg mt-3">Explore Our Services</a>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container">
        <div class="row text-center">
        <div class="col-md-6 mb-4 h-30">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Trending Artists</h5>
                        <p class="card-text">Placeholder</p>
                        <p class="card-text">Placeholder</p>
                        <p class="card-text">Placeholder</p>
                        <p class="card-text">Placeholder</p>
                        <a href="{{ route('artists.index') }}" class="btn btn-primary">Go to Artists</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4 h-50">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Upload Commission</h5>
                        <p class="card-text">Lihat semua pengguna yang terdaftar di platform kami.</p>
                        <a href="{{ route('users.index') }}" class="btn btn-primary">Go to Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="position-absolute bottom-0 bg-light text-black py-3 mt-5 b w-100">
        <div class="container text-center">
            <small>&copy; 2024 Bergambar. All Rights Reserved.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
