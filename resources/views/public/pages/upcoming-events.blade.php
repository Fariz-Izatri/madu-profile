@extends('public.layouts.main')

@section('title', 'Pengumuman Mendatang')

@section('content')
    <section class="events">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="event-title">Pengumuman Mendatang</h2>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="tab-content">
                    @include('public.components.upcoming-events', ['events' => $upcomingEvents])
                </div>
            </div>
        </div>
    </section>
@endsection 