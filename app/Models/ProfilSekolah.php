<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    use HasFactory;
    
    protected $table = 'profil_sekolah';
    
    protected $fillable = [
        'nama_sekolah',
        'sambutan_kepala_sekolah',
        'nama_kepala_sekolah',
        'foto_kepala_sekolah',
        'alamat',
        'telepon',
        'email',
        'website',
        'daftar_guru',
        'is_active',
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'daftar_guru' => 'array',
    ];
}
