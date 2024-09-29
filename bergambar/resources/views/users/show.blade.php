<!-- resources/views/users/show.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
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
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="{{ url('/') }}">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Profil User -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Profil {{ $user->username }}</h3>
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
                                            <span>Gambar Kosong</span>
                                        </div>
                                    @endif
                                </a>
                            </div>
                            <div class="col-md-8">
                                <h4>Username: {{ $user->username }}</h4>
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                                <!-- <p><strong>Peran:</strong> {{ ucfirst($user->role) }}</p> -->
                                <p><strong>Bio:</strong> {{ $user->bio ? $user->bio : 'Belum ada bio.' }}</p>
                                <a href="{{ route('users.edit', $user->id) }}">
                                    <button class="btn btn-primary text-white float-end w-25">Edit</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali ke Daftar Users</a> -->
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark position-absolute bottom-0 text-white text-center py-3 mt-4 w-100">
        <small>&copy; 2024 Bergambar. All Rights Reserved.</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
