<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlumniEvent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'organizer_id',
        'title_en',
        'title_km',
        'description_en',
        'description_km',
        'content_en',
        'content_km',
        'slug',
        'featured_image',
        'venue',
        'address',
        'start_datetime',
        'end_datetime',
        'contact_email',
        'contact_phone',
        'max_attendees',
        'current_attendees',
        'registration_fee',
        'registration_url',
        'status',
        'is_featured',
        'is_active',
        'gallery_images',
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
        'max_attendees' => 'integer',
        'current_attendees' => 'integer',
        'registration_fee' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'gallery_images' => 'array',
    ];

    // Relationships
    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id');
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

    public function scopeUpcoming($query)
    {
        return $query->where('start_datetime', '>', now());
    }

    public function scopePast($query)
    {
        return $query->where('start_datetime', '<', now());
    }

    public function scopeOngoing($query)
    {
        return $query->where('start_datetime', '<=', now())
                    ->where('end_datetime', '>=', now());
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Accessors
    public function getTitleAttribute()
    {
        return app()->getLocale() === 'km' && $this->title_km ? $this->title_km : $this->title_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() === 'km' && $this->description_km ? $this->description_km : $this->description_en;
    }

    public function getContentAttribute()
    {
        return app()->getLocale() === 'km' && $this->content_km ? $this->content_km : $this->content_en;
    }

    public function getFeaturedImageUrlAttribute()
    {
        return $this->featured_image ? asset('storage/' . $this->featured_image) : null;
    }

    public function getGalleryImagesUrlsAttribute()
    {
        if (!$this->gallery_images) {
            return [];
        }

        return collect($this->gallery_images)->map(function ($image) {
            return asset('storage/' . $image);
        })->toArray();
    }

    public function getFormattedDateAttribute()
    {
        return $this->start_datetime->format('F j, Y');
    }

    public function getFormattedTimeAttribute()
    {
        return $this->start_datetime->format('g:i A') . ' - ' . $this->end_datetime->format('g:i A');
    }

    public function getFullDateTimeAttribute()
    {
        return $this->start_datetime->format('F j, Y') . ' at ' . $this->start_datetime->format('g:i A');
    }

    public function getDurationAttribute()
    {
        $start = $this->start_datetime;
        $end = $this->end_datetime;
        
        if ($start->format('Y-m-d') === $end->format('Y-m-d')) {
            return $start->format('M j') . ', ' . $start->format('g:i A') . ' - ' . $end->format('g:i A');
        } else {
            return $start->format('M j, g:i A') . ' - ' . $end->format('M j, g:i A');
        }
    }

    public function getStatusDisplayAttribute()
    {
        $statuses = [
            'upcoming' => app()->getLocale() === 'km' ? 'មកដល់ខាងមុខ' : 'Upcoming',
            'ongoing' => app()->getLocale() === 'km' ? 'កំពុងដំណើរការ' : 'Ongoing',
            'completed' => app()->getLocale() === 'km' ? '�ានបញ្ចប់' : 'Completed',
            'cancelled' => app()->getLocale() === 'km' ? 'បានលុបចោល' : 'Cancelled',
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    public function getIsFreeAttribute()
    {
        return $this->registration_fee == 0;
    }

    public function getHasAvailabilityAttribute()
    {
        return $this->max_attendees === null || $this->current_attendees < $this->max_attendees;
    }

    public function getAvailableSlotsAttribute()
    {
        if ($this->max_attendees === null) {
            return null; // Unlimited
        }

        return max(0, $this->max_attendees - $this->current_attendees);
    }

    public function getIsSoldOutAttribute()
    {
        return $this->max_attendees && $this->current_attendees >= $this->max_attendees;
    }

    public function getRegistrationStatusAttribute()
    {
        if (!$this->is_active) {
            return 'inactive';
        }

        if ($this->status === 'cancelled') {
            return 'cancelled';
        }

        if ($this->start_datetime->isPast()) {
            return 'closed';
        }

        if ($this->is_sold_out) {
            return 'sold_out';
        }

        return 'open';
    }

    // Methods
    public function updateStatus()
    {
        $now = now();

        if ($now->between($this->start_datetime, $this->end_datetime)) {
            $this->status = 'ongoing';
        } elseif ($now->greaterThan($this->end_datetime)) {
            $this->status = 'completed';
        } elseif ($now->lessThan($this->start_datetime)) {
            $this->status = 'upcoming';
        }

        $this->save();
    }

    public function registerAttendee()
    {
        if ($this->has_availability) {
            $this->increment('current_attendees');
            return true;
        }

        return false;
    }

    public function cancelRegistration()
    {
        if ($this->current_attendees > 0) {
            $this->decrement('current_attendees');
            return true;
        }

        return false;
    }

    public function cancel()
    {
        $this->status = 'cancelled';
        $this->save();
    }

    public function toggleFeatured()
    {
        $this->is_featured = !$this->is_featured;
        $this->save();
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('title_en', 'like', "%{$term}%")
              ->orWhere('title_km', 'like', "%{$term}%")
              ->orWhere('description_en', 'like', "%{$term}%")
              ->orWhere('description_km', 'like', "%{$term}%")
              ->orWhere('venue', 'like', "%{$term}%");
        });
    }
}