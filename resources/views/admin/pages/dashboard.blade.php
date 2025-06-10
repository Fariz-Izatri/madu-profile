@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Statistics Section -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ App\Models\Berita::count() }}</h3>
                    <p>Total Berita</p>
                </div>
                <div class="icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <a href="{{ route('admin.berita.index') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ App\Models\Event::count() }}</h3>
                    <p>Total Pengumuman</p>
                </div>
                <div class="icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <a href="{{ route('admin.events.index') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ App\Models\Ekstrakurikuler::count() }}</h3>
                    <p>Total Ekstrakurikuler</p>
                </div>
                <div class="icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <a href="{{ route('admin.ekstrakurikuler.index') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ App\Models\Fasilitas::count() }}</h3>
                    <p>Total Fasilitas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-building"></i>
                </div>
                <a href="{{ route('admin.fasilitas.index') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Quick Access Cards -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Menu Utama</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fas fa-newspaper"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Berita</span>
                                    <span class="info-box-number">
                                        <a href="{{ route('admin.berita.index') }}" class="text-dark">Kelola Berita</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-bullhorn"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Pengumuman</span>
                                    <span class="info-box-number">
                                        <a href="{{ route('admin.events.index') }}" class="text-dark">Kelola Pengumuman</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fas fa-user-plus"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Informasi Pendaftaran</span>
                                    <span class="info-box-number">
                                        <a href="{{ route('admin.pendaftaran.index') }}" class="text-dark">Kelola Pendaftaran</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-graduation-cap"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Ekstrakurikuler</span>
                                    <span class="info-box-number">
                                        <a href="{{ route('admin.ekstrakurikuler.index') }}" class="text-dark">Kelola Ekstrakurikuler</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Additional Menu Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Menu Lainnya</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-indigo"><i class="fas fa-home"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Konten Halaman Depan</span>
                                    <span class="info-box-number">
                                        <a href="{{ route('admin.home-content.index') }}" class="text-dark">Kelola Konten</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fas fa-history"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Sejarah</span>
                                    <span class="info-box-number">
                                        <a href="{{ route('admin.sejarah.index') }}" class="text-dark">Kelola Sejarah</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-secondary"><i class="fas fa-building"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Fasilitas</span>
                                    <span class="info-box-number">
                                        <a href="{{ route('admin.fasilitas.index') }}" class="text-dark">Kelola Fasilitas</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-teal"><i class="fas fa-school"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Profil Sekolah</span>
                                    <span class="info-box-number">
                                        <a href="{{ route('admin.profil-sekolah.index') }}" class="text-dark">Kelola Profil</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6 col-12 mt-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fas fa-map"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Denah Sekolah</span>
                                    <span class="info-box-number">
                                        <a href="{{ route('admin.denah-sekolah.index') }}" class="text-dark">Kelola Denah</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6 col-12 mt-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-gray"><i class="fas fa-cog"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Pengaturan Footer</span>
                                    <span class="info-box-number">
                                        <a href="{{ route('admin.footer-settings.index') }}" class="text-dark">Kelola Footer</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection