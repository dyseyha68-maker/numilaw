<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en',
        'title_km',
        'slug',
        'description_en',
        'description_km',
        'type',
        'start_datetime',
        'end_datetime',
        'location',
        'featured_image',
        'is_registration_required',
        'max_participants',
        'registration_deadline',
        'organizer_id',
        'project_id',
        'status',
        'is_active',
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
        'is_registration_required' => 'boolean',
        'max_participants' => 'integer',
        'registration_deadline' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function reports()
    {
        return $this->hasMany(EventReport::class);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_datetime', '>', now())
                    ->where('status', '!=', 'cancelled');
    }

    public function scopeOngoing($query)
    {
        return $query->where('start_datetime', '<=', now())
                    ->where('end_datetime', '>=', now())
                    ->where('status', 'ongoing');
    }

    public function scopeCompleted($query)
    {
        return $query->where('end_datetime', '<', now())
                    ->orWhere('status', 'completed');
    }

    public function getTitleAttribute()
    {
        return app()->getLocale() === 'km' ? $this->title_km : $this->title_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() === 'km' ? $this->description_km : $this->description_en;
    }

    public function isUpcoming()
    {
        return $this->start_datetime > now() && $this->status !== 'cancelled';
    }

    public function isOngoing()
    {
        return now()->between($this->start_datetime, $this->end_datetime) && $this->status === 'ongoing';
    }

    public function isCompleted()
    {
        return $this->end_datetime < now() || $this->status === 'completed';
    }
}
