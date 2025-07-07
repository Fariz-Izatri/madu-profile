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
     * Get the combined event datetime (date + time).
     *
     * @return \Carbon\Carbon
     */
    public function getEventDateTimeAttribute()
    {
        // If event_time is null, default to 00:00:00
        $time = $this->event_time ?? '00:00:00';
        return $this->event_date->copy()->setTimeFromTimeString($time);
    }

    /**
     * Scope a query to only include upcoming events (date+time >= now).
     */
    public function scopeUpcoming($query)
    {
        return $query->whereRaw("STR_TO_DATE(CONCAT(event_date, ' ', IFNULL(event_time, '00:00:00')), '%Y-%m-%d %H:%i:%s') >= ?", [now()])
                    ->orderBy('event_date', 'asc');
    }

    /**
     * Scope a query to only include completed events (date+time < now).
     */
    public function scopeCompleted($query)
    {
        return $query->whereRaw("STR_TO_DATE(CONCAT(event_date, ' ', IFNULL(event_time, '00:00:00')), '%Y-%m-%d %H:%i:%s') < ?", [now()])
                    ->orderBy('event_date', 'desc');
    }

    /**
     * Get the is_completed attribute (date+time < now).
     *
     * @return bool
     */
    public function getIsCompletedAttribute()
    {
        $time = $this->event_time ?? '00:00:00';
        return $this->event_date->copy()->setTimeFromTimeString($time)->lt(now());
    }
} 