@extends('layouts.public')

@section('title', app()->getLocale() === 'km' ? 'ព្រឹត្តិការណ៍' : 'Events & Activities')

@push('styles')
<style>
    .events-header {
        position: relative;
        overflow: hidden;
        background: #f5fff5;
        min-height: 350px;
        padding: 65px 0;
    }

    .events-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .events-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .events-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .events-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .events-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .events-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .events-header .b5 {
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

    .events-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,255,245,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .events-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .events-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .events-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }

    .modern-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        border: none;
        overflow: hidden;
        transition: all 0.4s ease;
    }
    .modern-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    .event-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .event-type-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    .event-date-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: white;
        border-radius: 12px;
        padding: 0.5rem 0.8rem;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .event-date-badge .month {
        font-size: 0.65rem;
        text-transform: uppercase;
        color: #003A46;
        font-weight: 700;
    }
    .event-date-badge .day {
        font-size: 1.5rem;
        font-weight: 800;
        color: #003A46;
        line-height: 1;
    }
    .event-content {
        padding: 1.5rem;
    }
    .event-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #003A46;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }
    .event-meta {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    .event-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: #64748b;
    }
    .event-meta-item i {
        width: 18px;
        color: #003A46;
    }
    .event-excerpt {
        font-size: 0.9rem;
        color: #64748b;
        line-height: 1.6;
        margin-top: 1rem;
    }
    .event-footer {
        padding: 1rem 1.5rem;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
    }
    .tab-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        background: transparent;
        color: #64748b;
        text-decoration: none;
    }
    .tab-btn.active {
        background: linear-gradient(135deg, #003A46, #005f6b);
        color: white;
        box-shadow: 0 4px 15px rgba(0,58,70,0.3);
    }
    .tab-btn:hover:not(.active) {
        background: #e2e8f0;
        color: #003A46;
    }
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }
    .empty-state-icon {
        font-size: 4rem;
        color: #e2e8f0;
        margin-bottom: 1rem;
    }
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-slide-up { animation: slideUp 0.6s ease-out; }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="events-header">
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
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'ព្រឹត្តិការណ៍' : 'Events & Activities' }}</li>
                </ol>
            </nav>
            <h1 class="header-title">
                {{ app()->getLocale() === 'km' ? 'ព្រឹត្តិការណ៍ និង សកម្មភាព' : 'Events & Activities' }}
            </h1>
            <p class="header-subtitle">
                {{ app()->getLocale() === 'km' ? 'ព្រឹត្តិការណ៍ និង សកម្មភាព ពី មេបុណ្យ សាកលវិទ្យាល័យ យើង' : 'Upcoming and past events from our faculty' }}
            </p>
        </div>
    </div>
</section>

<!-- Filter Tabs -->
<section class="py-4" style="background: #f8fafb;">
    <div class="container">
        <div class="d-flex justify-content-center gap-2">
            <a href="{{ route('public.events.index', ['status' => 'upcoming']) }}" 
               class="tab-btn {{ request('status') != 'completed' ? 'active' : '' }}">
                <i class="bi bi-calendar-check me-2"></i>
                {{ app()->getLocale() === 'km' ? 'ព្រឹត្តិការណ៍ នាពេលខាងមុខ' : 'Upcoming Events' }}
            </a>
            <a href="{{ route('public.events.index', ['status' => 'completed']) }}" 
               class="tab-btn {{ request('status') == 'completed' ? 'active' : '' }}">
                <i class="bi bi-clock-history me-2"></i>
                {{ app()->getLocale() === 'km' ? 'ព្រឹត្តិការណ៍ បានបញ្ចប់' : 'Past Events' }}
            </a>
        </div>
    </div>
</section>

<!-- Events Grid -->
<div class="container py-5" style="background: #f8fafb;">
    @if($events->count() > 0)
        <div class="row g-4">
            @foreach($events as $event)
                <div class="col-md-6 col-lg-4">
                    <div class="modern-card h-100 position-relative">
                        @if($event->featured_image)
                            <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $event->featured_image)) }}" 
                                 alt="{{ $event->title }}" 
                                 class="event-image">
                        @else
                            <div class="event-image" style="background: linear-gradient(135deg, #003A46, #005f6b); display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-calendar-event text-white" style="font-size: 3rem; opacity: 0.5;"></i>
                            </div>
                        @endif
                        
                        <span class="event-type-badge" style="background: #e0f2fe; color: #0284c7;">
                            {{ $event->type }}
                        </span>
                        
                        <div class="event-date-badge">
                            <div class="month">{{ $event->start_datetime->format('M') }}</div>
                            <div class="day">{{ $event->start_datetime->format('j') }}</div>
                        </div>
                        
                        <div class="event-content">
                            <h3 class="event-title">
                                <a href="{{ route('public.events.show', $event->slug) }}" 
                                   style="text-decoration: none; color: inherit;">
                                    {{ Str::limit($event->title, 60) }}
                                </a>
                            </h3>
                            
                            <div class="event-meta">
                                <div class="event-meta-item">
                                    <i class="bi bi-clock"></i>
                                    {{ $event->start_datetime->format('g:i A') }} - {{ $event->end_datetime->format('g:i A') }}
                                </div>
                                <div class="event-meta-item">
                                    <i class="bi bi-geo-alt"></i>
                                    {{ $event->location }}
                                </div>
                                @if($event->is_registration_required)
                                    <div class="event-meta-item">
                                        <i class="bi bi-person-plus"></i>
                                        {{ app()->getLocale() === 'km' ? 'ត្រូវការចុះឈ្មោះ' : 'Registration Required' }}
                                        @if($event->registration_deadline && $event->registration_deadline->isFuture())
                                            <small style="color: #dc3545;">({{ app()->getLocale() === 'km' ? 'ថ្ងៃបិទ' : 'Deadline' }}: {{ $event->registration_deadline->format('M j') }})</small>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            
                            <p class="event-excerpt">
                                {{ Str::limit(strip_tags($event->description), 100) }}
                            </p>
                        </div>
                        
                        <div class="event-footer">
                            <a href="{{ route('public.events.show', $event->slug) }}" 
                               class="btn w-100" 
                               style="background: linear-gradient(135deg, #003A46, #005f6b); color: white; border-radius: 10px;">
                                <i class="bi bi-arrow-right me-2"></i>
                                {{ app()->getLocale() === 'km' ? 'មើលលម្អិត' : 'View Details' }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if($events->hasPages())
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $events->links() }}
                </div>
            </div>
        @endif
    @else
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="bi bi-calendar-x"></i>
            </div>
            <h3 style="color: #003A46;">
                {{ app()->getLocale() === 'km' ? 'គ្មានព្រឹត្តិការណ៍' : 'No Events Found' }}
            </h3>
            <p class="text-muted">
                {{ app()->getLocale() === 'km' ? 'សូមមកម្សាន្តពេលក្រោយ' : 'Check back later for upcoming events' }}
            </p>
        </div>
    @endif
</div>
@endsection
