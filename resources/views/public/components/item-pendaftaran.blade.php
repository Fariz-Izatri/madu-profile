@props(['pendaftaran'])

<div class="notice py-3 my-3">
    <div class="event_date">
        <div class="event-date-wrap">
            <p>{{ \Carbon\Carbon::parse($pendaftaran->tanggal)->format('d') }}</p>
            <span>{{ \Carbon\Carbon::parse($pendaftaran->tanggal)->format('M.y') }}</span>
        </div>
    </div>
    <div class="date-description pb-1">
        <h3 class="mt-0 mb-3">{{ $pendaftaran->judul }}</h3>
        <div class="mb-3">
            {!! nl2br(e($pendaftaran->deskripsi)) !!}
        </div>
        @if($pendaftaran->file_panduan)
            <a href="{{ $pendaftaran->file_panduan }}" class="btn btn-warning btn-sm mb-3" target="_blank">
                <i class="fa fa-download"></i> Unduh Panduan
            </a>
        @endif
        <hr class="my-2">
    </div>
</div> 