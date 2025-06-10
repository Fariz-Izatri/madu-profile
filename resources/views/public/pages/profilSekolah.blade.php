@php
    $tentang = (object)[
        'title' => 'Profil Sekolah',
    ]
@endphp

@extends('public.layouts.main')

@section('title', 'Profil Sekolah - SDN Medokan Ayu II')

@section('header')
    @include('public.partials.heroAction', ['tentang' => $tentang])
@endsection

@section('content')
    @include('public.partials.visiMisi')
<div class="speech">
    <div class="container">
         <h2>Sambutan Kepala Sekolah</h2>
          <div class="row">
              <div class="col-md-8">
                  {!! $profilSekolah->sambutan_kepala_sekolah !!}
                  
                  @if($profilSekolah->alamat || $profilSekolah->telepon || $profilSekolah->email || $profilSekolah->website)
                  <div class="mt-4">
                      <h4>Informasi Kontak:</h4>
                      <ul class="list-unstyled">
                          @if($profilSekolah->alamat)
                          <li><i class="fas fa-map-marker-alt mr-2"></i> {{ $profilSekolah->alamat }}</li>
                          @endif
                          
                          @if($profilSekolah->telepon)
                          <li><i class="fas fa-phone mr-2"></i> {{ $profilSekolah->telepon }}</li>
                          @endif
                          
                          @if($profilSekolah->email)
                          <li><i class="fas fa-envelope mr-2"></i> {{ $profilSekolah->email }}</li>
                          @endif
                          
                          @if($profilSekolah->website)
                          <li><i class="fas fa-globe mr-2"></i> {{ $profilSekolah->website }}</li>
                          @endif
                      </ul>
                  </div>
                  @endif
              </div>
              <div class="col-md-4">
                  <div class="kepsek-profile text-center">
                      @if($profilSekolah->foto_kepala_sekolah)
                          <img src="{{ $profilSekolah->foto_kepala_sekolah }}" class="kepsek-photo" alt="Foto Kepala Sekolah">
                      @else
                          <img src="{{ asset('images/admission-detail/instruction-img.jpg') }}" class="kepsek-photo" alt="Foto Kepala Sekolah">
                      @endif
                      <p class="kepsek-name"><strong>{{ $profilSekolah->nama_kepala_sekolah }}</strong>
                          <br>
                          <span>Kepala Sekolah</span></p>
                  </div>
              </div>
          </div>
    </div>
</div>
    @include('public.partials.dataGuru')
@endsection

@push('styles')
<style>
    .kepsek-profile {
        margin-bottom: 20px;
    }
    .kepsek-photo {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 5px;
        margin-bottom: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .kepsek-name {
        font-size: 18px;
        margin-top: 5px;
    }
    .kepsek-name span {
        font-size: 14px;
        color: #686868;
    }
</style>
@endpush