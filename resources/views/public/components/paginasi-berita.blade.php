@props(['berita'])

@if ($berita->hasPages())
<nav>
    <ul class="pagination justify-content-center">
        {{-- Previous Page Link --}}
        @if ($berita->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link page-next">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                    <span class="sr-only">Sebelumnya</span>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link page-next" href="{{ $berita->previousPageUrl() }}" aria-label="Previous">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                    <span class="sr-only">Sebelumnya</span>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($berita->getUrlRange(1, $berita->lastPage()) as $page => $url)
            @if ($page == $berita->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($berita->hasMorePages())
            <li class="page-item">
                <a class="page-link page-next" href="{{ $berita->nextPageUrl() }}" aria-label="Next">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                    <span class="sr-only">Selanjutnya</span>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link page-next">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                    <span class="sr-only">Selanjutnya</span>
                </span>
            </li>
        @endif
    </ul>
</nav>
@endif 