@extends('layouts.public')

@section('title', __('partner.title'))

@push('styles')
<style>
    .partners-header {
        position: relative;
        overflow: hidden;
        background: #f5f8ff;
        min-height: 350px;
        padding: 65px 0;
    }

    .partners-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .partners-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .partners-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .partners-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .partners-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .partners-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .partners-header .b5 {
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

    .partners-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,248,255,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .partners-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .partners-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .partners-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }

    .partners-header .breadcrumb-item a {
        color: #003A46;
        text-decoration: none;
    }

    .partners-header .breadcrumb-item.active {
        color: #64748b;
    }

    .partners-header .breadcrumb-item + .breadcrumb-item::before {
        color: #64748b;
    }

    .partner-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .partner-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
    }
    .partner-logo {
        height: 70px;
        width: auto;
        object-fit: contain;
    }
    .partner-logo-placeholder {
        width: 80px;
        height: 80px;
        background: #f3f4f6;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #9ca3af;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="partners-header">
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
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #003A46;">{{ __('partner.home') }}</a></li>
                    <li class="breadcrumb-item active" style="color: #64748b;">{{ __('partner.title') }}</li>
                </ol>
            </nav>
            <h1 class="header-title">{{ __('partner.hero_title') }}</h1>
            <p class="header-subtitle">{{ __('partner.hero_description') }}</p>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        @if($universities->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-building d-block mb-3 text-muted" style="font-size: 4rem;"></i>
            <h4 class="text-muted">{{ __('partner.no_partners') }}</h4>
            <p class="text-muted">{{ __('partner.no_partners_description') }}</p>
        </div>
        @else
        <div class="row g-4">
            @foreach($universities as $university)
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('partners.show', $university->id) }}" 
                   class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100 partner-card">
                        <div class="card-body p-4">
                            <div class="text-center mb-3">
                                @if($university->logo)
                                <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $university->logo)) }}" alt="{{ $university->name }}" 
                                     class="partner-logo mb-3">
                                @else
                                <div class="partner-logo-placeholder mb-3">
                                    <i class="bi bi-building"></i>
                                </div>
                                @endif
                                <h5 class="fw-bold mb-1" style="color: #003A46;">{{ $university->name }}</h5>
                                <p class="text-muted small mb-2">{{ $university->faculty_or_school }}</p>
                                <span class="badge bg-light text-dark border">
                                    <i class="bi bi-geo-alt me-1"></i>{{ $university->country }}
                                </span>
                            </div>
                            @if($university->publicActivities->count() > 0)
                            <hr>
                            <p class="small text-muted mb-0">
                                <i class="bi bi-calendar-event me-1"></i>
                                {{ $university->publicActivities->count() }} {{ __('partner.activities') }}
                            </p>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection
