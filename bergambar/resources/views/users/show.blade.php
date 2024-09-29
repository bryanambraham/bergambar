

<!-- resources/views/users/show.blade.php -->
<!DOCTYPE html>
<html style="scroll-behaviour:smooth;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-picture-placeholder {
            border: 2px dashed #ccc;
            width: 150px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #666;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            cursor: pointer;
        }
    </style>

</head>


    <body style="background-color: #1e1e2a;">
     <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm mb-4" style="background-color: #252539;">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
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
                    <li class="nav-item mx-1">
                        <a href="{{ route('commissions.index') }}" class="btn btn-muted text-white {{ Request::routeIs('commissions.index') ? 'fw-bold' : '' }}">
                            Commissions
                        </a>
                    </li>
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
    <!-- Profil User -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4" style="background-color: #5d5875;">
                <div class="card-header">
                    <h3 class="mb-0 text-white">Profil {{ $user->username }}</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <!-- Gambar profil dengan klik untuk edit -->
                            <a href="{{ route('users.edit', $user->id) }}">
                                @if($user->profile_picture)
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" class="profile-picture img-thumbnail" alt="Profile Picture">
                                @else
                                    <div class="profile-picture-placeholder">
                                        <span class="text-black">Choose Picture</span>
                                    </div>
                                @endif
                            </a>
                        </div>
                        <div class="col-md-8">
                            <h4 class="text-white">Username: {{ $user->username }}</h4>
                            <p class="text-white"><strong>Email:</strong> {{ $user->email }}</p>
                            <p class="text-white"><strong>Bio:</strong> {{ $user->bio ? $user->bio : 'Belum ada bio.' }}</p>
                            <a href="{{ route('users.edit', $user->id) }}">
                                <button class="btn btn-primary text-white float-end w-25">Edit</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menampilkan Daftar Commission -->
<div class="row justify-content-center col">
    <div class="col-md-8">
        <h2 class="text-white">My Commissions</h2>

        @if($commissions && !$commissions->isEmpty())
            @foreach($commissions as $commission)
                <div class="card mb-3" style="background-color: #5d5875;">
                    <div class="card-body">
                         @if($commission->image)
                            <img src="{{ asset('storage/' . $commission->image) }}" alt="Commission Image" style="max-width: 200px; height: 95%;" class="img-fluid mb-3">
                        @endif
                        <div class="col-md-3">
                            <h4 class="text-white">{{ $commission->description }}</h4>
                            <p class="text-white">Total Price: ${{ number_format($commission->total_price, 2) }}</p>
                            <p class="text-white">Status: {{ ucfirst($commission->status) }}</p>
                        </div>


                        <!-- Tombol Edit Commission -->
                        <a href="{{ route('commissions.edit', $commission->id) }}" class="btn btn-warning">Edit</a>

                        <!-- Tombol Delete Commission -->
                        <form action="{{ route('commissions.destroy', $commission->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this commission?')">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-white">You haven't created any commissions yet.</p>
        @endif
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<div class="bottom-0 bg-dark position-fixed w-100 mt-4">
 <footer class="fixed-bottom position-fixed text-white text-center py-3 mt-4 w-100" style="background-color: #252539;">
    <small>&copy; 2024 Bergambar. All Rights Reserved.</small>
</footer>
</div>
            
</html>
