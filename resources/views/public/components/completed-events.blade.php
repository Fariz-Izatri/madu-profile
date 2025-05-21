@props(['events'])

<div class="tab-pane" id="completed-events" role="tabpanel">
    @forelse($events as $event)
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2">
                <div class="event-date">
                    <h4>{{ \Carbon\Carbon::parse($event->date)->format('d') }}</h4>
                    <span>{{ \Carbon\Carbon::parse($event->date)->format('M Y') }}</span>
                </div>
                <span class="event-time">{{ $event->time }}</span>
            </div>
            <div class="col-md-10">
                <div class="event-heading">
                    <h3>{{ $event->title }}</h3>
                    <p>{{ $event->description }}</p>
                </div>
                <div id="collapse{{ $event->id }}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="event-hilights">
                            <h5>Foto Highlight Pengumuman</h5>
                        </div>
                        <div class="row">
                            @if($event->images)
                                @foreach($event->images as $image)
                                <div class="col-md-4">
                                    <img src="{{ $image }}" class="img-fluid" alt="event-img">
                                </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="event-highlight-discription">
                                    <p>{{ $event->highlight_description_1 }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="event-highlight-discription">
                                    <p>{{ $event->highlight_description_2 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" class="event-toggle" data-parent="#accordion" href="#collapse{{ $event->id }}">
                            {{ in_array("collapse".$event->id, session('expanded_events', [])) ? 'Sembunyikan Detail' : 'Lihat Detail' }}
                        </a>
                    </h4>
                </div>
            </div>
        </div>
        <hr class="event-underline">
    </div>
    @empty
    <div class="col-md-12 text-center">
        <p>Belum ada pengumuman selesai.</p>
    </div>
    @endforelse
</div> 