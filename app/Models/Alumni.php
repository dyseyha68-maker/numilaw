<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alumni extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'alumni';

    protected $fillable = [
        'user_id',
        'program_id',
        'student_id',
        'graduation_year',
        'current_job_title',
        'company',
        'industry',
        'location',
        'phone',
        'linkedin_url',
        'facebook_url',
        'twitter_url',
        'bio',
        'achievements',
        'skills',
        'is_featured',
        'contact_consent',
        'newsletter_consent',
        'is_verified',
        'verified_at',
        'profile_picture',
        'cv_file',
        'status',
        'rejection_reason',
        'approved_at',
        'approved_by',
    ];

    protected $casts = [
        'achievements' => 'array',
        'skills' => 'array',
        'is_featured' => 'boolean',
        'contact_consent' => 'boolean',
        'newsletter_consent' => 'boolean',
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
        'approved_at' => 'datetime',
        'graduation_year' => 'integer',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(AcademicProgram::class, 'program_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(AlumniTestimonial::class);
    }

    public function jobPostings(): HasMany
    {
        return $this->hasMany(JobPosting::class);
    }

    public function donations(): HasMany
    {
        return $this->hasMany(AlumniDonation::class);
    }

    public function surveyResponses(): HasMany
    {
        return $this->hasMany(AlumniSurveyResponse::class);
    }

    public function sentConnections(): HasMany
    {
        return $this->hasMany(AlumniConnection::class, 'requester_id');
    }

    public function receivedConnections(): HasMany
    {
        return $this->hasMany(AlumniConnection::class, 'recipient_id');
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopeByYear($query, $year)
    {
        return $query->where('graduation_year', $year);
    }

    public function scopeByProgram($query, $programId)
    {
        return $query->where('program_id', $programId);
    }

    public function scopeByIndustry($query, $industry)
    {
        return $query->where('industry', 'like', "%{$industry}%");
    }

    public function scopeByLocation($query, $location)
    {
        return $query->where('location', 'like', "%{$location}%");
    }

    public function scopeWithContactConsent($query)
    {
        return $query->where('contact_consent', true);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('current_job_title', 'like', "%{$term}%")
              ->orWhere('company', 'like', "%{$term}%")
              ->orWhere('industry', 'like', "%{$term}%")
              ->orWhere('location', 'like', "%{$term}%")
              ->orWhereHas('user', function ($userQuery) use ($term) {
                  $userQuery->where('name', 'like', "%{$term}%")
                           ->orWhere('email', 'like', "%{$term}%");
              });
        });
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return $this->user ? $this->user->name : null;
    }

    public function getEmailAttribute()
    {
        return $this->user ? $this->user->email : null;
    }

    public function getAvatarAttribute()
    {
        return $this->user ? $this->user->avatar : null;
    }

    public function getProfileImageUrlAttribute()
    {
        if ($this->profile_picture) {
            return asset('storage/' . $this->profile_picture);
        }
        
        if ($this->user && $this->user->avatar) {
            return asset('storage/' . $this->user->avatar);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->full_name) . '&color=7F9CF5&background=EBF4FF';
    }

    public function getCvUrlAttribute()
    {
        return $this->cv_file ? asset('storage/' . $this->cv_file) : null;
    }

    public function getGraduationYearRangeAttribute()
    {
        $currentYear = now()->year;
        $yearsSince = $currentYear - $this->graduation_year;
        
        if ($yearsSince == 0) {
            return $this->graduation_year;
        } elseif ($yearsSince == 1) {
            return $this->graduation_year . ' (1 year ago)';
        } else {
            return $this->graduation_year . " ({$yearsSince} years ago)";
        }
    }

    public function getSocialLinksAttribute()
    {
        $links = [];
        
        if ($this->linkedin_url) {
            $links[] = [
                'platform' => 'linkedin',
                'url' => $this->linkedin_url,
                'icon' => 'fab fa-linkedin'
            ];
        }
        
        if ($this->facebook_url) {
            $links[] = [
                'platform' => 'facebook',
                'url' => $this->facebook_url,
                'icon' => 'fab fa-facebook'
            ];
        }
        
        if ($this->twitter_url) {
            $links[] = [
                'platform' => 'twitter',
                'url' => $this->twitter_url,
                'icon' => 'fab fa-twitter'
            ];
        }
        
        return $links;
    }

    // Methods
    public function approve($approvedById)
    {
        $this->status = 'approved';
        $this->approved_at = now();
        $this->approved_by = $approvedById;
        $this->rejection_reason = null;
        $this->save();
    }

    public function reject($reason = null)
    {
        $this->status = 'rejected';
        $this->rejection_reason = $reason;
        $this->approved_at = null;
        $this->approved_by = null;
        $this->save();
    }

    public function toggleFeatured()
    {
        $this->is_featured = !$this->is_featured;
        $this->save();
    }

    public function verify()
    {
        $this->is_verified = true;
        $this->verified_at = now();
        $this->save();
    }

    public function canBeContacted()
    {
        return $this->contact_consent && $this->status === 'approved';
    }

    public function getConnectionsWith($alumniId)
    {
        return $this->sentConnections()
            ->where('recipient_id', $alumniId)
            ->orWhere(function ($query) use ($alumniId) {
                $query->where('requester_id', $alumniId)
                      ->where('recipient_id', $this->id);
            });
    }

    public function isConnectedWith($alumniId)
    {
        return $this->getConnectionsWith($alumniId)
            ->where('status', 'accepted')
            ->exists();
    }

    public function getPendingConnectionRequests()
    {
        return $this->receivedConnections()->where('status', 'pending');
    }

    public function getTotalDonationsAttribute()
    {
        return $this->donations()->where('is_verified', true)->sum('amount');
    }

    public function getRecentDonationsAttribute()
    {
        return $this->donations()
            ->where('is_verified', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }
}