@extends('admin.layouts.app')

@section('title', 'Kelola Data Staff')

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
                            <a class="nav-link" id="profile-tab" href="{{ route('admin.profil-sekolah.index') }}" role="tab">
                                <i class="fas fa-school mr-1"></i> Profil Sekolah
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="teachers-tab" href="{{ route('admin.profil-sekolah.teachers', $profilSekolah->id) }}" role="tab">
                                <i class="fas fa-chalkboard-teacher mr-1"></i> Data Guru
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="staff-tab" data-toggle="tab" href="#staff" role="tab" aria-controls="staff" aria-selected="true">
                                <i class="fas fa-user-tie mr-1"></i> Data Staff
                            </a>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="profileTabContent">
                        <div class="tab-pane fade show active" id="staff" role="tabpanel" aria-labelledby="staff-tab">
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
                            
                            <form action="{{ route('admin.profil-sekolah.update-staff', $profilSekolah->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="staff-container">
                                    @if(is_array($profilSekolah->daftar_staff) && count($profilSekolah->daftar_staff) > 0)
                                        @foreach($profilSekolah->daftar_staff as $index => $staff)
                                            <div class="card mb-3 staff-item">
                                                <div class="card-header bg-light">
                                                    <div class="row">
                                                        <div class="col">
                                                            <h5 class="mb-0">Staff #{{ $index + 1 }}</h5>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-sm btn-danger remove-staff">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <label>Nama Staff <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="staff[{{ $index }}][nama]" value="{{ $staff['nama'] ?? '' }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Jabatan</label>
                                                                <input type="text" class="form-control" name="staff[{{ $index }}][jabatan]" value="{{ $staff['jabatan'] ?? '' }}">
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label>Foto Staff</label>
                                                                <ul class="nav nav-tabs" id="fotoTab{{ $index }}" role="tablist">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" id="url-tab{{ $index }}" data-toggle="tab" href="#url{{ $index }}" role="tab">
                                                                            URL Gambar
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" id="upload-tab{{ $index }}" data-toggle="tab" href="#upload{{ $index }}" role="tab">
                                                                            Upload File
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                <div class="tab-content mt-2" id="fotoTabContent{{ $index }}">
                                                                    <div class="tab-pane fade show active" id="url{{ $index }}" role="tabpanel">
                                                                        <input type="text" class="form-control image-url-input" name="staff[{{ $index }}][foto]" value="{{ $staff['foto'] ?? '' }}" placeholder="https://example.com/foto.jpg">
                                                                        <small class="form-text text-muted">Masukkan URL gambar dari internet</small>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="upload{{ $index }}" role="tabpanel">
                                                                        <div class="custom-file">
                                                                            <input type="file" class="custom-file-input image-file-input" name="staff_foto[{{ $index }}]" id="staff_foto{{ $index }}" accept="image/*">
                                                                            <label class="custom-file-label" for="staff_foto{{ $index }}">Pilih file</label>
                                                                        </div>
                                                                        <small class="form-text text-muted">Upload file gambar (JPG, PNG, GIF max 2MB)</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="image-preview-container">
                                                                <label>Preview Foto:</label>
                                                                <div class="image-preview">
                                                                    @if(!empty($staff['foto']))
                                                                        <img src="{{ $staff['foto'] }}" alt="Preview" class="img-fluid img-thumbnail staff-img">
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
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="card mb-3 staff-item">
                                            <div class="card-header bg-light">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="mb-0">Staff #1</h5>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" class="btn btn-sm btn-danger remove-staff">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <label>Nama Staff <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="staff[0][nama]" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Jabatan</label>
                                                            <input type="text" class="form-control" name="staff[0][jabatan]">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label>Foto Staff</label>
                                                            <ul class="nav nav-tabs" id="fotoTab0" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" id="url-tab0" data-toggle="tab" href="#url0" role="tab">
                                                                        URL Gambar
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="upload-tab0" data-toggle="tab" href="#upload0" role="tab">
                                                                        Upload File
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content mt-2" id="fotoTabContent0">
                                                                <div class="tab-pane fade show active" id="url0" role="tabpanel">
                                                                    <input type="text" class="form-control image-url-input" name="staff[0][foto]" placeholder="https://example.com/foto.jpg">
                                                                    <small class="form-text text-muted">Masukkan URL gambar dari internet</small>
                                                                </div>
                                                                <div class="tab-pane fade" id="upload0" role="tabpanel">
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input image-file-input" name="staff_foto[0]" id="staff_foto0" accept="image/*">
                                                                        <label class="custom-file-label" for="staff_foto0">Pilih file</label>
                                                                    </div>
                                                                    <small class="form-text text-muted">Upload file gambar (JPG, PNG, GIF max 2MB)</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="image-preview-container">
                                                            <label>Preview Foto:</label>
                                                            <div class="image-preview">
                                                                <div class="no-image-placeholder">
                                                                    <i class="fas fa-user fa-5x text-secondary"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <button type="button" class="btn btn-success add-staff">
                                        <i class="fas fa-plus mr-1"></i> Tambah Staff
                                    </button>
                                </div>
                                
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary">Simpan Data Staff</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Template for new staff item -->
<template id="staff-template">
    <div class="card mb-3 staff-item">
        <div class="card-header bg-light">
            <div class="row">
                <div class="col">
                    <h5 class="mb-0">Staff #__INDEX__</h5>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-sm btn-danger remove-staff">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label>Nama Staff <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="staff[__INDEX__][nama]" required>
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" name="staff[__INDEX__][jabatan]">
                    </div>
                    
                    <div class="form-group">
                        <label>Foto Staff</label>
                        <ul class="nav nav-tabs" id="fotoTab__INDEX__" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="url-tab__INDEX__" data-toggle="tab" href="#url__INDEX__" role="tab">
                                    URL Gambar
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="upload-tab__INDEX__" data-toggle="tab" href="#upload__INDEX__" role="tab">
                                    Upload File
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content mt-2" id="fotoTabContent__INDEX__">
                            <div class="tab-pane fade show active" id="url__INDEX__" role="tabpanel">
                                <input type="text" class="form-control image-url-input" name="staff[__INDEX__][foto]" placeholder="https://example.com/foto.jpg">
                                <small class="form-text text-muted">Masukkan URL gambar dari internet</small>
                            </div>
                            <div class="tab-pane fade" id="upload__INDEX__" role="tabpanel">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input image-file-input" name="staff_foto[__INDEX__]" id="staff_foto__INDEX__" accept="image/*">
                                    <label class="custom-file-label" for="staff_foto__INDEX__">Pilih file</label>
                                </div>
                                <small class="form-text text-muted">Upload file gambar (JPG, PNG, GIF max 2MB)</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="image-preview-container">
                        <label>Preview Foto:</label>
                        <div class="image-preview">
                            <div class="no-image-placeholder">
                                <i class="fas fa-user fa-5x text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
@endsection

@push('styles')
<style>
    .image-preview-container {
        margin-top: 1.5rem;
    }
    .image-preview {
        height: 150px;
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
    .staff-img {
        max-height: 140px;
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
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();
        
        // Add new staff
        $('.add-staff').on('click', function() {
            var staffCount = $('.staff-item').length;
            var template = $('#staff-template').html();
            var newStaff = template.replace(/__INDEX__/g, staffCount);
            $('.staff-container').append(newStaff);
            updateStaffNumbers();
            bsCustomFileInput.init();
        });
        
        // Remove staff (delegated event for dynamically added elements)
        $(document).on('click', '.remove-staff', function() {
            if ($('.staff-item').length > 1) {
                $(this).closest('.staff-item').remove();
                updateStaffNumbers();
                // Update all input names to maintain consecutive indices
                $('.staff-item').each(function(index) {
                    $(this).find('input').each(function() {
                        var name = $(this).attr('name');
                        if (name) {
                            if (name.includes('staff[')) {
                                var newName = name.replace(/staff\[\d+\]/, 'staff[' + index + ']');
                                $(this).attr('name', newName);
                            } else if (name.includes('staff_foto[')) {
                                var newName = name.replace(/staff_foto\[\d+\]/, 'staff_foto[' + index + ']');
                                $(this).attr('name', newName);
                                $(this).attr('id', 'staff_foto' + index);
                                $(this).next('label').attr('for', 'staff_foto' + index);
                            }
                        }
                    });
                    
                    // Update tab IDs and href references
                    $(this).find('.nav-tabs').attr('id', 'fotoTab' + index);
                    $(this).find('.tab-content').attr('id', 'fotoTabContent' + index);
                    
                    var urlTab = $(this).find('a[id^="url-tab"]');
                    urlTab.attr('id', 'url-tab' + index);
                    urlTab.attr('href', '#url' + index);
                    
                    var uploadTab = $(this).find('a[id^="upload-tab"]');
                    uploadTab.attr('id', 'upload-tab' + index);
                    uploadTab.attr('href', '#upload' + index);
                    
                    $(this).find('div[id^="url"]').attr('id', 'url' + index);
                    $(this).find('div[id^="upload"]').attr('id', 'upload' + index);
                });
            } else {
                alert('Minimal harus ada satu data staff!');
            }
        });
        
        // Function to update staff numbers in headers
        function updateStaffNumbers() {
            $('.staff-item').each(function(index) {
                $(this).find('.card-header h5').text('Staff #' + (index + 1));
            });
        }
        
        // Image URL preview (delegated event for dynamically added elements)
        $(document).on('input', '.image-url-input', function() {
            var imageUrl = $(this).val().trim();
            var previewContainer = $(this).closest('.row').find('.image-preview');
            
            if (imageUrl) {
                previewContainer.html('<img src="' + imageUrl + '" alt="Preview" class="img-fluid img-thumbnail staff-img" onerror="this.onerror=null;this.src=\'data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22150%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20150%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1890d1c77d5%20text%20%7B%20fill%3A%23999%3Bfont-weight%3Anormal%3Bfont-family%3A-apple-system%2CBlinkMacSystemFont%2C%26quot%3BSegoe%20UI%26quot%3B%2CRoboto%2C%26quot%3BHelvetica%20Neue%26quot%3B%2CArial%2C%26quot%3BNoto%20Sans%26quot%3B%2Csans-serif%2C%26quot%3BApple%20Color%20Emoji%26quot%3B%2C%26quot%3BSegoe%20UI%20Emoji%26quot%3B%2C%26quot%3BSegoe%20UI%20Symbol%26quot%3B%2C%26quot%3BNoto%20Color%20Emoji%26quot%3B%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1890d1c77d5%22%3E%3Crect%20width%3D%22200%22%20height%3D%22150%22%20fill%3D%22%23373940%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2256.1953125%22%20y%3D%2280%22%3EImage%20Error%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E\';">');
            } else {
                previewContainer.html('<div class="no-image-placeholder"><i class="fas fa-user fa-5x text-secondary"></i></div>');
            }
        });
        
        // File input preview
        $(document).on('change', '.image-file-input', function() {
            var file = this.files[0];
            var previewContainer = $(this).closest('.row').find('.image-preview');
            
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    previewContainer.html('<img src="' + e.target.result + '" alt="Preview" class="img-fluid img-thumbnail staff-img">');
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush 