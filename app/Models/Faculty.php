<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faculty extends Model
{
    use HasFactory;

    protected $table = 'faculty';

    protected $fillable = [
        'user_id',
        'name',
        'title',
        'department',
        'bio_en',
        'bio_km',
        'specialization_en',
        'specialization_km',
        'education_en',
        'education_km',
        'office_location',
        'office_hours',
        'email',
        'phone',
        'photo',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supervisedProjects()
    {
        return $this->hasMany(Project::class, 'supervisor_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }

    public function getBioAttribute()
    {
        return app()->getLocale() === 'km' ? $this->bio_km : $this->bio_en;
    }

    public function getSpecializationAttribute()
    {
        return app()->getLocale() === 'km' ? $this->specialization_km : $this->specialization_en;
    }

    public function getEducationAttribute()
    {
        return app()->getLocale() === 'km' ? $this->education_km : $this->education_en;
    }

    public function getNameAttribute()
    {
        return $this->attributes['name'] ?? 'Unknown';
    }

    public function getEmailAttribute()
    {
        return $this->attributes['email'] ?? ($this->user ? $this->user->email : null);
    }

    public function getPhoneAttribute()
    {
        return $this->attributes['phone'] ?? ($this->user ? $this->user->phone : null);
    }
}
