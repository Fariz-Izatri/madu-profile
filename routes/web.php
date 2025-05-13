<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

#public routes
Route::get('/', function () {
    return view('public.pages.index');
});
route::get('/sejarah', function () {
    return view('public.pages.sejarah');
});
route::get('/fasilitas', function () {
    return view('public.pages.fasilitas');
});
route::get('/berita', function () {
    return view('public.pages.berita');
});
route::get('/pengumuman', function () {
    return view('public.pages.pengumuman');
});
route::get('/gallery', function () {
    return view('public.pages.gallery');
});
route::get('/profilSekolah', function () {
    return view('public.pages.profilSekolah');
});
route::get('/ekstrakurikuler', function () {
    return view('public.pages.ekstrakurikuler');
});
route::get('/pendaftaran', function () {
    return view('public.pages.pendaftaran');
});
route::get('/denahSekolah', function () {
    return view('public.pages.denahSekolah');
});

#admin routes
Route::get('/welcome', function () {
    return view('admin.pages.welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('admin.pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

require __DIR__.'/auth.php';
