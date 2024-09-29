<!-- resources/views/users/edit.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


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
    <div class="container mt-5">
        <h2 class="text-white">Edit Profil</h2>

        <!-- Form Edit Profil -->
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Menggunakan method PUT untuk update -->

    <!-- Username -->
    <div class="mb-3">
        <label for="username" class="text-white p-2">Username</label>
        <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $user->username) }}" required>
    </div>

    <!-- Name -->
    <div class="mb-3">
        <label for="name" class="text-white p-2">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="text-white p-2">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
    </div>

    <!-- Password (Opsional) -->
    <div class="mb-3" >
        <label for="password" class="text-white p-2">Password (Biarkan kosong jika tidak ingin mengubah)</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>

    <!-- Bio (Optional) -->
    <div class="mb-3">
        <label for="bio" class="text-white p-2">Bio</label>
        <textarea name="bio" id="bio" class="form-control">{{ old('bio', $user->bio) }}</textarea>
    </div>

    <!-- Profile Picture -->
    <div class="mb-3">
        <label for="profile_picture" class="text-white p-2">Profile Picture</label>
        <input type="file" name="profile_picture" id="profile_picture" class="form-control">

        @if($user->profile_picture)
            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" style="max-width: 100px; margin-top: 10px;">
        @endif
    </div>

    <!-- Submit -->
    <button type="submit" class="btn btn-primary text-white p-2 fs-3">Update</button>
</form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

    <footer class="fixed-bottom bg-dark position-absolute bottom-0 text-white text-center py-3 mt-4 w-100" style="background-color: #252539;">
        <small>&copy; 2024 Bergambar. All Rights Reserved.</small>
    </footer>

</html>
