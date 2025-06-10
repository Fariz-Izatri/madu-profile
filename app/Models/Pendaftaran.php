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
        'tanggal_mulai',
        'tanggal_selesai',
        'link_pendaftaran',
        'kontak_pendaftaran',
        'is_active',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'is_active' => 'boolean',
    ];
} 