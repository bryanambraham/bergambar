<?php

// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Commission; // Impor model Commission
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan daftar order milik user
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('orders.index', compact('orders'));
    }

    // Menampilkan detail order tertentu
    public function show($id)
    {
        // Mengambil commission berdasarkan ID
        $commission = Commission::find($id);

        if (!$commission) {
            abort(404); // Jika tidak ada commission dengan ID tersebut
        }
        
        // Mengambil data user yang mengupload commission
        $artist = $commission->user;

        return view('orders.show', compact('commission', 'artist'));
    }
}