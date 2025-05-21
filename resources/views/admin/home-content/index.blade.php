@extends('admin.layouts.app')

@section('title', 'Kelola Konten Halaman Beranda')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kelola Konten Halaman Beranda</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <p class="text-muted mb-4">Silakan pilih bagian konten yang ingin dikelola:</p>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 50px">No.</th>
                                    <th>Bagian Konten</th>
                                    <th>Deskripsi</th>
                                    <th style="width: 150px" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><i class="fas fa-images mr-2"></i> Hero Slider</td>
                                    <td>Kelola konten slider di bagian atas halaman beranda</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.home-content.hero') }}" class="btn btn-primary btn-sm">
                                            Kelola <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><i class="fas fa-info-circle mr-2"></i> Info SD Kami</td>
                                    <td>Kelola bagian informasi sekolah di halaman beranda</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.home-content.info') }}" class="btn btn-primary btn-sm">
                                            Kelola <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><i class="fas fa-chart-bar mr-2"></i> Prestasi Chart</td>
                                    <td>Kelola bagian prestasi dan statistik sekolah</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.home-content.prestasi-chart') }}" class="btn btn-primary btn-sm">
                                            Kelola <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><i class="fas fa-question-circle mr-2"></i> FAQ</td>
                                    <td>Kelola bagian pertanyaan yang sering ditanyakan</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.home-content.faq') }}" class="btn btn-primary btn-sm">
                                            Kelola <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><i class="fas fa-comment-dots mr-2"></i> Testimoni</td>
                                    <td>Kelola bagian testimoni dari siswa dan alumni</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.home-content.testimonial') }}" class="btn btn-primary btn-sm">
                                            Kelola <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        <div class="callout callout-info">
                            <h5><i class="fas fa-info-circle mr-2"></i> Informasi:</h5>
                            <p>Setiap perubahan yang Anda lakukan pada konten akan langsung terlihat di halaman beranda website. Pastikan untuk memeriksa tampilan setelah melakukan perubahan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 