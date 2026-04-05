<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AcademicProgram;
use App\Models\Application;
use App\Models\HeroSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AdmissionController extends Controller
{
    public function index()
    {
        $allPrograms = AcademicProgram::active()->ordered()->where('degree_type', 'bachelor')->get();

        $programGroups = [
            'bachelor' => $allPrograms,
        ];

        $importantDates = collect([
            ['title_en' => 'Application Opens', 'title_km' => 'ការប្រាក់ចូល', 'date' => 'March 1, 2026', 'type' => 'application_open', 'is_upcoming' => false],
            ['title_en' => 'Application Deadline', 'title_km' => 'ថ្ងៃបិទទ្វេក្យ', 'date' => 'May 31, 2026', 'type' => 'deadline', 'is_upcoming' => true],
            ['title_en' => 'Entrance Examination', 'title_km' => 'ការប្រឡងចូល', 'date' => 'June 15, 2026', 'type' => 'exam', 'is_upcoming' => true],
            ['title_en' => 'Results Announcement', 'title_km' => 'ប្រកាសលទ្ធផល', 'date' => 'July 1, 2026', 'type' => 'results', 'is_upcoming' => true],
        ]);

        $statistics = [
            ['icon' => 'bi-people-fill', 'number' => '1,200+', 'label_en' => 'New Students Yearly', 'label_km' => 'និស្សិតថ្មីប្រжел'],
            ['icon' => 'bi-trophy-fill', 'number' => '95%', 'label_en' => 'Employment Rate', 'label_km' => 'អត្រកការងារ'],
        ];

        $heroImage = HeroSettings::getImageForPage('admission') ?? HeroSettings::getDefaultImage('admission');

        return view('public.admission.index', compact('programGroups', 'importantDates', 'statistics', 'heroImage'));
    }

    public function programDetail($slug)
    {
        $program = AcademicProgram::where('slug', $slug)->active()->where('degree_type', 'bachelor')->firstOrFail();
        $relatedPrograms = AcademicProgram::where('degree_type', 'bachelor')->where('id', '!=', $program->id)->active()->take(3)->get();
        return view('public.admission.program-detail', compact('program', 'relatedPrograms'));
    }

    public function apply($program)
    {
        $program = AcademicProgram::where('slug', $program)->active()->where('degree_type', 'bachelor')->firstOrFail();
        return view('public.admission.apply', compact('program'));
    }

    public function submitApplication(Request $request, $program)
    {
        Log::info('Form submitted', ['program_param' => $program, 'all_data' => $request->all()]);
        
        try {
            $program = AcademicProgram::where('slug', $program)->active()->firstOrFail();

            $validated = $request->validate([
                'first_name_en' => 'required|string|max:255',
                'last_name_en' => 'required|string|max:255',
                'first_name_km' => 'nullable|string|max:255',
                'last_name_km' => 'nullable|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'date_of_birth' => 'required|date|before:today',
                'nationality' => 'required|string|max:100',
                'address' => 'required|string|max:500',
                'high_school' => 'required|string|max:255',
                'graduation_year' => 'required|integer|min:1950|max:' . (date('Y') + 1),
                'gpa' => 'required|numeric|min:0|max:4',
                'english_level' => 'required|in:beginner,intermediate,advanced,fluent',
                'education_type' => 'nullable|string|max:100',
                'study_gap' => 'nullable|string|max:255',
                'motivation_letter' => 'required|string|min:200',
                'experience' => 'nullable|string',
                'achievements' => 'nullable|string',
                'interests' => 'nullable|string',
                'reference_name' => 'required|string|max:255',
                'reference_email' => 'required|email|max:255',
                'reference_phone' => 'required|string|max:20',
                'reference_title' => 'nullable|string|max:255',
                'terms_accepted' => 'required|boolean',
            ]);

            $application = Application::create([
                'program_id' => $program->id,
                'first_name_en' => $validated['first_name_en'],
                'last_name_en' => $validated['last_name_en'],
                'first_name_km' => $validated['first_name_km'] ?? null,
                'last_name_km' => $validated['last_name_km'] ?? null,
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'date_of_birth' => $validated['date_of_birth'],
                'nationality' => $validated['nationality'],
                'address' => $validated['address'],
                'high_school' => $validated['high_school'],
                'graduation_year' => $validated['graduation_year'],
                'gpa' => $validated['gpa'],
                'english_level' => $validated['english_level'],
                'motivation_letter' => $validated['motivation_letter'],
                'reference_name' => $validated['reference_name'],
                'reference_email' => $validated['reference_email'],
                'application_reference' => 'APP-' . strtoupper(Str::random(8)),
                'status' => 'pending',
            ]);

            return redirect()->route('public.admission.success')
                ->with('application_reference', $application->application_reference)
                ->with('success', 'Your application has been submitted successfully!');
        } catch (\Exception $e) {
            Log::error('Application submission failed', ['error' => $e->getMessage()]);
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function success()
    {
        return view('public.admission.success');
    }

    public function requirements()
    {
        $generalRequirements = [
            ['title_en' => 'Academic Requirements', 'items_en' => ['High school diploma', 'Minimum GPA 2.5/4.0', 'Official transcripts', 'English proficiency proof']],
            ['title_en' => 'Required Documents', 'items_en' => ['Completed application form', 'Birth certificate copy', 'National ID or passport', 'Passport-sized photos']],
            ['title_en' => 'Application Process', 'items_en' => ['Submit online application', 'Pay application fee', 'Attend entrance exam', 'Receive admission decision']],
        ];

        $programRequirements = [
            'bachelor' => ['title_en' => "Bachelor's Degree Programs", 'additional_en' => ['No prior legal knowledge required', 'Foundation year included', 'Internship mandatory']],
            'master' => ['title_en' => "Master's Degree Programs", 'additional_en' => ["Bachelor's degree in law", '2 years work experience', 'Research proposal required']],
            'doctorate' => ['title_en' => 'PhD Program', 'additional_en' => ["Master's degree in law", '5 years experience', 'Comprehensive research proposal']],
        ];

        $heroImage = HeroSettings::getImageForPage('admission_requirements') ?? HeroSettings::getDefaultImage('admission_requirements');

        return view('public.admission.requirements', compact('generalRequirements', 'programRequirements', 'heroImage'));
    }
}
