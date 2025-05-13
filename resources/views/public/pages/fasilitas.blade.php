@php
    $tentang = (object)[
        'title' => 'Fasilitas',
    ]
@endphp

@extends('public.layouts.main')

@section('title', 'Fasilitas - Unisco - Education Website')

@section('header')
    @include('public.partials.header')
    @include('public.partials.heroAction', ['tentang' => $tentang])
@endsection

@section('content')

@endsection