<section class="pendaftaran-wrap py-4">
  <div class="container">
      <div class="row">
        <div class="col-md-12">
            <div class="mb-4">
                <p>Berikut adalah informasi terkini mengenai pendaftaran peserta didik baru SDN Medokan Ayu II.</p>
            </div>
            
            @forelse($daftarPendaftaran as $pendaftaran)
                @include('public.components.item-pendaftaran', ['pendaftaran' => $pendaftaran])
            @empty
                <div class="notice">
                    <div class="date-description">
                        <h3>Belum ada informasi pendaftaran</h3>
                        <p>Saat ini belum ada informasi pendaftaran yang dapat ditampilkan. Silakan kunjungi lagi nanti.</p>
                    </div>
                </div>
            @endforelse
        </div>
      </div>     
  </div>
</section> 