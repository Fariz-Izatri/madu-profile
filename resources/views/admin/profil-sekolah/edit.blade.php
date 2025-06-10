@extends('admin.layouts.app')

@section('title', 'Edit Profil Sekolah')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kelola Profil Sekolah</h3>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs mb-4" id="profileTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">
                                <i class="fas fa-school mr-1"></i> Profil Sekolah
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="teachers-tab" href="{{ route('admin.profil-sekolah.teachers', $profilSekolah->id) }}" role="tab">
                                <i class="fas fa-chalkboard-teacher mr-1"></i> Data Guru
                            </a>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="profileTabContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.profil-sekolah.update', $profilSekolah->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="form-group">
                                    <label for="nama_sekolah">Nama Sekolah <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="{{ old('nama_sekolah', $profilSekolah->nama_sekolah) }}" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="sambutan_kepala_sekolah">Sambutan Kepala Sekolah <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="sambutan_kepala_sekolah" name="sambutan_kepala_sekolah" rows="5" required>{{ old('sambutan_kepala_sekolah', $profilSekolah->sambutan_kepala_sekolah) }}</textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="nama_kepala_sekolah">Nama Kepala Sekolah <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_kepala_sekolah" name="nama_kepala_sekolah" value="{{ old('nama_kepala_sekolah', $profilSekolah->nama_kepala_sekolah) }}" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Foto Kepala Sekolah</label>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <ul class="nav nav-tabs" id="fotoKepsekTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="url-kepsek-tab" data-toggle="tab" href="#url-kepsek" role="tab">
                                                        URL Gambar
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="upload-kepsek-tab" data-toggle="tab" href="#upload-kepsek" role="tab">
                                                        Upload File
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content mt-2" id="fotoKepsekTabContent">
                                                <div class="tab-pane fade show active" id="url-kepsek" role="tabpanel">
                                                    <input type="text" class="form-control kepsek-image-url-input" name="foto_kepala_sekolah_url" value="{{ old('foto_kepala_sekolah_url', $profilSekolah->foto_kepala_sekolah) }}" placeholder="https://example.com/foto.jpg">
                                                    <small class="form-text text-muted">Masukkan URL gambar dari internet</small>
                                                </div>
                                                <div class="tab-pane fade" id="upload-kepsek" role="tabpanel">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input kepsek-image-file-input" name="foto_kepala_sekolah" id="foto_kepala_sekolah" accept="image/*">
                                                        <label class="custom-file-label" for="foto_kepala_sekolah">Pilih file</label>
                                                    </div>
                                                    <small class="form-text text-muted">Upload file gambar (JPG, PNG, GIF max 2MB). Disarankan ukuran 300x400px.</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="image-preview-container">
                                                <label>Preview Foto:</label>
                                                <div class="image-preview">
                                                    @if(!empty($profilSekolah->foto_kepala_sekolah))
                                                        <img src="{{ $profilSekolah->foto_kepala_sekolah }}" alt="Preview" class="img-fluid img-thumbnail kepsek-img">
                                                    @else
                                                        <div class="no-image-placeholder">
                                                            <i class="fas fa-user fa-5x text-secondary"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="alamat">Alamat Sekolah</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $profilSekolah->alamat) }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="telepon">Telepon</label>
                                    <input type="text" class="form-control" id="telepon" name="telepon" value="{{ old('telepon', $profilSekolah->telepon) }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $profilSekolah->email) }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="text" class="form-control" id="website" name="website" value="{{ old('website', $profilSekolah->website) }}">
                                </div>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ $profilSekolah->is_active ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_active">Aktif</label>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css">
<style>
    .image-preview-container {
        margin-top: 1.5rem;
    }
    .image-preview {
        height: 200px;
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background-color: #f8f9fa;
    }
    .kepsek-img {
        max-height: 190px;
        max-width: 100%;
        object-fit: contain;
    }
    .no-image-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        width: 100%;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();
        
        $('#sambutan_kepala_sekolah').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        
        // Image URL preview
        $('.kepsek-image-url-input').on('input', function() {
            var imageUrl = $(this).val().trim();
            var previewContainer = $('.image-preview');
            
            if (imageUrl) {
                previewContainer.html('<img src="' + imageUrl + '" alt="Preview" class="img-fluid img-thumbnail kepsek-img" onerror="this.onerror=null;this.src=\'data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22150%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20150%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1890d1c77d5%20text%20%7B%20fill%3A%23999%3Bfont-weight%3Anormal%3Bfont-family%3A-apple-system%2CBlinkMacSystemFont%2C%26quot%3BSegoe%20UI%26quot%3B%2CRoboto%2C%26quot%3BHelvetica%20Neue%26quot%3B%2CArial%2C%26quot%3BNoto%20Sans%26quot%3B%2Csans-serif%2C%26quot%3BApple%20Color%20Emoji%26quot%3B%2C%26quot%3BSegoe%20UI%20Emoji%26quot%3B%2C%26quot%3BSegoe%20UI%20Symbol%26quot%3B%2C%26quot%3BNoto%20Color%20Emoji%26quot%3B%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1890d1c77d5%22%3E%3Crect%20width%3D%22200%22%20height%3D%22150%22%20fill%3D%22%23373940%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2256.1953125%22%20y%3D%2280%22%3EImage%20Error%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E\';">');
            } else {
                previewContainer.html('<div class="no-image-placeholder"><i class="fas fa-user fa-5x text-secondary"></i></div>');
            }
        });
        
        // File input preview
        $('.kepsek-image-file-input').on('change', function() {
            var file = this.files[0];
            var previewContainer = $('.image-preview');
            
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    previewContainer.html('<img src="' + e.target.result + '" alt="Preview" class="img-fluid img-thumbnail kepsek-img">');
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush 