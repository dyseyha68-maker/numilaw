<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    use HasFactory;

    protected $fillable = [
        'slide_key',
        'order',
        'title_en',
        'title_km',
        'subtitle_en',
        'subtitle_km',
        'description_en',
        'description_km',
        'image',
        'image_alt_en',
        'image_alt_km',
        'button_text_en',
        'button_text_km',
        'button_url',
        'button_icon',
        'secondary_button_text_en',
        'secondary_button_text_km',
        'secondary_button_url',
        'theme',
        'use_theme',
        'content_position',
        'show_content',
        'overlay_opacity',
        'show_animation',
        'animation_type',
        'is_active',
        'publish_at',
        'expire_at',
        'view_count',
        'meta_title_en',
        'meta_title_km',
        'meta_description_en',
        'meta_description_km',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_animation' => 'boolean',
        'use_theme' => 'boolean',
        'show_content' => 'boolean',
        'publish_at' => 'datetime',
        'expire_at' => 'datetime',
        'view_count' => 'integer',
        'order' => 'integer',
    ];

    public function getTitleAttribute(): string
    {
        return app()->getLocale() === 'km' ? $this->title_km : $this->title_en;
    }

    public function getSubtitleAttribute(): ?string
    {
        $field = app()->getLocale() === 'km' ? 'subtitle_km' : 'subtitle_en';
        return $this->{$field};
    }

    public function getDescriptionAttribute(): ?string
    {
        $field = app()->getLocale() === 'km' ? 'description_km' : 'description_en';
        return $this->{$field};
    }

    public function getButtonTextAttribute(): ?string
    {
        return app()->getLocale() === 'km' ? $this->button_text_km : $this->button_text_en;
    }

    public function getSecondaryButtonTextAttribute(): ?string
    {
        return app()->getLocale() === 'km' ? $this->secondary_button_text_km : $this->secondary_button_text_en;
    }

    public function getImageAltAttribute(): ?string
    {
        return app()->getLocale() === 'km' ? $this->image_alt_km : $this->image_alt_en;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('publish_at')
                    ->orWhere('publish_at', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('expire_at')
                    ->orWhere('expire_at', '>=', now());
            });
    }

    public function scopeForPage($query, string $pageKey)
    {
        return $query->where('slide_key', $pageKey);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public static function getSlidesForPage(string $pageKey): \Illuminate\Database\Eloquent\Collection
    {
        return self::forPage($pageKey)
            ->active()
            ->ordered()
            ->get();
    }

    public static function getThemes(): array
    {
        return [
            'burgundy' => [
                'name' => 'Burgundy',
                'primary' => '#003A46',
                'secondary' => '#C5A028',
                'text' => '#FFFFFF',
                'description' => 'Deep teal with gold accents - Legal prestige',
            ],
            'gold' => [
                'name' => 'Gold',
                'primary' => '#C5A028',
                'secondary' => '#003A46',
                'text' => '#2C2C2C',
                'description' => 'Gold primary with teal - Excellence',
            ],
            'cream' => [
                'name' => 'Cream',
                'primary' => '#F5F0E6',
                'secondary' => '#003A46',
                'text' => '#2C2C2C',
                'description' => 'Cream background - Elegant & readable',
            ],
            'dark' => [
                'name' => 'Dark',
                'primary' => '#2C2C2C',
                'secondary' => '#C5A028',
                'text' => '#FFFFFF',
                'description' => 'Dark charcoal - Modern & authoritative',
            ],
            'gradient' => [
                'name' => 'Gradient',
                'primary' => 'linear-gradient(135deg, #003A46 0%, #002830 100%)',
                'secondary' => '#C5A028',
                'text' => '#FFFFFF',
                'description' => 'Teal gradient - Rich & depth',
            ],
        ];
    }

    public static function getOverlayOpacities(): array
    {
        return [
            'none' => 'None',
            'light' => 'Light (20%)',
            'medium' => 'Medium (40%)',
            'heavy' => 'Heavy (60%)',
        ];
    }

    public static function getAnimationTypes(): array
    {
        return [
            'fade' => 'Fade',
            'slide-left' => 'Slide from Left',
            'slide-right' => 'Slide from Right',
            'slide-up' => 'Slide Up',
            'slide-down' => 'Slide Down',
            'zoom' => 'Zoom In',
            'zoom-out' => 'Zoom Out',
        ];
    }

    public function incrementViewCount(): void
    {
        $this->increment('view_count');
    }
}
