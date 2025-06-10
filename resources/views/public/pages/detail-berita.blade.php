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
                    <div class="blog-content_block">
                        <div class="blog-tiltle_block">
                            <h4>{{ $berita->judul }}</h4>
                            <h6>
                                <span class="text-muted mr-2">{{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}</span>
                                | <a href="#"><i class="fa fa-user" aria-hidden="true"></i><span>{{ $berita->penulis ?? 'admin' }}</span></a>
                            </h6>
                            
                            @if($berita->external_link)
                            <div class="external-link-box mb-4">
                                <a href="{{ $berita->external_link }}" class="btn btn-primary" target="_blank">
                                    <i class="fa fa-external-link mr-2"></i> Lihat Informasi Tambahan
                                </a>
                            </div>
                            @endif
                            
                            <div class="blog-content">
                                {!! nl2br(e($berita->konten)) !!}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="blog-text_block">
                    <div class="blog-comments text-center mt-4">
                        <a href="{{ route('berita.index') }}" class="btn btn-warning">
                            <i class="fa fa-arrow-left mr-1"></i> Kembali ke Daftar Berita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 