<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternshipStory extends Model
{
    protected $fillable = [
        'student_name',
        'batch_year',
        'company_name',
        'duration',
        'story_en',
        'story_kh',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
