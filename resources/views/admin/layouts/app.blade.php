<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Admin Panel'))</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <!-- AdminLTE CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
        <!-- Custom styles for this template -->
        @stack('styles')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Navbar -->
            @include('admin.layouts.navigation')
            
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{ route('dashboard') }}" class="brand-link">
                    <img src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Admin Panel</span>
                </a>
                
                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.home-content.index') }}" class="nav-link {{ request()->routeIs('admin.home-content.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>Konten Beranda</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.ekstrakurikuler.index') }}" class="nav-link {{ request()->routeIs('admin.ekstrakurikuler.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-graduation-cap"></i>
                                    <p>Ekstrakurikuler</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.pendaftaran.index') }}" class="nav-link {{ request()->routeIs('admin.pendaftaran.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-plus"></i>
                                    <p>Pendaftaran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.berita.index') }}" class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-newspaper"></i>
                                    <p>Berita</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
            
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">@yield('title', 'Dashboard')</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">@yield('title', 'Dashboard')</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
            
            <!-- Footer -->
            <footer class="main-footer">
                <strong>Copyright &copy; {{ date('Y') }} <a href="{{ url('/') }}">SDN Medokan Ayu II</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 1.0.0
                </div>
            </footer>
        </div>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE JS -->
        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
        
        @stack('scripts')
    </body>
</html>
