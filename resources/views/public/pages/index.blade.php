@extends('public.layouts.main')

@section('title', 'Home - Unisco - Education Website')

@section('header')
    @include('public.partials.header')
<section>
  <div class="slider_img layout_two">
      <div id="carousel" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
              <li data-target="#carousel" data-slide-to="0" class="active"></li>
              <li data-target="#carousel" data-slide-to="1"></li>
              <li data-target="#carousel" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                  <img class="d-block" src="images/slider.jpg" alt="First slide">
                  <div class="carousel-caption d-md-block">
                      <div class="slider_title">
                          <h1>Creative Thinking &amp; Innovation</h1>
                          <h4>Proactively utilize open-source users for process-centric total linkage.<br> Energistically reinvent web-enabled initiatives with premium <br>processes. Proactively drive.</h4>
                          <div class="slider-btn">
                              <a href="#" class="btn btn-default">SEE Programs</a>
                              <a href="#" class="btn btn-default">Learn more</a>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="carousel-item">
                  <img class="d-block" src="images/slider-2.jpg" alt="Second slide">
                  <div class="carousel-caption d-md-block">
                      <div class="slider_title">
                          <h1>We foster wisdom</h1>
                          <h4>Proactively utilize open-source users for process-centric total linkage.<br> Energistically reinvent web-enabled initiatives with premium <br>processes. Proactively drive.</h4>
                          <div class="slider-btn">
                              <a href="#" class="btn btn-default">SEE Programs</a>
                              <a href="#" class="btn btn-default">Learn more</a>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="carousel-item">
                  <img class="d-block" src="images/slider-3.jpg" alt="Third slide">
                  <div class="carousel-caption d-md-block">
                      <div class="slider_title">
                          <h1>Campus life @ Unisco</h1>
                          <h4>Proactively utilize open-source users for process-centric total linkage.<br> Energistically reinvent web-enabled initiatives with premium <br>processes. Proactively drive.</h4>
                          <div class="slider-btn">
                              <a href="campus-life.html" class="btn btn-default">Campus Life</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
              <i class="icon-arrow-left fa-slider" aria-hidden="true"></i>
              <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
              <i class="icon-arrow-right fa-slider" aria-hidden="true"></i>
              <span class="sr-only">Next</span>
          </a>
      </div>
  </div>
</section>
@endsection

@section('content')
<section class="admission_cources">
  <div class="container">
      <div class="row text-center">
          <div class="col-md-12">
              <h2>Info SD Kami</h2>
              <p class="mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled</p>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <img src="images/admission-detail/admission-detail_img.jpg" class="img-fluid" alt="#">
          </div>
      </div>
  </div>
</section>
    @include('public.partials.prestasiChart')
    @include('public.partials.testimoni')
@endsection


@section('show_instagram', true)

@php
    // $judulfooter = 'Contact Us';
    $data = (object)[
        'judul' => 'newsletter',
        'button' => 'Kirim',
    ]
@endphp