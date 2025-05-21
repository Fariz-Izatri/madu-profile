<section class="our_courses">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Ekstrakurikuler</h2>
                <p class="mb-4">Kegiatan ekstrakurikuler di SDN Medokan Ayu II dirancang untuk mengembangkan bakat, minat, dan potensi siswa di luar kegiatan akademik. Melalui kegiatan ini, siswa dapat mengasah keterampilan, memperluas wawasan, dan membangun karakter.</p>
            </div>
        </div>
        <div class="row">
            @forelse($daftarEkstrakurikuler as $ekskul)
                @include('public.components.item-ekstrakurikuler', ['ekskul' => $ekskul])
            @empty
                <div class="col-md-12 text-center">
                    <div class="courses_box mb-5">
                        <h3>Belum ada ekstrakurikuler</h3>
                        <p>Saat ini belum ada kegiatan ekstrakurikuler yang dapat ditampilkan. Silakan kunjungi lagi nanti.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section> 