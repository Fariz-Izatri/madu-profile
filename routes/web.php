<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
});
route::get('/about', function () {
    return view('pages.about');
});