@props(['ekskul'])

<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
    <div class="courses_box mb-5">
        <div class="course-img-wrap">
            @if($ekskul->gambar && file_exists(public_path(ltrim($ekskul->gambar, '/'))))
                <img src="{{ $ekskul->gambar }}" class="img-fluid" alt="{{ $ekskul->nama }}" style="width: 100%; height: 200px; object-fit: cover;">
            @else
                <img src="{{ asset('images/courses_1.jpg') }}" class="img-fluid" alt="{{ $ekskul->nama }}" style="width: 100%; height: 200px; object-fit: cover;">
            @endif
            <div class="courses_box-img">
                <div class="courses-link-wrap">
                    <a href="#ekskul-{{ $ekskul->id }}" class="course-link" data-toggle="modal"><span>Detail </span></a>
                </div>
            </div>
        </div>
        <div class="courses_icon">
            <img src="{{ asset('images/plus-icon.png') }}" class="img-fluid close-icon" alt="plus-icon">
        </div>
        <a href="#ekskul-{{ $ekskul->id }}" class="course-box-content" data-toggle="modal">
            <h3>{{ $ekskul->nama }}</h3>
            <p>{{ Str::limit($ekskul->deskripsi, 60) }}</p>
        </a>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="ekskul-{{ $ekskul->id }}" tabindex="-1" role="dialog" aria-labelledby="ekskulModal{{ $ekskul->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ekskulModal{{ $ekskul->id }}">{{ $ekskul->nama }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($ekskul->gambar && file_exists(public_path(ltrim($ekskul->gambar, '/'))))
                        <img src="{{ $ekskul->gambar }}" class="img-fluid mb-3" alt="{{ $ekskul->nama }}" style="max-height: 400px; width: auto; margin: 0 auto; display: block;">
                    @else
                        <img src="{{ asset('images/courses_1.jpg') }}" class="img-fluid mb-3" alt="{{ $ekskul->nama }}">
                    @endif
                    
                    <h4>Deskripsi</h4>
                    <p>{!! nl2br(e($ekskul->deskripsi)) !!}</p>
                    
                    @if($ekskul->jadwal)
                        <h4>Jadwal</h4>
                        <p>{{ $ekskul->jadwal }}</p>
                    @endif
                    
                    @if($ekskul->pembina)
                        <h4>Pembina</h4>
                        <p>{{ $ekskul->pembina }}</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div> 