@extends('admin.layouts.app')

@section('title', 'Edit Denah Sekolah')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Denah Sekolah</h3>
                </div>
                
                <form action="{{ route('admin.denah-sekolah.update', $denahSekolah->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Sukses!</h5>
                                {{ session('success') }}
                            </div>
                        @endif
                        
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
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Judul <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $denahSekolah->title) }}" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $denahSekolah->description) }}</textarea>
                                    <small class="form-text text-muted">Deskripsi singkat mengenai denah sekolah (opsional).</small>
                                </div>
                                
                                <div class="form-group">
                                    <label>Gambar Denah</label>
                                    @if($denahSekolah->image)
                                        <div class="mb-2">
                                            <img src="{{ $denahSekolah->image }}" alt="{{ $denahSekolah->title }}" class="img-thumbnail" style="max-height: 300px;">
                                        </div>
                                    @endif
                                    
                                    <div class="row">
                                        <div class="col-md-9">
                                            <ul class="nav nav-tabs" id="imageTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="url-tab" data-toggle="tab" href="#url" role="tab">
                                                        URL Gambar
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="upload-tab" data-toggle="tab" href="#upload" role="tab">
                                                        Upload File
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content mt-2" id="imageTabContent">
                                                <div class="tab-pane fade show active" id="url" role="tabpanel">
                                                    <input type="text" class="form-control image-url-input" name="image_url" value="{{ old('image_url', $denahSekolah->image) }}" placeholder="https://example.com/gambar-denah.jpg">
                                                    <small class="form-text text-muted">Masukkan URL gambar dari internet</small>
                                                </div>
                                                <div class="tab-pane fade" id="upload" role="tabpanel">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input image-file-input" name="image" id="image" accept="image/*">
                                                        <label class="custom-file-label" for="image">Pilih file</label>
                                                    </div>
                                                    <small class="form-text text-muted">Upload file gambar (JPG, PNG, GIF max 2MB). Disarankan dimensi yang besar dan jelas agar denah dapat terlihat dengan baik.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ $denahSekolah->is_active ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_active">Aktif</label>
                                    </div>
                                    <small class="form-text text-muted">Jika dinonaktifkan, denah sekolah tidak akan ditampilkan di website.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
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
        // Custom file input
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
        
        // Image preview for URL input
        $('.image-url-input').on('change', function() {
            let url = $(this).val();
            if (url) {
                // Here you could add code to show a preview if needed
            }
        });
    });
</script>
@endpush 