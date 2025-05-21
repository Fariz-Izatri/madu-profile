@extends('public.layouts.main')

@section('title', 'Pengumuman Selesai')

@section('content')
    <section class="events">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="event-title">Pengumuman Selesai</h2>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="tab-content">
                    @include('public.components.completed-events', ['events' => $completedEvents])
                </div>
            </div>
        </div>
    </section>
@endsection 