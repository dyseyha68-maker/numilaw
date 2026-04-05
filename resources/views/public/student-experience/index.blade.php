@extends('layouts.public')

@section('title', $locale === 'kh' ? 'បទពិសោធន៍និស្សិត' : 'Student Experiences')

@push('styles')
<style>
    .studentexp-header {
        position: relative;
        overflow: hidden;
        background: #f5fff8;
        min-height: 350px;
        padding: 65px 0;
    }

    .studentexp-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .studentexp-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .studentexp-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .studentexp-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .studentexp-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .studentexp-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .studentexp-header .b5 {
        width: 110%; height: 110%;
        top: 30px; left: -5%;
        animation: moveB5 15s ease-in-out infinite alternate, colorB5 12s ease-in-out infinite alternate;
    }

    @keyframes moveB1 {
        0%   { transform: translate(0px, 0px) scale(1); }
        50%  { transform: translate(-40px, 30px) scale(1.1); }
        100% { transform: translate(20px, -40px) scale(0.92); }
    }
    @keyframes moveB2 {
        0%   { transform: translate(0px, 0px) scale(1); }
        50%  { transform: translate(35px, -25px) scale(0.93); }
        100% { transform: translate(-20px, 40px) scale(1.08); }
    }
    @keyframes moveB3 {
        0%   { transform: translate(0px, 0px) scale(1); }
        50%  { transform: translate(-30px, -35px) scale(1.06); }
        100% { transform: translate(40px, 20px) scale(0.94); }
    }
    @keyframes moveB4 {
        0%   { transform: translate(0px, 0px) scale(1); }
        50%  { transform: translate(25px, 30px) scale(1.05); }
        100% { transform: translate(-35px, -20px) scale(0.96); }
    }
    @keyframes moveB5 {
        0%   { transform: translate(0px, 0px) scale(1); }
        50%  { transform: translate(-50px, 20px) scale(1.08); }
        100% { transform: translate(30px, -30px) scale(0.95); }
    }

    @keyframes colorB1 {
        0%   { background: #50e878; }
        25%  { background: #c8f040; }
        50%  { background: #30d8c0; }
        75%  { background: #a0f060; }
        100% { background: #50e878; }
    }
    @keyframes colorB2 {
        0%   { background: #b8f050; }
        25%  { background: #40e8c0; }
        50%  { background: #f0e060; }
        75%  { background: #60d880; }
        100% { background: #b8f050; }
    }
    @keyframes colorB3 {
        0%   { background: #40d8b0; }
        25%  { background: #70f040; }
        50%  { background: #d8f080; }
        75%  { background: #20c8a0; }
        100% { background: #40d8b0; }
    }
    @keyframes colorB4 {
        0%   { background: #d0f870; }
        25%  { background: #50e890; }
        50%  { background: #a0f8d0; }
        75%  { background: #e8f050; }
        100% { background: #d0f870; }
    }
    @keyframes colorB5 {
        0%   { background: #50e878; }
        25%  { background: #40e8c0; }
        50%  { background: #c8f040; }
        75%  { background: #30d8c0; }
        100% { background: #50e878; }
    }

    .studentexp-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,255,248,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .studentexp-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .studentexp-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .studentexp-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }

    .experience-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .experience-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }
    
    .experience-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    
    .experience-card .card-body {
        padding: 20px;
    }
    
    .experience-card .student-name {
        font-weight: 600;
        color: #003A46;
        margin-bottom: 5px;
    }
    
    .experience-card .batch-year {
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 10px;
    }
    
    .experience-card .story-excerpt {
        color: #4b5563;
        font-size: 15px;
        line-height: 1.6;
    }
    
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }
    
    .gallery-item {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        aspect-ratio: 4/3;
    }
    
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .gallery-item:hover img {
        transform: scale(1.1);
    }
    
    .gallery-item .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        padding: 20px;
        color: #fff;
    }
    
    .club-card {
        background: #fff;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        border: 1px solid #e5e7eb;
    }
    
    .club-card .club-logo {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #003A46, #006d77);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 32px;
        margin-bottom: 15px;
    }
    
    .cta-section {
        background: linear-gradient(135deg, #003A46 0%, #006d77 100%);
        padding: 60px 0;
    }
    
    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    }
    
    .stat-card .number {
        font-size: 48px;
        font-weight: 700;
        color: #003A46;
    }
    
    .stat-card .label {
        color: #6b7280;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="studentexp-header">
    <div class="blob-wrapper">
        <div class="blob b1"></div>
        <div class="blob b2"></div>
        <div class="blob b3"></div>
        <div class="blob b4"></div>
        <div class="blob b5"></div>
    </div>
    <div class="fade-bottom"></div>
    <div class="container">
        <div class="header-content">
            <nav aria-label="breadcrumb" style="position: relative; z-index: 10;">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #003A46;">{{ __('navigation.home') }}</a></li>
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'បទពិសោធន៍និស្សិត' : 'Student Experiences' }}</li>
                </ol>
            </nav>
            <h1 class="header-title">
                {{ app()->getLocale() === 'km' ? 'បទពិសោធន៍និស្សិត' : 'Student Experiences' }}
            </h1>
            <p class="header-subtitle">
                {{ app()->getLocale() === 'km' ? 'ស្វែងយល់ពីរឿងរ៉ាវ និងបទពិសោធន៍របស់និស្សិត' : 'Discover the stories and experiences of our students' }}
            </p>
        </div>
    </div>
</section>

<!-- Featured Testimonials -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #003A46;">
                {{ $locale === 'kh' ? 'បទសម្ភាសន៍លេចធ្លាយ' : 'Featured Stories' }}
            </h2>
            <p class="text-muted">
                {{ $locale === 'kh' ? 'រឿងរ៉ាវ់និស្សិតដែលបានលេចធ្លាយ' : 'Outstanding student stories' }}
            </p>
        </div>
        
        <div class="row g-4">
            @forelse($featuredExperiences as $experience)
            <div class="col-md-6 col-lg-3">
                <div class="experience-card">
                    @if($experience->photo)
                    <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $experience->photo)) }}" alt="{{ $experience->student_name }}">
                    @else
                    <div style="height: 200px; background: linear-gradient(135deg, #003A46, #006d77); display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-person-fill text-white" style="font-size: 64px;"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <h5 class="student-name">{{ $experience->student_name }}</h5>
                        <p class="batch-year">{{ $locale === 'kh' ? ' វិញ្ញាសា' : 'Class of ' }}{{ $experience->batch_year }} - {{ $experience->program }}</p>
                        <p class="story-excerpt">
                            {{ Str::limit($locale === 'kh' ? $experience->story_kh : $experience->story_en, 100) }}
                        </p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">{{ $locale === 'kh' ? 'មិនទាន់មានទេ' : 'No stories yet' }}</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Campus Gallery Preview -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold" style="color: #003A46;">
                    {{ $locale === 'kh' ? 'ជីវិតក្នុងសាកលវិទ្យាល័យ' : 'Campus Life' }}
                </h2>
                <p class="text-muted mb-0">
                    {{ $locale === 'kh' ? 'ភាពសារម្ភក្នុងសាកលវិទ្យាល័យ' : 'Moments from our campus' }}
                </p>
            </div>
            <a href="{{ route('student-experience.gallery') }}" class="btn btn-outline-primary">
                {{ $locale === 'kh' ? 'មើលបន្ថែម' : 'View All' }}
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
        
        <div class="gallery-grid">
            @forelse($galleries as $gallery)
            <div class="gallery-item">
                <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $gallery->media_path)) }}" alt="{{ $locale === 'kh' ? $gallery->title_kh : $gallery->title_en }}">
                <div class="overlay">
                    <h6 class="mb-1">{{ $locale === 'kh' ? $gallery->title_kh : $gallery->title_en }}</h6>
                    <small>{{ $gallery->year }}</small>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-4">
                <p class="text-muted">{{ $locale === 'kh' ? 'មិនទាន់មានទេ' : 'No photos yet' }}</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Student Clubs -->
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold" style="color: #003A46;">
                    {{ $locale === 'kh' ? 'ក្លឹបនិស្សិត' : 'Student Clubs' }}
                </h2>
                <p class="text-muted mb-0">
                    {{ $locale === 'kh' ? 'ចូលរួមជាមួយក្លឹបផ្សេងៗ' : 'Join our vibrant student community' }}
                </p>
            </div>
            <a href="{{ route('student-experience.clubs') }}" class="btn btn-outline-primary">
                {{ $locale === 'kh' ? 'មើលបន្ថែម' : 'View All' }}
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
        
        <div class="row g-4">
            @forelse($clubs as $club)
            <div class="col-md-6 col-lg-3">
                <div class="club-card text-center">
                    <div class="club-logo mx-auto">
                        @if($club->logo)
                        <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $club->logo)) }}" alt="{{ $club->name_en }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                        @else
                        <i class="bi bi-people-fill"></i>
                        @endif
                    </div>
                    <h5 class="fw-bold" style="color: #003A46;">{{ $locale === 'kh' ? $club->name_kh : $club->name_en }}</h5>
                    @if($club->president_name)
                    <p class="text-muted small mb-0">{{ $locale === 'kh' ? 'ប្រធាន' : 'President' }}: {{ $club->president_name }}</p>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-4">
                <p class="text-muted">{{ $locale === 'kh' ? 'មិនទាន់មានក្លឹបទេ' : 'No clubs yet' }}</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center text-white">
                <h2 class="fw-bold mb-4">
                    {{ $locale === 'kh' ? 'ចែករំលែករឿងរ៉ាវ់របស់អ្នក' : 'Share Your Story' }}
                </h2>
                <p class="mb-4 opacity-75">
                    {{ $locale === 'kh' 
                        ? 'ប្រាប់យើងអំពីបទពិសោធន៍របស់អ្នកនៅ NUMiLaw ហើយជួយបង្រៀននិស្សិតជំនាន់ក្រោយ' 
                        : 'Tell us about your NUMiLaw experience and inspire future students' }}
                </p>
                <a href="{{ route('student-experience.submit') }}" class="btn btn-light btn-lg">
                    {{ $locale === 'kh' ? 'ដាក់ប្រតិភូ' : 'Submit Your Story' }}
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
