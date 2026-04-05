@extends('layouts.public')

@section('title', $event->title)

@section('description', Str::limit(strip_tags($event->description), 160))

@push('styles')
<style>
    .event-show-header {
        position: relative;
        overflow: hidden;
        background: #f5fff5;
        min-height: 280px;
        padding: 60px 0 40px;
    }

    .event-show-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .event-show-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .event-show-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .event-show-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .event-show-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .event-show-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .event-show-header .b5 {
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

    .event-show-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,255,245,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .event-show-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .event-show-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .event-show-header .header-subtitle {
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
    }
    .event-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }
    .event-type-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .event-date-card {
        background: linear-gradient(135deg, #003A46, #005f6b);
        border-radius: 16px;
        padding: 1rem;
        text-align: center;
        color: white;
        min-width: 70px;
    }
    .event-date-card .month {
        font-size: 0.75rem;
        text-transform: uppercase;
        opacity: 0.9;
    }
    .event-date-card .day {
        font-size: 1.75rem;
        font-weight: 800;
        line-height: 1;
    }
    .event-date-card .weekday {
        font-size: 0.85rem;
        opacity: 0.9;
    }
    .info-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s ease;
    }
    .info-card:hover {
        background: #e2e8f0;
        transform: translateX(5px);
    }
    .info-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    .sidebar-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: none;
        overflow: hidden;
    }
    .sidebar-card-header {
        background: linear-gradient(135deg, #003A46, #005f6b);
        color: white;
        padding: 1rem 1.25rem;
        font-weight: 600;
    }
    .register-btn {
        background: linear-gradient(135deg, #003A46, #005f6b);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    .register-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,58,70,0.3);
        color: white;
    }
    .register-btn:disabled {
        background: #94a3b8;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="event-show-header">
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
                    <li class="breadcrumb-item"><a href="{{ route('public.events.index') }}" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'ព្រឹត្តិការណ៍' : 'Events' }}</a></li>
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ Str::limit($event->title, 30) }}</li>
                </ol>
            </nav>
            <h1 class="header-title">
                {{ $event->title }}
            </h1>
            <p class="header-subtitle">
                {{ $event->start_datetime->format('F j, Y') }} - {{ $event->location ?? 'TBA' }}
            </p>
        </div>
    </div>
</section>

<!-- Event Details -->
<div class="container py-5" style="background: #f8fafb;">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="modern-card">
                @if($event->featured_image)
                    <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $event->featured_image)) }}" alt="{{ $event->title }}" class="event-image">
                @endif
                <div class="card-body p-4">
                    <!-- Quick Info Grid -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="info-card">
                                <div class="info-icon" style="background: #dcfce7; color: #16a34a;">
                                    <i class="bi bi-calendar"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">{{ app()->getLocale() === 'km' ? 'កាលបរិច្ឆេទ' : 'Date' }}</small>
                                    <strong>{{ $event->start_datetime->format('F j, Y') }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card">
                                <div class="info-icon" style="background: #fef3c7; color: #d97706;">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">{{ app()->getLocale() === 'km' ? 'ម៉ោង' : 'Time' }}</small>
                                    <strong>{{ $event->start_datetime->format('g:i A') }} - {{ $event->end_datetime->format('g:i A') }}</strong>
                                </div>
                            </div>
                        </div>
                        @if($event->location)
                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-icon" style="background: #fce7f3; color: #db2777;">
                                        <i class="bi bi-geo-alt"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">{{ app()->getLocale() === 'km' ? 'ទីតាំង' : 'Location' }}</small>
                                        <strong>{{ $event->location }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($event->organizer)
                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-icon" style="background: #dbeafe; color: #2563eb;">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">{{ app()->getLocale() === 'km' ? 'អ្នករៀបចំ' : 'Organizer' }}</small>
                                        <strong>{{ $event->organizer->name }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Registration Info -->
                    @if($event->is_registration_required)
                        <div class="info-card mb-4" style="background: #fef3c7; border: 1px solid #fcd34d;">
                            <div class="info-icon" style="background: #fff; color: #d97706;">
                                <i class="bi bi-person-plus"></i>
                            </div>
                            <div class="flex-grow-1">
                                <small class="text-muted d-block">{{ app()->getLocale() === 'km' ? 'ការចុះឈ្មោះ' : 'Registration Required' }}</small>
                                @if($event->registration_deadline && $event->registration_deadline->isFuture())
                                    <strong>{{ app()->getLocale() === 'km' ? 'ថៃ្ងៃបិទ' : 'Deadline' }}: {{ $event->registration_deadline->format('F j, Y g:i A') }}</strong>
                                @endif
                                @if($event->max_participants)
                                    <span class="ms-3 badge" style="background: #fcd34d; color: #92400e;">
                                        <i class="bi bi-people me-1"></i>
                                        {{ $event->max_participants }} {{ app()->getLocale() === 'km' ? 'នាក់' : 'participants' }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                    
                    <!-- Description -->
                    <div class="mb-5">
                        <h5 class="mb-3" style="color: #003A46; font-weight: 600;">
                            <i class="bi bi-file-text me-2"></i>
                            {{ app()->getLocale() === 'km' ? 'ពត៌មានលម្អិត' : 'About This Event' }}
                        </h5>
                        <div style="line-height: 1.8; color: #374151; font-size: 1.05rem;">
                            {!! $event->description !!}
                        </div>
                    </div>
                    
                    <!-- Registration Button -->
                    <div class="d-flex align-items-center justify-content-between pt-4" style="border-top: 1px solid #e2e8f0;">
                        <a href="{{ route('public.events.index') }}" class="btn" style="color: #64748b; text-decoration: none;">
                            <i class="bi bi-arrow-left me-2"></i>
                            {{ app()->getLocale() === 'km' ? 'ត្រលប់' : 'Back to Events' }}
                        </a>
                        
                        @if($event->is_registration_required && $event->status === 'upcoming' && (!$event->registration_deadline || $event->registration_deadline->isFuture()))
                            <button class="register-btn">
                                <i class="bi bi-person-plus me-2"></i>
                                {{ app()->getLocale() === 'km' ? 'ចុះឈ្មោះឥឡូវ' : 'Register Now' }}
                            </button>
                        @elseif($event->registration_deadline && $event->registration_deadline->isPast())
                            <button class="register-btn" disabled style="background: #94a3b8; cursor: not-allowed;">
                                <i class="bi bi-x-circle me-2"></i>
                                {{ app()->getLocale() === 'km' ? 'ការចុះឈ្មោះបានបិទ' : 'Registration Closed' }}
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4 mt-4 mt-lg-0">
            <!-- Quick Info -->
            <div class="sidebar-card mb-4">
                <div class="sidebar-card-header">
                    <i class="bi bi-info-circle me-2"></i>
                    {{ app()->getLocale() === 'km' ? 'ព�៌មាន' : 'Quick Info' }}
                </div>
                <div class="p-4">
                    <div class="mb-3 pb-3" style="border-bottom: 1px solid #e2e8f0;">
                        <small class="text-muted d-block mb-1">{{ app()->getLocale() === 'km' ? 'ប្រភេទ' : 'Event Type' }}</small>
                        <span class="event-type-badge" style="background: #e0f2fe; color: #0284c7;">
                            {{ $event->type }}
                        </span>
                    </div>
                    <div class="mb-3 pb-3" style="border-bottom: 1px solid #e2e8f0;">
                        <small class="text-muted d-block mb-1">{{ app()->getLocale() === 'km' ? 'ស្ថានភាព' : 'Status' }}</small>
                        <span class="event-type-badge" style="background: #dcfce7; color: #16a34a;">
                            {{ ucfirst($event->status) }}
                        </span>
                    </div>
                    @if($event->organizer)
                    <div>
                        <small class="text-muted d-block mb-1">{{ app()->getLocale() === 'km' ? 'អ្នករៀបចំ' : 'Organized By' }}</small>
                        <strong style="color: #003A46;">{{ $event->organizer->name }}</strong>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Calendar Link -->
            <div class="sidebar-card">
                <div class="sidebar-card-header">
                    <i class="bi bi-calendar3 me-2"></i>
                    {{ app()->getLocale() === 'km' ? 'ប្រតិទិន' : 'Calendar' }}
                </div>
                <div class="p-4">
                    <a href="{{ route('public.events.calendar') }}" class="btn w-100" style="background: #003A46; color: white; border-radius: 10px;">
                        <i class="bi bi-calendar me-2"></i>
                        {{ app()->getLocale() === 'km' ? 'មើលប្រតិទិន' : 'View Calendar' }}
                    </a>
                    <a href="{{ route('public.events.index') }}" class="btn w-100 mt-2" style="border: 2px solid #e2e8f0; color: #003A46; border-radius: 10px;">
                        <i class="bi bi-grid me-2"></i>
                        {{ app()->getLocale() === 'km' ? 'មើលព្រឹត្តិការណ៍' : 'All Events' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
