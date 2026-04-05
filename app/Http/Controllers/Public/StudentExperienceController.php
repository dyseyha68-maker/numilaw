<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\StudentExperience;
use App\Models\CampusGallery;
use App\Models\StudentClub;
use App\Models\InternshipStory;
use App\Models\HeroSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentExperienceController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();
        $featuredExperiences = StudentExperience::approved()->featured()->latest()->take(4)->get();
        $galleries = CampusGallery::latest()->take(6)->get();
        $clubs = StudentClub::active()->get();

        $heroImage = HeroSettings::getImageForPage('student_experience') ?? HeroSettings::getDefaultImage('student_experience');

        return view('public.student-experience.index', compact('featuredExperiences', 'galleries', 'clubs', 'locale', 'heroImage'));
    }

    public function gallery(Request $request)
    {
        $locale = app()->getLocale();
        $category = $request->get('category', 'all');

        $query = CampusGallery::query();
        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }

        $galleries = $query->latest()->paginate(12);

        return view('public.student-experience.gallery', compact('galleries', 'locale', 'category'));
    }

    public function clubs()
    {
        $locale = app()->getLocale();
        $clubs = StudentClub::active()->get();

        return view('public.student-experience.clubs', compact('clubs', 'locale'));
    }

    public function internships()
    {
        $locale = app()->getLocale();
        $internships = InternshipStory::approved()->latest()->paginate(9);

        return view('public.student-experience.internships', compact('internships', 'locale'));
    }

    public function submitExperience()
    {
        $locale = app()->getLocale();
        return view('public.student-experience.submit-form', compact('locale'));
    }

    public function storeExperience(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'batch_year' => 'required|integer|min:2000|max:2030',
            'program' => 'required|string|max:255',
            'story_en' => 'required|string|min:100',
            'story_kh' => 'required|string|min:50',
            'photo' => 'nullable|image|max:2048',
            'hp_field' => 'nullable|confirmed',
        ]);

        if (!empty($validated['hp_field'])) {
            return redirect()->back()->with('error', 'Invalid submission.');
        }

        unset($validated['hp_field']);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('experiences', 'public');
            $validated['photo'] = $path;
        }

        $validated['status'] = 'pending';
        $validated['is_featured'] = false;

        StudentExperience::create($validated);

        return redirect()->route('student-experience.submit')->with('success', app()->getLocale() === 'kh' 
            ? 'ប្រតិភូការរបស់អ្នកបានជោគជ័យ! យើងនឹងពិនិត្យមើលវាក្នុងពេលឆាប់។'
            : 'Your submission has been received successfully! We will review it shortly.');
    }

    public function submitInternship()
    {
        $locale = app()->getLocale();
        return view('public.student-experience.internship-form', compact('locale'));
    }

    public function storeInternship(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'batch_year' => 'required|integer|min:2000|max:2030',
            'company_name' => 'required|string|max:255',
            'duration' => 'required|string|max:100',
            'story_en' => 'required|string|min:100',
            'story_kh' => 'required|string|min:50',
            'hp_field' => 'nullable|confirmed',
        ]);

        if (!empty($validated['hp_field'])) {
            return redirect()->back()->with('error', 'Invalid submission.');
        }

        unset($validated['hp_field']);

        $validated['status'] = 'pending';
        $validated['is_featured'] = false;

        InternshipStory::create($validated);

        return redirect()->route('student-experience.internship.submit')->with('success', app()->getLocale() === 'kh' 
            ? 'ប្រតិភូការអនុវត្តន៍របស់អ្នកបានជោគជ័យ!'
            : 'Your internship story has been submitted successfully!');
    }
}
