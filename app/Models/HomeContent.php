<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    use HasFactory;

    protected $table = 'home_contents';
    
    protected $fillable = [
        'section',
        'title',
        'subtitle',
        'content',
        'image',
        'button_text',
        'button_link',
        'is_active',
        'order',
        'author_name',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'integer',
        'content' => 'array',
    ];
    
    /**
     * Get content for a specific section
     * 
     * @param string $section
     * @return HomeContent|null
     */
    public static function getSection(string $section)
    {
        return self::where('section', $section)
                   ->where('is_active', true)
                   ->first();
    }
    
    /**
     * Get all content for a specific section
     * 
     * @param string $section
     * @return Collection
     */
    public static function getAllSection(string $section)
    {
        return self::where('section', $section)
                   ->where('is_active', true)
                   ->orderBy('order')
                   ->get();
    }
    
    /**
     * Get all testimonials
     * 
     * @return Collection
     */
    public static function getTestimonials()
    {
        return self::where('section', 'testimonial')
                   ->where('is_active', true)
                   ->orderBy('order')
                   ->get();
    }
} 