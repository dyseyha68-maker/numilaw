<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::with('program');

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('first_name_en', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('last_name_en', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('application_reference', 'LIKE', "%{$searchTerm}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        $applications = $query->orderBy('created_at', 'desc')->paginate(15);

        $statusCounts = Application::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return view('admin.applications.index', compact('applications', 'statusCounts'));
    }

    public function show(Application $application)
    {
        $application->load('program');
        return view('admin.applications.show', compact('application'));
    }

    public function create()
    {
        $programs = \App\Models\AcademicProgram::active()->orderBy('title_en')->get();
        return view('admin.applications.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:academic_programs,id',
            'first_name_en' => 'required|string|max:255',
            'last_name_en' => 'required|string|max:255',
            'first_name_km' => 'nullable|string|max:255',
            'last_name_km' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'date_of_birth' => 'required|date|before:today',
            'nationality' => 'required|string|max:100',
            'address' => 'required|string',
            'high_school' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:1950|max:' . date('Y'),
            'gpa' => 'required|numeric|min:0|max:4',
            'english_level' => 'required|in:beginner,intermediate,advanced,fluent',
            'motivation_letter' => 'required|string',
            'experience' => 'nullable|string',
            'achievements' => 'nullable|string',
            'reference_name' => 'required|string|max:255',
            'reference_email' => 'required|email|max:255',
            'reference_phone' => 'required|string|max:50',
            'status' => 'sometimes|in:pending,reviewing,approved,rejected',
        ]);

        $validated['application_reference'] = 'APP-' . strtoupper(uniqid());
        $validated['status'] = $validated['status'] ?? 'pending';

        Application::create($validated);

        return redirect()->route('admin.applications.index')
            ->with('success', 'Application created successfully.');
    }

    public function edit(Application $application)
    {
        $application->load('program');
        $programs = \App\Models\AcademicProgram::active()->orderBy('title_en')->get();
        return view('admin.applications.edit', compact('application', 'programs'));
    }

    public function update(Request $request, Application $application)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:academic_programs,id',
            'first_name_en' => 'required|string|max:255',
            'last_name_en' => 'required|string|max:255',
            'first_name_km' => 'nullable|string|max:255',
            'last_name_km' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'date_of_birth' => 'required|date|before:today',
            'nationality' => 'required|string|max:100',
            'address' => 'required|string',
            'high_school' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:1950|max:' . date('Y'),
            'gpa' => 'required|numeric|min:0|max:4',
            'english_level' => 'required|in:beginner,intermediate,advanced,fluent',
            'motivation_letter' => 'required|string',
            'experience' => 'nullable|string',
            'achievements' => 'nullable|string',
            'reference_name' => 'required|string|max:255',
            'reference_email' => 'required|email|max:255',
            'reference_phone' => 'required|string|max:50',
            'status' => 'sometimes|in:pending,reviewing,approved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $application->update($validated);

        return redirect()->route('admin.applications.index')
            ->with('success', 'Application updated successfully.');
    }

    public function destroy(Application $application)
    {
        $application->delete();

        return redirect()->route('admin.applications.index')
            ->with('success', 'Application deleted successfully.');
    }

    public function updateStatus(Request $request, Application $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewing,approved,rejected',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $application->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'],
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->route('admin.applications.show', $application)
            ->with('success', 'Application status updated successfully.');
    }
}
