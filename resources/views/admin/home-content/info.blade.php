@extends('admin.layouts.app')

@section('title', 'Kelola Informasi Sekolah')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kelola Informasi Sekolah</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.home-content.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                @if($info)
                    <form action="{{ route('admin.home-content.info.update', $info->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                                    {{ session('success') }}
                                </div>
                            @endif
                            
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="title">Judul</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $info->title) }}" required>
                                        @error('title')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="description">Deskripsi</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6" required>{{ old('description', json_decode($info->content, true)['description'] ?? '') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ old('is_active', $info->is_active) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="is_active">Aktif</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="image">Gambar</label>
                                        @if($info->image)
                                            <div class="mb-3 text-center">
                                                @if(Str::startsWith($info->image, 'images/'))
                                                    <img src="{{ asset($info->image) }}" class="img-fluid img-thumbnail" style="max-height: 250px;" alt="{{ $info->title }}">
                                                @else
                                                    <img src="{{ $info->image }}" class="img-fluid img-thumbnail" style="max-height: 250px;" alt="{{ $info->title }}">
                                                @endif
                                            </div>
                                        @endif
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image">
                                                <label class="custom-file-label" for="image">{{ $info->image ? 'Ganti gambar' : 'Pilih gambar' }}</label>
                                            </div>
                                        </div>
                                        <small class="text-muted">Format: JPG, PNG, GIF. Maks: 2MB. Biarkan kosong jika tidak ingin mengubah gambar.</small>
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
                @else
                    <div class="card-body">
                        <div class="alert alert-info">
                            Data informasi sekolah tidak ditemukan.
                        </div>
                    </div>
                @endif
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
    });
</script>
@endpush 