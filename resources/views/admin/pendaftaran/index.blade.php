@extends('admin.layouts.app')

@section('title', 'Kelola Informasi Pendaftaran')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Informasi Pendaftaran</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.pendaftaran.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Informasi Pendaftaran
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
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 50px">No.</th>
                                    <th>Judul</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Link Pendaftaran</th>
                                    <th>Status</th>
                                    <th style="width: 150px" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pendaftaran as $index => $item)
                                <tr>
                                    <td>{{ $index + $pendaftaran->firstItem() }}</td>
                                    <td>{{ $item->judul }}</td>
                                    <td>{{ $item->tanggal_mulai ? $item->tanggal_mulai->format('d M Y') : '-' }}</td>
                                    <td>{{ $item->tanggal_selesai ? $item->tanggal_selesai->format('d M Y') : '-' }}</td>
                                    <td>
                                        @if($item->link_pendaftaran)
                                            <a href="{{ $item->link_pendaftaran }}" target="_blank" class="btn btn-sm btn-info">
                                                <i class="fas fa-link"></i> Link
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak ada link</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->is_active)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-secondary">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.pendaftaran.edit', $item->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.pendaftaran.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus informasi pendaftaran ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data informasi pendaftaran</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        {{ $pendaftaran->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 