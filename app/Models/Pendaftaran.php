<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';
    
    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'tanggal',
        'tahun_ajaran',
        'file_panduan',
        'is_active',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'is_active' => 'boolean',
    ];
} 