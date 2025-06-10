<section class="events">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2 class="event-title">Pengumuman</h2>
            </div>
            <div class="col-md-8">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item nav-tab1">
                        <a class="nav-link tab-list active" data-toggle="tab" href="#upcoming-events" role="tab">Pengumuman Mendatang</a>
                    </li>
                    <li class="nav-item nav-special-br">
                        <a class="nav-link tab-list" data-toggle="tab" href="#completed-events" role="tab">Pengumuman Selesai</a>
                    </li>
                </ul>
            </div>
        </div>
        <br>
        <div class="row">
            <!-- Tab panes -->
            <div class="tab-content">
                @include('public.components.upcoming-events', ['events' => $upcomingEvents])
                @include('public.components.completed-events', ['events' => $completedEvents])
            </div>
        </div>
    </div>
</section> 