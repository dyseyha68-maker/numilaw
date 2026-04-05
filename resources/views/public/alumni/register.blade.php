@extends('layouts.public')

@section('title', __('alumni.register_as_alumni'))

@push('styles')
<style>
    :root {
        --brand-primary: #003A46;
        --brand-light: #005f73;
        --brand-accent: #0a9396;
        --brand-gradient: linear-gradient(135deg, #003A46 0%, #005f73 50%, #0a9396 100%);
    }
    
    .brand-text { color: var(--brand-primary); }
    .brand-bg { background: var(--brand-primary); }
    .brand-gradient { background: var(--brand-gradient); }
    
    .alumni-register-header {
        position: relative;
        overflow: hidden;
        background: #f5f8ff;
        min-height: 350px;
        padding: 65px 0;
    }

    .alumni-register-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .alumni-register-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .alumni-register-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .alumni-register-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .alumni-register-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .alumni-register-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .alumni-register-header .b5 {
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

    .alumni-register-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,248,255,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .alumni-register-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .alumni-register-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .alumni-register-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }
    
    .form-card {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0, 58, 70, 0.1);
        border: none;
        overflow: hidden;
    }
    
    .form-header {
        background: var(--brand-gradient);
        padding: 2rem;
        color: white;
    }
    
    .section-label {
        color: var(--brand-primary);
        font-weight: 700;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
    }
    
    .modern-input, .modern-select {
        border: 2px solid #eef2f6;
        border-radius: 12px;
        padding: 14px 16px;
        transition: all 0.3s;
        background: #fafbfc;
    }
    
    .modern-input:focus, .modern-select:focus {
        border-color: var(--brand-primary);
        box-shadow: 0 0 0 4px rgba(0, 58, 70, 0.1);
        outline: none;
        background: #fff;
    }
    
    .form-check-input:checked {
        background-color: var(--brand-primary);
        border-color: var(--brand-primary);
    }
    
    .form-check-input:focus {
        box-shadow: 0 0 0 4px rgba(0, 58, 70, 0.15);
    }
    
    .btn-brand {
        background: var(--brand-gradient);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 14px 32px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-brand:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0, 58, 70, 0.3);
        color: white;
    }
    
    .btn-outline-brand {
        background: transparent;
        color: var(--brand-primary);
        border: 2px solid var(--brand-primary);
        border-radius: 12px;
        padding: 14px 32px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-outline-brand:hover {
        background: var(--brand-primary);
        color: white;
    }
    
    .stat-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        line-height: 1;
    }
    
    .progress-card {
        position: fixed;
        bottom: 24px;
        right: 24px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 58, 70, 0.2);
        padding: 1rem 1.5rem;
        z-index: 1000;
        max-width: 280px;
    }
    
    .progress-bar-custom {
        height: 8px;
        border-radius: 10px;
        background: #eef2f6;
        overflow: hidden;
    }
    
    .progress-bar-fill {
        height: 100%;
        background: var(--brand-gradient);
        border-radius: 10px;
        transition: width 0.3s ease;
    }
    
    .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, #e0f2fe, #bae6fd);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--brand-primary);
    }
    
    .required-label::after {
        content: ' *';
        color: #ef4444;
    }
    
    .file-upload {
        border: 2px dashed #eef2f6;
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s;
        cursor: pointer;
    }
    
    .file-upload:hover {
        border-color: var(--brand-primary);
        background: #f8fafc;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="alumni-register-header mb-5">
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
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="header-title">{{ __('alumni.register_as_alumni') }}</h1>
                    <p class="header-subtitle">
                        Join our prestigious alumni network and connect with fellow graduates, 
                        access exclusive opportunities, and stay engaged with the NUMiLaw community.
                    </p>
                    <div class="d-flex gap-3 flex-wrap mt-4">
                        <a href="{{ route('public.alumni.index') }}" class="btn btn-brand btn-lg fw-semibold">
                            <i class="bi bi-arrow-left me-2"></i>{{ __('alumni.back_to_directory') }}
                        </a>
                        <a href="{{ route('public.alumni.stories') }}" class="btn btn-outline-brand btn-lg fw-semibold">
                            <i class="bi bi-book me-2"></i>{{ __('alumni.success_stories') }}
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="stat-card">
                        <i class="bi bi-people fs-1 d-block mb-3"></i>
                        <div class="stat-number">{{ \App\Models\Alumni::count() }}+</div>
                        <div style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'ពួកពាល់' : 'Alumni Members' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Registration Form -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="form-card">
                    <div class="form-header">
                        <h3 class="h4 mb-1">{{ __('alumni.alumni_registration_form') }}</h3>
                        <p class="mb-0 opacity-90">{{ __('alumni.registration_description') }}</p>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('public.alumni.register.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Personal Information -->
                            <div class="mb-5">
                                <h5 class="section-label">
                                    <div class="icon-box d-inline-flex me-2">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    {{ __('alumni.personal_information') }}
                                </h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required-label">{{ __('alumni.first_name') }}</label>
                                        <input type="text" name="first_name" class="form-control modern-input" 
                                               value="{{ old('first_name', auth()->user()->first_name ?? '') }}" required>
                                        @error('first_name')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required-label">{{ __('alumni.last_name') }}</label>
                                        <input type="text" name="last_name" class="form-control modern-input" 
                                               value="{{ old('last_name', auth()->user()->last_name ?? '') }}" required>
                                        @error('last_name')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required-label">{{ __('alumni.email') }}</label>
                                        <input type="email" name="email" class="form-control modern-input" 
                                               value="{{ old('email', auth()->user()->email ?? '') }}" required>
                                        @error('email')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">{{ __('alumni.phone') }}</label>
                                        <input type="tel" name="phone" class="form-control modern-input" 
                                               value="{{ old('phone') }}">
                                        @error('phone')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Academic Information -->
                            <div class="mb-5">
                                <h5 class="section-label">
                                    <div class="icon-box d-inline-flex me-2">
                                        <i class="bi bi-mortarboard"></i>
                                    </div>
                                    {{ __('alumni.academic_information') }}
                                </h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">{{ __('alumni.program') }}</label>
                                        <select name="program_id" class="form-select modern-select">
                                            <option value="">{{ __('alumni.select_program') }}</option>
                                            @foreach($programs as $program)
                                                <option value="{{ $program->id }}" 
                                                        {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                                    {{ $program->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('program_id')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">{{ __('alumni.student_id') }}</label>
                                        <input type="text" name="student_id" class="form-control modern-input" 
                                               value="{{ old('student_id') }}">
                                        @error('student_id')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required-label">{{ __('alumni.graduation_year') }}</label>
                                        <select name="graduation_year" class="form-select modern-select" required>
                                            <option value="">{{ __('alumni.select_year') }}</option>
                                            @for($year = now()->year; $year >= 1950; $year--)
                                                <option value="{{ $year }}" 
                                                        {{ old('graduation_year') == $year ? 'selected' : '' }}>
                                                    {{ $year }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('graduation_year')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Professional Information -->
                            <div class="mb-5">
                                <h5 class="section-label">
                                    <div class="icon-box d-inline-flex me-2">
                                        <i class="bi bi-briefcase"></i>
                                    </div>
                                    {{ __('alumni.professional_information') }}
                                </h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">{{ __('alumni.current_job_title') }}</label>
                                        <input type="text" name="current_job_title" class="form-control modern-input" 
                                               value="{{ old('current_job_title') }}">
                                        @error('current_job_title')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">{{ __('alumni.company') }}</label>
                                        <input type="text" name="company" class="form-control modern-input" 
                                               value="{{ old('company') }}">
                                        @error('company')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">{{ __('alumni.industry') }}</label>
                                        <input type="text" name="industry" class="form-control modern-input" 
                                               value="{{ old('industry') }}">
                                        @error('industry')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">{{ __('alumni.location') }}</label>
                                        <input type="text" name="location" class="form-control modern-input" 
                                               value="{{ old('location') }}">
                                        @error('location')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Social Media -->
                            <div class="mb-5">
                                <h5 class="section-label">
                                    <div class="icon-box d-inline-flex me-2">
                                        <i class="bi bi-share"></i>
                                    </div>
                                    {{ __('alumni.social_media') }}
                                </h5>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">{{ __('alumni.linkedin_url') }}</label>
                                        <input type="url" name="linkedin_url" class="form-control modern-input" 
                                               value="{{ old('linkedin_url') }}"
                                               placeholder="https://linkedin.com/in/username">
                                        @error('linkedin_url')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">{{ __('alumni.facebook_url') }}</label>
                                        <input type="url" name="facebook_url" class="form-control modern-input" 
                                               value="{{ old('facebook_url') }}"
                                               placeholder="https://facebook.com/username">
                                        @error('facebook_url')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">{{ __('alumni.twitter_url') }}</label>
                                        <input type="url" name="twitter_url" class="form-control modern-input" 
                                               value="{{ old('twitter_url') }}"
                                               placeholder="https://twitter.com/username">
                                        @error('twitter_url')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Bio -->
                            <div class="mb-5">
                                <h5 class="section-label">
                                    <div class="icon-box d-inline-flex me-2">
                                        <i class="bi bi-card-text"></i>
                                    </div>
                                    {{ __('alumni.bio') }}
                                </h5>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('alumni.tell_us_about_yourself') }}</label>
                                    <textarea name="bio" class="form-control modern-input" rows="5" 
                                              placeholder="{{ __('alumni.bio_placeholder') }}">{{ old('bio') }}</textarea>
                                    <small class="text-muted">{{ __('alumni.max_characters', ['count' => 2000]) }}</small>
                                    @error('bio')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Profile Picture -->
                            <div class="mb-5">
                                <h5 class="section-label">
                                    <div class="icon-box d-inline-flex me-2">
                                        <i class="bi bi-image"></i>
                                    </div>
                                    {{ __('alumni.profile_picture') }}
                                </h5>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('alumni.upload_profile_picture') }}</label>
                                    <input type="file" name="profile_picture" class="form-control modern-input" 
                                           accept="image/jpeg,image/jpg,image/png,image/gif">
                                    <small class="text-muted">{{ __('alumni.max_file_size', ['size' => '2MB']) }}</small>
                                    @error('profile_picture')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- CV/Resume -->
                            <div class="mb-5">
                                <h5 class="section-label">
                                    <div class="icon-box d-inline-flex me-2">
                                        <i class="bi bi-file-text"></i>
                                    </div>
                                    {{ __('alumni.cv_resume') }}
                                </h5>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('alumni.upload_cv') }}</label>
                                    <input type="file" name="cv_file" class="form-control modern-input" 
                                           accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                    <small class="text-muted">{{ __('alumni.max_file_size', ['size' => '5MB']) }}</small>
                                    @error('cv_file')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Consent -->
                            <div class="mb-4">
                                <h5 class="section-label">
                                    <div class="icon-box d-inline-flex me-2">
                                        <i class="bi bi-shield-check"></i>
                                    </div>
                                    {{ __('alumni.privacy_consent') }}
                                </h5>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="contact_consent" 
                                               value="1" id="contact_consent" required>
                                        <label class="form-check-label" for="contact_consent">
                                            {{ __('alumni.contact_consent_text') }}
                                        </label>
                                    </div>
                                    @error('contact_consent')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="newsletter_consent" 
                                               value="1" id="newsletter_consent" required>
                                        <label class="form-check-label" for="newsletter_consent">
                                            {{ __('alumni.newsletter_consent_text') }}
                                        </label>
                                    </div>
                                    @error('newsletter_consent')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-flex gap-3">
                                <button type="submit" class="btn btn-brand">
                                    <i class="bi bi-send me-2"></i>{{ __('alumni.submit_registration') }}
                                </button>
                                <a href="{{ route('public.alumni.index') }}" class="btn btn-outline-brand">
                                    {{ __('common.cancel') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Progress Indicator -->
<div class="progress-card" id="progressCard" style="display: none;">
    <h6 class="mb-2" style="color: var(--brand-primary); font-weight: 600;">{{ __('alumni.registration_progress') }}</h6>
    <div class="progress-bar-custom mb-2">
        <div class="progress-bar-fill" id="progressBar" style="width: 0%"></div>
    </div>
    <small class="text-muted" id="progressText">0% {{ __('alumni.completed') }}</small>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const progressCard = document.getElementById('progressCard');
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');
    
    function updateProgress() {
        const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
        const filled = Array.from(inputs).filter(input => input.value.trim() !== '').length;
        const percentage = Math.round((filled / inputs.length) * 100);
        
        progressBar.style.width = percentage + '%';
        progressText.textContent = percentage + '% {{ __("alumni.completed") }}';
        
        if (percentage > 0) {
            progressCard.style.display = 'block';
        }
    }
    
    form.addEventListener('input', updateProgress);
    form.addEventListener('change', updateProgress);
    updateProgress();
});
</script>
@endsection
