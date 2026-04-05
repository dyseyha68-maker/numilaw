@extends('layouts.public')

@section('title', $locale === 'kh' ? 'ដាក់ប្រតិភូបទពិសោធន៍ការងារ' : 'Share Your Internship')

@push('styles')
<style>
    .internshipform-header {
        position: relative;
        overflow: hidden;
        background: #f5f8ff;
        min-height: 350px;
        padding: 65px 0;
    }

    .internshipform-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .internshipform-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .internshipform-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .internshipform-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .internshipform-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .internshipform-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .internshipform-header .b5 {
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

    .internshipform-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,248,255,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .internshipform-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .internshipform-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .internshipform-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }

    .submit-hero {
        background: linear-gradient(135deg, #003A46 0%, #004d5c 100%);
        padding: 60px 0;
    }
    
    .form-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 40px rgba(0,0,0,0.1);
        padding: 40px;
        margin-top: -40px;
        position: relative;
    }
    
    .form-floating label {
        color: #6b7280;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #003A46;
        box-shadow: 0 0 0 0.2rem rgba(0,58,70,0.15);
    }
    
    .hp-field {
        position: absolute;
        left: -9999px;
        opacity: 0;
        pointer-events: none;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="internshipform-header">
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
                    <li class="breadcrumb-item"><a href="{{ route('student-experience.index') }}" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'បទពិសោធន៍និស្សិត' : 'Student Experiences' }}</a></li>
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ $locale === 'kh' ? 'ចែករំលែកបទពិសោធន៍' : 'Share Your Experience' }}</li>
                </ol>
            </nav>
            <h1 class="header-title">
                {{ $locale === 'kh' ? 'ចែករំលែកបទពិសោធន៍' : 'Share Your Experience' }}
            </h1>
            <p class="header-subtitle">
                {{ $locale === 'kh' 
                    ? 'ប្រាប់យើងអំពីបទពិសោធន៍ការងាររបស់អ្នក' 
                    : 'Tell us about your internship experience' }}
            </p>
        </div>
    </div>
</section>

<!-- Form Section -->
<section class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="form-card">
                    @if(session('success'))
                    <div class="alert alert-success d-flex align-items-center mb-4">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                    </div>
                    @endif
                    
                    @if($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <form method="POST" action="{{ route('student-experience.internship.store') }}">
                        @csrf
                        
                        <!-- Honeypot field -->
                        <div class="hp-field">
                            <label for="hp_field">Leave this empty</label>
                            <input type="text" name="hp_field" id="hp_field" tabindex="-1" autocomplete="off">
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="student_name" name="student_name" 
                                           value="{{ old('student_name') }}" placeholder="Your Name" required>
                                    <label for="student_name">{{ $locale === 'kh' ? 'ឈ្មោះ' : 'Your Name' }} *</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="batch_year" name="batch_year" required>
                                        <option value="">{{ $locale === 'kh' ? 'ជ្រើសរើស' : 'Select' }}</option>
                                        @for($year = date('Y'); $year >= 2000; $year--)
                                        <option value="{{ $year }}" {{ old('batch_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                    <label for="batch_year">{{ $locale === 'kh' ? 'ឆ្នាំ' : 'Batch Year' }} *</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="company_name" name="company_name" 
                                           value="{{ old('company_name') }}" placeholder="Company Name" required>
                                    <label for="company_name">{{ $locale === 'kh' ? 'ឈ្មោះក្រុមហ៊ុន' : 'Company/Organization' }} *</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="duration" name="duration" 
                                           value="{{ old('duration') }}" placeholder="Duration" required>
                                    <label for="duration">{{ $locale === 'kh' ? 'រយៈពេល' : 'Duration' }} *</label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="story_en" name="story_en" 
                                              placeholder="Your Experience in English" style="height: 150px" required>{{ old('story_en') }}</textarea>
                                    <label for="story_en">{{ $locale === 'kh' ? 'បទពិសោធន៍ (អង់គ្លេស)' : 'Your Experience (English)' }} *</label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="story_kh" name="story_kh" 
                                              placeholder="Your Experience in Khmer" style="height: 150px" required>{{ old('story_kh') }}</textarea>
                                    <label for="story_kh">{{ $locale === 'kh' ? 'បទពិសោធន៍ (ខ្មែរ)' : 'Your Experience (Khmer)' }} *</label>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="bi bi-send me-2"></i>
                                    {{ $locale === 'kh' ? 'ដាក់ប្រតិភូ' : 'Submit' }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
