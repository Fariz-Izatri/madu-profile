<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'ekstrakurikuler';
    
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'gambar',
        'jadwal',
        'pembina',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
} 