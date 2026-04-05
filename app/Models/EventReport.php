<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'event_id',
        'title_en',
        'title_km',
        'slug',
        'content_en',
        'content_km',
        'summary_en',
        'summary_km',
        'photo_gallery',
        'author_id',
        'status',
        'published_at',
        'views',
    ];

    protected $casts = [
        'photo_gallery' => 'array',
        'published_at' => 'datetime',
        'views' => 'integer',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function getTitleAttribute()
    {
        return app()->getLocale() === 'km' ? $this->title_km : $this->title_en;
    }

    public function getContentAttribute()
    {
        return app()->getLocale() === 'km' ? $this->content_km : $this->content_en;
    }

    public function getSummaryAttribute()
    {
        return app()->getLocale() === 'km' ? $this->summary_km : $this->summary_en;
    }

    public function incrementViews()
    {
        $this->increment('views');
    }
}
