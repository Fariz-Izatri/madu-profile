@extends('public.layouts.main')

@section('title', $berita->judul)

@section('header')
    @php
        $tentang = (object)[
            'title' => $berita->judul,
        ]
    @endphp
    @include('public.partials.heroAction', ['tentang' => $tentang])
@endsection

@section('content')
<section class="blog-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="blog-single-item">
                    <div class="blog-img_block">
                        @if($berita->gambar && file_exists(public_path(str_replace('/storage', '/storage/app/public', $berita->gambar))))
                            <img src="{{ $berita->gambar }}" class="img-fluid" alt="{{ $berita->judul }}">
                        @else
                            <img src="{{ asset('images/blog/blog-img_01.jpg') }}" class="img-fluid" alt="{{ $berita->judul }}">
                        @endif
                        <div class="blog-date">
                            <span>{{ \Carbon\Carbon::parse($berita->tanggal)->format('d-m-y') }}</span>
                        </div>
                    </div>
                    <div class="blog-tiltle_block">
                        <h4>{{ $berita->judul }}</h4>
                        <h6>
                            <a href="#"><i class="fa fa-user" aria-hidden="true"></i><span>{{ $berita->penulis ?? 'admin' }}</span></a>
                            @if($berita->kategori)
                            | <a href="{{ route('berita.kategori', $berita->kategori->slug) }}"><i class="fa fa-tags" aria-hidden="true"></i><span>{{ $berita->kategori->nama }}</span></a>
                            @endif
                        </h6>
                        <div class="blog-content">
                            {!! nl2br(e($berita->konten)) !!}
                        </div>
                        <div class="blog-icons">
                            <div class="blog-share_block">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                    <li> Bagikan :</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="blog-text_block">
                    <div class="blog-comments">
                        <a href="{{ route('berita.index') }}" class="btn btn-warning">Kembali ke Daftar Berita</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 