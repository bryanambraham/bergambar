<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderController;

/*
|---------------------------------------------------------------------------
// Rute Web
|---------------------------------------------------------------------------
// 
| Di sini adalah tempat untuk mendaftarkan rute web untuk aplikasi kamu.
// Rute ini dimuat oleh RouteServiceProvider dalam grup yang 
| berisi grup middleware "web". Sekarang buat sesuatu yang hebat!
// 
*/

Route::get('/', [CardController::class, 'welcome'])->name('welcome');

// Rute untuk resource User
Route::resource('users', UserController::class)->middleware('auth');

// Rute untuk resource lainnya
Route::resource('artists', ArtistController::class);
Route::resource('services', ServiceController::class);
Route::resource('payments', PaymentController::class);

// Rute untuk resource Komisi
Route::resource('commissions', CommissionController::class)->middleware('auth');

// Profil user, hanya bisa diakses oleh user yang sudah login
Route::get('/profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');

// Aktifkan semua rute autentikasi Laravel (login, register, dll.)
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/commissions', [CommissionController::class, 'create'])->name('commissions.index');
Route::put('/commissions', [CommissionController::class, 'store'])->name('commissions.store');
Route::post('/commissions', [CommissionController::class, 'store'])->name('commissions.store');
// Menampilkan commission berdasarkan user_id
Route::get('/commissions/user/{userId}', [CommissionController::class, 'showCommissionsByUser'])->name('commissions.byUser');

// Edit commission
Route::get('/commissions/{commission}/edit', [CommissionController::class, 'edit'])->name('commissions.edit');

// Hapus commission
Route::delete('/commissions/{commission}', [CommissionController::class, 'destroy'])->name('commissions.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

Route::get('/commissions/{commission}/order', [OrderController::class, 'show'])->name('commissions.order');
