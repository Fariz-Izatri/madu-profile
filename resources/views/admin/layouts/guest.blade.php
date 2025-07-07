<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SDN Medokan Ayu II - Admin Login</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/school-logo/logo-sdnmedokanayu2.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Custom Admin Login CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="admin-login-split">
        <!-- Left: Education Quote/Info -->
        <div class="admin-login-left">
            <div class="admin-login-quote-box">
                <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="80" height="80" rx="20" fill="#6366f1"/>
                    <path d="M20 50L40 30L60 50" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="40" cy="40" r="8" fill="#fff"/>
                </svg>
                <h2 class="admin-login-quote">"Pendidikan adalah senjata paling ampuh yang dapat Anda gunakan untuk mengubah dunia."</h2>
                <p class="admin-login-author">— Nelson Mandela</p>
            </div>
        </div>
        <!-- Right: Login Form -->
        <div class="admin-login-right">
            <div class="admin-login-form-container">
                <div class="admin-login-header">
                    <h1 class="admin-login-title">Selamat Datang</h1>
                    <p class="admin-login-subtitle">Sign in to your account</p>
                </div>
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
