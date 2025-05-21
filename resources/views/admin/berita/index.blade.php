@extends('admin.layouts.app')

@section('title', 'Kelola Berita')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Berita</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Berita
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
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Penulis</th>
                                    <th>Populer</th>
                                    <th style="width: 150px" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($berita as $index => $item)
                                <tr>
                                    <td>{{ $index + $berita->firstItem() }}</td>
                                    <td>{{ Str::limit($item->judul, 50) }}</td>
                                    <td>{{ $item->kategori ? $item->kategori->nama : '-' }}</td>
                                    <td>{{ $item->tanggal->format('d M Y') }}</td>
                                    <td>{{ $item->penulis ?? '-' }}</td>
                                    <td>
                                        @if($item->is_populer)
                                            <span class="badge badge-success">Ya</span>
                                        @else
                                            <span class="badge badge-secondary">Tidak</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
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
                                    <td colspan="7" class="text-center">Tidak ada data berita</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        {{ $berita->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 