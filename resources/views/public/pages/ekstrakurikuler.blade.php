@php
    $tentang = (object)[
        'title' => 'Ekstrakurikuler',
    ]
@endphp

@extends('public.layouts.main')
@section('title', 'Ekstrakurikuler - Unisco - Education Website')

@section('header')
    @include('public.partials.header')
    @include('public.partials.heroAction', ['tentang' => $tentang])
@endsection

@section('content')
  @include('public.partials.ekstrakurikuler')
  @include('public.partials.prestasiChart')
@endsection

@section('show_instagram', true)
