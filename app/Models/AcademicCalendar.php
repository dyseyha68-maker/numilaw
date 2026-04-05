<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicCalendar extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en',
        'title_km',
        'description_en',
        'description_km',
        'event_type',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'location',
        'audience',
        'is_all_day',
        'is_recurring',
        'recurring_pattern',
        'notes_en',
        'notes_km',
        'color_code',
        'is_active',
        'sort_order',
        'program_id',
        'moot_court_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_all_day' => 'boolean',
        'is_recurring' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByEventType($query, $type)
    {
        return $query->where('event_type', $type);
    }

    public function scopeByDateRange($query, $start, $end)
    {
        return $query->where(function($q) use ($start, $end) {
            $q->whereBetween('start_date', [$start, $end])
              ->orWhereBetween('end_date', [$start, $end])
              ->orWhere(function($subQ) use ($start, $end) {
                  $subQ->where('start_date', '<=', $start)
                        ->where('end_date', '>=', $end);
              });
        });
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now());
    }

    public function scopePast($query)
    {
        return $query->where('start_date', '<', now());
    }

    public function getTitleAttribute()
    {
        return \Illuminate\Support\Facades\App::getLocale() === 'km' ? $this->title_km : $this->title_en;
    }

    public function getDescriptionAttribute()
    {
        return \Illuminate\Support\Facades\App::getLocale() === 'km' ? $this->description_km : $this->description_en;
    }

    public function getNotesAttribute()
    {
        return \Illuminate\Support\Facades\App::getLocale() === 'km' ? $this->notes_km : $this->notes_en;
    }

    public function getEventTypeDisplayAttribute()
    {
        $types = [
            'academic_deadline' => \Illuminate\Support\Facades\App::getLocale() === 'km' ? 'កាលបរិច្ឆេទសិក្សា' : 'Academic Deadline',
            'exam_period' => \Illuminate\Support\Facades\App::getLocale() === 'km' ? 'រយៈពេលប្រឡង' : 'Exam Period',
            'holiday' => \Illuminate\Support\Facades\App::getLocale() === 'km' ? 'ថ្ងៃឈប់សម្រាប' : 'Holiday',
            'registration' => \Illuminate\Support\Facades\App::getLocale() === 'km' ? 'ការចុះឈ្មោះ' : 'Registration',
            'orientation' => \Illuminate\Support\Facades\App::getLocale() === 'km' ? 'ការណែនាំ' : 'Orientation',
            'graduation' => \Illuminate\Support\Facades\App::getLocale() === 'km' ? 'ពិធីបញ្ចប់ការសិក្សា' : 'Graduation',
            'semester_start' => \Illuminate\Support\Facades\App::getLocale() === 'km' ? 'ចាប់ផ្តើមឆមាស' : 'Semester Start',
            'semester_end' => \Illuminate\Support\Facades\App::getLocale() === 'km' ? 'បញ្ចប់ឆមាស' : 'Semester End',
            'special_event' => \Illuminate\Support\Facades\App::getLocale() === 'km' ? 'ព្រឹត្តិការណ៍ពិសេស' : 'Special Event',
        ];

        return $types[$this->event_type] ?? $this->event_type;
    }

    public function getAudienceDisplayAttribute()
    {
        $audiences = [
            'students' => app()->getLocale() === 'km' ? 'និស្សិត' : 'Students',
            'faculty' => app()->getLocale() === 'km' ? 'បុគ្គលិក' : 'Faculty',
            'all' => app()->getLocale() === 'km' ? 'គ្រប់គ្នា' : 'All',
            'specific_program' => app()->getLocale() === 'km' ? 'កម្មវិធីជាក់លាក់' : 'Specific Program',
        ];

        return $audiences[$this->audience] ?? $this->audience;
    }

    public function getFormattedDateRangeAttribute()
    {
        if ($this->is_all_day) {
            if ($this->end_date && $this->end_date->format('Y-m-d') !== $this->start_date->format('Y-m-d')) {
                return $this->start_date->format('M j') . ' - ' . $this->end_date->format('M j, Y');
            }
            return $this->start_date->format('M j, Y');
        }

        $datePart = $this->start_date->format('M j, Y');
        $timePart = $this->start_time ? $this->start_time->format('g:i A') : '';
        
        if ($this->end_time) {
            $timePart .= ' - ' . $this->end_time->format('g:i A');
        }

        return $datePart . ($timePart ? ' at ' . $timePart : '');
    }

    public function isUpcoming()
    {
        return $this->start_date >= now();
    }

    public function isPast()
    {
        return $this->end_date ? $this->end_date < now() : $this->start_date < now();
    }

    public function isToday()
    {
        $today = now()->format('Y-m-d');
        $startDate = $this->start_date->format('Y-m-d');
        $endDate = $this->end_date ? $this->end_date->format('Y-m-d') : $startDate;
        
        return $today >= $startDate && $today <= $endDate;
    }
    
    public function program()
    {
        return $this->belongsTo(AcademicProgram::class, 'program_id');
    }
}
