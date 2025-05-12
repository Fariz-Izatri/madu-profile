@php
    $tentang = (object)[
        'title' => 'Berita',
    ]
@endphp

@extends('public.layouts.main')

@section('title', 'Berita - Unisco - Education Website')

@section('header')
    @include('public.partials.header')
    @include('public.partials.heroAction', ['tentang' => $tentang])
@endsection

@section('content')
    @include('public.partials.berita')
@endsection