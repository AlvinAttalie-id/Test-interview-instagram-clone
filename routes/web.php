<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilePageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaPostController;


Route::get('/', function () {
    return view('welcome');
});

// Dashboard umum
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Route untuk semua user yang login
Route::middleware('auth')->group(function () {
    // Profile setting
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Feed (semua post user)
    Route::get('/feed', [FeedController::class, 'index'])->name('feed.index');

    // Komentar pada media post
    Route::post('/media-posts/{mediaPost}/comments', [CommentController::class, 'store'])->name('comments.store');
    // Media Post (Tambah Post)
    Route::get('/media-posts/create', [MediaPostController::class, 'create'])->name('media-posts.create');
    Route::post('/media-posts', [MediaPostController::class, 'store'])->name('media-posts.store');



    Route::get('/my-profile', [ProfilePageController::class, 'index'])->name('profile.page');
    Route::resource('media-posts', MediaPostController::class)->only(['index', 'create', 'store'])->middleware('auth');
});

// ✅ Route Khusus Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); // Buat file di resources/views/admin/dashboard.blade.php
    })->name('admin.dashboard');
});

// ✅ Route Khusus User Biasa
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard'); // Buat file di resources/views/user/dashboard.blade.php
    })->name('user.dashboard');
});

require __DIR__ . '/auth.php';
