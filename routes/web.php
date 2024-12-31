<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\SocialiteController;
Route::get('/auth/redirect', [SocialiteController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback']);
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/admin/dashboard', [AdminController::class, 'dashboardAdmin'])->name('admin.dashboard');
        Route::get('/rekap', [AdminController::class, 'rekap'])->name('rekap');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
    });

    // User Routes
    Route::middleware(['auth'])->group(function () {
        // Rute Dashboard User
        Route::get('/user/dashboard', [AbsensiController::class, 'userDashboard'])->name('user.dashboard');
        Route::post('/user/absen', [AbsensiController::class, 'absen'])->name('user.absen');
    });

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
