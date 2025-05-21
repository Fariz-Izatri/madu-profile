@extends('admin.layouts.app')

@section('title', 'Kelola Prestasi Chart')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kelola Prestasi Chart</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.home-content.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                
                <form action="{{ route('admin.home-content.prestasi-chart.update', $prestasiChart->id) }}" method="POST">
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
                            <label for="title">Judul</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $prestasiChart->title) }}">
                        </div>
                        
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ $prestasiChart->is_active ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Aktif</label>
                            </div>
                        </div>
                        
                        <hr>
                        <h5>Item Prestasi Chart</h5>
                        <p class="text-muted">Tambahkan item yang akan ditampilkan pada bagian prestasi chart.</p>
                        
                        <div id="chart-items-container">
                            @forelse($chartItems as $index => $item)
                                <div class="card card-outline card-info chart-item-card mb-3">
                                    <div class="card-header">
                                        <h3 class="card-title">Item #{{ $index + 1 }}</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-danger btn-sm remove-chart-item" {{ count($chartItems) <= 1 ? 'disabled' : '' }}>
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Label</label>
                                            <input type="text" class="form-control" name="chart_items[{{ $index }}][label]" value="{{ $item['label'] ?? '' }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <input type="number" class="form-control" name="chart_items[{{ $index }}][count]" value="{{ $item['count'] ?? 0 }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Icon</label>
                                            <input type="text" class="form-control" name="chart_items[{{ $index }}][icon]" value="{{ $item['icon'] ?? '' }}" placeholder="chart-icon_1.png">
                                            <small class="form-text text-muted">Nama file ikon yang tersimpan di folder public/images.</small>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="card card-outline card-info chart-item-card mb-3">
                                    <div class="card-header">
                                        <h3 class="card-title">Item #1</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-danger btn-sm remove-chart-item" disabled>
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Label</label>
                                            <input type="text" class="form-control" name="chart_items[0][label]" value="Guru" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <input type="number" class="form-control" name="chart_items[0][count]" value="39" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Icon</label>
                                            <input type="text" class="form-control" name="chart_items[0][icon]" value="chart-icon_1.png" placeholder="chart-icon_1.png">
                                            <small class="form-text text-muted">Nama file ikon yang tersimpan di folder public/images.</small>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        
                        <button type="button" id="add-chart-item" class="btn btn-success">
                            <i class="fas fa-plus"></i> Tambah Item
                        </button>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.home-content.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
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
        // Add new chart item
        $('#add-chart-item').on('click', function() {
            const index = $('.chart-item-card').length;
            const newItem = `
                <div class="card card-outline card-info chart-item-card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Item #${index + 1}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-danger btn-sm remove-chart-item">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Label</label>
                            <input type="text" class="form-control" name="chart_items[${index}][label]" required>
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" class="form-control" name="chart_items[${index}][count]" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>Icon</label>
                            <input type="text" class="form-control" name="chart_items[${index}][icon]" placeholder="chart-icon_1.png">
                            <small class="form-text text-muted">Nama file ikon yang tersimpan di folder public/images.</small>
                        </div>
                    </div>
                </div>
            `;
            
            $('#chart-items-container').append(newItem);
            
            // Enable all remove buttons
            $('.remove-chart-item').prop('disabled', false);
        });
        
        // Remove chart item
        $(document).on('click', '.remove-chart-item', function() {
            $(this).closest('.chart-item-card').remove();
            
            // Update item numbers
            $('.chart-item-card').each(function(index) {
                $(this).find('.card-title').text(`Item #${index + 1}`);
            });
            
            // If only one item left, disable its remove button
            if ($('.chart-item-card').length <= 1) {
                $('.remove-chart-item').prop('disabled', true);
            }
            
            // Update input names with new indices
            $('.chart-item-card').each(function(index) {
                $(this).find('input').each(function() {
                    const name = $(this).attr('name').replace(/chart_items\[\d+\]/, `chart_items[${index}]`);
                    $(this).attr('name', name);
                });
            });
        });
    });
</script>
@endpush 