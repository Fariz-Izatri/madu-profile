@php
    $tentang = (object)[
        'title' => 'Denah Sekolah',
    ]
@endphp

@extends('public.layouts.main')

@section('title', 'Denah Sekolah - SDN Medokan Ayu II')

@section('header')
    @include('public.partials.heroAction', ['tentang' => $tentang])
@endsection

@section('content')
<div class="gallery-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="gallery-style">{{ $denahSekolah->title }}</h3>
            </div>
        </div>
        
        @if($denahSekolah->description)
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="denah-description">
                    {!! $denahSekolah->description !!}
                </div>
            </div>
        </div>
        @endif
        
        <div class="row">
            <div class="col-md-12">
                <div id="gallery">
                    <div id="gallery-content">
                        <div id="gallery-content-center">
                            @if($denahSekolah->image)
                                <a href="{{ $denahSekolah->image }}" class="image-link2">
                                    <img src="{{ $denahSekolah->image }}" class="all studio img-fluid" alt="{{ $denahSekolah->title }}" />
                                </a>
                                <div class="text-center mt-3">
                                    <a href="{{ $denahSekolah->image }}" class="btn btn-primary" target="_blank">
                                        <i class="fas fa-search-plus"></i> Lihat Gambar Ukuran Penuh
                                    </a>
                                </div>
                            @else
                                <div class="alert alert-info text-center">
                                    <i class="fas fa-info-circle"></i> Gambar denah sekolah belum tersedia.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .denah-description {
        margin-bottom: 20px;
    }
    #gallery img {
        max-width: 100%;
        height: auto;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
</style>
@endpush