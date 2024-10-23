<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\User;

class ArtistController extends Controller
{
    public function index()
    {
        // Ambil semua user yang pernah mengunggah commission beserta commissions dan reviews
        $artists = User::whereHas('commissions')->with('commissions.reviews.user')->get();

        // Kirimkan data artists ke view artists.index
        return view('artists.index', compact('artists'));
    }
}
