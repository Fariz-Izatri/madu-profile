@extends('admin.layouts.app')

@section('title', 'Edit Pengumuman')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Pengumuman: {{ $event->title }}</h3>
                </div>
                
                <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
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
                            <label for="title">Judul Pengumuman <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $event->title) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="event_date">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="event_date" name="event_date" value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="event_time">Waktu <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="event_time" name="event_time" value="{{ old('event_time', $event->event_time) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="location">Lokasi</label>
                            <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $event->location) }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description', $event->description) }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="image">Gambar</label>
                            @if($event->image)
                                <div class="mb-2">
                                    <img src="{{ $event->image }}" alt="{{ $event->title }}" class="img-thumbnail" style="max-height: 200px">
                                </div>
                            @endif
                            <input type="file" class="form-control-file" id="image" name="image">
                            <small class="form-text text-muted">Upload gambar baru untuk mengganti gambar saat ini (opsional).</small>
                        </div>
                        
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $event->is_featured) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_featured">Tampilkan di Beranda</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $event->is_active) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Aktif</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> Status pengumuman (Mendatang/Selesai) akan ditentukan secara otomatis berdasarkan tanggal.
                                @if($event->is_completed)
                                <div class="mt-2">
                                    <strong>Status saat ini:</strong> <span class="badge badge-secondary">Selesai</span> (Tanggal sudah lewat)
                                </div>
                                @else
                                <div class="mt-2">
                                    <strong>Status saat ini:</strong> <span class="badge badge-success">Mendatang</span> (Tanggal belum lewat)
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

 