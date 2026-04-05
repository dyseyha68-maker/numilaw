<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Models\Alumni;
use App\Models\HeroSettings;
use Illuminate\Http\Request;

class JobPostingController extends Controller
{
    public function index(Request $request)
    {
        $query = JobPosting::active()->with(['alumni.user']);

        // Filter by job type
        if ($request->filled('job_type')) {
            $query->byJobType($request->job_type);
        }

        // Filter by industry
        if ($request->filled('industry')) {
            $query->byIndustry($request->industry);
        }

        // Filter by experience level
        if ($request->filled('experience_level')) {
            $query->byExperienceLevel($request->experience_level);
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->byLocation($request->location);
        }

        // Remote filter
        if ($request->boolean('remote')) {
            $query->remote();
        }

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Featured jobs
        if ($request->boolean('featured')) {
            $query->featured();
        }

        $jobs = $query->ordered()->paginate(12)->withQueryString();
        $featuredJobs = JobPosting::featured()->active()->take(6)->get();

        // Filter options
        $jobTypes = ['full-time', 'part-time', 'contract', 'internship', 'remote', 'freelance'];
        $industries = JobPosting::distinct()->pluck('industry')->sort();
        $experienceLevels = ['entry-level', 'mid-level', 'senior', 'executive'];
        $locations = JobPosting::where('is_remote', false)->distinct()->pluck('location')->sort();
        
        $heroImage = HeroSettings::getImageForPage('jobs') ?? HeroSettings::getDefaultImage('jobs');

        return view('public.jobs.index', compact(
            'jobs', 'featuredJobs', 'jobTypes', 'industries', 'experienceLevels', 'locations', 'heroImage'
        ));
    }

    public function show(JobPosting $job)
    {
        if (!$job->is_active || $job->is_expired) {
            abort(404);
        }

        // Increment views
        $job->incrementViews();

        $job->load(['alumni.user', 'alumni.posted']);

        // Related jobs
        $relatedJobs = JobPosting::active()
            ->where('id', '!=', $job->id)
            ->where(function ($query) use ($job) {
                $query->where('industry', $job->industry)
                      ->orWhere('job_type', $job->job_type)
                      ->orWhere('location', $job->location);
            })
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('public.jobs.show', compact('job', 'relatedJobs'));
    }

    public function apply(Request $request, JobPosting $job)
    {
        if (!$job->is_active || $job->is_expired) {
            return redirect()->back()
                ->with('error', 'This job posting is no longer available.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'cover_letter' => 'nullable|string|max:2000',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        // Here you would typically create an application record
        // and handle file uploads
        
        $job->incrementApplications();

        return redirect()->back()
            ->with('success', 'Your application has been submitted successfully!');
    }

    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Please login to post a job.');
        }

        $alumni = Alumni::where('user_id', auth()->id())->first();
        
        if (!$alumni) {
            return redirect()->route('public.alumni.register')
                ->with('info', 'Please register as alumni first to post jobs.');
        }

        return view('public.jobs.create', compact('alumni'));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            abort(403);
        }

        $alumni = Alumni::where('user_id', auth()->id())->first();
        
        if (!$alumni) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'job_type' => 'required|in:full-time,part-time,contract,internship,remote,freelance',
            'industry' => 'required|string|max:255',
            'experience_level' => 'required|in:entry-level,mid-level,senior,executive',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'salary_currency' => 'required|string|size:3',
            'application_url' => 'nullable|url|max:255',
            'application_email' => 'nullable|email|max:255',
            'application_deadline' => 'nullable|date|after:today',
            'is_remote' => 'boolean',
        ]);

        $validated['alumni_id'] = $alumni->id;
        $validated['is_active'] = true; // Auto-activate for now

        JobPosting::create($validated);

        return redirect()->route('public.jobs.index')
            ->with('success', 'Job posted successfully! It will be reviewed before being published.');
    }
}