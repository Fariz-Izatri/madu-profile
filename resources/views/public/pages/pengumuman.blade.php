@php
    $tentang = (object)[
        'title' => 'Pengumuman',
    ]
@endphp

@extends('public.layouts.main')

@section('title', 'Pengumuman - Unisco - Education Website')

@section('header')
    @include('public.partials.header')
    @include('public.partials.heroAction', ['tentang' => $tentang])
@endsection

@section('content')
    @include('public.partials.pengumuman')
@endsection