<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commission;

class CardController extends Controller
{
    public function welcome()
    {
        // Ambil data commission dari database
        $commissions = Commission::all();
        
        // Kirimkan data commission ke view welcome.blade.php
        return view('welcome', compact('commissions'));
    }
}