<section class="blog-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @forelse($daftarBerita as $berita)
                    @include('public.components.artikel-berita', ['berita' => $berita])
                @empty
                    <div class="blog-single-item">
                        <div class="blog-tiltle_block">
                            <h4>Belum ada berita</h4>
                            <p>Saat ini belum ada berita yang dapat ditampilkan. Silakan kunjungi lagi nanti.</p>
                        </div>
                    </div>
                @endforelse
                
                @include('public.components.paginasi-berita', ['berita' => $daftarBerita])
            </div>
        </div>
    </div>
</section>