<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas';
    
    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
        'is_active',
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
    ];
    
    /**
     * Scope untuk fasilitas aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }
    
    /**
     * Scope untuk mengurutkan fasilitas
     */
    public function scopeUrutan($query)
    {
        return $query->orderBy('id', 'asc');
    }
}
