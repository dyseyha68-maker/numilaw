<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendar;
use App\Models\AcademicProgram;
use App\Models\HeroSettings;
use Illuminate\Http\Request;

class AcademicCalendarController extends Controller
{
    public function index(Request $request)
    {
        $currentYear = date('Y');
        $currentMonth = date('m');
        
        $year = $request->get('year', $currentYear);
        $month = $request->get('month', $currentMonth);
        $type = $request->get('type');
        $programId = $request->get('program_id');
        $view = $request->get('view', 'calendar');
        $page = $request->get('page', 1);
        
        // Get all programs for filter
        $programs = AcademicProgram::active()->ordered()->get();
        
        // Get events for calendar view (filtered by month)
        $monthStart = sprintf('%04d-%02d-01', $year, $month);
        $monthEnd = date('Y-m-t', strtotime($monthStart));
        
        $eventsQuery = AcademicCalendar::active()
            ->byDateRange($monthStart, $monthEnd);
        
        // Apply type filter if specified
        if ($type) {
            $eventsQuery->byEventType($type);
        }
        
        // Apply program filter if specified
        if ($programId) {
            $eventsQuery->where('program_id', $programId);
        }
        
        $events = $eventsQuery->orderBy('start_date')
            ->orderBy('start_time')
            ->get();
        
        // Get all events for list view (not filtered by month, with pagination)
        $allEventsQuery = AcademicCalendar::active()
            ->orderBy('start_date')
            ->orderBy('start_time');
        
        if ($type) {
            $allEventsQuery->byEventType($type);
        }
        
        if ($programId) {
            $allEventsQuery->where('program_id', $programId);
        }
        
        $allEvents = $allEventsQuery->paginate(10);
        
        // Get upcoming events for sidebar (events from selected month)
        $upcomingStartDate = sprintf('%04d-%02d-01', $year, $month);
        $upcomingEndDate = date('Y-m-t', strtotime($upcomingStartDate));
        
        $upcomingEvents = AcademicCalendar::active()
            ->byDateRange($upcomingStartDate, $upcomingEndDate)
            ->orderBy('start_date')
            ->limit(10)
            ->get();
        
        // Get event types for filtering
        $eventTypes = [
            'academic_deadline' => app()->getLocale() === 'km' ? 'កាលបរិច្ឆេទសិក្សា' : 'Academic Deadlines',
            'exam_period' => app()->getLocale() === 'km' ? 'រយៈពេលប្រឡង' : 'Exam Periods',
            'holiday' => app()->getLocale() === 'km' ? 'ថ្ងៃឈប់សម្រាប' : 'Holidays',
            'registration' => app()->getLocale() === 'km' ? 'ការចុះឈ្មោះ' : 'Registration',
            'orientation' => app()->getLocale() === 'km' ? 'ការណែនាំ' : 'Orientation',
            'graduation' => app()->getLocale() === 'km' ? 'ពិធីបញ្ចប់ការសិក្សា' : 'Graduation',
            'semester_start' => app()->getLocale() === 'km' ? 'ចាប់ផ្តើមឆមាស' : 'Semester Start',
            'semester_end' => app()->getLocale() === 'km' ? 'បញ្ចប់ឆមាស' : 'Semester End',
            'special_event' => app()->getLocale() === 'km' ? 'ព្រឹត្តិការណ៍ពិសេស' : 'Special Events',
        ];
        
        // Prepare calendar data
        $calendarData = $this->generateCalendarData($year, $month, $events);
        
        $heroImage = HeroSettings::getImageForPage('calendar') ?? HeroSettings::getDefaultImage('calendar');
        
        // Navigation variables
        $prevMonth = $month - 1;
        $prevYear = $year;
        if ($prevMonth < 1) {
            $prevMonth = 12;
            $prevYear--;
        }
        
        $nextMonth = $month + 1;
        $nextYear = $year;
        if ($nextMonth > 12) {
            $nextMonth = 1;
            $nextYear++;
        }
        
        // Next day navigation
        $nextDay = \Carbon\Carbon::createFromDate($year, $month, 1)->addDay();
        $nextDayYear = $nextDay->format('Y');
        $nextDayMonth = $nextDay->format('m');
        
        // Same month next year navigation
        $nextMonthSame = $month;
        $nextMonthYear = $year + 1;
        
        // Handle AJAX request
        if ($request->ajax() || $request->get('ajax')) {
            // Check if requesting list view
            if ($request->get('view') === 'list') {
                // Get all events (not filtered by month, but respect program and type filters)
                $allEventsQuery = AcademicCalendar::active()
                    ->orderBy('start_date')
                    ->orderBy('start_time');
                
                // Apply program filter if specified
                if ($programId) {
                    $allEventsQuery->where('program_id', $programId);
                }
                
                // Apply type filter if specified
                if ($type) {
                    $allEventsQuery->byEventType($type);
                }
                
                $allEvents = $allEventsQuery->paginate(10, ['*'], 'page', $page);
                
                $eventsList = view('public.academic-calendar.partials.events-list', [
                    'events' => $allEvents,
                    'year' => $year,
                    'month' => $month
                ])->render();
                
                return response()->json([
                    'eventsList' => $eventsList,
                    'view' => 'list',
                    'currentPage' => $allEvents->currentPage(),
                    'lastPage' => $allEvents->lastPage()
                ]);
            }
            
            // Render calendar grid
            $calendarGrid = view('public.academic-calendar.partials.calendar-grid', compact('calendarData', 'year', 'month'))->render();
            
            // Render sidebar events - show events from the selected month
            $startDate = sprintf('%04d-%02d-01', $year, $month);
            $endDate = date('Y-m-t', strtotime($startDate));
            
            $sidebarEventsQuery = AcademicCalendar::active()
                ->byDateRange($startDate, $endDate)
                ->orderBy('start_date')
                ->orderBy('start_time');
            
            if ($programId) {
                $sidebarEventsQuery->where('program_id', $programId);
            }
            if ($type) {
                $sidebarEventsQuery->byEventType($type);
            }
            
            $sidebarEventsData = $sidebarEventsQuery->limit(10)->get();
            $sidebarEvents = view('public.academic-calendar.partials.sidebar-events', ['events' => $sidebarEventsData])->render();
            
            return response()->json([
                'calendarGrid' => $calendarGrid,
                'sidebarEvents' => $sidebarEvents,
                'monthYear' => \Carbon\Carbon::createFromDate($year, $month, 1)->format('F Y'),
                'navigation' => [
                    'year' => $year,
                    'month' => $month,
                    'prevYear' => $year - 1,
                    'prevMonth' => $prevMonth,
                    'nextYear' => $nextYear,
                    'nextMonth' => $nextMonth,
                    'nextMonthSame' => $nextMonthSame,
                    'nextMonthYear' => $nextMonthYear,
                    'todayYear' => date('Y'),
                    'todayMonth' => date('m'),
                ],
                'view' => 'calendar'
            ]);
        }
        
        return view('public.academic-calendar.index', compact(
            'events',
            'allEvents',
            'upcomingEvents',
            'eventTypes',
            'year',
            'month',
            'calendarData',
            'prevMonth',
            'prevYear',
            'nextMonth',
            'nextYear',
            'nextDayYear',
            'nextDayMonth',
            'nextMonthSame',
            'nextMonthYear',
            'type',
            'view',
            'programs',
            'programId',
            'heroImage'
        ));
    }
    
    public function show($id)
    {
        $event = AcademicCalendar::active()
            ->findOrFail($id);
        
        // Get related events (same type)
        $relatedEvents = AcademicCalendar::active()
            ->byEventType($event->event_type)
            ->where('id', '!=', $event->id)
            ->limit(5)
            ->get();
        
        $heroImage = HeroSettings::getImageForPage('calendar_detail') ?? HeroSettings::getDefaultImage('calendar_detail');
        
        return view('public.academic-calendar.show', compact('event', 'relatedEvents', 'heroImage'));
    }
    
    private function generateCalendarData($year, $month, $events)
    {
        $calendar = [];
        $daysInMonth = date('t', strtotime("$year-$month-01"));
        $firstDayOfWeek = date('w', strtotime("$year-$month-01"));
        
        // Initialize calendar grid
        for ($week = 0; $week < 6; $week++) {
            for ($day = 0; $day < 7; $day++) {
                $calendar[$week][$day] = null;
            }
        }
        
        // Fill in the days
        $currentDay = 1;
        $today = date('Y-m-d');
        
        for ($week = 0; $week < 6 && $currentDay <= $daysInMonth; $week++) {
            for ($day = 0; $day < 7; $day++) {
                if ($week == 0 && $day < $firstDayOfWeek) {
                    // Empty cells before the first day of month
                    $calendar[$week][$day] = null;
                    continue;
                }
                
                if ($currentDay > $daysInMonth) {
                    // Empty cells after the last day of month
                    $calendar[$week][$day] = null;
                    continue;
                }
                
                $date = "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . "-" . str_pad($currentDay, 2, '0', STR_PAD_LEFT);
                
                // Find events for this date
                $dayEvents = $events->filter(function($event) use ($date) {
                    $eventStart = $event->start_date instanceof \Carbon\Carbon ? $event->start_date->format('Y-m-d') : date('Y-m-d', strtotime($event->start_date));
                    $eventEnd = $event->end_date ? ($event->end_date instanceof \Carbon\Carbon ? $event->end_date->format('Y-m-d') : date('Y-m-d', strtotime($event->end_date))) : $eventStart;
                    return $date >= $eventStart && $date <= $eventEnd;
                });
                
                $calendar[$week][$day] = [
                    'day' => $currentDay,
                    'date' => $date,
                    'events' => $dayEvents,
                    'is_today' => $date === $today,
                    'is_current_month' => true
                ];
                
                $currentDay++;
            }
        }
        
        return $calendar;
    }
}