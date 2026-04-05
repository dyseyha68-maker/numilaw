@extends('layouts.public')

@section('title', __('alumni.success_stories'))

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
    
    .alumni-stories-header {
        position: relative;
        overflow: hidden;
        background: #f5f8ff;
        min-height: 350px;
        padding: 65px 0;
    }

    .alumni-stories-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .alumni-stories-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .alumni-stories-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .alumni-stories-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .alumni-stories-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .alumni-stories-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .alumni-stories-header .b5 {
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

    .alumni-stories-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,248,255,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .alumni-stories-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .alumni-stories-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .alumni-stories-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }
    
    .alumni-stories-cta-header {
        position: relative;
        overflow: hidden;
        background: #f5f8ff;
        min-height: 300px;
        padding: 65px 0;
    }

    .alumni-stories-cta-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .alumni-stories-cta-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .alumni-stories-cta-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .alumni-stories-cta-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .alumni-stories-cta-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .alumni-stories-cta-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .alumni-stories-cta-header .b5 {
        width: 110%; height: 110%;
        top: 30px; left: -5%;
        animation: moveB5 15s ease-in-out infinite alternate, colorB5 12s ease-in-out infinite alternate;
    }

    .alumni-stories-cta-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,248,255,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .alumni-stories-cta-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .alumni-stories-cta-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .alumni-stories-cta-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }
    
    .story-card {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(0, 58, 70, 0.08);
        border: none;
        transition: all 0.3s;
        height: 100%;
        overflow: hidden;
    }
    
    .story-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 58, 70, 0.15);
    }
    
    .story-card .card-body {
        padding: 2rem;
    }
    
    .quote-icon {
        position: absolute;
        top: 1rem;
        right: 1.5rem;
        font-size: 4rem;
        color: var(--brand-primary);
        opacity: 0.1;
    }
    
    .story-avatar {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border: 3px solid white;
        box-shadow: 0 8px 25px rgba(0, 58, 70, 0.15);
    }
    
    .year-badge {
        background: linear-gradient(135deg, #e0f2fe, #bae6fd);
        color: var(--brand-primary);
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .program-badge {
        background: linear-gradient(135deg, #f0fdf4, #bbf7d0);
        color: #166534;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .story-title {
        color: var(--brand-primary);
        font-weight: 700;
        font-size: 1.1rem;
    }
    
    .story-quote {
        border-left: 4px solid var(--brand-primary);
        padding-left: 1.5rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #64748b;
        line-height: 1.8;
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
    
    .social-link {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #f1f5f9;
        color: var(--brand-primary);
        transition: all 0.3s;
        text-decoration: none;
    }
    
    .social-link:hover {
        background: var(--brand-primary);
        color: white;
    }
    
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(0, 58, 70, 0.08);
    }
    
    .empty-icon {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 1rem;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="alumni-stories-header">
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
            <div class="text-center">
                <span class="badge mb-3 px-4 py-2" style="background: rgba(0,58,70,0.1); color: #003A46; font-size: 0.9rem;">
                    <i class="bi bi-star-fill me-1"></i>{{ app()->getLocale() === 'km' ? 'បុគ្គលិកលក្ខណៈ' : 'Featured' }}
                </span>
                <h1 class="header-title">{{ __('alumni.success_stories') }}</h1>
                <p class="header-subtitle">
                    Discover inspiring success stories from our accomplished alumni
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Alumni Stories -->
@if($alumniStories->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="h1 fw-bold brand-text mb-3">{{ __('alumni.featured_testimonials') }}</h2>
            <p class="lead text-muted">{{ __('alumni.what_alumni_say') }}</p>
        </div>
        
        <div class="row g-4">
            @foreach($alumniStories as $story)
            <div class="col-lg-6">
                <div class="story-card card h-100">
                    <div class="card-body position-relative">
                        <i class="bi bi-quote quote-icon"></i>
                        
                        <div class="d-flex align-items-start mb-4">
                            <img src="{{ $story->profile_image_url }}" 
                                 alt="{{ $story->alumni->full_name }}" 
                                 class="story-avatar rounded-circle me-3">
                            <div>
                                <h5 class="mb-1" style="color: var(--brand-primary); font-weight: 700;">{{ $story->alumni->full_name }}</h5>
                                <div class="d-flex gap-2 flex-wrap">
                                    @if($story->alumni->graduation_year)
                                        <span class="year-badge">{{ $story->alumni->graduation_year }}</span>
                                    @endif
                                    @if($story->alumni->program)
                                        <span class="program-badge">{{ $story->alumni->program->title }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <h6 class="story-title mb-3">{{ $story->title }}</h6>
                        
                        <blockquote class="story-quote mb-3">
                            "{{ Str::limit($story->content, 250) }}"
                        </blockquote>
                        
                        @if($story->company_at_time)
                            <p class="text-muted small mb-3">
                                <i class="bi bi-building me-1"></i>
                                <strong>{{ __('alumni.at_company') }}:</strong> {{ $story->company_at_time }}
                            </p>
                        @endif
                        
                        <div class="d-flex justify-content-between align-items-center pt-3" style="border-top: 1px solid #eef2f6;">
                            <div>
                                @if($story->alumni->social_links->count() > 0)
                                    @foreach($story->alumni->social_links as $social)
                                        <a href="{{ $social['url'] }}" target="_blank" class="social-link me-1" title="{{ $social['platform'] }}">
                                            <i class="{{ $social['icon'] }}"></i>
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                            <a href="{{ route('public.alumni.show', $story->alumni) }}" class="btn btn-outline-brand btn-sm">
                                {{ __('alumni.view_full_story') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@else
<!-- No Stories Available -->
<section class="py-5">
    <div class="container">
        <div class="empty-state">
            <div class="empty-icon">
                <i class="bi bi-book"></i>
            </div>
            <h3 class="brand-text fw-bold mb-2">{{ __('alumni.no_stories_available') }}</h3>
            <p class="text-muted mb-4">
                {{ __('alumni.stories_no_content') }}
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('public.alumni.register') }}" class="btn btn-brand">
                    <i class="bi bi-person-plus me-2"></i>{{ __('alumni.register_as_alumni') }}
                </a>
                <a href="{{ route('public.alumni.index') }}" class="btn btn-outline-brand">
                    <i class="bi bi-people me-2"></i>{{ __('alumni.alumni_directory') }}
                </a>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Call to Action -->
@if(!auth()->check())
<section class="alumni-stories-cta-header">
    <div class="blob-wrapper">
        <div class="blob b1"></div>
        <div class="blob b2"></div>
        <div class="blob b3"></div>
        <div class="blob b4"></div>
        <div class="blob b5"></div>
    </div>
    <div class="fade-bottom"></div>
    <div class="container">
        <div class="header-content text-center">
            <h2 class="header-title">{{ __('alumni.join_community') }}</h2>
            <p class="header-subtitle mb-4">
                {{ __('alumni.stories_join_description') }}
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('public.alumni.register') }}" class="btn btn-brand btn-lg fw-semibold">
                    <i class="bi bi-person-plus me-2"></i>{{ __('alumni.register_as_alumni') }}
                </a>
                <a href="{{ route('public.alumni.index') }}" class="btn btn-outline-brand btn-lg fw-semibold">
                    <i class="bi bi-people me-2"></i>{{ __('alumni.alumni_directory') }}
                </a>
            </div>
        </div>
    </div>
</section>
@endif
@endsection
