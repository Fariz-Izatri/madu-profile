<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';
    
    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'external_link',
        'tanggal',
        'penulis',
        'is_populer',
        'kategori_id',
        'gambar'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'is_populer' => 'boolean',
    ];

    /**
     * Relasi ke kategori
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id');
    }

    /**
     * Scope berita populer
     */
    public function scopePopuler($query)
    {
        return $query->where('is_populer', true)
                     ->latest('tanggal');
    }

    /**
     * Scope filter berdasarkan kategori
     */
    public function scopeKategori($query, $kategoriSlug)
    {
        return $query->whereHas('kategori', function($q) use ($kategoriSlug) {
            $q->where('slug', $kategoriSlug);
        });
    }

    /**
     * Scope pencarian
     */
    public function scopeCari($query, $kataKunci)
    {
        return $query->where('judul', 'like', "%{$kataKunci}%")
                     ->orWhere('konten', 'like', "%{$kataKunci}%");
    }
} 