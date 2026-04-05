<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\AcademicProgram;
use App\Models\AlumniConnection;
use App\Models\HeroSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $query = Alumni::approved()->with(['user', 'program'])->withContactConsent();

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

        // View type (grid/list)
        $viewType = $request->get('view', 'grid');

        $alumni = $query->latest()->paginate(12)->withQueryString();
        $programs = AcademicProgram::active()->ordered()->get();
        $industries = Alumni::whereNotNull('industry')->distinct()->pluck('industry')->sort();
        $locations = Alumni::whereNotNull('location')->distinct()->pluck('location')->sort();
        $graduationYears = Alumni::distinct()->orderBy('graduation_year', 'desc')->pluck('graduation_year');

        // Featured alumni for showcase
        $featuredAlumni = Alumni::featured()->approved()->with(['user', 'program'])->take(6)->get();
        
        $heroImage = HeroSettings::getImageForPage('alumni') ?? HeroSettings::getDefaultImage('alumni');

        return view('public.alumni.index', compact(
            'alumni', 'programs', 'industries', 'locations', 'graduationYears',
            'featuredAlumni', 'viewType', 'heroImage'
        ));
    }

    public function show(Alumni $alumni)
    {
        // Only show approved alumni with contact consent
        if (!$alumni->is_approved || !$alumni->contact_consent) {
            abort(404);
        }

        $alumni->load(['user', 'program', 'testimonials' => function ($query) {
            $query->active()->ordered();
        }]);

        // Related alumni by program or graduation year
        $relatedAlumni = Alumni::approved()
            ->with(['user', 'program'])
            ->where('id', '!=', $alumni->id)
            ->where(function ($query) use ($alumni) {
                $query->where('program_id', $alumni->program_id)
                      ->orWhere('graduation_year', $alumni->graduation_year);
            })
            ->take(4)
            ->get();

        return view('public.alumni.show', compact('alumni', 'relatedAlumni'));
    }

    public function featured()
    {
        $featuredAlumni = Alumni::featured()
            ->approved()
            ->with(['user', 'program'])
            ->latest()
            ->paginate(12);

        return view('public.alumni.featured', compact('featuredAlumni'));
    }

    public function stories()
    {
        // Get alumni with testimonials
        $alumniStories = Alumni::approved()
            ->with(['user', 'program', 'testimonials' => function ($query) {
                $query->active()->featured()->ordered();
            }])
            ->whereHas('testimonials', function ($query) {
                $query->active()->featured();
            })
            ->paginate(12);

        return view('public.alumni.stories', compact('alumniStories'));
    }

    public function register()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Please login to register as alumni.');
        }

        // Check if already registered as alumni
        $existingAlumni = Alumni::where('user_id', auth()->id())->first();
        if ($existingAlumni) {
            return redirect()->route('public.alumni.show', $existingAlumni)
                ->with('info', 'You are already registered as alumni.');
        }

        $programs = AcademicProgram::active()->ordered()->get();
        return view('public.alumni.register', compact('programs'));
    }

    public function storeRegistration(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Check if already registered
        $existingAlumni = Alumni::where('user_id', auth()->id())->first();
        if ($existingAlumni) {
            return redirect()->route('public.alumni.show', $existingAlumni)
                ->with('info', 'You are already registered as alumni.');
        }

        $validated = $request->validate([
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
            'contact_consent' => 'required|boolean',
            'newsletter_consent' => 'required|boolean',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        // Handle file uploads
        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')->store('alumni/profile-pictures', 'public');
        }

        if ($request->hasFile('cv_file')) {
            $validated['cv_file'] = $request->file('cv_file')->store('alumni/cv', 'public');
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending'; // Requires admin approval

        Alumni::create($validated);

        return redirect()->route('public.alumni.success')
            ->with('success', 'Your alumni registration has been submitted successfully. It will be reviewed by the administration.');
    }

    public function success()
    {
        return view('public.alumni.success');
    }

    public function connect(Request $request, Alumni $alumni)
    {
        // Only allow connections between approved alumni
        if (!auth()->check() || !$alumni->contact_consent) {
            abort(403);
        }

        $currentUserAlumni = Alumni::where('user_id', auth()->id())
            ->approved()
            ->first();

        if (!$currentUserAlumni) {
            return redirect()->route('public.alumni.register')
                ->with('info', 'Please register as alumni first to connect with others.');
        }

        // Check if already connected
        if ($currentUserAlumni->isConnectedWith($alumni->id)) {
            return redirect()->back()
                ->with('info', 'You are already connected with this alumni.');
        }

        // Check if already sent request
        $existingRequest = AlumniConnection::where('requester_id', $currentUserAlumni->id)
            ->where('recipient_id', $alumni->id)
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            return redirect()->back()
                ->with('info', 'You have already sent a connection request.');
        }

        $validated = $request->validate([
            'message' => 'required|string|max:500'
        ]);

        AlumniConnection::create([
            'requester_id' => $currentUserAlumni->id,
            'recipient_id' => $alumni->id,
            'message' => $validated['message'],
            'status' => 'pending'
        ]);

        return redirect()->back()
            ->with('success', 'Connection request sent successfully.');
    }

    public function profile()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $alumni = Alumni::where('user_id', auth()->id())->first();
        
        if (!$alumni) {
            return redirect()->route('public.alumni.register');
        }

        // Load relationships
        $alumni->load(['user', 'program', 'sentConnections', 'receivedConnections']);

        $pendingRequests = $alumni->getPendingConnectionRequests()->with('requester.user')->get();
        $acceptedConnections = $alumni->sentConnections()
            ->where('status', 'accepted')
            ->orWhere(function ($query) use ($alumni) {
                $query->where('recipient_id', $alumni->id)
                      ->where('status', 'accepted');
            })
            ->with(['requester.user', 'recipient.user'])
            ->get();

        return view('public.alumni.profile', compact('alumni', 'pendingRequests', 'acceptedConnections'));
    }

    public function editProfile()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $alumni = Alumni::where('user_id', auth()->id())->first();
        
        if (!$alumni) {
            return redirect()->route('public.alumni.register');
        }

        $programs = AcademicProgram::active()->ordered()->get();
        return view('public.alumni.edit', compact('alumni', 'programs'));
    }

    public function updateProfile(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $alumni = Alumni::where('user_id', auth()->id())->first();
        
        if (!$alumni) {
            return redirect()->route('public.alumni.register');
        }

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
            'contact_consent' => 'required|boolean',
            'newsletter_consent' => 'required|boolean',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
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

        $alumni->update($validated);

        return redirect()->route('public.alumni.profile')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * API endpoint for alumni directory (for React components)
     */
    public function apiIndex(Request $request)
    {
        $query = Alumni::approved()->with(['user', 'program'])->withContactConsent();

        // Filter by program
        if ($request->filled('program')) {
            $query->byProgram($request->program);
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

        // Paginate results
        $alumni = $query->paginate(12);

        return response()->json([
            'success' => true,
            'data' => $alumni->items(),
            'pagination' => [
                'current_page' => $alumni->currentPage(),
                'last_page' => $alumni->lastPage(),
                'per_page' => $alumni->perPage(),
                'total' => $alumni->total(),
            ]
        ]);
    }

    /**
     * API endpoint for connection requests (for React components)
     */
    public function apiConnect(Request $request, Alumni $alumni)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Authentication required'
            ], 401);
        }

        $user = auth()->user();
        
        // Check if user is an alumni
        if (!$user->alumni) {
            return response()->json([
                'success' => false,
                'message' => 'Only alumni can send connection requests'
            ], 403);
        }

        // Check if connection already exists
        $existingConnection = AlumniConnection::where('alumni_id', $user->alumni->id)
            ->where('connected_alumni_id', $alumni->id)
            ->first();

        if ($existingConnection) {
            return response()->json([
                'success' => false,
                'message' => 'Connection request already sent'
            ], 422);
        }

        // Create connection request
        AlumniConnection::create([
            'alumni_id' => $user->alumni->id,
            'connected_alumni_id' => $alumni->id,
            'status' => 'pending',
            'message' => $request->input('message', 'I would like to connect with you!')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Connection request sent successfully!'
        ]);
    }
}