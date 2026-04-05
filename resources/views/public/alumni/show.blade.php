@extends('layouts.public')

@section('title', $alumni->full_name)

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
    
    .alumni-show-header {
        position: relative;
        overflow: hidden;
        background: #f5f8ff;
        min-height: 350px;
        padding: 65px 0;
    }

    .alumni-show-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .alumni-show-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .alumni-show-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .alumni-show-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .alumni-show-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .alumni-show-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .alumni-show-header .b5 {
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

    .alumni-show-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,248,255,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .alumni-show-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .alumni-show-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .alumni-show-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }
    
    .profile-avatar {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border: 6px solid white;
        box-shadow: 0 15px 50px rgba(0, 58, 70, 0.3);
    }
    
    .featured-badge {
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        color: #fff;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .info-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 58, 70, 0.08);
        border: none;
    }
    
    .info-card .card-body {
        padding: 1.75rem;
    }
    
    .section-title {
        color: var(--brand-primary);
        font-weight: 700;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .info-label {
        color: #94a3b8;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .info-value {
        color: var(--brand-primary);
        font-weight: 600;
        font-size: 1rem;
    }
    
    .skill-badge {
        background: linear-gradient(135deg, #e0f2fe, #bae6fd);
        color: var(--brand-primary);
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
        margin: 4px;
        display: inline-block;
    }
    
    .achievement-item {
        padding: 12px 0;
        border-bottom: 1px solid #f0f4f8;
    }
    
    .achievement-item:last-child {
        border-bottom: none;
    }
    
    .achievement-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #166534;
    }
    
    .btn-brand {
        background: var(--brand-gradient);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px 28px;
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
        padding: 12px 28px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-outline-brand:hover {
        background: var(--brand-primary);
        color: white;
    }
    
    .social-btn {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.15);
        color: white;
        transition: all 0.3s;
        text-decoration: none;
    }
    
    .social-btn:hover {
        background: white;
        color: var(--brand-primary);
        transform: translateY(-3px);
    }
    
    .contact-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .year-tag {
        background: linear-gradient(135deg, #e0f2fe, #bae6fd);
        color: var(--brand-primary);
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .program-tag {
        background: linear-gradient(135deg, #f0fdf4, #bbf7d0);
        color: #166534;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .verified-badge {
        background: linear-gradient(135deg, #dcfce7, #86efac);
        color: #166534;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .modal-content {
        border-radius: 20px;
        border: none;
    }
    
    .modal-header {
        background: var(--brand-gradient);
        border-radius: 20px 20px 0 0;
        border: none;
    }
    
    .breadcrumb-item a {
        color: #003A46;
        text-decoration: none;
    }
    
    .breadcrumb-item.active {
        color: #64748b;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        color: #64748b;
    }
</style>
@endpush

@section('content')
<!-- Profile Header -->
<section class="alumni-show-header">
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
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background: transparent; padding: 0; margin-bottom: 0.5rem;">
                    <li class="breadcrumb-item"><a href="/" style="color: #003A46;">{{ __('common.home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('public.alumni.index') }}" style="color: #003A46;">{{ __('alumni.alumni_directory') }}</a></li>
                    <li class="breadcrumb-item active" style="color: #64748b;">{{ $alumni->full_name }}</li>
                </ol>
            </nav>
            <div class="row align-items-center mt-4">
                <div class="col-lg-3 text-center mb-4 mb-lg-0">
                    <div class="position-relative d-inline-block">
                        <img src="{{ $alumni->profile_image_url }}" 
                             alt="{{ $alumni->full_name }}" 
                             class="profile-avatar rounded-circle">
                        @if($alumni->is_featured)
                            <span class="position-absolute top-0 end-0 featured-badge">
                                <i class="bi bi-star-fill me-1"></i> Featured
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <h1 class="header-title">{{ $alumni->full_name }}</h1>
                    <p class="header-subtitle">{{ $alumni->current_position }}</p>
                    @if($alumni->company)
                        <p class="header-subtitle" style="opacity: 0.8;">{{ $alumni->company }}</p>
                    @endif
                    
                    <div class="d-flex flex-wrap gap-3 align-items-center mt-3">
                        @if($alumni->graduation_year)
                            <span class="year-tag">
                                <i class="bi bi-mortarboard me-1"></i>Class of {{ $alumni->graduation_year }}
                            </span>
                        @endif
                        @if($alumni->program)
                            <span class="program-tag">{{ $alumni->program->title }}</span>
                        @endif
                        @if($alumni->is_verified)
                            <span class="verified-badge">
                                <i class="bi bi-check-circle me-1"></i>{{ __('alumni.verified') }}
                            </span>
                        @endif
                    </div>
                    
                    @if($alumni->current_location)
                        <p style="color: #64748b; margin-top: 0.5rem; margin-bottom: 0;">
                            <i class="bi bi-geo-alt me-2"></i>{{ $alumni->current_location }}
                        </p>
                    @endif
                </div>
                
                <div class="col-lg-3 mt-4 mt-lg-0">
                    <div class="contact-card">
                        @if(auth()->check() && auth()->user()->id !== $alumni->user_id)
                            <button class="btn btn-light w-100 mb-3 fw-semibold" onclick="showConnectModal()">
                                <i class="bi bi-person-plus me-2"></i>{{ __('alumni.connect') }}
                            </button>
                        @endif
                        
                        <div class="d-flex justify-content-center gap-2 mb-3">
                            @if($alumni->linkedin_url)
                                <a href="{{ $alumni->linkedin_url }}" target="_blank" class="social-btn" title="LinkedIn">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            @endif
                            @if($alumni->facebook_url)
                                <a href="{{ $alumni->facebook_url }}" target="_blank" class="social-btn" title="Facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>
                            @endif
                            @if($alumni->twitter_url)
                                <a href="{{ $alumni->twitter_url }}" target="_blank" class="social-btn" title="Twitter">
                                    <i class="bi bi-twitter"></i>
                                </a>
                            @endif
                        </div>
                        
                        <div style="color: white; font-size: 0.875rem;">
                            @if($alumni->phone)
                                <div class="mb-2">
                                    <i class="bi bi-telephone me-2"></i>{{ $alumni->phone }}
                                </div>
                            @endif
                            <div>
                                <i class="bi bi-envelope me-2"></i>{{ $alumni->email }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Profile Details -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <!-- Bio -->
                @if($alumni->bio)
                <div class="info-card mb-4">
                    <div class="card-body">
                        <h5 class="section-title mb-4">
                            <i class="bi bi-person me-2"></i>{{ __('alumni.about') }} {{ $alumni->first_name }}
                        </h5>
                        <div class="content" style="line-height: 1.8; color: #4b5563;">
                            {!! nl2br(e($alumni->bio)) !!}
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Achievements -->
                @if($alumni->achievements && count($alumni->achievements) > 0)
                <div class="info-card mb-4">
                    <div class="card-body">
                        <h5 class="section-title mb-4">
                            <i class="bi bi-trophy me-2"></i>{{ __('alumni.achievements') }}
                        </h5>
                        @foreach($alumni->achievements as $achievement)
                            <div class="achievement-item d-flex align-items-start">
                                <div class="achievement-icon me-3 flex-shrink-0">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <p class="mb-0" style="color: #4b5563;">{{ $achievement }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Skills -->
                @if($alumni->skills && count($alumni->skills) > 0)
                <div class="info-card mb-4">
                    <div class="card-body">
                        <h5 class="section-title mb-4">
                            <i class="bi bi-star me-2"></i>{{ __('alumni.skills') }}
                        </h5>
                        <div>
                            @foreach($alumni->skills as $skill)
                                <span class="skill-badge">{{ $skill }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- CV/Resume -->
                @if($alumni->cv_file)
                <div class="info-card">
                    <div class="card-body">
                        <h5 class="section-title mb-4">
                            <i class="bi bi-file-text me-2"></i>{{ __('alumni.resume') }}
                        </h5>
                        <a href="{{ asset('storage/' . $alumni->cv_file) }}" 
                           target="_blank" class="btn btn-brand">
                            <i class="bi bi-download me-2"></i>{{ __('alumni.download_resume') }}
                        </a>
                    </div>
                </div>
                @endif
            </div>
            
            <div class="col-lg-4">
                <!-- Academic Background -->
                <div class="info-card mb-4">
                    <div class="card-body">
                        <h5 class="section-title mb-4">
                            <i class="bi bi-mortarboard me-2"></i>{{ __('alumni.academic_background') }}
                        </h5>
                        <div class="mb-3">
                            <div class="info-label mb-1">{{ __('alumni.program') }}</div>
                            <div class="info-value">{{ $alumni->program?->title ?? __('alumni.not_specified') }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="info-label mb-1">{{ __('alumni.graduation_year') }}</div>
                            <div class="info-value">{{ $alumni->graduation_year }}</div>
                        </div>
                        @if($alumni->student_id)
                            <div>
                                <div class="info-label mb-1">{{ __('alumni.student_id') }}</div>
                                <div class="info-value">{{ $alumni->student_id }}</div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Professional Info -->
                <div class="info-card mb-4">
                    <div class="card-body">
                        <h5 class="section-title mb-4">
                            <i class="bi bi-briefcase me-2"></i>{{ __('alumni.professional_info') }}
                        </h5>
                        <div class="mb-3">
                            <div class="info-label mb-1">{{ __('alumni.current_position') }}</div>
                            <div class="info-value">{{ $alumni->current_position ?? __('alumni.not_specified') }}</div>
                        </div>
                        @if($alumni->company)
                            <div class="mb-3">
                                <div class="info-label mb-1">{{ __('alumni.company') }}</div>
                                <div class="info-value">{{ $alumni->company }}</div>
                            </div>
                        @endif
                        @if($alumni->industry)
                            <div class="mb-3">
                                <div class="info-label mb-1">{{ __('alumni.industry') }}</div>
                                <div class="info-value">{{ $alumni->industry }}</div>
                            </div>
                        @endif
                        @if($alumni->current_location)
                            <div>
                                <div class="info-label mb-1">{{ __('alumni.location') }}</div>
                                <div class="info-value">{{ $alumni->current_location }}</div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Contact Preferences -->
                <div class="info-card">
                    <div class="card-body">
                        <h5 class="section-title mb-4">
                            <i class="bi bi-shield-check me-2"></i>{{ __('alumni.contact_preferences') }}
                        </h5>
                        <div class="mb-2">
                            <small class="{{ $alumni->contact_consent ? 'text-success' : 'text-danger' }}">
                                <i class="bi {{ $alumni->contact_consent ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }} me-1"></i> 
                                {{ $alumni->contact_consent ? __('alumni.contact_allowed') : __('alumni.contact_not_allowed') }}
                            </small>
                        </div>
                        <div>
                            <small class="{{ $alumni->newsletter_consent ? 'text-success' : 'text-danger' }}">
                                <i class="bi {{ $alumni->newsletter_consent ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }} me-1"></i> 
                                {{ $alumni->newsletter_consent ? __('alumni.newsletter_allowed') : __('alumni.newsletter_not_allowed') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Connect Modal -->
@if(auth()->check() && auth()->user()->id !== $alumni->user_id)
<div class="modal fade" id="connectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-white fw-bold">
                    <i class="bi bi-link-45deg me-2"></i>{{ __('alumni.connect_with') }} {{ $alumni->first_name }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="connectForm" method="POST" action="{{ route('public.alumni.connect', $alumni) }}">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold brand-text">{{ __('alumni.message') }}</label>
                        <textarea name="message" class="form-control" rows="4" 
                                  placeholder="{{ __('alumni.connection_message_placeholder') }}"
                                  style="border: 2px solid #eef2f6; border-radius: 12px;">{{ __('alumni.default_connection_message') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 12px;">
                        {{ __('common.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-brand">
                        <i class="bi bi-send me-2"></i>{{ __('alumni.send_request') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<script>
function showConnectModal() {
    const modal = new bootstrap.Modal(document.getElementById('connectModal'));
    modal.show();
}

document.getElementById('connectForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> {{ __("alumni.sending") }}...';
    
    fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('connectModal'));
            modal.hide();
            alert(data.message || '{{ __("alumni.connection_sent") }}');
        } else {
            alert(data.message || '{{ __("alumni.connection_failed") }}');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('{{ __("alumni.connection_error") }}');
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    });
});
</script>
@endsection
