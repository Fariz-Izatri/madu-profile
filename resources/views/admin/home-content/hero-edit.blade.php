@extends('admin.layouts.app')

@section('title', 'Edit Hero Slide')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Hero Slide</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.home-content.hero') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <form action="{{ route('admin.home-content.hero.update', $slide->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Judul</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $slide->title) }}" required>
                                    @error('title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="subtitle">Subjudul</label>
                                    <textarea class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" rows="3">{{ old('subtitle', $slide->subtitle) }}</textarea>
                                    @error('subtitle')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="button_text">Teks Tombol</label>
                                    <input type="text" class="form-control @error('button_text') is-invalid @enderror" id="button_text" name="button_text" value="{{ old('button_text', $slide->button_text) }}">
                                    <small class="text-muted">Kosongkan jika tidak ingin menampilkan tombol.</small>
                                    @error('button_text')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="button_link">Link Tombol</label>
                                    <input type="text" class="form-control @error('button_link') is-invalid @enderror" id="button_link" name="button_link" value="{{ old('button_link', $slide->button_link) }}">
                                    @error('button_link')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label>Tombol Tambahan</label>
                                    <div class="additional-buttons">
                                        @php
                                            $buttons = [];
                                            if ($slide->content) {
                                                $content = json_decode($slide->content, true);
                                                $buttons = $content['buttons'] ?? [];
                                            }
                                        @endphp
                                        
                                        @foreach($buttons as $index => $button)
                                            <div class="row mb-2 button-row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="additional_buttons[{{ $index }}][text]" value="{{ $button['text'] }}" placeholder="Teks Tombol">
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="additional_buttons[{{ $index }}][link]" value="{{ $button['link'] }}" placeholder="Link Tombol">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger remove-button"><i class="fas fa-times"></i></button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-info btn-sm add-button mt-2">
                                        <i class="fas fa-plus"></i> Tambah Tombol
                                    </button>
                                </div>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ old('is_active', $slide->is_active) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_active">Aktif</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Gambar</label>
                                    @if($slide->image)
                                        <div class="mb-2">
                                            @if(Str::startsWith($slide->image, 'images/'))
                                                <img src="{{ asset($slide->image) }}" class="img-fluid img-thumbnail" style="max-height: 200px;" alt="{{ $slide->title }}">
                                            @else
                                                <img src="{{ $slide->image }}" class="img-fluid img-thumbnail" style="max-height: 200px;" alt="{{ $slide->title }}">
                                            @endif
                                        </div>
                                    @endif
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image">
                                            <label class="custom-file-label" for="image">{{ $slide->image ? 'Ganti gambar' : 'Pilih gambar' }}</label>
                                        </div>
                                    </div>
                                    <small class="text-muted">Format: JPG, PNG, GIF. Maks: 2MB. Gambar akan dioptimalkan ke ukuran 1920x1080px untuk tampilan slider (rasio aspek dijaga).</small>
                                    @error('image')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Show file name when selected
        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $(this).next('.custom-file-label').html(fileName);
        });
        
        // Add new button row
        $('.add-button').click(function() {
            var index = $('.button-row').length;
            var newRow = `
                <div class="row mb-2 button-row">
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="additional_buttons[${index}][text]" placeholder="Teks Tombol">
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="additional_buttons[${index}][link]" placeholder="Link Tombol">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-button"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            `;
            $('.additional-buttons').append(newRow);
        });
        
        // Remove button row
        $(document).on('click', '.remove-button', function() {
            $(this).closest('.button-row').remove();
        });
    });
</script>
@endpush 