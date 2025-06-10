@props(['pendaftaran'])

<div class="notice py-3 my-3">
    <div class="event_date">
        <div class="event-date-wrap">
            <p>{{ $pendaftaran->tanggal_mulai ? \Carbon\Carbon::parse($pendaftaran->tanggal_mulai)->format('d') : '--' }}</p>
            <span>{{ $pendaftaran->tanggal_mulai ? \Carbon\Carbon::parse($pendaftaran->tanggal_mulai)->format('M.y') : '--' }}</span>
        </div>
    </div>
    <div class="date-description pb-1">
        <h3 class="mt-0 mb-3">{{ $pendaftaran->judul }}</h3>
        <div class="mb-3">
            {!! nl2br(e($pendaftaran->deskripsi)) !!}
        </div>
        <div class="mb-3">
            <p>Periode pendaftaran: {{ $pendaftaran->tanggal_mulai ? $pendaftaran->tanggal_mulai->format('d M Y') : '-' }} s/d {{ $pendaftaran->tanggal_selesai ? $pendaftaran->tanggal_selesai->format('d M Y') : '-' }}</p>
        </div>
        @if($pendaftaran->link_pendaftaran)
            <a href="{{ $pendaftaran->link_pendaftaran }}" class="btn btn-primary btn-sm mb-3" target="_blank">
                <i class="fa fa-external-link"></i> Link Pendaftaran
            </a>
        @endif
        <hr class="my-2">
    </div>
</div> 