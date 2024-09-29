<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class CommissionController extends Controller
{
    // Menampilkan semua commission
    public function index()
    {
        // Memuat data commission beserta relasi user
        $commissions = Commission::with('user')->get();
        // Memuat data commission berdasarkan user yang sedang login
        $commissions = Commission::where('user_id', Auth::id())->get();
        return view('commissions.index', compact('commissions'));
    }

    // Menampilkan form untuk menambah commission
    public function create()
    {
        return view('commissions.create');
    }

    // Menyimpan commission baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'status' => 'required|string|in:pending,accepted,completed',
            'total_price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Mengelola upload gambar
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('commissions', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Tambahkan user_id dari user yang login
        $validatedData['user_id'] = Auth::user()->id;

        // Simpan commission ke database
        Commission::create($validatedData);

        return redirect()->route('commissions.index')->with('success', 'Commission berhasil ditambahkan!');
    }

    // Menampilkan detail commission
    public function show($id)
    {
        $commission = Commission::with('user')->findOrFail($id);
        return view('commissions.show', compact('commission'));
    }

    // Menampilkan form untuk mengedit commission
    // Menampilkan form untuk mengedit commission
    public function edit($id)
    {
        $commission = Commission::findOrFail($id);

        // Pastikan hanya user yang memiliki commission yang bisa mengedit
        if ($commission->user_id !== Auth::id()) {
            return redirect()->route('commissions.index')->with('error', 'Unauthorized action.');
        }

        return view('commissions.edit', compact('commission'));
    }


    // Mengupdate commission di database
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|string|in:pending,accepted,completed',
            'total_price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $commission = Commission::findOrFail($id);

        // Mengelola upload gambar baru jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('commissions', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Update data commission di database
        $commission->update($validatedData);

        return redirect()->route('commissions.index')->with('success', 'Commission berhasil diupdate!');
    }

    // Menghapus commission dari database
    public function destroy($id)
    {
        $commission = Commission::findOrFail($id);

        // Pastikan hanya user yang memiliki commission yang bisa menghapus
        if ($commission->user_id !== Auth::id()) {
            return redirect()->route('commissions.index')->with('error', 'Unauthorized action.');
        }

        // Hapus commission
        $commission->delete();

        return redirect()->route('commissions.index')->with('success', 'Commission berhasil dihapus!');
    }

}
