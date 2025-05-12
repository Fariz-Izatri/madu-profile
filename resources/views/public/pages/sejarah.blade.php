@php
    $tentang = (object)[
        'title' => 'Sejarah',
    ]
@endphp

@extends('public.layouts.main')
@section('title', 'Sejarah - Unisco - Education Website')

@section('header')
    @include('public.partials.header')
    @include('public.partials.heroAction', ['tentang' => $tentang])
@endsection

@section('content')
<section class="event">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2>Sejarah</h2>
                <div class="event-img">
                    <span class="event-img_date">06-Nov-17</span>
                    <img src="images/upcoming-event-img.jpg" class="img-fluid" alt="event-img">
                </div>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="date-description ml-0 mt-5">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam animi harum rerum perspiciatis, odit exercitationem ab! Nemo mollitia deserunt, sed consequuntur, quidem sunt id possimus omnis eaque aperiam iste molestias. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('public.partials.visiMisi')
@endsection

@section('show_instagram', true)
