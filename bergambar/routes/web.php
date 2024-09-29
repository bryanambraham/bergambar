<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Halaman utama (welcome page)
Route::get('/', function () {
    return view('welcome');
});

// Route untuk resource User
Route::resource('users', UserController::class)->middleware('auth');

// Route untuk resource lainnya
Route::resource('artists', ArtistController::class);
Route::resource('services', ServiceController::class);
Route::resource('commissions', CommissionController::class);
Route::resource('payments', PaymentController::class);

// Profil user, hanya bisa diakses oleh user yang sudah login
Route::get('/profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');

// Aktifkan semua route autentikasi Laravel (login, register, dll.)
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

