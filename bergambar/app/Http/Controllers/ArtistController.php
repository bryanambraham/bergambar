<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    // Menampilkan daftar semua artist
    public function index()
    {
        $artists = Artist::with('user')->get();
        return view('artists.index', compact('artists'));
    }

    // Menampilkan detail artist tertentu
    public function show($id)
    {
        $artist = Artist::with('services')->findOrFail($id);
        return view('artists.show', compact('artist'));
    }
}
