<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use App\Models\HeroSettings;
use App\Models\Leadership;

class PublicAboutController extends Controller
{
    public function index()
    {
        $sections = AboutSection::active()->ordered()->get();
        $leadership = Leadership::active()->ordered()->get();
        $heroImage = HeroSettings::getImageForPage('about') ?? HeroSettings::getDefaultImage('about');
        
        return view('public.about.index', compact('sections', 'leadership', 'heroImage'));
    }

    public function overview()
    {
        $overview = AboutSection::where('type', 'overview')
            ->active()
            ->first();
        $heroImage = HeroSettings::getImageForPage('about_overview') ?? HeroSettings::getDefaultImage('about_overview');
            
        return view('public.about.overview', compact('overview', 'heroImage'));
    }

    public function mission()
    {
        $mission = AboutSection::where('type', 'mission')
            ->active()
            ->first();
        $heroImage = HeroSettings::getImageForPage('about_mission') ?? HeroSettings::getDefaultImage('about_mission');
            
        return view('public.about.mission', compact('mission', 'heroImage'));
    }

    public function vision()
    {
        $vision = AboutSection::where('type', 'vision')
            ->active()
            ->first();
        $heroImage = HeroSettings::getImageForPage('about_vision') ?? HeroSettings::getDefaultImage('about_vision');
            
        return view('public.about.vision', compact('vision', 'heroImage'));
    }

    public function leadership()
    {
        $leadership = Leadership::active()->ordered()->get();
        $heroImage = HeroSettings::getImageForPage('leadership') ?? HeroSettings::getDefaultImage('leadership');
        
        return view('public.about.leadership', compact('leadership', 'heroImage'));
    }
}