<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobPosting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'alumni_id',
        'title',
        'description',
        'requirements',
        'benefits',
        'company',
        'location',
        'job_type',
        'industry',
        'experience_level',
        'salary_min',
        'salary_max',
        'salary_currency',
        'application_url',
        'application_email',
        'application_deadline',
        'is_remote',
        'is_active',
        'views_count',
        'applications_count',
        'featured_until',
    ];

    protected $casts = [
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
        'application_deadline' => 'date',
        'is_remote' => 'boolean',
        'is_active' => 'boolean',
        'views_count' => 'integer',
        'applications_count' => 'integer',
        'featured_until' => 'datetime',
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
        return $query->where('featured_until', '>', now());
    }

    public function scopeByJobType($query, $jobType)
    {
        return $query->where('job_type', $jobType);
    }

    public function scopeByIndustry($query, $industry)
    {
        return $query->where('industry', $industry);
    }

    public function scopeByExperienceLevel($query, $level)
    {
        return $query->where('experience_level', $level);
    }

    public function scopeByLocation($query, $location)
    {
        return $query->where('location', 'like', "%{$location}%");
    }

    public function scopeRemote($query)
    {
        return $query->where('is_remote', true);
    }

    public function scopeOnSite($query)
    {
        return $query->where('is_remote', false);
    }

    public function scopeWithDeadline($query)
    {
        return $query->whereNotNull('application_deadline')
                    ->where('application_deadline', '>=', now());
    }

    public function scopeExpired($query)
    {
        return $query->where('application_deadline', '<', now());
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
              ->orWhere('description', 'like', "%{$term}%")
              ->orWhere('company', 'like', "%{$term}%")
              ->orWhere('location', 'like', "%{$term}%")
              ->orWhere('industry', 'like', "%{$term}%");
        });
    }

    // Accessors
    public function getSalaryRangeAttribute()
    {
        if ($this->salary_min && $this->salary_max) {
            return $this->salary_currency . ' ' . number_format($this->salary_min) . ' - ' . number_format($this->salary_max);
        } elseif ($this->salary_min) {
            return $this->salary_currency . ' ' . number_format($this->salary_min) . '+';
        } elseif ($this->salary_max) {
            return 'Up to ' . $this->salary_currency . ' ' . number_format($this->salary_max);
        }

        return 'Negotiable';
    }

    public function getJobTypeDisplayAttribute()
    {
        $types = [
            'full-time' => app()->getLocale() === 'km' ? 'ពេញមោង' : 'Full Time',
            'part-time' => app()->getLocale() === 'km' ? 'ពេលវេលាផ្នែក' : 'Part Time',
            'contract' => app()->getLocale() === 'km' ? 'កិច្ចសន្យា' : 'Contract',
            'internship' => app()->getLocale() === 'km' ? 'បណ្តុះបណ្តាល' : 'Internship',
            'remote' => app()->getLocale() === 'km' ? 'ពីចម្ងាយ' : 'Remote',
            'freelance' => app()->getLocale() === 'km' ? 'ឯករាជ្យ' : 'Freelance',
        ];

        return $types[$this->job_type] ?? $this->job_type;
    }

    public function getExperienceLevelDisplayAttribute()
    {
        $levels = [
            'entry-level' => app()->getLocale() === 'km' ? 'កម្រិតចូលថ្មី' : 'Entry Level',
            'mid-level' => app()->getLocale() === 'km' ? 'កម្រិតមធ្យម' : 'Mid Level',
            'senior' => app()->getLocale() === 'km' ? 'កម្រិតខ្ពស់' : 'Senior',
            'executive' => app()->getLocale() === 'km' ? 'កម្រិតនាយក' : 'Executive',
        ];

        return $levels[$this->experience_level] ?? $this->experience_level;
    }

    public function getLocationDisplayAttribute()
    {
        if ($this->is_remote) {
            return app()->getLocale() === 'km' ? 'ពីចម្ងាយ' : 'Remote';
        }

        return $this->location;
    }

    public function getIsExpiredAttribute()
    {
        return $this->application_deadline && $this->application_deadline->isPast();
    }

    public function getIsUrgentAttribute()
    {
        return $this->application_deadline && 
               $this->application_deadline->diffInDays(now()) <= 7;
    }

    public function getDaysUntilDeadlineAttribute()
    {
        if (!$this->application_deadline) {
            return null;
        }

        $diff = $this->application_deadline->diffInDays(now(), false);
        
        if ($diff < 0) {
            return 'expired';
        } elseif ($diff === 0) {
            return 'today';
        } elseif ($diff === 1) {
            return 'tomorrow';
        } elseif ($diff <= 7) {
            return $diff . ' days';
        } else {
            return $diff . ' days';
        }
    }

    public function getPostedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getAlumniNameAttribute()
    {
        return $this->alumni ? $this->alumni->full_name : null;
    }

    public function getApplicationMethodAttribute()
    {
        if ($this->application_url) {
            return 'url';
        } elseif ($this->application_email) {
            return 'email';
        } else {
            return 'contact';
        }
    }

    // Methods
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    public function incrementApplications()
    {
        $this->increment('applications_count');
    }

    public function isFeatured()
    {
        return $this->featured_until && $this->featured_until->isFuture();
    }

    public function makeFeatured($days = 30)
    {
        $this->featured_until = now()->addDays($days);
        $this->save();
    }

    public function removeFeatured()
    {
        $this->featured_until = null;
        $this->save();
    }

    public function deactivate()
    {
        $this->is_active = false;
        $this->save();
    }

    public function activate()
    {
        $this->is_active = true;
        $this->save();
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('is_featured', 'desc')
                    ->orderBy('created_at', 'desc');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('views_count', 'desc')
                    ->orderBy('applications_count', 'desc');
    }
}