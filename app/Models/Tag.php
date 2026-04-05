<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_km',
        'description_en',
        'description_km',
        'color',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            if (empty($tag->slug)) {
                $tag->slug = Str::slug($tag->name_en);
            }
        });

        static::updating(function ($tag) {
            if ($tag->isDirty('name_en') && empty($tag->slug)) {
                $tag->slug = Str::slug($tag->name_en);
            }
        });
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getNameAttribute()
    {
        return app()->getLocale() === 'km' ? $this->name_km : $this->name_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() === 'km' ? $this->description_km : $this->description_en;
    }
}
