<section class="campus">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Fasilitas Sekolah</h2>
                <p>Berikut adalah berbagai fasilitas yang tersedia di SD Negeri Medokan Ayu II untuk mendukung kegiatan belajar mengajar dan pengembangan siswa.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            @forelse($daftarFasilitas as $fasilitas)
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <div class="campus-img_block">
                        @if($fasilitas->gambar && file_exists(public_path(ltrim($fasilitas->gambar, '/'))))
                            <img src="{{ $fasilitas->gambar }}" class="img-fluid" alt="{{ $fasilitas->nama }}">
                        @else
                            <img src="{{ asset('images/campus/campus-img_01.jpg') }}" class="img-fluid" alt="{{ $fasilitas->nama }}">
                        @endif
                        <div class="campus-title-block">
                            <h4>{{ $fasilitas->nama }}</h4>
                        </div>
                    </div>
                    <div class="campus-img_text">
                        <p>{{ Str::limit($fasilitas->deskripsi, 150) }}</p>
                        @if(strlen($fasilitas->deskripsi) > 150)
                            <a href="{{ route('fasilitas.detail', $fasilitas->id) }}" class="btn btn-sm btn-primary mt-2">
                                <i class="fa fa-info-circle"></i> Detail
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-md-12 text-center">
                    <p>Belum ada data fasilitas.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>