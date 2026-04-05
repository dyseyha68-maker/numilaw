<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSettings extends Model
{
    use HasFactory;

    protected $table = 'hero_settings';

    protected $fillable = [
        'page_key',
        'title',
        'image',
        'default_image',
        'is_active',
        'section_type',
        'enable_slideshow',
        'slideshow_interval',
        'slideshow_autoplay',
        'slideshow_navigation',
        'slideshow_pagination',
        'height',
        'content_position',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'enable_slideshow' => 'boolean',
        'slideshow_autoplay' => 'boolean',
        'slideshow_navigation' => 'boolean',
        'slideshow_pagination' => 'boolean',
        'slideshow_interval' => 'integer',
    ];

    public static function getImageForPage(string $pageKey): ?string
    {
        $heroImage = self::where('page_key', $pageKey)
            ->where('is_active', true)
            ->first();

        if ($heroImage && $heroImage->image) {
            return $heroImage->image;
        }

        return null;
    }

    public static function getDefaultImage(string $pageKey): ?string
    {
        $heroImage = self::where('page_key', $pageKey)->first();
        return $heroImage?->default_image;
    }

    public static function getSettingsForPage(string $pageKey): ?self
    {
        return self::where('page_key', $pageKey)->first();
    }

    public static function getHeights(): array
    {
        return [
            '30vh' => '30% - Small',
            '50vh' => '50% - Half Screen',
            '70vh' => '70% - Tall',
            '85vh' => '85% - Almost Full',
            '100vh' => '100% - Full Screen',
            'auto' => 'Auto Height',
        ];
    }

    public static function getContentPositions(): array
    {
        return [
            'left' => 'Left',
            'center' => 'Center',
            'right' => 'Right',
        ];
    }

    public static function getSectionTypes(): array
    {
        return [
            'single' => 'Single Image',
            'slideshow' => 'Slideshow',
            'video' => 'Video Background',
            'carousel' => 'Carousel',
        ];
    }
}
