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
        'description',
        'date',
        'time',
        'images',
        'highlight_description_1',
        'highlight_description_2',
        'is_completed',
    ];

    protected $casts = [
        'date' => 'date',
        'images' => 'array',
        'is_completed' => 'boolean',
    ];

    /**
     * Scope a query to only include upcoming events.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', Carbon::today())
                    ->where('is_completed', false)
                    ->orderBy('date', 'asc');
    }

    /**
     * Scope a query to only include completed events.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true)
                    ->orderBy('date', 'desc');
    }
} 