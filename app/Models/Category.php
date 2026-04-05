<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_km',
        'slug',
        'description_en',
        'description_km',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
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
