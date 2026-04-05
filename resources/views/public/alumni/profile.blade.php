@extends('layouts.public')

@section('title', __('alumni.my_profile'))

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
    
    .alumni-profile-header {
        position: relative;
        overflow: hidden;
        background: #f5f8ff;
        min-height: 350px;
        padding: 65px 0;
    }

    .alumni-profile-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .alumni-profile-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .alumni-profile-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .alumni-profile-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .alumni-profile-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .alumni-profile-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .alumni-profile-header .b5 {
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

    .alumni-profile-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,248,255,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .alumni-profile-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .alumni-profile-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .alumni-profile-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }
    
    .profile-avatar {
        width: 160px;
        height: 160px;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 10px 40px rgba(0, 58, 70, 0.25);
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
        font-size: 1rem;
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
    
    .btn-brand {
        background: var(--brand-gradient);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px 24px;
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
        padding: 12px 24px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-outline-brand:hover {
        background: var(--brand-primary);
        color: white;
    }
    
    .stat-box {
        text-align: center;
        padding: 1rem;
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--brand-primary);
    }
    
    .stat-label {
        font-size: 0.85rem;
        color: #64748b;
    }
    
    .connection-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0, 58, 70, 0.08);
        border: none;
        transition: all 0.3s;
    }
    
    .connection-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 58, 70, 0.15);
    }
    
    .connection-avatar {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border: 3px solid white;
        box-shadow: 0 5px 20px rgba(0, 58, 70, 0.15);
    }
    
    .nav-tabs-custom {
        border: none;
        gap: 1rem;
    }
    
    .nav-tabs-custom .nav-link {
        border: none;
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 600;
        color: #64748b;
        background: #f1f5f9;
        transition: all 0.3s;
    }
    
    .nav-tabs-custom .nav-link.active {
        background: var(--brand-gradient);
        color: white;
    }
    
    .nav-tabs-custom .nav-link:hover {
        color: var(--brand-primary);
    }
    
    .pending-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0, 58, 70, 0.08);
        border: none;
    }
    
    .pending-avatar {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border: 3px solid white;
        box-shadow: 0 5px 15px rgba(0, 58, 70, 0.1);
    }
    
    .accept-btn {
        background: linear-gradient(135deg, #22c55e, #16a34a);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 8px 20px;
        font-weight: 600;
    }
    
    .reject-btn {
        background: #fee2e2;
        color: #dc2626;
        border: none;
        border-radius: 10px;
        padding: 8px 20px;
        font-weight: 600;
    }
    
    .social-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f5f9;
        color: var(--brand-primary);
        transition: all 0.3s;
        text-decoration: none;
    }
    
    .social-btn:hover {
        background: var(--brand-primary);
        color: white;
    }
    
    .skill-badge {
        background: linear-gradient(135deg, #e0f2fe, #bae6fd);
        color: var(--brand-primary);
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
    }
</style>
@endpush

@section('content')
<!-- Profile Header -->
<section class="alumni-profile-header">
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
                    <h1 class="header-title">{{ __('alumni.my_profile') }}</h1>
                    <p class="header-subtitle">
                        Manage your alumni profile, connections, and stay connected with the NUMiLaw community.
                    </p>
                    <div class="d-flex gap-3 flex-wrap mt-4">
                        <a href="{{ route('public.alumni.profile.edit') }}" class="btn btn-brand btn-lg fw-semibold">
                            <i class="bi bi-pencil me-2"></i>{{ __('alumni.edit_profile') }}
                        </a>
                        <a href="{{ route('public.alumni.index') }}" class="btn btn-outline-brand btn-lg fw-semibold">
                            <i class="bi bi-arrow-left me-2"></i>{{ __('alumni.back_to_directory') }}
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 text-center mt-4 mt-lg-0">
                    <img src="{{ $alumni->profile_image_url }}" 
                         alt="{{ $alumni->full_name }}" 
                         class="profile-avatar rounded-circle mb-3">
                    <h3 class="mb-1" style="color: #003A46;">{{ $alumni->full_name }}</h3>
                    <p class="mb-0" style="color: #64748b;">{{ $alumni->current_position }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Profile Content -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Profile Information -->
            <div class="col-lg-8">
                <div class="info-card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="section-title mb-0">{{ __('alumni.profile_information') }}</h5>
                            <a href="{{ route('public.alumni.profile.edit') }}" class="btn btn-outline-brand btn-sm">
                                <i class="bi bi-pencil me-1"></i>{{ __('alumni.edit') }}
                            </a>
                        </div>
                        
                        <!-- Contact Information -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="info-label mb-1">{{ __('alumni.email') }}</div>
                                <div class="info-value">{{ $alumni->email }}</div>
                            </div>
                            @if($alumni->phone)
                                <div class="col-md-6">
                                    <div class="info-label mb-1">{{ __('alumni.phone') }}</div>
                                    <div class="info-value">{{ $alumni->phone }}</div>
                                </div>
                            @endif
                            @if($alumni->current_location)
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <div class="info-label mb-1">{{ __('alumni.location') }}</div>
                                    <div class="info-value">{{ $alumni->current_location }}</div>
                                </div>
                            @endif
                        </div>

                        <!-- Professional Information -->
                        @if($alumni->current_position || $alumni->company || $alumni->industry)
                        <div class="mb-4 pt-3" style="border-top: 1px solid #eef2f6;">
                            <h6 class="info-label mb-3">{{ __('alumni.professional_information') }}</h6>
                            <div class="row">
                                @if($alumni->current_position)
                                    <div class="col-md-6 mb-3">
                                        <div class="info-label mb-1">{{ __('alumni.current_position') }}</div>
                                        <div class="info-value">{{ $alumni->current_position }}</div>
                                    </div>
                                @endif
                                @if($alumni->company)
                                    <div class="col-md-6 mb-3">
                                        <div class="info-label mb-1">{{ __('alumni.company') }}</div>
                                        <div class="info-value">{{ $alumni->company }}</div>
                                    </div>
                                @endif
                                @if($alumni->industry)
                                    <div class="col-md-6">
                                        <div class="info-label mb-1">{{ __('alumni.industry') }}</div>
                                        <div class="info-value">{{ $alumni->industry }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Academic Information -->
                        <div class="mb-4 pt-3" style="border-top: 1px solid #eef2f6;">
                            <h6 class="info-label mb-3">{{ __('alumni.academic_information') }}</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="info-label mb-1">{{ __('alumni.program') }}</div>
                                    <div class="info-value">{{ $alumni->program?->title ?? __('alumni.not_specified') }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="info-label mb-1">{{ __('alumni.graduation_year') }}</div>
                                    <div class="info-value">{{ $alumni->graduation_year }}</div>
                                </div>
                                @if($alumni->student_id)
                                    <div class="col-md-6">
                                        <div class="info-label mb-1">{{ __('alumni.student_id') }}</div>
                                        <div class="info-value">{{ $alumni->student_id }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Bio -->
                        @if($alumni->bio)
                        <div class="mb-4 pt-3" style="border-top: 1px solid #eef2f6;">
                            <h6 class="info-label mb-2">{{ __('alumni.bio') }}</h6>
                            <p class="mb-0" style="line-height: 1.8; color: #4b5563;">{{ nl2br(e($alumni->bio)) }}</p>
                        </div>
                        @endif

                        <!-- Social Media -->
                        @if($alumni->linkedin_url || $alumni->facebook_url || $alumni->twitter_url)
                        <div class="pt-3" style="border-top: 1px solid #eef2f6;">
                            <h6 class="info-label mb-3">{{ __('alumni.social_media') }}</h6>
                            <div class="d-flex gap-2">
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
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Achievements -->
                @if($alumni->achievements && count($alumni->achievements) > 0)
                <div class="info-card mb-4">
                    <div class="card-body">
                        <h5 class="section-title mb-4">
                            <i class="bi bi-trophy me-2"></i>{{ __('alumni.achievements') }}
                        </h5>
                        <ul class="list-unstyled mb-0">
                            @foreach($alumni->achievements as $achievement)
                                <li class="mb-3 d-flex align-items-start">
                                    <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                    <span style="color: #4b5563;">{{ $achievement }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Skills -->
                @if($alumni->skills && count($alumni->skills) > 0)
                <div class="info-card">
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
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Quick Stats -->
                <div class="info-card mb-4">
                    <div class="card-body">
                        <h5 class="section-title mb-4">{{ __('alumni.profile_stats') }}</h5>
                        <div class="row">
                            <div class="col-4">
                                <div class="stat-box">
                                    <div class="stat-number">{{ $acceptedConnections->count() }}</div>
                                    <div class="stat-label">{{ __('alumni.connections') }}</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-box">
                                    <div class="stat-number text-warning">{{ $pendingRequests->count() }}</div>
                                    <div class="stat-label">{{ __('alumni.pending') }}</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-box">
                                    <div class="stat-number text-success">{{ $alumni->is_verified ? 1 : 0 }}</div>
                                    <div class="stat-label">{{ __('alumni.verified') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Actions -->
                <div class="info-card mb-4">
                    <div class="card-body">
                        <h5 class="section-title mb-4">{{ __('alumni.quick_actions') }}</h5>
                        <div class="d-grid gap-2">
                            <a href="{{ route('public.alumni.profile.edit') }}" class="btn btn-brand">
                                <i class="bi bi-pencil me-2"></i>{{ __('alumni.edit_profile') }}
                            </a>
                            <a href="{{ route('public.alumni.index') }}" class="btn btn-outline-brand">
                                <i class="bi bi-people me-2"></i>{{ __('alumni.browse_directory') }}
                            </a>
                            @if($alumni->cv_file)
                                <a href="{{ asset('storage/' . $alumni->cv_file) }}" target="_blank" class="btn btn-outline-brand">
                                    <i class="bi bi-download me-2"></i>{{ __('alumni.view_resume') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Privacy Settings -->
                <div class="info-card">
                    <div class="card-body">
                        <h5 class="section-title mb-4">{{ __('alumni.privacy_settings') }}</h5>
                        <div class="mb-2">
                            <small class="{{ $alumni->contact_consent ? 'text-success' : 'text-danger' }}">
                                <i class="bi {{ $alumni->contact_consent ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }} me-1"></i> 
                                {{ $alumni->contact_consent ? __('alumni.contact_allowed') : __('alumni.contact_not_allowed') }}
                            </small>
                        </div>
                        <div class="mb-2">
                            <small class="{{ $alumni->newsletter_consent ? 'text-success' : 'text-danger' }}">
                                <i class="bi {{ $alumni->newsletter_consent ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }} me-1"></i> 
                                {{ $alumni->newsletter_consent ? __('alumni.newsletter_allowed') : __('alumni.newsletter_not_allowed') }}
                            </small>
                        </div>
                        <small class="text-muted">{{ __('alumni.update_privacy_settings') }}</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Connections Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="info-card">
                    <div class="card-body">
                        <h5 class="section-title mb-4">{{ __('alumni.my_connections') }}</h5>
                        
                        <ul class="nav nav-tabs-custom mb-4" id="connectionTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="accepted-tab" data-bs-toggle="tab" 
                                        data-bs-target="#accepted" type="button" role="tab">
                                    {{ __('alumni.accepted_connections') }} ({{ $acceptedConnections->count() }})
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pending-tab" data-bs-toggle="tab" 
                                        data-bs-target="#pending" type="button" role="tab">
                                    {{ __('alumni.pending_requests') }} ({{ $pendingRequests->count() }})
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="connectionTabContent">
                            <div class="tab-pane fade show active" id="accepted" role="tabpanel">
                                @if($acceptedConnections->count() > 0)
                                    <div class="row g-4">
                                        @foreach($acceptedConnections as $connection)
                                            @php
                                                $connectedAlumni = $connection->requester_id === $alumni->id 
                                                    ? $connection->recipient 
                                                    : $connection->requester;
                                            @endphp
                                            <div class="col-md-6 col-lg-4">
                                                <div class="connection-card card h-100">
                                                    <div class="card-body text-center">
                                                        <img src="{{ $connectedAlumni->profile_image_url }}" 
                                                             alt="{{ $connectedAlumni->full_name }}" 
                                                             class="connection-avatar rounded-circle mb-3">
                                                        <h6 class="mb-1" style="color: var(--brand-primary); font-weight: 600;">{{ $connectedAlumni->full_name }}</h6>
                                                        <p class="text-muted small mb-3">{{ $connectedAlumni->current_position }}</p>
                                                        <a href="{{ route('public.alumni.show', $connectedAlumni) }}" 
                                                           class="btn btn-outline-brand btn-sm">
                                                            {{ __('alumni.view_profile') }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <i class="bi bi-people fs-1 text-muted d-block mb-3"></i>
                                        <h5 class="brand-text fw-bold">{{ __('alumni.no_connections') }}</h5>
                                        <p class="text-muted mb-4">{{ __('alumni.start_connecting') }}</p>
                                        <a href="{{ route('public.alumni.index') }}" class="btn btn-brand">
                                            {{ __('alumni.browse_directory') }}
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <div class="tab-pane fade" id="pending" role="tabpanel">
                                @if($pendingRequests->count() > 0)
                                    <div class="row g-4">
                                        @foreach($pendingRequests as $connection)
                                            <div class="col-md-6 col-lg-4">
                                                <div class="pending-card card h-100">
                                                    <div class="card-body text-center">
                                                        <img src="{{ $connection->requester->profile_image_url }}" 
                                                             alt="{{ $connection->requester->full_name }}" 
                                                             class="pending-avatar rounded-circle mb-3">
                                                        <h6 class="mb-1" style="color: var(--brand-primary); font-weight: 600;">{{ $connection->requester->full_name }}</h6>
                                                        <p class="text-muted small mb-2">{{ $connection->requester->current_position }}</p>
                                                        <p class="text-muted small mb-3">{{ Str::limit($connection->message, 50) }}</p>
                                                        <div class="d-flex gap-2 justify-content-center">
                                                            <form action="{{ route('alumni.connections.respond', $connection) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="action" value="accept">
                                                                <button type="submit" class="accept-btn">
                                                                    <i class="bi bi-check me-1"></i>{{ __('alumni.accept') }}
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('alumni.connections.respond', $connection) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="action" value="reject">
                                                                <button type="submit" class="reject-btn">
                                                                    <i class="bi bi-x me-1"></i>{{ __('alumni.reject') }}
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <i class="bi bi-clock fs-1 text-muted d-block mb-3"></i>
                                        <h5 class="brand-text fw-bold">{{ __('alumni.no_pending_requests') }}</h5>
                                        <p class="text-muted">{{ __('alumni.all_caught_up') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
