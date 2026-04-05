<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AcademicProgram;
use App\Models\Course;
use App\Models\HeroSettings;
use App\Models\MootParticipation;
use Illuminate\Http\Request;

class AcademicProgramController extends Controller
{
    public function index()
    {
        $programs = AcademicProgram::active()
            ->ordered()
            ->get()
            ->groupBy('degree_type');

        $degreeTypes = [
            "Bachelor's Degree" => app()->getLocale() === 'km' ? 'បរិញ្ញាប័ត្រ' : "Bachelor's Degree",
            "Master's Degree" => app()->getLocale() === 'km' ? 'បណ្ឌិត្យសភា' : "Master's Degree",
            "Doctorate" => app()->getLocale() === 'km' ? ' បណ្ឌិត' : 'Doctorate',
            "Certificate" => app()->getLocale() === 'km' ? ' វិញ្ញាបនបត្រ' : 'Certificate',
        ];

        $heroImage = HeroSettings::getImageForPage('programs') ?? HeroSettings::getDefaultImage('programs');

        $featuredParticipations = MootParticipation::with(['moot', 'teams.members'])
            ->published()
            ->latest('year')
            ->take(6)
            ->get();

        $llbProgram = AcademicProgram::where('slug', 'bachelor-of-laws')->first();
        $courses = [];
        if ($llbProgram) {
            $courses = Course::where('program_id', $llbProgram->id)
                ->where('is_active', true)
                ->orderBy('year')
                ->orderBy('semester')
                ->orderBy('sort_order')
                ->get()
                ->groupBy('year');
        }

        return view('public.academic-programs.index', compact('programs', 'degreeTypes', 'heroImage', 'featuredParticipations', 'courses'));
    }

    public function show($slug)
    {
        $program = AcademicProgram::where('slug', $slug)
            ->active()
            ->firstOrFail();

        $courses = Course::where('program_id', $program->id)
            ->where('is_active', true)
            ->orderBy('year')
            ->orderBy('semester')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('year');

        $relatedPrograms = AcademicProgram::active()
            ->where('degree_type', $program->degree_type)
            ->where('id', '!=', $program->id)
            ->limit(3)
            ->get();

        $heroImage = HeroSettings::getImageForPage('program_detail') ?? HeroSettings::getDefaultImage('program_detail');

        return view('public.academic-programs.show', compact('program', 'courses', 'relatedPrograms', 'heroImage'));
    }
}
