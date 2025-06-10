@extends('admin.layouts.app')

@section('title', 'Edit Konten Sejarah')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Konten Sejarah</h3>
                </div>
                
                <form action="{{ route('admin.sejarah.update', $sejarah->id) }}" method="POST" enctype="multipart/form-data">
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
                        
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                {{ session('error') }}
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
                        
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="sejarah-tab" data-toggle="tab" href="#sejarah" role="tab" aria-controls="sejarah" aria-selected="true">Sejarah</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="visi-misi-tab" data-toggle="tab" href="#visi-misi" role="tab" aria-controls="visi-misi" aria-selected="false">Visi & Misi</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="sejarah" role="tabpanel" aria-labelledby="sejarah-tab">
                                <div class="form-group">
                                    <label for="title">Judul <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $sejarah->title) }}" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="content">Konten Sejarah <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="content" name="content" rows="10" required>{{ old('content', $sejarah->content) }}</textarea>
                                    <small class="form-text text-muted">Tuliskan konten sejarah di sini. Anda dapat menggunakan format baris baru untuk paragraf.</small>
                                </div>
                                
                                <div class="form-group">
                                    <label for="image">Gambar</label>
                                    @if($sejarah->image)
                                        <div class="mb-2">
                                            <img src="{{ $sejarah->image }}" alt="{{ $sejarah->title }}" class="img-thumbnail" style="max-height: 200px;">
                                        </div>
                                    @endif
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image">
                                            <label class="custom-file-label" for="image">Pilih gambar baru (opsional)</label>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Format: jpg, jpeg, png, gif. Maksimal 2MB.</small>
                                </div>
                                
                                <div class="form-group">
                                    <label for="image_date">Tanggal Gambar</label>
                                    <input type="date" class="form-control" id="image_date" name="image_date" value="{{ old('image_date', $sejarah->image_date ? $sejarah->image_date->format('Y-m-d') : '') }}">
                                    <small class="form-text text-muted">Tanggal yang ditampilkan pada gambar (opsional).</small>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="visi-misi" role="tabpanel" aria-labelledby="visi-misi-tab">
                                <div class="form-group">
                                    <label for="visi">Visi <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="visi" name="visi" rows="5" required>{{ old('visi', $sejarah->visi) }}</textarea>
                                    <small class="form-text text-muted">Tuliskan visi sekolah di sini.</small>
                                </div>
                                
                                <div class="form-group">
                                    <label for="misi">Misi <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="misi" name="misi" rows="10" required>{{ old('misi', $sejarah->misi) }}</textarea>
                                    <small class="form-text text-muted">Tuliskan misi sekolah di sini. Gunakan baris baru untuk memisahkan setiap poin misi.</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ $sejarah->is_active ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Aktif</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
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
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
        
        // Activate tab based on hash
        var hash = window.location.hash;
        if (hash) {
            $('.nav-tabs a[href="' + hash + '"]').tab('show');
        }
        
        // Change hash on tab change
        $('.nav-tabs a').on('shown.bs.tab', function (e) {
            window.location.hash = e.target.hash;
        });
    });
</script>
@endpush 