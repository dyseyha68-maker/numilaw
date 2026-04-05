@extends('layouts.public')

@section('title', $locale === 'kh' ? 'ក្លឹបនិស្សិត' : 'Student Clubs')

@push('styles')
<style>
    .clubs-header {
        position: relative;
        overflow: hidden;
        background: #f5f8ff;
        min-height: 350px;
        padding: 65px 0;
    }

    .clubs-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .clubs-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .clubs-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .clubs-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .clubs-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .clubs-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .clubs-header .b5 {
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

    .clubs-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,248,255,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .clubs-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .clubs-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .clubs-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }

    .clubs-hero {
        background: linear-gradient(135deg, #003A46 0%, #004d5c 100%);
        padding: 60px 0;
    }
    
    .club-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }
    
    .club-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.12);
    }
    
    .club-card .club-logo {
        height: 140px;
        background: linear-gradient(135deg, #003A46, #006d77);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .club-card .club-logo img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid rgba(255,255,255,0.3);
    }
    
    .club-card .club-logo i {
        font-size: 56px;
        color: rgba(255,255,255,0.9);
    }
    
    .club-card .card-body {
        padding: 25px;
    }
    
    .club-card h4 {
        color: #003A46;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .club-card .description {
        color: #6b7280;
        font-size: 15px;
        line-height: 1.7;
    }
    
    .club-card .president {
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #e5e7eb;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="clubs-header">
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
                    <li class="breadcrumb-item"><a href="{{ route('student-experience.index') }}" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'បទពិសោធន៍និស្សិត' : 'Student Experiences' }}</a></li>
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ $locale === 'kh' ? 'ក្លឹបនិស្សិត' : 'Student Clubs' }}</li>
                </ol>
            </nav>
            <h1 class="header-title">
                {{ $locale === 'kh' ? 'ក្លឹបនិស្សិត' : 'Student Clubs' }}
            </h1>
            <p class="header-subtitle">
                {{ $locale === 'kh' 
                    ? 'ចូលរួមជាមួយក្លឹបផ្សេងៗ ដើម្បីអភិវឌ្ឍជំនាញ និង ធ្វើមិត្តភាព' 
                    : 'Join our clubs to develop skills and make lasting friendships' }}
            </p>
        </div>
    </div>
</section>

<!-- Clubs Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($clubs as $club)
            <div class="col-md-6 col-lg-3">
                <div class="club-card">
                    <div class="club-logo">
                        @if($club->logo)
                        <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $club->logo)) }}" alt="{{ $club->name_en }}">
                        @else
                        <i class="bi bi-people-fill"></i>
                        @endif
                    </div>
                    <div class="card-body">
                        <h4>{{ $locale === 'kh' ? $club->name_kh : $club->name_en }}</h4>
                        <p class="description">
                            {{ Str::limit($locale === 'kh' ? $club->description_kh : $club->description_en, 120) }}
                        </p>
                        @if($club->president_name)
                        <div class="president">
                            <small class="text-muted d-block">{{ $locale === 'kh' ? 'ប្រធាន' : 'President' }}</small>
                            <strong>{{ $club->president_name }}</strong>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">{{ $locale === 'kh' ? 'មិនទាន់មានក្លឹបទេ' : 'No clubs available' }}</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
