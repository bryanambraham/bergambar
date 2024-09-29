<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Menambahkan middleware 'auth' untuk melindungi route yang memerlukan autentikasi
    public function __construct()
    {
        // Hanya user yang login yang bisa mengakses halaman profil dan daftar user
        $this->middleware('auth')->except(['create', 'store']);
    }

    // Menampilkan daftar semua pengguna, hanya bisa diakses oleh admin atau user terautentikasi
    public function index()
    {
        // Jika user bukan admin, bisa tambahkan pengecekan (opsional)
        // if (!Auth::user()->isAdmin()) {
        //     abort(403, 'Anda tidak memiliki akses ke halaman ini');
        // }
        
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Menampilkan detail pengguna tertentu
    public function show($id)
    {
        // Hanya user yang sedang login yang bisa melihat profil mereka sendiri
        $user = User::findOrFail($id);

        // Pastikan hanya user itu sendiri yang bisa melihat profilnya
        if (Auth::id() !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk melihat profil ini');
        }

        return view('users.show', compact('user'));
    }

    // Form untuk menambah user (umumnya hanya untuk admin atau sistem registrasi)
    public function create()
    {
        return view('users.create');
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('users.index');
    }

    // Menampilkan form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);

        // Pastikan hanya user itu sendiri yang bisa mengedit profilnya
        if (Auth::id() !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit profil ini');
        }

        return view('users.edit', compact('user'));
    }

    // Mengupdate data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi data input
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'bio' => 'nullable|string|max:500',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update data user
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->bio = $request->input('bio');

        // Jika ada gambar profil yang di-upload
        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $imagePath;
        }

        $user->save(); // Simpan perubahan

        return redirect()->route('users.show', $user->id)->with('success', 'Profil berhasil diperbarui');
    }
}
