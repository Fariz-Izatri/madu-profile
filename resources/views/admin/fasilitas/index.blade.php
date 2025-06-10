@extends('admin.layouts.app')

@section('title', 'Daftar Fasilitas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Fasilitas</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Fasilitas
                        </a>
                    </div>
                </div>
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
                
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="10%">Gambar</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th width="8%">Urutan</th>
                                    <th width="8%">Status</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($fasilitas) > 0)
                                    @foreach($fasilitas as $key => $item)
                                        <tr>
                                            <td>{{ $fasilitas->firstItem() + $key }}</td>
                                            <td>
                                                @if($item->gambar && file_exists(public_path(ltrim($item->gambar, '/'))))
                                                    <img src="{{ $item->gambar }}" class="img-thumbnail" alt="{{ $item->nama }}">
                                                @else
                                                    <img src="{{ asset('images/placeholder.png') }}" class="img-thumbnail" alt="Placeholder">
                                                @endif
                                            </td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ Str::limit($item->deskripsi, 100) }}</td>
                                            <td>{{ $item->urutan }}</td>
                                            <td>
                                                @if($item->is_active)
                                                    <span class="badge badge-success">Aktif</span>
                                                @else
                                                    <span class="badge badge-secondary">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.fasilitas.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.fasilitas.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data fasilitas</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $fasilitas->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table img.img-thumbnail {
        max-width: 100px;
        max-height: 80px;
        object-fit: cover;
    }
</style>
@endpush 