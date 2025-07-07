<div data-toggle="affix">
  <div class="container nav-menu2">
      <div class="row">
          <div class="col-md-12">
              <nav class="navbar navbar2 navbar-toggleable-md navbar-light bg-faded">
                  <button class="navbar-toggler navbar-toggler2 navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
                      <span class="icon-menu"></span>
                  </button>
                  <a href="{{ url('/') }}" class="navbar-brand nav-brand2">
                    <img src="{{ asset('images/school-logo/logo-sdnmedokanayu2.png')}}" alt="">
                    <h2><b>SDN Medokan Ayu II/615</b></h2></a>
                  <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">
                            Akademik<span class="glyphicon glyphicon-chevron-down pull-right"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/pendaftaran') }}">Informasi Pendaftaran</a></li>
                            <li><a class="dropdown-item" href="{{ url('/ekstrakurikuler') }}">Ekstrakurikuler</a></li>
                        </ul>
                        </li>
                        <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">
                            Fasilitas<span class="glyphicon glyphicon-chevron-down pull-right"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/denahSekolah') }}">Denah Sekolah</a></li>
                            <li><a class="dropdown-item" href="{{ url('/fasilitas') }}">Fasilitas</a></li>
                        </ul>
                        </li>
                        <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">
                            Berita & Pengumuman<span class="glyphicon glyphicon-chevron-down pull-right"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/berita') }}">Berita</a></li>
                            <li><a class="dropdown-item" href="{{ url('/pengumuman') }}">Pengumuman</a></li>
                        </ul>
                        </li>
                        <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">
                            Tentang<span class="glyphicon glyphicon-chevron-down pull-right"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/sejarah') }}">Sejarah</a></li>
                            <li><a class="dropdown-item" href="{{ url('/profilSekolah') }}">Profil Sekolah</a></li>
                        </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#footer-section">Kontak</a>
                        </li>
                  </ul>
              </div>
          </nav>
      </div>
    </div>
 </div>
</div>