@php
    $tentang = (object)[
        'title' => 'Sejarah',
    ]
@endphp

@extends('public.layouts.main')
@section('title', 'Sejarah - SDN Medokan Ayu II')

@section('header')
    @include('public.partials.heroAction', ['tentang' => $tentang])
@endsection

@section('content')
<section class="event">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2>{{ $sejarah->title }}</h2>
                <div class="event-img">
                    @if($sejarah->image_date)
                        <span class="event-img_date">{{ $sejarah->image_date->format('d-M-y') }}</span>
                    @endif
                    @if($sejarah->image && file_exists(public_path(ltrim($sejarah->image, '/'))))
                        <img src="{{ $sejarah->image }}" class="img-fluid" alt="{{ $sejarah->title }}">
                    @else
                        <img src="{{ asset('images/upcoming-event-img.jpg') }}" class="img-fluid" alt="{{ $sejarah->title }}">
                    @endif
                </div>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="date-description ml-0 mt-5">
                            <p>{!! nl2br(e($sejarah->content)) !!}</p>
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
