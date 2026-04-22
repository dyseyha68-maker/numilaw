@extends('layouts.public')

@section('title', $locale === 'kh' ? 'ការទទួលយក' : 'Admissions')

@push('styles')
<style>
    :root {
        --brand-primary: #003A46;
        --brand-light: #005f73;
        --brand-accent: #0a9396;
        --brand-gradient: linear-gradient(135deg, #003A46 0%, #005f73 50%, #0a9396 100%);
    }
    
    .admission-header {
        position: relative;
        overflow: hidden;
        background: #f5f8ff;
        min-height: 350px;
        padding: 65px 0;
    }

    .admission-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .admission-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .admission-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .admission-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .admission-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .admission-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .admission-header .b5 {
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
        25%  { background: #48e8c8; }
        50%  { background: #a8f030; }
        75%  { background: #68f028; }
        100% { background: #b8f050; }
    }
    @keyframes colorB3 {
        0%   { background: #28e8a0; }
        25%  { background: #f0d830; }
        50%  { background: #38e860; }
        75%  { background: #d8f040; }
        100% { background: #28e8a0; }
    }
    @keyframes colorB4 {
        0%   { background: #c0f048; }
        25%  { background: #38e8b8; }
        50%  { background: #88f038; }
        75%  { background: #18e888; }
        100% { background: #c0f048; }
    }
    @keyframes colorB5 {
        0%   { background: #58e870; }
        25%  { background: #d0f028; }
        50%  { background: #40e880; }
        75%  { background: #f05840; }
        100% { background: #58e870; }
    }
    
    .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }
    
    .header-title {
        font-size: 2.5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--brand-primary);
        margin-bottom: 0.5rem;
    }
    
    .header-subtitle {
        font-size: 1.1rem;
        color: #6b7280;
    }
    
    .breadcrumb-nav {
        padding: 0;
        margin: 0;
        list-style: none;
        display: flex;
        gap: 8px;
        align-items: center;
        font-size: 0.875rem;
    }
    
    .breadcrumb-nav li {
        display: flex;
        align-items: center;
    }
    
    .breadcrumb-nav li a {
        color: var(--brand-primary);
        text-decoration: none;
        opacity: 0.7;
        transition: opacity 0.2s;
    }
    
    .breadcrumb-nav li a:hover {
        opacity: 1;
    }
    
    .breadcrumb-nav li::after {
        content: '/';
        margin-left: 8px;
        color: #d1d5db;
    }
    
    .breadcrumb-nav li:last-child::after {
        content: '';
    }
    
    .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, transparent, #f8fafb);
        pointer-events: none;
    }
    
    .program-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .program-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }
    
    .program-card .badge-scholarship {
        position: absolute;
        top: 15px;
        right: 15px;
    }
    
    .process-step {
        text-align: center;
        padding: 20px;
    }
    
    .process-step .step-number {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #003A46, #006d77);
        color: white;
        font-size: 24px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
    }
    
    .faq-item {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        margin-bottom: 10px;
        overflow: hidden;
    }
    
    .faq-item .question {
        padding: 15px 20px;
        background: #f8fafc;
        cursor: pointer;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .faq-item .answer {
        padding: 15px 20px;
        display: none;
    }
    
    .faq-item.open .answer {
        display: block;
    }
</style>
@endpush

@section('content')
<!-- Hero Section with Blob Animation -->
<section class="admission-header">
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
            <ul class="breadcrumb-nav">
                <li><a href="{{ url('/') }}">{{ $locale === 'kh' ? 'ទំព័រដេី' : 'Home' }}</a></li>
                <li>{{ $locale === 'kh' ? 'ការទទួលយក' : 'Admissions' }}</li>
            </ul>
            <h1 class="header-title">
                {{ $locale === 'kh' ? 'ចាប់ផ្តើមដំណើររបស់អ្នកនៅ NUMiLaw' : 'Begin Your Legal Journey at NUMiLaw' }}
            </h1>
            <p class="header-subtitle">
                {{ $locale === 'kh' 
                    ? ' បណ្ឌិតសភាច្បាប់ រដ្ឋសាកលវិទ្យាល័យជាតិគ្រប់គ្រង'
                    : 'Faculty of Law, National University of Management' }}
            </p>
            <div class="d-flex gap-3 mt-4">
                <a href="{{ route('admissions.apply') }}" class="btn btn-primary btn-lg" style="background: var(--brand-primary); border-color: var(--brand-primary);">
                    {{ $locale === 'kh' ? 'ដាក់ពាក់ឥឡូវ' : 'Apply Now' }}
                </a>
                <a href="{{ route('admissions.track') }}" class="btn btn-outline-primary btn-lg" style="color: var(--brand-primary); border-color: var(--brand-primary);">
                    {{ $locale === 'kh' ? 'តាមដំណើរពាក្យ' : 'Track Application' }}
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose NUMiLaw -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #003A46;">
                {{ $locale === 'kh' ? 'ហេតុអ្វីត្រូវជ្រើសរើស NUMiLaw?' : 'Why Choose NUMiLaw?' }}
            </h2>
        </div>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="text-center p-4">
                    <div class="mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #003A46, #006d77); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="bi bi-book text-white" style="font-size: 32px;"></i>
                    </div>
                    <h5>{{ $locale === 'kh' ? 'គ្រូបង្រៀនជំនាញ' : 'Expert Faculty' }}</h5>
                    <p class="text-muted small mb-0">{{ $locale === 'kh' ? 'គ្រូបង្រៀនមានបទពិសោធន៍ជាច្រើន' : 'Experienced legal professionals' }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-4">
                    <div class="mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #003A46, #006d77); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="bi bi-gavel text-white" style="font-size: 32px;"></i>
                    </div>
                    <h5>{{ $locale === 'kh' ? 'កម្មវិធី Moot Court' : 'Moot Court Program' }}</h5>
                    <p class="text-muted small mb-0">{{ $locale === 'kh' ? 'ការហាត់តុលាការ' : 'Practical litigation training' }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-4">
                    <div class="mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #003A46, #006d77); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="bi bi-translate text-white" style="font-size: 32px;"></i>
                    </div>
                    <h5>{{ $locale === 'kh' ? 'ការអប់រំពីរភាសា' : 'Bilingual Education' }}</h5>
                    <p class="text-muted small mb-0">{{ $locale === 'kh' ? 'អង់គ្លេស និង ខ្មែរ' : 'English & Khmer' }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-4">
                    <div class="mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #003A46, #006d77); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="bi bi-briefcase text-white" style="font-size: 32px;"></i>
                    </div>
                    <h5>{{ $locale === 'kh' ? 'ការគាំទ្រអាជីព' : 'Career Support' }}</h5>
                    <p class="text-muted small mb-0">{{ $locale === 'kh' ? 'ជំនួយការងារ' : 'Job placement assistance' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Programs Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #003A46;">
                {{ $locale === 'kh' ? 'កម្មវិធីសិក្សា' : 'Our Programs' }}
            </h2>
        </div>
        
        <ul class="nav nav-pills mb-4 justify-content-center" id="programTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#all">
                    {{ $locale === 'kh' ? 'ទាំងអស់' : 'All' }}
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#bachelor">
                    {{ $locale === 'kh' ? ' បរិញ្ញាប័ត្រ' : 'Bachelor' }}
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#master">
                    {{ $locale === 'kh' ? ' បណ្ឌិត' : 'Master' }}
                </button>
            </li>
        </ul>
        
        <div class="tab-content">
            <div class="tab-pane fade show active" id="all">
                <div class="row g-4">
                    @forelse($programs->flatten() as $program)
                    <div class="col-md-4">
                        <div class="program-card h-100">
                            @if($program->scholarship_available)
                            <span class="badge bg-warning badge-scholarship">{{ $locale === 'kh' ? 'ឧបត្ថម្ភ' : 'Scholarship' }}</span>
                            @endif
                            <div class="p-4">
                                <h5 class="fw-bold mb-2">{{ $locale === 'kh' ? $program->name_kh : $program->name_en }}</h5>
                                <p class="text-muted small mb-3">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $locale === 'kh' ? $program->duration_kh : $program->duration_en }}
                                </p>
                                <p class="text-muted small mb-3">
                                    <i class="bi bi-currency-dollar me-1"></i>
                                    {{ $locale === 'kh' ? $program->tuition_kh : $program->tuition_en }}
                                </p>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admissions.program.detail', $program->id) }}" class="btn btn-outline-primary btn-sm">
                                        {{ $locale === 'kh' ? 'មើលលំអិត' : 'Details' }}
                                    </a>
                                    <a href="{{ route('admissions.apply') }}" class="btn btn-primary btn-sm">
                                        {{ $locale === 'kh' ? 'Apply' : 'Apply' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-4">
                        <p class="text-muted">{{ $locale === 'kh' ? 'មិនទាន់មានទេ' : 'No programs available' }}</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('admissions.programs') }}" class="btn btn-outline-primary">
                {{ $locale === 'kh' ? 'មើលកម្មវិធីទាំងអស់' : 'View All Programs' }}
            </a>
        </div>
    </div>
</section>

<!-- Admission Process -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #003A46;">
                {{ $locale === 'kh' ? 'ដំណើរការទទួលយក' : 'Admission Process' }}
            </h2>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h5>{{ $locale === 'kh' ? 'ជ្រើសរើសកម្មវិធី' : 'Choose Program' }}</h5>
                    <p class="text-muted small">{{ $locale === 'kh' ? 'ជ្រើសរើសកម្មវិធីសិក្សា' : 'Select your desired program' }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h5>{{ $locale === 'kh' ? 'បំពេញពាក្យ' : 'Complete Application' }}</h5>
                    <p class="text-muted small">{{ $locale === 'kh' ? 'បំពេញទំរង់ពាក់កណ្តាល' : 'Fill out the application form' }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h5>{{ $locale === 'kh' ? ' ទទួលលទ្ធផល' : 'Get Results' }}</h5>
                    <p class="text-muted small">{{ $locale === 'kh' ? 'ទទួលបានការទទួលយក' : 'Receive admission decision' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Key Dates -->
@if($openIntakes->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #003A46;">
                {{ $locale === 'kh' ? 'កាលបរិច្ឆេទសំខាន់' : 'Key Dates' }}
            </h2>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>{{ $locale === 'kh' ? 'កម្មវិធី' : 'Program' }}</th>
                        <th>{{ $locale === 'kh' ? ' Intake' : 'Intake' }}</th>
                        <th>{{ $locale === 'kh' ? 'ថ្ងៃបិទ' : 'Deadline' }}</th>
                        <th>{{ $locale === 'kh' ? 'ទីផេយ' : 'Seats' }}</th>
                        <th>{{ $locale === 'kh' ? 'ស្ថាន' : 'Status' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($openIntakes as $intake)
                    <tr>
                        <td>{{ $locale === 'kh' ? $intake->program->name_kh : $intake->program->name_en }}</td>
                        <td>{{ $locale === 'kh' ? $intake->intake_name_kh : $intake->intake_name_en }}</td>
                        <td>{{ \Carbon\Carbon::parse($intake->application_end)->format('d M Y') }}</td>
                        <td>{{ $intake->max_seats }}</td>
                        <td><span class="badge bg-success">{{ $locale === 'kh' ? 'កំពុងបើក' : 'Open' }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endif

<!-- FAQ -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #003A46;">
                {{ $locale === 'kh' ? ' សំណួរដែលសួរញឹកញាប់' : 'Frequently Asked Questions' }}
            </h2>
        </div>
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @foreach($faqs as $index => $faq)
                <div class="faq-item">
                    <div class="question" onclick="this.parentElement.classList.toggle('open')">
                        {{ $locale === 'kh' ? $faq['question_kh'] : $faq['question_en'] }}
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="answer">
                        {{ $locale === 'kh' ? $faq['answer_kh'] : $faq['answer_en'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5" style="background: linear-gradient(135deg, #003A46, #006d77);">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center text-white">
                <h2 class="fw-bold mb-4">
                    {{ $locale === 'kh' ? 'ត្រៀមដាក់ពាក់?' : 'Ready to Apply?' }}
                </h2>
                <p class="mb-4 opacity-75">
                    {{ $locale === 'kh' 
                        ? 'ចាប់ផ្តើមដំណើររបស់អ្នកនៅថ្ងៃនេះ'
                        : 'Start your journey with us today' }}
                </p>
                <a href="{{ route('admissions.apply') }}" class="btn btn-light btn-lg">
                    {{ $locale === 'kh' ? 'Apply Now' : 'Apply Now' }}
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
