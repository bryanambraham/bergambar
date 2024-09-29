<!-- resources/views/users/edit.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Profil</h2>

        <!-- Form Edit Profil -->
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Input Username -->
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" value="{{ $user->username }}" required>
            </div>

            <!-- Input Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
            </div>

            <!-- Input Bio -->
            <div class="mb-3">
                <label for="bio" class="form-label">Bio</label>
                <textarea name="bio" class="form-control" id="bio" rows="3">{{ $user->bio }}</textarea>
            </div>

            <!-- Upload Gambar Profil -->
            <div class="mb-3">
                <label for="profile_picture" class="form-label">Gambar Profil</label>
                <input type="file" name="profile_picture" class="form-control" id="profile_picture">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
