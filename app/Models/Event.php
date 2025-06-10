<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'event_date',
        'event_time',
        'location',
        'image',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Scope a query to only include upcoming events.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', Carbon::today())
                    ->orderBy('event_date', 'asc'); // Closest dates first
    }

    /**
     * Scope a query to only include completed events.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->where('event_date', '<', Carbon::today())
                    ->orderBy('event_date', 'desc');
    }
    
    /**
     * Get the is_completed attribute.
     * Events are automatically considered completed if their date is in the past.
     *
     * @return bool
     */
    public function getIsCompletedAttribute()
    {
        return $this->event_date < Carbon::today();
    }
} 