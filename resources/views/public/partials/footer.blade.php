<!--============================= FOOTER =============================-->
<footer id="footer-section">
<div class="container">
<div class="row">
    <div class="col-md-12 text-center mb-3">
        <div class="school-info">
            <h3>SDN Medokan Ayu II</h3>
            <p>Membangun Generasi Unggul, Berbudi Pekerti Luhur, dan Berwawasan Lingkungan</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 order-md-1">
        <div class="sitemap">
            <h4>Navigasi</h4>
            <div class="row">
                <div class="col-md-4">
                    <ul>
                        <li><a href="{{ url('/') }}">Beranda</a></li>
                        <li><a href="{{ url('/pendaftaran') }}">Informasi Pendaftaran</a></li>
                        <li><a href="{{ url('/ekstrakurikuler') }}">Ekstrakurikuler</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul>
                        <li><a href="{{ url('/denahSekolah') }}">Denah Sekolah</a></li>
                        <li><a href="{{ url('/fasilitas') }}">Fasilitas</a></li>
                        <li><a href="{{ url('/berita') }}">Berita</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul>
                        <li><a href="{{ url('/pengumuman') }}">Pengumuman</a></li>
                        <li><a href="{{ url('/sejarah') }}">Sejarah</a></li>
                        <li><a href="{{ url('/profilSekolah') }}">Profil Sekolah</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 order-md-2 text-md-right">
        <div class="address">
            <h4>Hubungi Kami</h4>
            <p><span>Alamat: </span> {{ $footerSettings->alamat ?? 'SDN Medokan Ayu II, Surabaya, Indonesia' }}</p>
            <p>Email : {{ $footerSettings->email ?? 'info@sdnmedokanayu2.sch.id' }}
                <br> Telepon : {{ $footerSettings->telepon ?? '031-xxxxxxxx' }}</p>
                <ul class="footer-social-icons">
                    <li><a href="{{ $footerSettings->facebook_url ?? '#' }}" target="_blank"><i class="fa fa-facebook fa-fb" aria-hidden="true"></i></a></li>
                    <li><a href="{{ $footerSettings->instagram_url ?? '#' }}" target="_blank"><i class="fa fa-instagram fa-in" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12 text-center">
            <p class="copyright">© {{ date('Y') }} SDN Medokan Ayu II - Hak Cipta Dilindungi</p>
        </div>
    </div>
</div>
</footer>
<!--//END FOOTER -->