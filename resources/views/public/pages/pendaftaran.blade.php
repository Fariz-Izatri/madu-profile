@php
    $tentang = (object)[
        'title' => 'Informasi Pendaftaran',
    ]
@endphp

@extends('public.layouts.main')

@section('title', 'Informasi Pendaftaran - SDN Medokan Ayu II')

@section('header')
    @include('public.partials.heroAction', ['tentang' => $tentang])
@endsection

@section('content')
    @include('public.partials.pendaftaran', ['daftarPendaftaran' => $daftarPendaftaran])
@endsection