<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\MediaPostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilePageController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard umum
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Route untuk semua user yang login
Route::middleware('auth')->group(function () {
    // Pengaturan profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Feed: menampilkan semua post dari semua user
    Route::get('/feed', [FeedController::class, 'index'])->name('feed.index');

    // Komentar
    Route::post('/media-posts/{mediaPost}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Media Post (tambah post)
    Route::get('/media-posts/create', [MediaPostController::class, 'create'])->name('media-posts.create');
    Route::post('/media-posts', [MediaPostController::class, 'store'])->name('media-posts.store');
    // Load more posts untuk infinite scroll
    Route::get('/media-posts/load', [MediaPostController::class, 'loadMorePosts'])->name('media-posts.load');
    // Resource MediaPost terbatas hanya index, create, store
    Route::resource('media-posts', MediaPostController::class)->only(['index', 'create', 'store']);

    // ✅ Archive Page: menampilkan dan download media post user
    Route::get('/media-posts/archive', [MediaPostController::class, 'archive'])->name('media-posts.archive');
    Route::get('/media-posts/archive/download', [MediaPostController::class, 'downloadArchive'])->name('media-posts.downloadArchive');

    // My Profile Page
    Route::get('/my-profile', [ProfilePageController::class, 'index'])->name('profile.page');

    // ✅ Route tambahan: Menampilkan detail post pribadi (hanya milik user sendiri)
    Route::get('/profile/posts/{post}', [ProfilePageController::class, 'show'])->name('profile.posts.show');
    Route::delete('/profile/posts/{post}/delete', [ProfilePageController::class, 'delete'])->name('profile.posts.delete');
    Route::get('/profile/archives', [ProfilePageController::class, 'archive'])->name('profile.archive');
    Route::patch('/profile/posts/{post}/restore', [ProfilePageController::class, 'restore'])->name('profile.posts.restore');
    Route::delete('/profile/posts/{post}/delete-permanent', [ProfilePageController::class, 'deletePermanent'])->name('profile.posts.delete-permanent');
});

// ✅ Route Khusus Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// ✅ Route Khusus User Biasa
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
});

require __DIR__ . '/auth.php';
