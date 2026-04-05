@extends('layouts.public')

@section('title', __('about.title'))

@php
$heroImageUrl = $heroImage ? asset($heroImage) : 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=1200&q=80';
@endphp

@push('styles')
<style>
    :root {
        --brand-primary: #003A46;
        --brand-light: #005f73;
        --brand-accent: #0a9396;
        --brand-gradient: linear-gradient(135deg, #003A46 0%, #005f73 50%, #0a9396 100%);
    }
    
    .about-header {
        position: relative;
        overflow: hidden;
        background: #f5fff5;
        min-height: 350px;
        padding: 65px 0;
    }

    .about-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .about-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .about-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .about-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .about-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .about-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .about-header .b5 {
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

    .about-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,255,245,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .about-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .about-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .about-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }
    
    .brand-text { color: var(--brand-primary); }
    .brand-bg { background: var(--brand-primary); }
    .brand-gradient { background: var(--brand-gradient); }
    
    .hero-pattern {
        background: var(--brand-gradient);
        position: relative;
    }
    
    .hero-pattern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    
    /* Modern Navigation */
    .about-nav {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 58, 70, 0.1);
        padding: 1rem;
        position: sticky;
        top: 90px;
        z-index: 100;
    }
    
    .about-nav .nav-link {
        border-radius: 12px;
        padding: 12px 20px;
        font-weight: 600;
        color: #64748b;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .about-nav .nav-link:hover {
        background: #f1f5f9;
        color: var(--brand-primary);
    }
    
    .about-nav .nav-link.active {
        background: var(--brand-gradient);
        color: white;
    }
    
    .about-nav .nav-link i {
        font-size: 1.1rem;
    }
    
    /* Section Cards */
    .section-card {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(0, 58, 70, 0.08);
        border: none;
        overflow: hidden;
    }
    
    .section-header {
        padding: 1.5rem 2rem;
        color: white;
    }
    
    .section-header.overview {
        background: var(--brand-gradient);
    }
    
    .section-header.mission {
        background: linear-gradient(135deg, #16a34a, #22c55e);
    }
    
    .section-header.vision {
        background: linear-gradient(135deg, #ca8a04, #eab308);
    }
    
    .section-header h2 {
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .section-body {
        padding: 2rem;
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
    
    .section-content li {
        margin-bottom: 0.5rem;
    }
    
    /* Leadership Cards */
    .leader-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 58, 70, 0.08);
        border: none;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    .leader-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0, 58, 70, 0.15);
    }
    
    .leader-image {
        width: 100%;
        height: 260px;
        object-fit: cover;
    }
    
    .leader-image-placeholder {
        width: 100%;
        height: 260px;
        background: linear-gradient(135deg, #e0f2fe, #bae6fd);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .leader-image-placeholder i {
        font-size: 5rem;
        color: #94a3b8;
    }
    
    .leader-card .card-body {
        padding: 1.5rem;
    }
    
    .leader-name {
        color: var(--brand-primary);
        font-weight: 700;
        font-size: 1.1rem;
    }
    
    .leader-position {
        color: var(--brand-accent);
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .leader-bio {
        color: #64748b;
        font-size: 0.9rem;
        line-height: 1.6;
    }
    
    .contact-btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }
    
    .contact-btn.email {
        background: linear-gradient(135deg, #dbeafe, #93c5fd);
        color: #1e40af;
    }
    
    .contact-btn.phone {
        background: linear-gradient(135deg, #dcfce7, #86efac);
        color: #166534;
    }
    
    .contact-btn:hover {
        transform: translateY(-3px);
    }
    
    /* Empty State */
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
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }
    
    .empty-icon i {
        font-size: 2.5rem;
        color: #94a3b8;
    }
    
    /* Section spacing */
    section {
        scroll-margin-top: 120px;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="about-header">
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
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ __('about.title') }}</li>
                </ol>
            </nav>
            <h1 class="header-title">
                {{ __('about.title') }}
            </h1>
            <p class="header-subtitle">
                {{ __('about.description') }}
            </p>
        </div>
    </div>
</section>

<div class="container py-5" style="background: #f8fafb;">
    <!-- In-Page Navigation -->
    <div class="row mb-5">
        <div class="col-12">
            <nav class="about-nav">
                <ul class="nav nav-pills nav-fill">
                    <li class="nav-item">
                        <a class="nav-link" href="#overview">
                            <i class="bi bi-info-circle"></i>{{ __('about.overview') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#mission">
                            <i class="bi bi-bullseye"></i>{{ __('about.mission') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#vision">
                            <i class="bi bi-eye"></i>{{ __('about.vision') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#leadership">
                            <i class="bi bi-people"></i>{{ __('about.leadership') }}
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Overview Section -->
    @php
        $overviewSection = $sections->where('type', 'overview')->first();
    @endphp
    <section id="overview" class="mb-5">
        @if($overviewSection)
            <div class="section-card">
                <div class="section-header overview">
                    <h2>
                        <i class="bi bi-info-circle"></i>
                        {{ $overviewSection->title }}
                    </h2>
                </div>
                <div class="section-body">
                    <div class="section-content">
                        {!! $overviewSection->content !!}
                    </div>
                </div>
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon"><i class="bi bi-info-circle"></i></div>
                <h4 class="brand-text fw-bold mb-2">Overview Information Coming Soon</h4>
                <p class="text-muted">We're working on updating our overview information.</p>
            </div>
        @endif
    </section>

    <!-- Mission Section -->
    @php
        $missionSection = $sections->where('type', 'mission')->first();
    @endphp
    <section id="mission" class="mb-5">
        @if($missionSection)
            <div class="section-card">
                <div class="section-header mission">
                    <h2>
                        <i class="bi bi-bullseye"></i>
                        {{ $missionSection->title }}
                    </h2>
                </div>
                <div class="section-body">
                    <div class="section-content">
                        {!! $missionSection->content !!}
                    </div>
                </div>
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon"><i class="bi bi-bullseye"></i></div>
                <h4 class="fw-bold mb-2" style="color: #16a34a;">Mission Statement Coming Soon</h4>
                <p class="text-muted">We're working on updating our mission statement.</p>
            </div>
        @endif
    </section>

    <!-- Vision Section -->
    @php
        $visionSection = $sections->where('type', 'vision')->first();
    @endphp
    <section id="vision" class="mb-5">
        @if($visionSection)
            <div class="section-card">
                <div class="section-header vision">
                    <h2>
                        <i class="bi bi-eye"></i>
                        {{ $visionSection->title }}
                    </h2>
                </div>
                <div class="section-body">
                    <div class="section-content">
                        {!! $visionSection->content !!}
                    </div>
                </div>
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon"><i class="bi bi-eye"></i></div>
                <h4 class="fw-bold mb-2" style="color: #ca8a04;">Vision Statement Coming Soon</h4>
                <p class="text-muted">We're working on updating our vision statement.</p>
            </div>
        @endif
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.about-nav .nav-link');
    
    function highlightNavigation() {
        let current = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            
            if (pageYOffset >= sectionTop - 200) {
                current = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('active');
            }
        });
    }
    
    window.addEventListener('scroll', highlightNavigation);
    highlightNavigation();
});
</script>
@endsection
