<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

#public routes
Route::get('/', function () {
    return view('public.pages.index');
});
route::get('/about', function () {
    return view('public.pages.about');
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
