@extends('admin.layouts.app')

@section('title', 'Kelola Hero Slider')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kelola Hero Slider</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.home-content.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
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
                    
                    <div class="row">
                        @forelse($heroSlides as $slide)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="position-relative">
                                        @if(Str::startsWith($slide->image, 'images/'))
                                            <img src="{{ asset($slide->image) }}" class="card-img-top" alt="{{ $slide->title }}">
                                        @else
                                            <img src="{{ $slide->image }}" class="card-img-top" alt="{{ $slide->title }}">
                                        @endif
                                        @if(!$slide->is_active)
                                            <div class="ribbon-wrapper ribbon-lg">
                                                <div class="ribbon bg-danger">
                                                    Tidak Aktif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $slide->title }}</h5>
                                        <p class="card-text">{{ Str::limit($slide->subtitle, 100) }}</p>
                                        <a href="{{ route('admin.home-content.hero.edit', $slide->id) }}" class="btn btn-primary btn-block">Edit Slide</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    Tidak ada slide yang tersedia.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 