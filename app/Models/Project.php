<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_km',
        'slug',
        'type',
        'description_en',
        'description_km',
        'objectives_en',
        'objectives_km',
        'supervisor_id',
        'status',
        'start_date',
        'end_date',
        'featured_image',
        'leader_id',
        'members',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'members' => 'array',
    ];

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeClubs($query)
    {
        return $query->where('type', 'club');
    }

    public function scopeAcademicProjects($query)
    {
        return $query->where('type', 'academic_project');
    }

    public function scopeResearchProjects($query)
    {
        return $query->where('type', 'research_project');
    }

    public function getNameAttribute()
    {
        return app()->getLocale() === 'km' ? $this->name_km : $this->name_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() === 'km' ? $this->description_km : $this->description_en;
    }

    public function getObjectivesAttribute()
    {
        return app()->getLocale() === 'km' ? $this->objectives_km : $this->objectives_en;
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isClub()
    {
        return $this->type === 'club';
    }
}
