@php
    $tentang = (object)[
        'title' => 'Denah Sekolah',
    ]
@endphp

@extends('public.layouts.main')

@section('title', 'Denah Sekolah - Unisco - Education Website')

@section('header')
    @include('public.partials.header')
    @include('public.partials.heroAction', ['tentang' => $tentang])
@endsection

@section('content')

@endsection