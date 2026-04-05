<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlumniSurveyResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumni_id',
        'survey_title',
        'responses',
        'satisfaction_rating',
        'feedback',
        'would_recommend',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'responses' => 'array',
        'satisfaction_rating' => 'integer',
        'would_recommend' => 'boolean',
    ];

    // Relationships
    public function alumni(): BelongsTo
    {
        return $this->belongsTo(Alumni::class);
    }

    // Scopes
    public function scopeBySurvey($query, $surveyTitle)
    {
        return $query->where('survey_title', $surveyTitle);
    }

    public function scopeByRating($query, $rating)
    {
        return $query->where('satisfaction_rating', $rating);
    }

    public function scopeHighlySatisfied($query)
    {
        return $query->where('satisfaction_rating', '>=', 4);
    }

    public function scopeSatisfied($query)
    {
        return $query->where('satisfaction_rating', '>=', 3);
    }

    public function scopeDissatisfied($query)
    {
        return $query->where('satisfaction_rating', '<=', 2);
    }

    public function scopeWouldRecommend($query)
    {
        return $query->where('would_recommend', true);
    }

    public function scopeWouldNotRecommend($query)
    {
        return $query->where('would_recommend', false);
    }

    // Accessors
    public function getAlumniNameAttribute()
    {
        return $this->alumni ? $this->alumni->full_name : null;
    }

    public function getGraduationYearAttribute()
    {
        return $this->alumni ? $this->alumni->graduation_year : null;
    }

    public function getSatisfactionDisplayAttribute()
    {
        $ratings = [
            1 => app()->getLocale() === 'km' ? 'មិនពេញចិត្តទេ' : 'Very Dissatisfied',
            2 => app()->getLocale() === 'km' ? 'មិនពេញចិត្ត' : 'Dissatisfied',
            3 => app()->getLocale() === 'km' ? 'អរគុណ' : 'Neutral',
            4 => app()->getLocale() === 'km' ? 'ពេញចិត្ត' : 'Satisfied',
            5 => app()->getLocale() === 'km' ? 'ពេញចិត្តខ្លាំង' : 'Very Satisfied',
        ];

        return $ratings[$this->satisfaction_rating] ?? 'N/A';
    }

    public function getRecommendationDisplayAttribute()
    {
        return $this->would_recommend 
            ? (app()->getLocale() === 'km' ? 'បាទ/ចាស' : 'Yes')
            : (app()->getLocale() === 'km' ? 'ទេ' : 'No');
    }

    public function getResponseDateAttribute()
    {
        return $this->created_at->format('F j, Y');
    }

    public function hasResponseFor($question)
    {
        return isset($this->responses[$question]);
    }

    public function getResponseFor($question, $default = null)
    {
        return $this->responses[$question] ?? $default;
    }

    // Methods
    public function scopeByProgram($query, $programId)
    {
        return $query->whereHas('alumni', function ($alumniQuery) use ($programId) {
            $alumniQuery->where('program_id', $programId);
        });
    }

    public function scopeByYear($query, $year)
    {
        return $query->whereHas('alumni', function ($alumniQuery) use ($year) {
            $alumniQuery->where('graduation_year', $year);
        });
    }

    public function scopeByIndustry($query, $industry)
    {
        return $query->whereHas('alumni', function ($alumniQuery) use ($industry) {
            $alumniQuery->where('industry', 'like', "%{$industry}%");
        });
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function getAverageRating()
    {
        return static::avg('satisfaction_rating');
    }

    public static function getRecommendationRate()
    {
        $total = static::whereNotNull('would_recommend')->count();
        if ($total === 0) return 0;

        $yes = static::where('would_recommend', true)->count();
        return round(($yes / $total) * 100, 2);
    }

    public static function getRatingDistribution()
    {
        return static::selectRaw('satisfaction_rating, COUNT(*) as count')
                    ->whereNotNull('satisfaction_rating')
                    ->groupBy('satisfaction_rating')
                    ->orderBy('satisfaction_rating')
                    ->pluck('count', 'satisfaction_rating')
                    ->toArray();
    }

    public static function getSurveyTitles()
    {
        return static::distinct()->pluck('survey_title')->sort();
    }
}