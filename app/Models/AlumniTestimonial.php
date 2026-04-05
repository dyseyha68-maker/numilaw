<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlumniTestimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'alumni_id',
        'title_en',
        'title_km',
        'content_en',
        'content_km',
        'photo',
        'company_at_time',
        'position_at_time',
        'sort_order',
        'is_featured',
        'is_active',
        'featured_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'featured_at' => 'datetime',
        'sort_order' => 'integer',
    ];

    // Relationships
    public function alumni(): BelongsTo
    {
        return $this->belongsTo(Alumni::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    // Accessors
    public function getTitleAttribute()
    {
        return app()->getLocale() === 'km' && $this->title_km ? $this->title_km : $this->title_en;
    }

    public function getContentAttribute()
    {
        return app()->getLocale() === 'km' && $this->content_km ? $this->content_km : $this->content_en;
    }

    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }

        return $this->alumni ? $this->alumni->profile_image_url : null;
    }

    public function getAlumniNameAttribute()
    {
        return $this->alumni ? $this->alumni->full_name : null;
    }

    public function getAlumniGraduationYearAttribute()
    {
        return $this->alumni ? $this->alumni->graduation_year : null;
    }

    // Methods
    public function toggleFeatured()
    {
        $this->is_featured = !$this->is_featured;
        $this->featured_at = $this->is_featured ? now() : null;
        $this->save();
    }

    public function activate()
    {
        $this->is_active = true;
        $this->save();
    }

    public function deactivate()
    {
        $this->is_active = false;
        $this->save();
    }
}