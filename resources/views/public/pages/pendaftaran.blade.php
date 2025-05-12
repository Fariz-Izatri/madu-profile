@php
    $tentang = (object)[
        'title' => 'Informasi Pendaftaran',
    ]
@endphp

@extends('public.layouts.main')

@section('title', 'Informasi pendaftaran - Unisco - Education Website')

@section('header')
    @include('public.partials.header')
    @include('public.partials.heroAction', ['tentang' => $tentang])
@endsection

@section('content')
    @include('public.partials.infoPPDB')
@endsection