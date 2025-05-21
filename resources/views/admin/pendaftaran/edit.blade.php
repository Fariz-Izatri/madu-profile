@extends('admin.layouts.app')

@section('title', 'Edit Informasi Pendaftaran')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Informasi Pendaftaran</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                
                <form action="{{ route('admin.pendaftaran.update', $pendaftaran->id) }}" method="POST" enctype="multipart/form-data">
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
                    
                        <div class="form-group">
                            <label for="judul">Judul Pendaftaran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $pendaftaran->judul) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="tahun_ajaran">Tahun Ajaran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran', $pendaftaran->tahun_ajaran) }}" required>
                            <small class="form-text text-muted">Contoh: 2023/2024</small>
                        </div>

                        <div class="form-group">
                            <label for="tanggal">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', $pendaftaran->tanggal->format('Y-m-d')) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi', $pendaftaran->deskripsi) }}</textarea>
                            <small class="form-text text-muted">Jelaskan secara detail tentang informasi pendaftaran</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="file_panduan">File Panduan</label>
                            @if($pendaftaran->file_panduan)
                                <div class="mb-2">
                                    <a href="{{ $pendaftaran->file_panduan }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="fas fa-file-pdf"></i> Lihat File Panduan Saat Ini
                                    </a>
                                </div>
                            @endif
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file_panduan" name="file_panduan">
                                    <label class="custom-file-label" for="file_panduan">Pilih file baru (opsional)</label>
                                </div>
                            </div>
                            <small class="form-text text-muted">Format: pdf, doc, docx. Maksimal 2MB.</small>
                        </div>
                        
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ $pendaftaran->is_active ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Aktif</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
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
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@endpush 