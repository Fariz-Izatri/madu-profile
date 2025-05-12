<?php

use Illuminate\Support\Facades\Route;

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
