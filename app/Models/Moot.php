<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Moot extends Model
{
    protected $fillable = [
        'name_en',
        'name_km',
        'slug',
        'short_name',
        'acronym',
        'description_en',
        'description_km',
        'official_url',
        'organizing_body_en',
        'organizing_body_km',
        'logo_path',
        'cover_image_path',
        'case_file_path',
        'first_participation_year',
        'is_active',
        'is_featured',
        'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'first_participation_year' => 'integer',
        'display_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($moot) {
            if (empty($moot->slug)) {
                $moot->slug = Str::slug($moot->name_en);
            }
        });

        static::updating(function ($moot) {
            if ($moot->isDirty('name_en') && empty($moot->slug)) {
                $moot->slug = Str::slug($moot->name_en);
            }
        });
    }

    public function participations(): HasMany
    {
        return $this->hasMany(MootParticipation::class, 'moot_id')->orderBy('year', 'desc');
    }

    public function publishedParticipations(): HasMany
    {
        return $this->hasMany(MootParticipation::class, 'moot_id')
            ->where('is_published', true)
            ->orderBy('year', 'desc');
    }

    public function getLatestParticipation(): ?MootParticipation
    {
        return $this->participations()->first();
    }

    public function getNameAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'km' ? $this->name_km : $this->name_en;
    }

    public function getDescriptionAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'km' ? $this->description_km : $this->description_en;
    }

    public function getYearsParticipated(): array
    {
        return $this->participations()->pluck('year')->toArray();
    }

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
        return $query->orderBy('display_order')->orderBy('name_en');
    }
}
