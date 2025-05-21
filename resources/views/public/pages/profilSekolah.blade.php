@php
    $tentang = (object)[
        'title' => 'Profil Sekolah',
    ]
@endphp

@extends('public.layouts.main')

@section('title', 'Profil Sekolah - Unisco - Education Website')

@section('header')
    @include('public.partials.heroAction', ['tentang' => $tentang])
@endsection

@section('content')
    @include('public.partials.visiMisi')
<div class="speech">
    <div class="container">
         <h2>Sambutan Kepala Sekolah SDN Medokan Ayu</h2>
          <div class="row">
              <div class="col-md-8">
                  <p>Continually seize worldwide sources with quality ROI. Synergistically impact flexible vortals rather than proactive process improvements. Assertively maximize e-business convergence via standardized solutions. Professionally whiteboard vertical data through backend customer service. Compellingly leverage existing enterprise schemas through fully researched sources.</p> 

                  <p>Conveniently aggregate ubiquitous quality vectors via corporate infomediaries. Intrinsicly monetize impactful value with multidisciplinary alignments. Continually transform standardized.</p> 
                  <img src="images/welcom_sign.png" class="img-fluid" alt="welcom-img">
              </div>
              <div class="col-md-4">
                  <img src="images/admission-detail/instruction-img.jpg" class="img-fluid" alt="#">
                  <p class="text-center"><strong>Frank Harvey</strong>
                      <br>
                      <span>Kepala Sekolah</span></p>
              </div>
          </div>
    </div>
</div>
    @include('public.partials.dataGuru')
@endsection