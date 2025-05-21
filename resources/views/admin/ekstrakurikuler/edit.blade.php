@extends('admin.layouts.app')

@section('title', 'Edit Ekstrakurikuler')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Ekstrakurikuler: {{ $ekstrakurikuler->nama }}</h3>
                </div>
                
                <form action="{{ route('admin.ekstrakurikuler.update', $ekstrakurikuler->id) }}" method="POST" enctype="multipart/form-data">
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
                            <label for="nama">Nama Ekstrakurikuler <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $ekstrakurikuler->nama) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="pembina">Pembina</label>
                            <input type="text" class="form-control" id="pembina" name="pembina" value="{{ old('pembina', $ekstrakurikuler->pembina) }}">
                            <small class="form-text text-muted">Nama lengkap pembina ekstrakurikuler</small>
                        </div>

                        <div class="form-group">
                            <label for="jadwal">Jadwal</label>
                            <input type="text" class="form-control" id="jadwal" name="jadwal" value="{{ old('jadwal', $ekstrakurikuler->jadwal) }}">
                            <small class="form-text text-muted">Contoh: Setiap hari Senin, 15.00-17.00 WIB</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi', $ekstrakurikuler->deskripsi) }}</textarea>
                            <small class="form-text text-muted">Jelaskan secara detail tentang ekstrakurikuler ini</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            @if($ekstrakurikuler->gambar)
                                <div class="mb-2">
                                    <img src="{{ $ekstrakurikuler->gambar }}" alt="{{ $ekstrakurikuler->nama }}" class="img-thumbnail" style="max-height: 200px;">
                                </div>
                            @endif
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                    <label class="custom-file-label" for="gambar">Pilih gambar baru (opsional)</label>
                                </div>
                            </div>
                            <small class="form-text text-muted">Format: jpg, jpeg, png, gif. Maksimal 2MB.</small>
                        </div>
                        
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ $ekstrakurikuler->is_active ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Aktif</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn btn-secondary">
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