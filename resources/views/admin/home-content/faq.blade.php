@extends('admin.layouts.app')

@section('title', 'Kelola Tanya Jawab')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kelola Tanya Jawab (FAQ)</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.home-content.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                @if($faq)
                    <form action="{{ route('admin.home-content.faq.update', $faq->id) }}" method="POST">
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
                            
                            <div class="form-group">
                                <label for="title">Judul Bagian (Tanya Jawab)</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $faq->title) }}" required>
                                @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <div class="custom-control custom-switch mb-3">
                                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ old('is_active', $faq->is_active) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_active">Aktif</label>
                                </div>
                            </div>
                            
                            <h4>Daftar Pertanyaan</h4>
                            <div class="faq-items">
                                @forelse($faqItems as $index => $item)
                                    <div class="card card-outline card-info mb-3 faq-item">
                                        <div class="card-header">
                                            <h3 class="card-title">Pertanyaan #{{ $index + 1 }}</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-danger btn-sm remove-faq">
                                                    <i class="fas fa-times"></i> Hapus
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Pertanyaan</label>
                                                <input type="text" class="form-control" name="faq_items[{{ $index }}][question]" value="{{ $item['question'] }}" required>
                                            </div>
                                            <div class="form-group mb-0">
                                                <label>Jawaban</label>
                                                <textarea class="form-control" name="faq_items[{{ $index }}][answer]" rows="3" required>{{ $item['answer'] }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="card card-outline card-info mb-3 faq-item">
                                        <div class="card-header">
                                            <h3 class="card-title">Pertanyaan #1</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-danger btn-sm remove-faq">
                                                    <i class="fas fa-times"></i> Hapus
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Pertanyaan</label>
                                                <input type="text" class="form-control" name="faq_items[0][question]" required>
                                            </div>
                                            <div class="form-group mb-0">
                                                <label>Jawaban</label>
                                                <textarea class="form-control" name="faq_items[0][answer]" rows="3" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                            
                            <button type="button" class="btn btn-success btn-sm add-faq mt-2">
                                <i class="fas fa-plus"></i> Tambah Pertanyaan
                            </button>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                @else
                    <div class="card-body">
                        <div class="alert alert-info">
                            Data Tanya Jawab tidak ditemukan.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Add new FAQ item
        $('.add-faq').click(function() {
            var index = $('.faq-item').length;
            var newItem = `
                <div class="card card-outline card-info mb-3 faq-item">
                    <div class="card-header">
                        <h3 class="card-title">Pertanyaan #${index + 1}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-danger btn-sm remove-faq">
                                <i class="fas fa-times"></i> Hapus
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Pertanyaan</label>
                            <input type="text" class="form-control" name="faq_items[${index}][question]" required>
                        </div>
                        <div class="form-group mb-0">
                            <label>Jawaban</label>
                            <textarea class="form-control" name="faq_items[${index}][answer]" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
            `;
            $('.faq-items').append(newItem);
            updateFaqIndexes();
        });
        
        // Remove FAQ item
        $(document).on('click', '.remove-faq', function() {
            // Prevent removing if it's the only item
            if ($('.faq-item').length > 1) {
                $(this).closest('.faq-item').remove();
                updateFaqIndexes();
            } else {
                alert('Minimal harus ada satu pertanyaan.');
            }
        });
        
        // Update FAQ indexes after adding/removing
        function updateFaqIndexes() {
            $('.faq-item').each(function(index) {
                $(this).find('.card-title').text('Pertanyaan #' + (index + 1));
                $(this).find('input').attr('name', 'faq_items[' + index + '][question]');
                $(this).find('textarea').attr('name', 'faq_items[' + index + '][answer]');
            });
        }
    });
</script>
@endpush 