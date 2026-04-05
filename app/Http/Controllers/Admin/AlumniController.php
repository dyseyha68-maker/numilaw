<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\User;
use App\Models\AcademicProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AlumniController extends Controller
{
    public function __construct()
    {
        // Simple admin check - in production, use proper middleware
    }

    private function checkAdmin()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403);
        }
    }

    public function index(Request $request)
    {
        $this->checkAdmin();

        $query = Alumni::with(['user', 'program']);

        // Filter by status
        if ($request->filled('status')) {
            $query->{$request->status}();
        }

        // Filter by program
        if ($request->filled('program_id')) {
            $query->byProgram($request->program_id);
        }

        // Filter by graduation year
        if ($request->filled('graduation_year')) {
            $query->byYear($request->graduation_year);
        }

        // Filter by industry
        if ($request->filled('industry')) {
            $query->byIndustry($request->industry);
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->byLocation($request->location);
        }

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Featured alumni
        if ($request->boolean('featured')) {
            $query->featured();
        }

        // Verified alumni
        if ($request->boolean('verified')) {
            $query->verified();
        }

        $alumni = $query->latest()->paginate(20)->withQueryString();
        $programs = AcademicProgram::active()->ordered()->get();
        $industries = Alumni::whereNotNull('industry')->distinct()->pluck('industry');
        $locations = Alumni::whereNotNull('location')->distinct()->pluck('location');
        $graduationYears = Alumni::distinct()->orderBy('graduation_year', 'desc')->pluck('graduation_year');

        $stats = [
            'total' => Alumni::count(),
            'pending' => Alumni::pending()->count(),
            'approved' => Alumni::approved()->count(),
            'rejected' => Alumni::rejected()->count(),
            'featured' => Alumni::featured()->count(),
            'verified' => Alumni::verified()->count(),
        ];

        return view('admin.alumni.index', compact('alumni', 'programs', 'industries', 'locations', 'graduationYears', 'stats'));
    }

    public function create()
    {
        $this->checkAdmin();
        $programs = AcademicProgram::active()->ordered()->get();
        return view('admin.alumni.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $this->checkAdmin();

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'program_id' => 'nullable|exists:academic_programs,id',
            'student_id' => 'nullable|string|unique:alumni,student_id',
            'graduation_year' => 'required|integer|min:1950|max:' . (now()->year + 5),
            'current_job_title' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'linkedin_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'bio' => 'nullable|string|max:2000',
            'achievements' => 'nullable|array',
            'achievements.*' => 'string|max:255',
            'skills' => 'nullable|array',
            'skills.*' => 'string|max:100',
            'is_featured' => 'boolean',
            'contact_consent' => 'boolean',
            'newsletter_consent' => 'boolean',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
        ]);

        // Handle file uploads
        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')->store('alumni/profile-pictures', 'public');
        }

        if ($request->hasFile('cv_file')) {
            $validated['cv_file'] = $request->file('cv_file')->store('alumni/cv', 'public');
        }

        $validated['approved_by'] = auth()->id();
        $validated['approved_at'] = $validated['status'] === 'approved' ? now() : null;
        $validated['is_verified'] = $validated['status'] === 'approved';

        Alumni::create($validated);

        return redirect()
            ->route('admin.alumni.index')
            ->with('success', 'Alumni created successfully.');
    }

    public function show(Alumni $alumni)
    {
        $this->checkAdmin();

        $alumni->load(['user', 'program', 'testimonials', 'jobPostings', 'donations', 'surveyResponses']);
        
        $connectionStats = [
            'sent_connections' => $alumni->sentConnections()->count(),
            'received_connections' => $alumni->receivedConnections()->count(),
            'pending_requests' => $alumni->getPendingConnectionRequests()->count(),
        ];

        return view('admin.alumni.show', compact('alumni', 'connectionStats'));
    }

    public function edit(Alumni $alumni)
    {
        $this->checkAdmin();

        $programs = AcademicProgram::active()->ordered()->get();
        return view('admin.alumni.edit', compact('alumni', 'programs'));
    }

    public function update(Request $request, Alumni $alumni)
    {
        $this->checkAdmin();

        $validated = $request->validate([
            'program_id' => 'nullable|exists:academic_programs,id',
            'student_id' => ['nullable', 'string', Rule::unique('alumni', 'student_id')->ignore($alumni->id)],
            'graduation_year' => 'required|integer|min:1950|max:' . (now()->year + 5),
            'current_job_title' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'linkedin_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'bio' => 'nullable|string|max:2000',
            'achievements' => 'nullable|array',
            'achievements.*' => 'string|max:255',
            'skills' => 'nullable|array',
            'skills.*' => 'string|max:100',
            'is_featured' => 'boolean',
            'contact_consent' => 'boolean',
            'newsletter_consent' => 'boolean',
            'is_verified' => 'boolean',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
        ]);

        // Handle file uploads
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture
            if ($alumni->profile_picture) {
                Storage::disk('public')->delete($alumni->profile_picture);
            }
            $validated['profile_picture'] = $request->file('profile_picture')->store('alumni/profile-pictures', 'public');
        }

        if ($request->hasFile('cv_file')) {
            // Delete old CV
            if ($alumni->cv_file) {
                Storage::disk('public')->delete($alumni->cv_file);
            }
            $validated['cv_file'] = $request->file('cv_file')->store('alumni/cv', 'public');
        }

        // Update approval details
        $oldStatus = $alumni->status;
        if ($validated['status'] !== $oldStatus) {
            if ($validated['status'] === 'approved') {
                $validated['approved_by'] = auth()->id();
                $validated['approved_at'] = now();
                $validated['is_verified'] = true;
            } elseif ($validated['status'] === 'rejected') {
                $validated['approved_by'] = null;
                $validated['approved_at'] = null;
                $validated['is_verified'] = false;
                $validated['rejection_reason'] = $request->input('rejection_reason');
            }
        }

        $alumni->update($validated);

        return redirect()
            ->route('admin.alumni.show', $alumni)
            ->with('success', 'Alumni updated successfully.');
    }

    public function destroy(Alumni $alumni)
    {
        $this->checkAdmin();

        // Delete associated files
        if ($alumni->profile_picture) {
            Storage::disk('public')->delete($alumni->profile_picture);
        }
        if ($alumni->cv_file) {
            Storage::disk('public')->delete($alumni->cv_file);
        }

        $alumni->delete();

        return redirect()
            ->route('admin.alumni.index')
            ->with('success', 'Alumni deleted successfully.');
    }

    public function approve(Alumni $alumni)
    {
        $this->checkAdmin();

        $alumni->approve(auth()->id());
        
        return redirect()
            ->route('admin.alumni.show', $alumni)
            ->with('success', 'Alumni approved successfully.');
    }

    public function reject(Request $request, Alumni $alumni)
    {
        $this->checkAdmin();

        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $alumni->reject($request->rejection_reason);
        
        return redirect()
            ->route('admin.alumni.show', $alumni)
            ->with('success', 'Alumni rejected successfully.');
    }

    public function toggleFeatured(Alumni $alumni)
    {
        $this->checkAdmin();

        $alumni->toggleFeatured();
        
        return redirect()
            ->route('admin.alumni.show', $alumni)
            ->with('success', $alumni->is_featured 
                ? 'Alumni featured successfully.' 
                : 'Alumni unfeatured successfully.');
    }

    public function verify(Alumni $alumni)
    {
        $this->checkAdmin();

        $alumni->verify();
        
        return redirect()
            ->route('admin.alumni.show', $alumni)
            ->with('success', 'Alumni verified successfully.');
    }

    public function export(Request $request)
    {
        $this->checkAdmin();

        // Simple CSV export for now
        $alumni = Alumni::with(['user', 'program']);

        // Apply filters
        if ($request->filled('status')) {
            $alumni->{$request->status}();
        }
        if ($request->filled('program_id')) {
            $alumni->byProgram($request->program_id);
        }
        if ($request->filled('graduation_year')) {
            $alumni->byYear($request->graduation_year);
        }

        $alumni = $alumni->get();

        $filename = 'alumni_export_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($alumni) {
            $file = fopen('php://output', 'w');
            
            // Header row
            fputcsv($file, [
                'ID', 'Name', 'Email', 'Student ID', 'Program', 'Graduation Year',
                'Current Job', 'Company', 'Industry', 'Location', 'Phone', 'Status',
                'Featured', 'Verified', 'Created At'
            ]);
            
            foreach ($alumni as $alumnus) {
                fputcsv($file, [
                    $alumnus->id,
                    $alumnus->full_name,
                    $alumnus->email,
                    $alumnus->student_id,
                    $alumnus->program ? $alumnus->program->title : 'N/A',
                    $alumnus->graduation_year,
                    $alumnus->current_job_title,
                    $alumnus->company,
                    $alumnus->industry,
                    $alumnus->location,
                    $alumnus->phone,
                    $alumnus->status,
                    $alumnus->is_featured ? 'Yes' : 'No',
                    $alumnus->is_verified ? 'Yes' : 'No',
                    $alumnus->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function dashboard()
    {
        $this->checkAdmin();

        $totalAlumni = Alumni::count();
        $approvedAlumni = Alumni::approved()->count();
        $pendingAlumni = Alumni::pending()->count();
        $featuredAlumni = Alumni::featured()->count();
        $verifiedAlumni = Alumni::verified()->count();

        // Recent registrations
        $recentRegistrations = Alumni::with(['user', 'program'])
                                    ->latest()
                                    ->take(5)
                                    ->get();

        // Statistics by year
        $alumniByYear = Alumni::selectRaw('graduation_year, COUNT(*) as count')
                             ->groupBy('graduation_year')
                             ->orderBy('graduation_year', 'desc')
                             ->take(10)
                             ->get();

        // Statistics by program
        $alumniByProgram = Alumni::with('program')
                                ->selectRaw('program_id, COUNT(*) as count')
                                ->whereNotNull('program_id')
                                ->groupBy('program_id')
                                ->orderByDesc('count')
                                ->take(10)
                                ->get();

        // Statistics by industry
        $alumniByIndustry = Alumni::selectRaw('industry, COUNT(*) as count')
                                 ->whereNotNull('industry')
                                 ->groupBy('industry')
                                 ->orderByDesc('count')
                                 ->take(10)
                                 ->get();

        return view('admin.alumni.dashboard', compact(
            'totalAlumni', 'approvedAlumni', 'pendingAlumni', 
            'featuredAlumni', 'verifiedAlumni', 'recentRegistrations',
            'alumniByYear', 'alumniByProgram', 'alumniByIndustry'
        ));
    }
}