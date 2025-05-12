@php
    $tentang = (object)[
        'title' => 'Gallery',
    ]
@endphp

@extends('public.layouts.main')

@section('title', 'Gallery - Unisco - Education Website')

@section('header')
    @include('public.partials.header')
    @include('public.partials.heroAction', ['tentang' => $tentang])
@endsection

@section('content')
<div class="gallery-wrap">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <h3 class="gallery-style">Foto Kegiatan</h3>
        </div>
      </div>
        <div class="row">
            <div class="col-md-4">
                <a href="images/gallery/large_1.jpg" class="grid image-link">
                    <figure class="effect-bubba gallery-img-wrap">
                        <img src="images/gallery/gallery_1.jpg" class="img-fluid" alt="#">
                        <figcaption>
                        <p><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></p>
                        </figcaption>     
                    </figure>
                </a>
            </div>
            <div class="col-md-4">
                <a href="images/gallery/large_2.jpg" class="grid image-link">
                    <figure class="effect-bubba gallery-img-wrap">
                        <img src="images/gallery/gallery_2.jpg" class="img-fluid" alt="#">
                        <figcaption>
                        <p><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></p>
                        </figcaption>     
                    </figure>
                </a>
            </div>
            <div class="col-md-4">
                <a href="images/gallery/large_3.jpg" class="grid image-link">
                    <figure class="effect-bubba gallery-img-wrap">
                        <img src="images/gallery/gallery_3.jpg" class="img-fluid" alt="#">
                        <figcaption>
                        <p><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></p>
                        </figcaption>     
                    </figure>
                </a>
            </div>
        </div>
            <div class="row">
            <div class="col-md-4">
                <a href="images/gallery/large_4.jpg" class="grid image-link">
                <figure class="effect-bubba gallery-img-wrap">
                <img src="images/gallery/gallery_4.jpg" class="img-fluid" alt="#">
                <figcaption>
                    <p><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></p>
                </figcaption>     
                </figure>
            </a>
            </div>
            <div class="col-md-4">
            <a href="images/gallery/large_5.jpg" class="grid image-link">
                <figure class="effect-bubba gallery-img-wrap">
                <img src="images/gallery/gallery_5.jpg" class="img-fluid" alt="#">
                <figcaption>
                <p><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></p>
                </figcaption>     
            </figure>
            </a>
            </div>
            <div class="col-md-4">
            <a href="images/gallery/large_6.jpg" class="grid image-link">
                <figure class="effect-bubba gallery-img-wrap">
                <img src="images/gallery/gallery_6.jpg" class="img-fluid" alt="#">
                <figcaption>
                <p><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></p>
                </figcaption>     
            </figure>
            </a>
            </div>
            </div>
            <br>
            <br>
            <!-- Style 2 -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="gallery-style">Video Dokumentasi</h3>
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