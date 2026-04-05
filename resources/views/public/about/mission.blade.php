@extends('layouts.public')

@section('title', $mission ? $mission->title : 'Our Mission')

@push('styles')
<style>
    :root {
        --brand-primary: #003A46;
        --brand-light: #005f73;
        --brand-accent: #0a9396;
    }
    
    .mission-header {
        position: relative;
        overflow: hidden;
        background: #f5fff5;
        min-height: 350px;
        padding: 65px 0;
    }

    .mission-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .mission-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .mission-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .mission-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .mission-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .mission-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .mission-header .b5 {
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

    .mission-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,255,245,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .mission-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .mission-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .mission-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }
    
    .brand-text { color: var(--brand-primary); }
    
    .content-card {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(0, 58, 70, 0.08);
        border: none;
    }
    
    .content-card .card-body {
        padding: 3rem;
    }
    
    .section-content {
        line-height: 1.9;
        font-size: 1.05rem;
        color: #4b5563;
    }
    
    .section-content h3 {
        color: var(--brand-primary);
        font-weight: 700;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .section-content p {
        margin-bottom: 1.25rem;
    }
    
    .section-content ul, .section-content ol {
        margin-bottom: 1.25rem;
        padding-left: 1.5rem;
    }
    
    .nav-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0, 58, 70, 0.08);
        border: none;
        padding: 1.5rem;
    }
    
    .nav-btn {
        padding: 1rem 1.5rem;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        text-decoration: none;
        font-weight: 600;
    }
    
    .nav-btn:hover {
        transform: translateY(-3px);
    }
    
    .nav-btn i {
        margin-right: 0.5rem;
    }
    
    .empty-state {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(0, 58, 70, 0.08);
        padding: 4rem 2rem;
        text-align: center;
    }
    
    .empty-icon {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }
    
    .empty-icon i {
        font-size: 2.5rem;
        color: #16a34a;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="mission-header">
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
                    <li class="breadcrumb-item"><a href="{{ route('public.about.index') }}" style="color: #003A46;">{{ __('about.title') }}</a></li>
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ __('about.mission') }}</li>
                </ol>
            </nav>
            <h1 class="header-title">
                {{ $mission ? $mission->title : __('about.mission') }}
            </h1>
            <p class="header-subtitle">
                Discover our commitment to excellence in legal education and service to society.
            </p>
        </div>
    </div>
</section>

<div class="container py-5" style="background: #f8fafb;">
    @if($mission)
        <div class="row">
            <div class="col-lg-12">
                <div class="content-card card">
                    <div class="card-body">
                        <div class="section-content">
                            {!! $mission->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="nav-card">
                    <h5 class="fw-bold mb-4" style="color: var(--brand-primary);">Explore More</h5>
                    <div class="row g-3">
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('public.about.overview') }}" class="nav-btn btn bg-light text-decoration-none" style="color: var(--brand-primary);">
                                <i class="bi bi-info-circle"></i>Overview
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('public.about.vision') }}" class="nav-btn btn text-decoration-none" style="background: #fef3c7; color: #ca8a04;">
                                <i class="bi bi-eye"></i>Vision
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('public.about.leadership') }}" class="nav-btn btn text-decoration-none" style="background: #e0f2fe; color: #0369a1;">
                                <i class="bi bi-people"></i>Leadership
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('public.about.index') }}" class="nav-btn btn bg-light text-decoration-none" style="color: #64748b;">
                                <i class="bi bi-house"></i>About Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon"><i class="bi bi-bullseye"></i></div>
            <h4 class="fw-bold mb-2" style="color: #16a34a;">Mission Statement Coming Soon</h4>
            <p class="text-muted mb-4">We're working on updating our mission statement.</p>
            <a href="{{ route('public.about.index') }}" class="btn" style="background: linear-gradient(135deg, #16a34a, #22c55e); color: white;">
                <i class="bi bi-arrow-left me-2"></i>Back to About
            </a>
        </div>
    @endif
</div>
@endsection
