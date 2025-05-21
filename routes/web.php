<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\KategoriBeritaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\EkstrakurikulerController as AdminEkstrakurikulerController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\Admin\HomeContentController as AdminHomeContentController;
use Illuminate\Support\Facades\Route;

#public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
route::get('/sejarah', function () {
    return view('public.pages.sejarah');
});
route::get('/fasilitas', function () {
    return view('public.pages.fasilitas');
});

// Berita Routes
route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
route::get('/berita/kategori/{slug}', [BeritaController::class, 'kategori'])->name('berita.kategori');
route::get('/berita/cari', [BeritaController::class, 'cari'])->name('berita.cari');
route::get('/berita/{id}', [BeritaController::class, 'detail'])->name('berita.detail');

// Pengumuman Routes
route::get('/pengumuman', [EventController::class, 'index'])->name('events.index');
route::get('/pengumuman/upcoming', [EventController::class, 'upcoming'])->name('events.upcoming');
route::get('/pengumuman/completed', [EventController::class, 'completed'])->name('events.completed');

// Pendaftaran Routes
route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');

// Ekstrakurikuler Routes
route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('ekstrakurikuler.index');


route::get('/profilSekolah', function () {
    return view('public.pages.profilSekolah');
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
    
    // Admin Event Routes
    Route::resource('admin/events', AdminEventController::class, ['as' => 'admin']);
    
    // Admin Berita Routes
    Route::resource('admin/berita', AdminBeritaController::class, ['as' => 'admin']);
    Route::resource('admin/kategori-berita', KategoriBeritaController::class, ['as' => 'admin']);
    
    // Admin Pendaftaran Routes
    Route::resource('admin/pendaftaran', AdminPendaftaranController::class, ['as' => 'admin']);
    
    // Admin Ekstrakurikuler Routes
    Route::resource('admin/ekstrakurikuler', AdminEkstrakurikulerController::class, ['as' => 'admin']);
    
    // Admin Home Content Routes
    Route::get('admin/home-content', [AdminHomeContentController::class, 'index'])->name('admin.home-content.index');
    
    // Hero Section
    Route::get('admin/home-content/hero', [AdminHomeContentController::class, 'heroSection'])->name('admin.home-content.hero');
    Route::get('admin/home-content/hero/{id}/edit', [AdminHomeContentController::class, 'editHeroSlide'])->name('admin.home-content.hero.edit');
    Route::put('admin/home-content/hero/{id}', [AdminHomeContentController::class, 'updateHeroSlide'])->name('admin.home-content.hero.update');
    
    // Info Section
    Route::get('admin/home-content/info', [AdminHomeContentController::class, 'infoSection'])->name('admin.home-content.info');
    Route::put('admin/home-content/info/{id}', [AdminHomeContentController::class, 'updateInfoSection'])->name('admin.home-content.info.update');
    
    // FAQ Section
    Route::get('admin/home-content/faq', [AdminHomeContentController::class, 'faqSection'])->name('admin.home-content.faq');
    Route::put('admin/home-content/faq/{id}', [AdminHomeContentController::class, 'updateFaqSection'])->name('admin.home-content.faq.update');
    
    // Prestasi Chart Section
    Route::get('admin/home-content/prestasi-chart', [AdminHomeContentController::class, 'prestasiChartSection'])->name('admin.home-content.prestasi-chart');
    Route::put('admin/home-content/prestasi-chart/{id}', [AdminHomeContentController::class, 'updatePrestasiChartSection'])->name('admin.home-content.prestasi-chart.update');
    
    // Testimonial Section
    Route::get('admin/home-content/testimonial', [AdminHomeContentController::class, 'testimonialSection'])->name('admin.home-content.testimonial');
    Route::get('admin/home-content/testimonial/create', [AdminHomeContentController::class, 'createTestimonial'])->name('admin.home-content.testimonial.create');
    Route::post('admin/home-content/testimonial', [AdminHomeContentController::class, 'storeTestimonial'])->name('admin.home-content.testimonial.store');
    Route::get('admin/home-content/testimonial/migrate', [AdminHomeContentController::class, 'migrateTestimonials'])->name('admin.home-content.testimonial.migrate');
    Route::get('admin/home-content/testimonial/{id}/edit', [AdminHomeContentController::class, 'editTestimonial'])->name('admin.home-content.testimonial.edit');
    Route::put('admin/home-content/testimonial/{id}', [AdminHomeContentController::class, 'updateTestimonial'])->name('admin.home-content.testimonial.update');
    Route::delete('admin/home-content/testimonial/{id}', [AdminHomeContentController::class, 'destroyTestimonial'])->name('admin.home-content.testimonial.destroy');
});

require __DIR__.'/auth.php';
