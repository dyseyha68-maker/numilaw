<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\AcademicProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $programId = $request->get('program_id');
        
        $programs = AcademicProgram::orderBy('title_en')->get();
        
        $query = Course::with('program');
        
        if ($programId) {
            $query->where('program_id', $programId);
        }
        
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name_en', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('name_km', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('code', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        $courses = $query->orderBy('year')
                        ->orderBy('semester')
                        ->orderBy('sort_order')
                        ->paginate(20);
        
        return view('admin.courses.index', compact('courses', 'programs', 'programId'));
    }

    public function create()
    {
        $programs = AcademicProgram::orderBy('title_en')->get();
        return view('admin.courses.create', compact('programs'));
    }

    public function store(Request $request)
    {
        \Log::info('Course store called', $request->all());
        
        try {
            $data = $request->validate([
                'program_id' => 'required|exists:academic_programs,id',
                'year' => 'required|integer|min:1|max:6',
                'semester' => 'required|integer|min:1|max:2',
                'code' => 'nullable|string|max:20',
                'name_en' => 'required|string|max:255',
                'name_km' => 'required|string|max:255',
                'description_en' => 'nullable|string',
                'description_km' => 'nullable|string',
                'credits' => 'required|integer|min:1|max:10',
                'phase' => 'nullable|string|max:50',
                'is_active' => 'boolean',
            ]);

            $data['is_active'] = $request->has('is_active');
            
            $course = Course::create($data);

            return redirect()->route('admin.courses.index')
                           ->with('success', 'Course created successfully. ID: ' . $course->id);
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Course $course)
    {
        $programs = AcademicProgram::orderBy('title_en')->get();
        return view('admin.courses.edit', compact('course', 'programs'));
    }

    public function update(Request $request, Course $course)
    {
        try {
            $data = $request->validate([
                'program_id' => 'required|exists:academic_programs,id',
                'year' => 'required|integer|min:1|max:6',
                'semester' => 'required|integer|min:1|max:2',
                'code' => 'nullable|string|max:20',
                'name_en' => 'required|string|max:255',
                'name_km' => 'required|string|max:255',
                'description_en' => 'nullable|string',
                'description_km' => 'nullable|string',
                'credits' => 'required|integer|min:1|max:10',
                'phase' => 'nullable|string|max:50',
                'is_active' => 'boolean',
            ]);

            $data['is_active'] = $request->has('is_active');
            
            $course->update($data);

            return redirect()->route('admin.courses.index')
                           ->with('success', 'Course updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index')
                       ->with('success', 'Course deleted successfully.');
    }

    public function getByProgram($programId)
    {
        $courses = Course::where('program_id', $programId)
                        ->where('is_active', true)
                        ->orderBy('year')
                        ->orderBy('semester')
                        ->orderBy('sort_order')
                        ->get();
        
        return response()->json($courses);
    }
}
