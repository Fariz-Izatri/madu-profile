@php
    $tentang = (object)[
        'title' => 'Ekstrakurikuler',
    ]
@endphp

@extends('public.layouts.main')
@section('title', 'Ekstrakurikuler - SDN Medokan Ayu II')

@section('header')
    @include('public.partials.heroAction', ['tentang' => $tentang])
@endsection

@section('content')
    @include('public.partials.daftar-ekstrakurikuler', ['daftarEkstrakurikuler' => $daftarEkstrakurikuler])
@endsection

@section('show_instagram', true)
