<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sejarah extends Model
{
    use HasFactory;
    
    protected $table = 'sejarah';
    
    protected $fillable = [
        'title',
        'content',
        'visi',
        'misi',
        'image',
        'image_date',
        'is_active',
    ];
    
    protected $casts = [
        'image_date' => 'date',
        'is_active' => 'boolean',
    ];
}
