<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    // Menampilkan semua commission
    public function index()
    {
        $commissions = Commission::with('user', 'service')->get();
        return view('commissions.index', compact('commissions'));
    }

    // Menampilkan detail commission tertentu
    public function show($id)
    {
        $commission = Commission::with('user', 'service', 'payments')->findOrFail($id);
        return view('commissions.show', compact('commission'));
    }

    // Form untuk menambah commission
    public function create()
    {
        return view('commissions.create');
    }

    // Menyimpan commission baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'status' => 'required|string',
            'total_price' => 'required|numeric',
            'start_date' => 'required|date',
            'deadline' => 'required|date',
        ]);

        Commission::create($validatedData);

        return redirect()->route('commissions.index');
    }
}
