<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CampusGallery extends Model
{
    protected $fillable = [
        'title_en',
        'title_kh',
        'media_path',
        'media_type',
        'category',
        'year',
        'caption_en',
        'caption_kh',
    ];

    protected $casts = [
        'year' => 'integer',
    ];

    public function scopeApproved($query)
    {
        return $query;
    }

    public function getMediaUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->media_path);
    }
}
