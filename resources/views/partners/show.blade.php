@extends('layouts.public')

@section('title', $partner->name)

@push('styles')
<style>
    .partners-show-header {
        position: relative;
        overflow: hidden;
        background: #f5f8ff;
        min-height: 350px;
        padding: 65px 0;
    }

    .partners-show-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .partners-show-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .partners-show-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .partners-show-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .partners-show-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .partners-show-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .partners-show-header .b5 {
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

    .partners-show-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,248,255,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .partners-show-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .partners-show-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .partners-show-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }

    .partners-show-header .breadcrumb-item a {
        color: #003A46;
        text-decoration: none;
    }

    .partners-show-header .breadcrumb-item.active {
        color: #64748b;
    }

    .partners-show-header .breadcrumb-item + .breadcrumb-item::before {
        color: #64748b;
    }

    .partners-show-header .partner-logo-display {
        width: 100px;
        height: 100px;
        object-fit: contain;
        background: white;
        border-radius: 20px;
        padding: 12px;
        box-shadow: 0 8px 25px rgba(0,58,70,0.15);
    }

    .timeline {
        position: relative;
    }
    .timeline-year:not(:last-child) {
        margin-bottom: 2rem;
    }
    .timeline-marker {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex-shrink: 0;
    }
    .marker-dot {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 0.75rem;
        z-index: 1;
    }
    .marker-line {
        width: 2px;
        flex-grow: 1;
        background: #e5e7eb;
        min-height: 30px;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="partners-show-header">
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
                <div class="col-lg-9">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background: transparent; padding: 0; margin-bottom: 0.5rem;">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #003A46;">{{ __('partner.home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('partners.index') }}" style="color: #003A46;">{{ __('partner.title') }}</a></li>
                            <li class="breadcrumb-item active" style="color: #64748b;">{{ $partner->name }}</li>
                        </ol>
                    </nav>
                    <h1 class="header-title">{{ $partner->name }}</h1>
                    <div class="d-flex flex-wrap gap-3 mt-3">
                        <span class="d-flex align-items-center" style="color: #64748b;">
                            <i class="bi bi-building me-2"></i> {{ $partner->faculty_or_school }}
                        </span>
                        <span class="badge px-3 py-2" style="background: #003A46; color: white;">
                            <i class="bi bi-geo-alt me-1"></i> {{ $partner->country }}
                        </span>
                        @if($partner->official_website)
                        <a href="{{ $partner->official_website }}" target="_blank" class="btn btn-sm" style="background: #003A46; color: white;">
                            <i class="bi bi-box-arrow-up-right me-1"></i> {{ __('partner.visit_website') }}
                        </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 text-center text-lg-end mt-4 mt-lg-0">
                    @if($partner->logo)
                        <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $partner->logo)) }}" 
                             alt="{{ $partner->name }}" 
                             class="partner-logo-display">
                    @endif
                    @if($activitiesByYear->isNotEmpty())
                    <div class="mt-3">
                        <div style="display: inline-block; padding: 0.75rem 1.25rem; background: linear-gradient(135deg, #003A46, #005f6b); border-radius: 12px; color: white;">
                            <div class="small mb-0 opacity-75">{{ __('partner.activities') }}</div>
                            <div class="h5 mb-0 fw-bold">{{ $activitiesByYear->flatten()->count() }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Description Section -->
@if($partner->description)
<section class="py-4" style="background: #f8fafc;">
    <div class="container">
        <div class="card border-0 shadow-sm">
            <div class="card-body py-4">
                <h5 class="fw-bold mb-3" style="color: #003A46;">
                    <i class="bi bi-info-circle me-2"></i>{{ __('partner.about') }}
                </h5>
                <p class="mb-0 text-muted" style="line-height: 1.8;">{!! nl2br(e($partner->description)) !!}</p>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Timeline Section -->
<section class="py-5">
    <div class="container">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-4">
                <h5 class="fw-bold mb-0" style="color: #003A46;">
                    <i class="bi bi-calendar-range me-2"></i>{{ __('partner.cooperation_timeline') }}
                </h5>
            </div>
            <div class="card-body p-4">
                @if($activitiesByYear->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-clock-history d-block mb-3 text-muted" style="font-size: 3rem;"></i>
                    <h5 class="text-muted">{{ __('partner.no_activities') }}</h5>
                </div>
                @else
                <div class="timeline">
                    @foreach($activitiesByYear as $year => $activities)
                    <div class="timeline-year mb-4">
                        <h6 class="fw-bold text-muted text-uppercase mb-3" style="font-size: 0.85rem;">
                            {{ $year }}
                        </h6>
                        @foreach($activities as $activity)
                        <div class="timeline-item d-flex gap-3 mb-3">
                            <div class="timeline-marker">
                                <div class="marker-dot" style="background: #003A46;">
                                    <i class="bi bi-{{ $activity->getTypeIcon() }}"></i>
                                </div>
                                @if(!$loop->last)
                                <div class="marker-line"></div>
                                @endif
                            </div>
                            <div class="timeline-content flex-grow-1">
                                <div class="card border-0" style="background: #f8fafc;">
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <span class="badge bg-white text-dark border mb-1">
                                                    {{ __('partner.activity_types.' . $activity->type) }}
                                                </span>
                                                <h6 class="fw-bold mb-0">{{ $activity->title }}</h6>
                                            </div>
                                            <small class="text-muted">
                                                {{ $activity->activity_date->format('M d') }}
                                            </small>
                                        </div>
                                        @if($activity->location)
                                        <p class="small text-muted mb-1">
                                            <i class="bi bi-geo-alt me-1"></i>{{ $activity->location }}
                                        </p>
                                        @endif
                                        @if($activity->description)
                                        <p class="small text-muted mb-0">{!! nl2br(e(Str::limit($activity->description, 150))) !!}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
