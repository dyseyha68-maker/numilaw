<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en',
        'title_km',
        'content_en',
        'content_km',
        'type',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title_en');
    }

    public function getTitleAttribute()
    {
        return app()->getLocale() === 'km' ? $this->title_km : $this->title_en;
    }

    public function getContentAttribute()
    {
        return app()->getLocale() === 'km' ? $this->content_km : $this->content_en;
    }
}
