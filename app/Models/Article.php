<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title_en',
        'title_km',
        'slug',
        'content_en',
        'content_km',
        'excerpt_en',
        'excerpt_km',
        'featured_image',
        'gallery_images',
        'status',
        'is_featured',
        'author_id',
        'category_id',
        'project_id',
        'published_at',
        'views',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'views' => 'integer',
        'gallery_images' => 'array',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getTitleAttribute()
    {
        return app()->getLocale() === 'km' ? $this->title_km : $this->title_en;
    }

    public function getContentAttribute()
    {
        return app()->getLocale() === 'km' ? $this->content_km : $this->content_en;
    }

    public function getExcerptAttribute()
    {
        return app()->getLocale() === 'km' ? $this->excerpt_km : $this->excerpt_en;
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function getGalleryImagesAttribute($value)
    {
        if (empty($value)) {
            return [];
        }

        $images = is_array($value) ? $value : json_decode($value, true) ?? [];
        
        return array_map(function ($image) {
            if (substr($image, 0, 4) === 'http') {
                return $image;
            }
            return url('/laravel-img/'.$image);
        }, $images);
    }
}
