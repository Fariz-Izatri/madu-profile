@extends('public.layouts.main')

@section('title', 'Pengumuman')

@section('content')
    @include('public.partials.events', [
        'upcomingEvents' => $upcomingEvents, 
        'completedEvents' => $completedEvents
    ])
@endsection