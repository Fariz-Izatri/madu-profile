@extends('public.layouts.main')

@section('title', $fasilitas->nama)

@section('header')
    @php
        $tentang = (object)[
            'title' => $fasilitas->nama,
        ]
    @endphp
    @include('public.partials.heroAction', ['tentang' => $tentang])
@endsection

@section('content')
<section class="campus-details">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card mb-4">
                    <div class="card-body">
                        @if($fasilitas->gambar && file_exists(public_path(ltrim($fasilitas->gambar, '/'))))
                            <img src="{{ $fasilitas->gambar }}" alt="{{ $fasilitas->nama }}" class="img-fluid mb-4 w-100">
                        @else
                            <img src="{{ asset('images/campus/campus-img_01.jpg') }}" alt="{{ $fasilitas->nama }}" class="img-fluid mb-4 w-100">
                        @endif
                        
                        <h2 class="mb-3">{{ $fasilitas->nama }}</h2>
                        
                        <div class="facility-description">
                            {!! nl2br(e($fasilitas->deskripsi)) !!}
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="{{ route('fasilitas.index') }}" class="btn btn-warning">
                                <i class="fa fa-arrow-left mr-1"></i> Kembali ke Daftar Fasilitas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .facility-description {
        line-height: 1.7;
    }
    
    .campus-details {
        padding: 50px 0;
    }
    
    /* Standardized dimensions now handled in custom-image-sizes.css */
</style>
@endpush 