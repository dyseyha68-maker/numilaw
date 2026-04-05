@extends('layouts.public')

@section('title', __('alumni.alumni_directory'))

@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    :root {
        --brand-primary: #003A46;
        --brand-light: #005f73;
        --brand-accent: #0a9396;
        --brand-gradient: linear-gradient(135deg, #003A46 0%, #005f73 50%, #0a9396 100%);
    }
    
    .alumni-header {
        position: relative;
        overflow: hidden;
        background: #f5f8ff;
        min-height: 350px;
        padding: 65px 0;
    }

    .alumni-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .alumni-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .alumni-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .alumni-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .alumni-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .alumni-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .alumni-header .b5 {
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

    .alumni-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,248,255,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .alumni-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .alumni-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .alumni-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }
    
    .brand-text { color: var(--brand-primary); }
    .brand-bg { background: var(--brand-primary); }
    .brand-gradient { background: var(--brand-gradient); }
    
    .alumni-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    .alumni-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(0, 58, 70, 0.25);
    }
    
    .alumni-card .card-body {
        padding: 1.75rem;
    }
    
    .alumni-avatar {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 8px 25px rgba(0, 58, 70, 0.15);
    }
    
    .featured-badge {
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        color: #fff;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .filter-sidebar {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(0, 58, 70, 0.08);
        padding: 2rem;
        position: sticky;
        top: 100px;
    }
    
    .filter-section {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #eef2f6;
    }
    
    .filter-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .filter-label {
        font-weight: 600;
        color: var(--brand-primary);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.75rem;
    }
    
    .modern-input {
        border: 2px solid #eef2f6;
        border-radius: 12px;
        padding: 12px 16px;
        transition: all 0.3s;
    }
    
    .modern-input:focus {
        border-color: var(--brand-primary);
        box-shadow: 0 0 0 4px rgba(0, 58, 70, 0.1);
        outline: none;
    }
    
    .modern-select {
        border: 2px solid #eef2f6;
        border-radius: 12px;
        padding: 12px 16px;
        transition: all 0.3s;
        background-position: right 12px center;
    }
    
    .modern-select:focus {
        border-color: var(--brand-primary);
        box-shadow: 0 0 0 4px rgba(0, 58, 70, 0.1);
        outline: none;
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
        color: #003A46;
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
    
    .connect-btn {
        background: linear-gradient(135deg, #0a9396, #005f73);
        color: white;
        border-radius: 50px;
        padding: 8px 20px;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .connect-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(10, 147, 150, 0.4);
        color: white;
    }
    
    .view-profile-btn {
        background: transparent;
        color: var(--brand-primary);
        border: 2px solid var(--brand-primary);
        border-radius: 50px;
        padding: 8px 20px;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .view-profile-btn:hover {
        background: var(--brand-primary);
        color: white;
    }
    
    .social-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f0f4f8;
        color: var(--brand-primary);
        transition: all 0.3s;
        text-decoration: none;
    }
    
    .social-icon:hover {
        background: var(--brand-primary);
        color: white;
        transform: translateY(-3px);
    }
    
    .year-tag {
        background: linear-gradient(135deg, #e0f2fe, #bae6fd);
        color: var(--brand-primary);
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .program-tag {
        background: linear-gradient(135deg, #f0fdf4, #bbf7d0);
        color: #166534;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .job-title {
        color: var(--brand-primary);
        font-weight: 600;
    }
    
    .company-name {
        color: #64748b;
        font-size: 0.9rem;
    }
    
    .location-text {
        color: #94a3b8;
        font-size: 0.85rem;
    }
    
    .pagination-wrap .page-link {
        border: none;
        border-radius: 10px;
        margin: 0 4px;
        color: var(--brand-primary);
        padding: 10px 16px;
    }
    
    .pagination-wrap .page-item.active .page-link {
        background: var(--brand-primary);
        color: white;
    }
    
    .pagination-wrap .page-link:hover {
        background: var(--brand-light);
        color: white;
    }
    
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }
    
    .empty-icon {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 1rem;
    }
</style>
@endpush

@push('scripts')
@vite(['resources/js/react/alumni-app.js'])
@endpush

@section('content')
<!-- Hero Section -->
<section class="alumni-header">
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
                    <li class="breadcrumb-item active" style="color: #64748b;">{{ __('alumni.alumni_directory') }}</li>
                </ol>
            </nav>
            <h1 class="header-title">{{ __('alumni.alumni_directory') }}</h1>
            <p class="header-subtitle">
                {{ app()->getLocale() === 'km' ? 'ភ្ជាប់ជាមួយបណ្តាញចាស់របស់យើង' : 'Connect with our distinguished alumni network' }}
            </p>
        </div>
    </div>
</section>

<!-- Featured Alumni -->
@if($featuredAlumni->count() > 0)
<section class="py-5 mb-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge mb-3 px-4 py-2" style="background: linear-gradient(135deg, #fbbf24, #f59e0b); color: white; font-size: 0.8rem;">
                <i class="bi bi-star-fill me-1"></i>{{ app()->getLocale() === 'km' ? 'លេចធ្លោ' : 'Featured' }}
            </span>
            <h2 class="h1 fw-bold brand-text">{{ __('alumni.featured_alumni') }}</h2>
            <p class="text-muted">{{ app()->getLocale() === 'km' ? 'និស្សិតចេញបេសៀលកំពុងបង្កើតផលប៉ះពាល់' : 'Outstanding graduates making an impact in their fields' }}</p>
        </div>
        
        <div class="row">
            @foreach($featuredAlumni as $alumnus)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="alumni-card card h-100">
                        <div class="card-body text-center">
                            <div class="position-relative d-inline-block mb-3">
                                <img src="{{ $alumnus->profile_image_url }}" 
                                     alt="{{ $alumnus->full_name }}" 
                                     class="alumni-avatar rounded-circle">
                                @if($alumnus->is_featured)
                                    <span class="position-absolute top-0 start-100 translate-middle featured-badge">
                                        <i class="bi bi-star-fill me-1"></i>Featured
                                    </span>
                                @endif
                            </div>
                            
                            <h5 class="card-title fw-bold mb-1">{{ $alumnus->full_name }}</h5>
                            
                            <div class="d-flex gap-2 justify-content-center mb-3 flex-wrap">
                                <span class="year-tag">{{ $alumnus->graduation_year }}</span>
                                @if($alumnus->program)
                                    <span class="program-tag">{{ $alumnus->program->title }}</span>
                                @endif
                            </div>
                            
                            <p class="job-title mb-1">{{ $alumnus->current_job_title ?: 'Professional' }}</p>
                            @if($alumnus->company)
                                <p class="company-name mb-2">{{ $alumnus->company }}</p>
                            @endif
                            @if($alumnus->location)
                                <p class="location-text mb-3">
                                    <i class="bi bi-geo-alt me-1"></i>{{ $alumnus->location }}
                                </p>
                            @endif
                            
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('public.alumni.show', $alumnus) }}" class="view-profile-btn">
                                    <i class="bi bi-person me-1"></i>{{ __('alumni.view_profile') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Main Content -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Filters Sidebar -->
            <div class="col-lg-3">
                <div class="filter-sidebar">
                    <h5 class="fw-bold brand-text mb-4">
                        <i class="bi bi-funnel me-2"></i>{{ __('alumni.filter_by') }}
                    </h5>
                    
                    <form method="GET" action="{{ route('public.alumni.index') }}">
                        <div class="filter-section">
                            <div class="filter-label">{{ __('alumni.search_alumni') }}</div>
                            <input type="text" name="search" class="form-control modern-input" 
                                   value="{{ request('search') }}" 
                                   placeholder="{{ __('alumni.search_alumni') }}...">
                        </div>
                        
                        <div class="filter-section">
                            <div class="filter-label">{{ __('alumni.program') }}</div>
                            <select name="program_id" class="form-select modern-select">
                                <option value="">{{ __('alumni.all_programs') }}</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}" {{ request('program_id') == $program->id ? 'selected' : '' }}>
                                        {{ $program->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="filter-section">
                            <div class="filter-label">{{ __('alumni.graduation_year') }}</div>
                            <select name="graduation_year" class="form-select modern-select">
                                <option value="">{{ __('alumni.all_years') }}</option>
                                @foreach($graduationYears as $year)
                                    <option value="{{ $year }}" {{ request('graduation_year') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="filter-section">
                            <div class="filter-label">{{ __('alumni.industry') }}</div>
                            <select name="industry" class="form-select modern-select">
                                <option value="">{{ __('alumni.all_industries') }}</option>
                                @foreach($industries as $industry)
                                    <option value="{{ $industry }}" {{ request('industry') == $industry ? 'selected' : '' }}>
                                        {{ $industry }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="filter-section">
                            <div class="filter-label">{{ __('alumni.location') }}</div>
                            <select name="location" class="form-select modern-select">
                                <option value="">{{ __('alumni.all_locations') }}</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                                        {{ $location }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="filter-section">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="featured" value="1" 
                                       {{ request('featured') ? 'checked' : '' }} id="featuredCheck">
                                <label class="form-check-label fw-semibold" for="featuredCheck">
                                    {{ __('alumni.featured_only') }}
                                </label>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-brand">
                                <i class="bi bi-funnel me-2"></i>{{ __('common.filter') }}
                            </button>
                            <a href="{{ route('public.alumni.index') }}" class="btn btn-outline-brand">
                                <i class="bi bi-arrow-counterclockwise me-2"></i>{{ __('common.clear') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Alumni Grid -->
            <div class="col-lg-9">
                <!-- React Component -->
                <div id="alumni-directory-app">
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3 text-muted">Loading Alumni Directory...</p>
                    </div>
                </div>
                
                @if($alumni->count() > 0)
                    <div class="row">
                        @foreach($alumni as $alumnus)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="alumni-card card h-100">
                                    <div class="card-body text-center">
                                        <div class="position-relative d-inline-block mb-3">
                                            <img src="{{ $alumnus->profile_image_url }}" 
                                                 alt="{{ $alumnus->full_name }}" 
                                                 class="alumni-avatar rounded-circle">
                                            @if($alumnus->is_featured)
                                                <span class="position-absolute top-0 start-100 translate-middle featured-badge">
                                                    <i class="bi bi-star-fill"></i>
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <h5 class="card-title fw-bold mb-1">{{ $alumnus->full_name }}</h5>
                                        
                                        <div class="d-flex gap-2 justify-content-center mb-3 flex-wrap">
                                            <span class="year-tag">{{ $alumnus->graduation_year }}</span>
                                            @if($alumnus->program)
                                                <span class="program-tag">{{ $alumnus->program->title }}</span>
                                            @endif
                                        </div>
                                        
                                        <p class="job-title mb-1">{{ $alumnus->current_job_title ?: 'Professional' }}</p>
                                        @if($alumnus->company)
                                            <p class="company-name mb-2">{{ $alumnus->company }}</p>
                                        @endif
                                        @if($alumnus->location)
                                            <p class="location-text mb-3">
                                                <i class="bi bi-geo-alt me-1"></i>{{ $alumnus->location }}
                                            </p>
                                        @endif
                                        
                                        @if($alumnus->bio)
                                            <p class="card-text small text-muted mb-3">
                                                {{ Str::limit($alumnus->bio, 80) }}
                                            </p>
                                        @endif
                                        
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('public.alumni.show', $alumnus) }}" class="view-profile-btn">
                                                <i class="bi bi-person me-1"></i>{{ __('alumni.view_profile') }}
                                            </a>
                                            @if(auth()->check() && auth()->user()->isAlumni())
                                                <button type="button" class="connect-btn"
                                                        data-bs-toggle="modal" data-bs-target="#connectModal"
                                                        data-alumni-id="{{ $alumnus->id }}"
                                                        data-alumni-name="{{ $alumnus->full_name }}">
                                                    <i class="bi bi-link-45deg me-1"></i>{{ __('alumni.connect') }}
                                                </button>
                                            @endif
                                        </div>
                                        
                                        @if(count($alumnus->social_links) > 0)
                                            <div class="mt-3 d-flex gap-2 justify-content-center">
                                                @foreach($alumnus->social_links as $social)
                                                    <a href="{{ $social['url'] }}" target="_blank" 
                                                       class="social-icon" title="{{ $social['platform'] }}">
                                                        <i class="{{ $social['icon'] }}"></i>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    @if($alumni->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        <nav class="pagination-wrap">
                            {{ $alumni->links() }}
                        </nav>
                    </div>
                    @endif
                    
                    <div class="text-center text-muted mt-3">
                        Showing {{ $alumni->firstItem() }} to {{ $alumni->lastItem() }} of {{ $alumni->total() }} alumni
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h4 class="brand-text fw-bold">{{ __('alumni.no_alumni_found') }}</h4>
                        <p class="text-muted">No alumni match your current filters.</p>
                        <a href="{{ route('public.alumni.index') }}" class="btn btn-brand">
                            <i class="bi bi-arrow-counterclockwise me-2"></i>{{ __('common.clear_filters') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Connection Modal -->
@if(auth()->check() && auth()->user()->isAlumni())
<div class="modal fade" id="connectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 20px; border: none;">
            <div class="modal-header border-0 pb-0" style="background: var(--brand-gradient); border-radius: 20px 20px 0 0;">
                <h5 class="modal-title text-white fw-bold">
                    <i class="bi bi-link-45deg me-2"></i>{{ __('alumni.send_connection_request') }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('public.alumni.connect', ':alumni_id') }}" method="POST" id="connectForm">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold brand-text">Connect with <span id="alumniName" class="fw-bold"></span></label>
                        <textarea name="message" class="form-control modern-input" rows="4" 
                                  placeholder="{{ __('alumni.send_message') }}..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 12px;">{{ __('common.cancel') }}</button>
                    <button type="submit" class="btn btn-brand">
                        <i class="bi bi-send me-2"></i>{{ __('alumni.send_connection_request') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const connectModal = document.getElementById('connectModal');
    const connectForm = document.getElementById('connectForm');
    const alumniNameSpan = document.getElementById('alumniName');
    
    if (connectModal) {
        connectModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const alumniId = button.getAttribute('data-alumni-id');
            const alumniName = button.getAttribute('data-alumni-name');
            
            alumniNameSpan.textContent = alumniName;
            connectForm.action = connectForm.action.replace(':alumni_id', alumniId);
        });
    }
});
</script>
@endpush
@endsection
