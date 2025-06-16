@extends('public.layouts.main')

@section('title', 'SDN Medokan Ayu II')

@section('header')
    @include('public.partials.hero', ['heroSlides' => $heroSlides])
@endsection

@section('content')
    @include('public.partials.info', ['info' => $info])
    @include('public.partials.prestasiChart')
    @include('public.partials.testimoni', ['testimoni' => $testimoni])
    @include('public.partials.faq', ['faq' => $faq, 'faqItems' => $faqItems])
@endsection


@section('show_instagram', true)

@php
    // $judulfooter = 'Contact Us';
    $data = (object)[
        'judul' => 'newsletter',
        'button' => 'Kirim',
    ]
@endphp