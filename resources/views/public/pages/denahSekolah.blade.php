@php
    $tentang = (object)[
        'title' => 'Denah Sekolah',
    ]
@endphp

@extends('public.layouts.main')

@section('title', 'Denah Sekolah - Unisco - Education Website')

@section('header')
    @include('public.partials.heroAction', ['tentang' => $tentang])
@endsection

@section('content')
<div class="gallery-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="gallery-style">Denah Sekolah</h3>
                </div>
            </div><br>
        <div class="row">
            <div class="col-md-12">
                <div id="gallery">
                    <div id="gallery-content">
                        <div id="gallery-content-center">
                            <a href="images/gallery/large_5.jpg" class="image-link2">
                            <img src="images/gallery/gallery_5.jpg" class="all studio img-fluid" alt="#" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection