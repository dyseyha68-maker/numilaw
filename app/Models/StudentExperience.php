<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentExperience extends Model
{
    protected $fillable = [
        'student_name',
        'batch_year',
        'program',
        'story_en',
        'story_kh',
        'photo',
        'is_featured',
        'status',
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
