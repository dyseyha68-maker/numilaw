<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendar;
use App\Models\AcademicProgram;
use Illuminate\Http\Request;

class AcademicCalendarController extends Controller
{
    public function index(Request $request)
    {
        $query = AcademicCalendar::query();

        // Filter by event type
        if ($request->filled('event_type')) {
            $query->byEventType($request->event_type);
        }

        // Filter by program
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        // Filter by date range
        if ($request->filled('month')) {
            $month = $request->month;
            $year = $request->filled('year') ? $request->year : date('Y');
            $startDate = "$year-$month-01";
            $endDate = date('Y-m-t', strtotime($startDate));
            $query->byDateRange($startDate, $endDate);
        }

        $events = $query->orderBy('start_date')
            ->orderBy('sort_order')
            ->paginate(20);

        $eventTypes = [
            'academic_deadline' => 'Academic Deadline',
            'exam_period' => 'Exam Period',
            'holiday' => 'Holiday',
            'registration' => 'Registration',
            'orientation' => 'Orientation',
            'graduation' => 'Graduation',
            'semester_start' => 'Semester Start',
            'semester_end' => 'Semester End',
            'special_event' => 'Special Event',
        ];

        $programs = AcademicProgram::active()->ordered()->get();

        return view('admin.academic-calendar.index', compact('events', 'eventTypes', 'programs'));
    }

    public function create()
    {
        $eventTypes = [
            'academic_deadline' => 'Academic Deadline',
            'exam_period' => 'Exam Period',
            'holiday' => 'Holiday',
            'registration' => 'Registration',
            'orientation' => 'Orientation',
            'graduation' => 'Graduation',
            'semester_start' => 'Semester Start',
            'semester_end' => 'Semester End',
            'special_event' => 'Special Event',
        ];

        $audiences = [
            'students' => 'Students',
            'faculty' => 'Faculty',
            'all' => 'All',
            'specific_program' => 'Specific Program',
        ];

        $recurringPatterns = [
            'daily' => 'Daily',
            'weekly' => 'Weekly',
            'monthly' => 'Monthly',
        ];

        $colorCodes = [
            '#007bff' => 'Blue',
            '#28a745' => 'Green',
            '#dc3545' => 'Red',
            '#ffc107' => 'Yellow',
            '#6f42c1' => 'Purple',
            '#fd7e14' => 'Orange',
            '#20c997' => 'Teal',
            '#6c757d' => 'Gray',
        ];

        $programs = AcademicProgram::active()->ordered()->get();

        return view('admin.academic-calendar.create', compact('eventTypes', 'audiences', 'recurringPatterns', 'colorCodes', 'programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_km' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_km' => 'nullable|string',
            'event_type' => 'required|in:academic_deadline,exam_period,holiday,registration,orientation,graduation,semester_start,semester_end,special_event',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'location' => 'nullable|string|max:255',
            'audience' => 'required|in:students,faculty,all,specific_program',
            'program_id' => 'nullable|exists:academic_programs,id',
            'is_all_day' => 'boolean',
            'is_recurring' => 'boolean',
            'recurring_pattern' => 'nullable|required_if:is_recurring,true|in:daily,weekly,monthly',
            'notes_en' => 'nullable|string',
            'notes_km' => 'nullable|string',
            'color_code' => 'required|string|max:7',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['is_active'] = true;
        $validated['is_all_day'] = $request->has('is_all_day');
        $validated['is_recurring'] = $request->has('is_recurring');

        AcademicCalendar::create($validated);

        return redirect()
            ->route('admin.academic-calendar.index')
            ->with('success', 'Academic calendar event created successfully.');
    }

    public function show(AcademicCalendar $academicCalendar)
    {
        return view('admin.academic-calendar.show', compact('academicCalendar'));
    }

    public function edit(AcademicCalendar $academicCalendar)
    {
        $eventTypes = [
            'academic_deadline' => 'Academic Deadline',
            'exam_period' => 'Exam Period',
            'holiday' => 'Holiday',
            'registration' => 'Registration',
            'orientation' => 'Orientation',
            'graduation' => 'Graduation',
            'semester_start' => 'Semester Start',
            'semester_end' => 'Semester End',
            'special_event' => 'Special Event',
        ];

        $audiences = [
            'students' => 'Students',
            'faculty' => 'Faculty',
            'all' => 'All',
            'specific_program' => 'Specific Program',
        ];

        $recurringPatterns = [
            'daily' => 'Daily',
            'weekly' => 'Weekly',
            'monthly' => 'Monthly',
        ];

        $colorCodes = [
            '#007bff' => 'Blue',
            '#28a745' => 'Green',
            '#dc3545' => 'Red',
            '#ffc107' => 'Yellow',
            '#6f42c1' => 'Purple',
            '#fd7e14' => 'Orange',
            '#20c997' => 'Teal',
            '#6c757d' => 'Gray',
        ];

        $programs = AcademicProgram::active()->ordered()->get();

        return view('admin.academic-calendar.edit', compact('academicCalendar', 'eventTypes', 'audiences', 'recurringPatterns', 'colorCodes', 'programs'));
    }

    public function update(Request $request, AcademicCalendar $academicCalendar)
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_km' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_km' => 'nullable|string',
            'event_type' => 'required|in:academic_deadline,exam_period,holiday,registration,orientation,graduation,semester_start,semester_end,special_event',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'location' => 'nullable|string|max:255',
            'audience' => 'required|in:students,faculty,all,specific_program',
            'program_id' => 'nullable|exists:academic_programs,id',
            'is_all_day' => 'boolean',
            'is_recurring' => 'boolean',
            'recurring_pattern' => 'nullable|required_if:is_recurring,true|in:daily,weekly,monthly',
            'notes_en' => 'nullable|string',
            'notes_km' => 'nullable|string',
            'color_code' => 'required|string|max:7',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['is_all_day'] = $request->has('is_all_day');
        $validated['is_recurring'] = $request->has('is_recurring');

        $academicCalendar->update($validated);

        return redirect()
            ->route('admin.academic-calendar.index')
            ->with('success', 'Academic calendar event updated successfully.');
    }

    public function destroy(AcademicCalendar $academicCalendar)
    {
        $academicCalendar->delete();

        return redirect()
            ->route('admin.academic-calendar.index')
            ->with('success', 'Academic calendar event deleted successfully.');
    }
}