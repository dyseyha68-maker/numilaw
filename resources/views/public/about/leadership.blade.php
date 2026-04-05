@extends('layouts.public')

@section('title', 'Leadership Team')

@push('styles')
<style>
    /* Leadership Header */
    .leadership-header {
        position: relative;
        overflow: hidden;
        background: #f5fff5;
        min-height: 350px;
        padding: 65px 0;
    }

    .leadership-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .leadership-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .leadership-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .leadership-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .leadership-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .leadership-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .leadership-header .b5 {
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

    .leadership-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,255,245,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .leadership-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .leadership-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .leadership-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }
    
    :root {
        --brand-primary: #003A46;
        --brand-light: #005f73;
        --brand-accent: #C5A028;
    }
    
    .brand-text { color: var(--brand-primary); }
    .brand-bg { background: var(--brand-primary); }
    
    .leader-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.4s ease;
        border: 1px solid #f1f5f9;
    }
    
    .leader-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    }
    
    .leader-image-wrapper {
        position: relative;
        height: 350px;
        overflow: hidden;
        border-radius: 20px;
        padding: 10px;
    }
    
    .leader-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
        border-radius: 16px;
    }
    
    .leader-card:hover .leader-image-wrapper img {
        transform: scale(1.08);
    }
    
    .leader-social {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%) translateY(20px);
        opacity: 0;
        transition: all 0.4s ease;
        display: flex;
        gap: 10px;
    }
    
    .leader-card:hover .leader-social {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }
    
    .social-icon {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #003A46;
        text-decoration: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .social-icon:hover {
        background: #003A46;
        color: white;
        transform: translateY(-3px);
    }
    
    .leader-content {
        padding: 24px;
    }
    
    .leader-name {
        font-size: 1.25rem;
        font-weight: 700;
        color: #003A46;
        margin-bottom: 4px;
    }
    
    .leader-position {
        color: #C5A028;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
    }
    
    .leader-bio {
        color: #64748b;
        font-size: 0.9rem;
        line-height: 1.6;
    }
    
    .leader-credentials {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 12px;
    }
    
    .credential-badge {
        background: #f1f5f9;
        color: #64748b;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }
    
    .section-header h2 {
        color: #003A46;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .section-header p {
        color: #64748b;
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
    }
    
    .quick-link-card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
        text-decoration: none;
    }
    
    .quick-link-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        border-color: #003A46;
    }
    
    .quick-link-card i {
        font-size: 2rem;
        color: #003A46;
        margin-bottom: 10px;
    }
    
    .quick-link-card span {
        display: block;
        color: #003A46;
        font-weight: 600;
    }
    
    @media (max-width: 768px) {
        .leadership-hero h1 {
            font-size: 2.5rem;
        }
        
        .leader-image-wrapper {
            height: 240px;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="leadership-header">
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
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ __('about.leadership') }}</li>
                </ol>
            </nav>
            <h1 class="header-title">
                {{ __('about.leadership') }}
            </h1>
            <p class="header-subtitle">
                Meet the distinguished leaders who guide our institution toward excellence in legal education and research.
            </p>
        </div>
    </div>
</section>

<!-- Leadership Cards Section -->
<section class="py-2" style="background: #f8fafb;">
    <div class="container mt-4">
        @if($leadership->count() > 0)
            <div class="row g-4">
            @foreach($leadership as $member)
                <div class="col-lg-4 col-md-6">
                    <div class="leader-card">
                        <div class="leader-image-wrapper">
                            @if($member->photo)
                                <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $member->photo)) }}" alt="{{ $member->name }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&q=80" alt="{{ $member->name }}">
                            @endif
                            <div class="leader-social">
                                @if($member->email)
                                    <a href="mailto:{{ $member->email }}" class="social-icon" title="Email">
                                        <i class="bi bi-envelope"></i>
                                    </a>
                                @endif
                                @if($member->phone)
                                    <a href="tel:{{ $member->phone }}" class="social-icon" title="Phone">
                                        <i class="bi bi-telephone"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="leader-content">
                            <h5 class="leader-name">{{ $member->name }}</h5>
                            <p class="leader-position">{{ $member->position }}</p>
                            <p class="leader-bio">{{ Str::limit($member->bio, 100) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-people fs-1 text-muted"></i>
                <p class="text-muted mt-3">No leadership members found.</p>
            </div>
        @endif
    </div>
</section>
@endsection
