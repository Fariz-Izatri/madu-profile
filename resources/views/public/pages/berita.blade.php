@php
    $tentang = (object)[
        'title' => 'Berita',
    ]
@endphp

@extends('public.layouts.main')

@section('title', 'Berita')

@section('header')
    @include('public.partials.heroAction', ['tentang' => $tentang])
@endsection

@section('content')
    @include('public.partials.berita', [
        'daftarBerita' => $daftarBerita
    ])
@endsection