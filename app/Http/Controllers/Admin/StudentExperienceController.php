<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentExperience;
use App\Models\CampusGallery;
use App\Models\StudentClub;
use App\Models\InternshipStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentExperienceController extends Controller
{
    public function index()
    {
        $stats = [
            'pendingExperiences' => StudentExperience::pending()->count(),
            'pendingInternships' => InternshipStory::pending()->count(),
            'totalGalleries' => CampusGallery::count(),
            'activeClubs' => StudentClub::active()->count(),
        ];

        return view('admin.student-experience.index', compact('stats'));
    }

    public function experiences(Request $request)
    {
        $status = $request->get('status', 'all');
        $query = StudentExperience::query();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $experiences = $query->latest()->paginate(20);

        return view('admin.student-experience.experiences', compact('experiences', 'status'));
    }

    public function editExperience($id)
    {
        $experience = StudentExperience::findOrFail($id);
        return view('admin.student-experience.experiences-edit', compact('experience'));
    }

    public function updateExperience(Request $request, $id)
    {
        $experience = StudentExperience::findOrFail($id);

        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'batch_year' => 'required|integer|min:2000|max:2030',
            'program' => 'required|string|max:255',
            'story_en' => 'required|string',
            'story_kh' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'status' => 'required|in:pending,approved,rejected',
            'is_featured' => 'boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('photo')) {
            if ($experience->photo && Storage::disk('public')->exists($experience->photo)) {
                Storage::disk('public')->delete($experience->photo);
            }
            $path = $request->file('photo')->store('experiences', 'public');
            $validated['photo'] = $path;
        }

        $experience->update($validated);

        return redirect()->route('admin.student-experience.experiences')->with('success', 'Experience updated successfully.');
    }

    public function deleteExperience($id)
    {
        $experience = StudentExperience::findOrFail($id);
        
        if ($experience->photo && Storage::disk('public')->exists($experience->photo)) {
            Storage::disk('public')->delete($experience->photo);
        }
        
        $experience->delete();

        return redirect()->back()->with('success', 'Experience deleted.');
    }

    public function approveExperience($id)
    {
        $experience = StudentExperience::findOrFail($id);
        $experience->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Experience approved successfully.');
    }

    public function rejectExperience($id)
    {
        $experience = StudentExperience::findOrFail($id);
        $experience->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Experience rejected.');
    }

    public function featureExperience($id)
    {
        $experience = StudentExperience::findOrFail($id);
        $experience->update(['is_featured' => !$experience->is_featured]);

        return redirect()->back()->with('success', 'Featured status toggled.');
    }

    public function gallery()
    {
        $galleries = CampusGallery::latest()->paginate(20);
        return view('admin.student-experience.gallery.index', compact('galleries'));
    }

    public function createGallery()
    {
        return view('admin.student-experience.gallery.create');
    }

    public function editGallery($id)
    {
        $gallery = CampusGallery::findOrFail($id);
        return view('admin.student-experience.gallery.edit', compact('gallery'));
    }

    public function updateGallery(Request $request, $id)
    {
        $gallery = CampusGallery::findOrFail($id);

        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_kh' => 'required|string|max:255',
            'media_path' => 'nullable|file|max:10240',
            'media_type' => 'required|in:photo,video',
            'category' => 'required|in:events,moot_court,graduation,clubs,general',
            'year' => 'required|integer|min:2000|max:2030',
            'caption_en' => 'nullable|string',
            'caption_kh' => 'nullable|string',
        ]);

        if ($request->hasFile('media_path')) {
            if ($gallery->media_path && Storage::disk('public')->exists($gallery->media_path)) {
                Storage::disk('public')->delete($gallery->media_path);
            }
            $path = $request->file('media_path')->store('gallery', 'public');
            $validated['media_path'] = $path;
        }

        $gallery->update($validated);

        return redirect()->route('admin.student-experience.gallery.index')->with('success', 'Gallery item updated successfully.');
    }

    public function storeGallery(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_kh' => 'required|string|max:255',
            'media_path' => 'required|file|max:10240',
            'media_type' => 'required|in:photo,video',
            'category' => 'required|in:events,moot_court,graduation,clubs,general',
            'year' => 'required|integer|min:2000|max:2030',
            'caption_en' => 'nullable|string',
            'caption_kh' => 'nullable|string',
        ]);

        if ($request->hasFile('media_path')) {
            $path = $request->file('media_path')->store('gallery', 'public');
            $validated['media_path'] = $path;
        }

        CampusGallery::create($validated);

        return redirect()->route('admin.student-experience.gallery.index')->with('success', 'Gallery item created successfully.');
    }

    public function deleteGallery($id)
    {
        $gallery = CampusGallery::findOrFail($id);
        
        if ($gallery->media_path && Storage::disk('public')->exists($gallery->media_path)) {
            Storage::disk('public')->delete($gallery->media_path);
        }
        
        $gallery->delete();

        return redirect()->back()->with('success', 'Gallery item deleted.');
    }

    public function clubs()
    {
        $clubs = StudentClub::latest()->paginate(20);
        return view('admin.student-experience.clubs.index', compact('clubs'));
    }

    public function createClub()
    {
        return view('admin.student-experience.clubs.form');
    }

    public function storeClub(Request $request)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_kh' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_kh' => 'required|string',
            'logo' => 'nullable|image|max:2048',
            'president_name' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('clubs', 'public');
            $validated['logo'] = $path;
        }

        StudentClub::create($validated);

        return redirect()->route('admin.student-experience.clubs.index')->with('success', 'Club created successfully.');
    }

    public function editClub($id)
    {
        $club = StudentClub::findOrFail($id);
        return view('admin.student-experience.clubs.form', compact('club'));
    }

    public function updateClub(Request $request, $id)
    {
        $club = StudentClub::findOrFail($id);

        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_kh' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_kh' => 'required|string',
            'logo' => 'nullable|image|max:2048',
            'president_name' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            if ($club->logo && Storage::disk('public')->exists($club->logo)) {
                Storage::disk('public')->delete($club->logo);
            }
            $path = $request->file('logo')->store('clubs', 'public');
            $validated['logo'] = $path;
        }

        $club->update($validated);

        return redirect()->route('admin.student-experience.clubs.index')->with('success', 'Club updated successfully.');
    }

    public function deleteClub($id)
    {
        $club = StudentClub::findOrFail($id);
        
        if ($club->logo && Storage::disk('public')->exists($club->logo)) {
            Storage::disk('public')->delete($club->logo);
        }
        
        $club->delete();

        return redirect()->back()->with('success', 'Club deleted.');
    }

    public function internships(Request $request)
    {
        $status = $request->get('status', 'all');
        $query = InternshipStory::query();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $internships = $query->latest()->paginate(20);

        return view('admin.student-experience.internships', compact('internships', 'status'));
    }

    public function editInternship($id)
    {
        $internship = InternshipStory::findOrFail($id);
        return view('admin.student-experience.internships-edit', compact('internship'));
    }

    public function updateInternship(Request $request, $id)
    {
        $internship = InternshipStory::findOrFail($id);

        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'batch_year' => 'required|integer|min:2000|max:2030',
            'company_name' => 'required|string|max:255',
            'duration' => 'required|string|max:100',
            'story_en' => 'required|string',
            'story_kh' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
            'is_featured' => 'boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        $internship->update($validated);

        return redirect()->route('admin.student-experience.internships')->with('success', 'Internship updated successfully.');
    }

    public function deleteInternship($id)
    {
        $internship = InternshipStory::findOrFail($id);
        $internship->delete();

        return redirect()->back()->with('success', 'Internship deleted.');
    }

    public function approveInternship($id)
    {
        $internship = InternshipStory::findOrFail($id);
        $internship->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Internship approved successfully.');
    }

    public function rejectInternship($id)
    {
        $internship = InternshipStory::findOrFail($id);
        $internship->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Internship rejected.');
    }
}
