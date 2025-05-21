@extends('public.layouts.main')

@section('title', 'Pengumuman')

@section('content')
    @include('public.partials.pengumuman', [
        'upcomingEvents' => $upcomingEvents, 
        'completedEvents' => $completedEvents
    ])
@endsection