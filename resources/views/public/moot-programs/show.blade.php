@extends('layouts.public')

@section('title', $moot->name_en . ' - Moot Court Program')

@push('styles')
<style>
    .mootshow-header {
        position: relative;
        overflow: hidden;
        background: #f5f8ff;
        min-height: 350px;
        padding: 65px 0;
    }

    .mootshow-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .mootshow-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .mootshow-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .mootshow-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .mootshow-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .mootshow-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .mootshow-header .b5 {
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

    .mootshow-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,248,255,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .mootshow-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .mootshow-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .mootshow-header .header-subtitle {
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
<section class="mootshow-header">
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
                    <li class="breadcrumb-item"><a href="{{ route('public.moot-programs.index') }}" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'ការប្រកួតច្បាប់' : 'Moot Court Programs' }}</a></li>
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ $moot->name_en }}</li>
                </ol>
            </nav>
            <div class="d-flex align-items-center gap-3 mb-3">
                @if($moot->logo_path)
                <img src="{{ asset($moot->logo_path) }}" alt="{{ $moot->name_en }}" style="max-width: 60px; max-height: 60px; object-fit: contain;">
                @endif
                @if($moot->acronym)
                <span class="badge" style="background: #003A46; color: #fff;">{{ $moot->acronym }}</span>
                @endif
            </div>
            <h1 class="header-title">
                {{ $moot->name_en }}
            </h1>
            <p class="header-subtitle">
                @if($moot->organizing_body_en)
                <i class="bi bi-building me-2"></i>{{ $moot->organizing_body_en }}
                @endif
            </p>
        </div>
    </div>
</section>

<div class="container py-5" style="background: #f8fafb;">

    <div class="row mb-5">
        <div class="col-lg-8">
            <div class="d-flex align-items-start gap-3 mb-3">
                @if($moot->logo_path)
                <img src="{{ asset($moot->logo_path) }}" alt="{{ $moot->name_en }}" 
                     style="max-width: 80px; max-height: 80px; object-fit: contain;">
                @endif
                <div>
                    <h1 class="display-4 fw-bold" style="color: var(--primary);">
                        {{ $moot->name_en }}
                    </h1>
                    @if($moot->acronym)
                    <span class="badge bg-primary">{{ $moot->acronym }}</span>
                    @endif
                </div>
            </div>
            
            @if($moot->organizing_body_en)
            <p class="lead text-muted">
                <i class="bi bi-building me-2"></i>{{ $moot->organizing_body_en }}
            </p>
            @endif
            
            @if($moot->description_en)
            <div class="mt-4">
                <p class="lead">{!! $moot->description_en !!}</p>
            </div>
            @endif
            
            @if($moot->official_url)
            <a href="{{ $moot->official_url }}" target="_blank" class="btn btn-outline-primary mt-3">
                <i class="bi bi-box-arrow-up-right me-2"></i>Official Website
            </a>
            @endif
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body">
                    <h5 class="card-title mb-3">Program Statistics</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Total Years</span>
                            <strong>{{ $participations->count() }}</strong>
                        </li>
                        @if($participations->count() > 0)
                        <li class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">First Participation</span>
                            <strong>{{ $participations->max('year') }}</strong>
                        </li>
                        <li class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Latest Year</span>
                            <strong>{{ $participations->min('year') }}</strong>
                        </li>
                        <li class="d-flex justify-content-between py-2">
                            <span class="text-muted">Teams Fielded</span>
                            <strong>{{ $participations->flatMap->teams->count() }}</strong>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @if($participations->count() > 0)
    <div class="row">
        <div class="col-12">
            <h2 class="h3 border-bottom pb-2 mb-4">Participation History</h2>
        </div>
    </div>

    <div class="row g-4">
        @foreach($participations as $participation)
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('public.moot-programs.participations.show', [$moot->slug, $participation->year]) }}" 
               class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 transition-card" style="border-radius: 12px;">
                    <div class="card-header bg-transparent border-0 p-4 pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h4 mb-0" style="color: var(--primary);">{{ $participation->year }}</span>
                            @switch($participation->status)
                                @case('completed')
                                    <span class="badge bg-success">Completed</span>
                                    @break
                                @case('ongoing')
                                    <span class="badge bg-primary">Ongoing</span>
                                    @break
                                @case('registration_open')
                                    <span class="badge bg-success">Registration Open</span>
                                    @break
                                @case('cancelled')
                                    <span class="badge bg-secondary">Cancelled</span>
                                    @break
                                @default
                                    <span class="badge bg-warning text-dark">{{ ucfirst($participation->status) }}</span>
                            @endswitch
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @if($participation->theme_en)
                        <p class="mb-2">
                            <i class="bi bi-bookmark text-muted me-2"></i>
                            {{ $participation->theme_en }}
                        </p>
                        @endif
                        
                        @if($participation->venue || $participation->host_country)
                        <p class="text-muted small mb-3">
                            <i class="bi bi-geo-alt me-1"></i>
                            {{ $participation->venue ?? '' }}@if($participation->venue && $participation->host_country), @endif{{ $participation->host_country ?? '' }}
                        </p>
                        @endif
                        
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="badge bg-light text-dark">
                                {{ $participation->teams->count() }} Teams
                            </span>
                            <span class="badge bg-light text-dark">
                                {{ $participation->activities->count() }} Activities
                            </span>
                        </div>
                        
                        @if($participation->result_en)
                        <div class="mt-3 pt-3 border-top">
                            <span class="badge bg-warning text-dark">
                                <i class="bi bi-trophy me-1"></i>{{ $participation->result_en }}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-5">
        <i class="bi bi-calendar text-muted" style="font-size: 3rem;"></i>
        <h4 class="mt-3 text-muted">No Participation History</h4>
        <p class="text-muted">We haven't participated in this competition yet.</p>
    </div>
    @endif
</div>

@endsection
