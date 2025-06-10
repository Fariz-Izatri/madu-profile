@props(['berita'])

<div class="blog-single-item">
    <div class="blog-content_block">
        <div class="blog-tiltle_block">
            <h4><a href="{{ route('berita.detail', $berita->id) }}">{{ $berita->judul }}</a></h4>
            <h6> 
                <span class="text-muted mr-2">{{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}</span>
                | <a href="#"><i class="fa fa-user" aria-hidden="true"></i><span>{{ $berita->penulis ?? 'admin' }}</span></a> 
                @if($berita->external_link)
                | <a href="{{ $berita->external_link }}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i><span>Link Terkait</span></a>
                @endif
            </h6>
            <p>{{ Str::limit($berita->konten, 150) }}</p>
            <div class="mt-3 mb-4">
                <a href="{{ route('berita.detail', $berita->id) }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-arrow-right mr-1"></i> Baca Selengkapnya
                </a>
            </div>
        </div>
    </div>
    <div class="separator-line"></div>
</div>
<!-- // end .blog-single --> 