@extends('admin.layouts.app')

@section('title', 'Edit Testimoni')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Testimoni</h3>
                </div>
                
                <form action="{{ route('admin.home-content.testimonial.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    
                        <div class="form-group">
                            <label for="author_name">Nama Pemberi Testimoni <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('author_name') is-invalid @enderror" id="author_name" name="author_name" value="{{ old('author_name', $testimonial->author_name) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="title">Pesan Testimoni <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('title') is-invalid @enderror" id="title" name="title" rows="4" required>{{ old('title', $testimonial->title) }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="image">Foto Profil</label>
                            @if($testimonial->image)
                                <div class="mb-3">
                                    <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->author_name }}" width="100" class="img-thumbnail">
                                    <p class="text-muted mt-1">Gambar saat ini</p>
                                </div>
                            @endif
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image">
                                    <label class="custom-file-label" for="image">Pilih gambar baru (opsional)</label>
                                </div>
                            </div>
                            <small class="form-text text-muted">Format: jpg, jpeg, png, gif. Maksimal 2MB.</small>
                        </div>
                        
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ $testimonial->is_active ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Aktif</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.home-content.testimonial') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        // File input preview
        bsCustomFileInput.init();
    });
</script>
@endpush 