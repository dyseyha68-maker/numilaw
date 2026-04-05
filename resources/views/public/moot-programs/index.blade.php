@extends('layouts.public')

@section('title', 'Moot Court Programs')

@push('styles')
<style>
    .mootprograms-header {
        position: relative;
        overflow: hidden;
        background: #f5f8ff;
        min-height: 350px;
        padding: 65px 0;
    }

    .mootprograms-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .mootprograms-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .mootprograms-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .mootprograms-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .mootprograms-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .mootprograms-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .mootprograms-header .b5 {
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

    .mootprograms-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,248,255,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .mootprograms-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .mootprograms-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .mootprograms-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }

    .transition-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .transition-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="mootprograms-header">
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
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'ការប្រកួតច្បាប់' : 'Moot Court Programs' }}</li>
                </ol>
            </nav>
            <h1 class="header-title">
                {{ app()->getLocale() === 'km' ? 'ការប្រកួតច្បាប់' : 'Moot Court Programs' }}
            </h1>
            <p class="header-subtitle">
                {{ app()->getLocale() === 'km' ? 'គេហទំព័រនេះបង្ហាញពីបេសកកម្ម Moot Court អន្�រជាតិ ដែលសិស្សយើងចូលរួម' : 'Our institution has a proud tradition of participating in international moot court competitions' }}
            </p>
        </div>
    </div>
</section>

<div class="container py-5">
    @if($upcomingRegistrations->count() > 0)
    <div class="row mb-5" id="register">
        <div class="col-12">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 12px; background: linear-gradient(135deg, var(--primary) 0%, #005f6b 100%);">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="h4 text-white mb-2">
                                <i class="bi bi-calendar-check me-2"></i>Open for Registration
                            </h2>
                            <p class="text-white-50 mb-0">
                                Sign up now to represent our university in upcoming international moot court competitions!
                            </p>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <button class="btn btn-light fw-bold" data-bs-toggle="modal" data-bs-target="#registrationModal">
                                <i class="bi bi-pencil-square me-2"></i>Request Registration
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <h2 class="h4 border-bottom pb-2 mb-4">Upcoming Competitions</h2>
        </div>
        @foreach($upcomingRegistrations as $participation)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        @if($participation->moot->logo_path)
                        <img src="{{ asset($participation->moot->logo_path) }}" alt="{{ $participation->moot->name_en }}" 
                             style="width: 40px; height: 40px; object-fit: contain;">
                        @endif
                        <div>
                            <span class="badge bg-warning text-dark">{{ $participation->year }}</span>
                        </div>
                    </div>
                    <h5 class="mb-2" style="color: var(--primary);">{{ $participation->moot->name_en }}</h5>
                    @if($participation->theme_en)
                    <p class="text-muted small mb-2">{{ $participation->theme_en }}</p>
                    @endif
                    <div class="d-flex align-items-center text-muted small">
                        <i class="bi bi-geo-alt me-1"></i>
                        {{ $participation->host_city ?? 'TBD' }}, {{ $participation->host_country ?? 'TBD' }}
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('public.moot-programs.show', $participation->moot->slug) }}" class="btn btn-sm btn-outline-primary">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    @if($featuredMoots->count() > 0)
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="h4 border-bottom pb-2 mb-4">Featured Programs</h2>
        </div>
        @foreach($featuredMoots as $moot)
        <div class="col-md-6 mb-4">
            <a href="{{ route('public.moot-programs.show', $moot->slug) }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 transition-card" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex align-items-start gap-3">
                                @if($moot->logo_path)
                                <img src="{{ asset($moot->logo_path) }}" alt="{{ $moot->name_en }}" 
                                     style="width: 50px; height: 50px; object-fit: contain;">
                                @endif
                                <div>
                                    @if($moot->acronym)
                                    <span class="badge bg-primary mb-2">{{ $moot->acronym }}</span>
                                    @endif
                                    <h3 class="h5 mb-0" style="color: var(--primary);">{{ $moot->name_en }}</h3>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right text-muted"></i>
                        </div>
                        
                        @if($moot->description_en)
                        <p class="text-muted mb-3">{{ Str::limit($moot->description_en, 150) }}</p>
                        @endif
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small">
                                <i class="bi bi-calendar3 me-1"></i>
                                Since {{ $moot->first_participation_year ?? 'N/A' }}
                            </span>
                            <span class="badge bg-secondary">
                                {{ $moot->participations->count() }} years
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <h2 class="h4 border-bottom pb-2 mb-4">All Programs</h2>
        </div>
    </div>

    @if($allMoots->count() > 0)
    <div class="row g-4">
        @foreach($allMoots as $moot)
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('public.moot-programs.show', $moot->slug) }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 transition-card" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="d-flex align-items-start gap-2">
                                @if($moot->logo_path)
                                <img src="{{ asset($moot->logo_path) }}" alt="{{ $moot->name_en }}" 
                                     style="width: 40px; height: 40px; object-fit: contain;">
                                @endif
                                <div>
                                    <h3 class="h6 mb-0" style="color: var(--primary);">
                                        {{ $moot->name_en }}
                                    </h3>
                                </div>
                            </div>
                            @if($moot->is_featured)
                            <i class="bi bi-star-fill text-warning"></i>
                            @endif
                        </div>
                        
                        @if($moot->acronym)
                        <span class="badge bg-light text-dark mb-2">{{ $moot->acronym }}</span>
                        @endif
                        
                        @if($moot->description_en)
                        <p class="text-muted small mb-3">{{ Str::limit($moot->description_en, 100) }}</p>
                        @endif
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small">
                                @if($moot->first_participation_year)
                                {{ $moot->first_participation_year }} - {{ $moot->participations->max('year') ?? 'Present' }}
                                @else
                                No participation yet
                                @endif
                            </span>
                            <span class="small text-muted">
                                <i class="bi bi-arrow-right"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $allMoots->links() }}
    </div>
    @else
    <div class="text-center py-5">
        <i class="bi bi-book text-muted" style="font-size: 3rem;"></i>
        <h4 class="mt-3 text-muted">No Moot Court Programs Available</h4>
        <p class="text-muted">Check back soon for updates on our moot court activities.</p>
    </div>
    @endif
</div>

<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: var(--primary); color: white;">
                <h5 class="modal-title" id="registrationModalLabel">
                    <i class="bi bi-pencil-square me-2"></i>Moot Court Registration Request
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('public.moot-programs.register') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p class="text-muted mb-4">
                        Interested in representing our university in a moot court competition? 
                        Please fill out this form and we will contact you with more information.
                    </p>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Full Name *</label>
                            <input type="text" class="form-control" id="name" name="name" required placeholder="Your full name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="your.email@student.edu.kh">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="+855 12 345 678">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="moot_id" class="form-label">Competition *</label>
                            <select class="form-select" id="moot_id" name="moot_id" required>
                                <option value="">Select a competition</option>
                                @foreach($allMoots as $moot)
                                <option value="{{ $moot->id }}">{{ $moot->name_en }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="year" class="form-label">Year *</label>
                        <select class="form-select" id="year" name="year" required>
                            <option value="">Select year</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="motivation" class="form-label">Why do you want to participate? *</label>
                        <textarea class="form-control" id="motivation" name="motivation" rows="4" required 
                            placeholder="Tell us about your interest in moot court competitions and why you would be a good candidate..."></textarea>
                        <small class="text-muted">Minimum 50 characters</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn" style="background: var(--primary); color: white;">Submit Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if(session('success'))
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white">
            <i class="bi bi-check-circle me-2"></i>
            <strong class="me-auto">Success</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session('success') }}
        </div>
    </div>
</div>
@endif

@endsection
