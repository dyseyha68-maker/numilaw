@extends('layouts.public')

@section('title', $event->title)

@php
$heroImageUrl = $heroImage ? asset($heroImage) : 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=1200&q=80';
@endphp

@push('styles')
<style>
    .calendar-show-header {
        position: relative;
        overflow: hidden;
        background: #f5fff5;
        min-height: 280px;
        padding: 60px 0 40px;
    }

    .calendar-show-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .calendar-show-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .calendar-show-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .calendar-show-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .calendar-show-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .calendar-show-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .calendar-show-header .b5 {
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

    .calendar-show-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,255,245,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .calendar-show-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .calendar-show-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .calendar-show-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }

    .event-type-badge {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        flex-shrink: 0;
    }
    .detail-item {
        display: flex;
        flex-direction: column;
    }
    .detail-label {
        font-size: 0.85rem;
        color: #64748b;
        margin-bottom: 0.25rem;
    }
    .detail-value {
        font-weight: 600;
        color: #1e293b;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="calendar-show-header">
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
                    <li class="breadcrumb-item"><a href="{{ route('public.academic-calendar.index') }}" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'ប្រតិទិនសិក្សា' : 'Academic Calendar' }}</a></li>
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ Str::limit($event->title, 30) }}</li>
                </ol>
            </nav>
            <h1 class="header-title">
                {{ $event->title }}
            </h1>
            <p class="header-subtitle">
                {{ $event->formatted_date_range }}
            </p>
        </div>
    </div>
</section>

<!-- Event Details -->
<div class="container py-5" style="background: #f8fafb;">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card shadow-sm" style="border-radius: 24px;">
                <div class="card-body p-4 p-lg-5">
                    <!-- Event Description -->
                    <div class="mb-4">
                        <h3 class="h5 mb-3" style="color: #003A46;">
                            <i class="bi bi-info-circle me-2"></i>{{ app()->getLocale() === 'km' ? 'ពិពណ៌នា' : 'Description' }}
                        </h3>
                        <div class="text-muted" style="line-height: 1.8;">
                            {!! nl2br(e($event->description)) !!}
                        </div>
                    </div>

                    <!-- Event Details -->
                    <div class="event-details">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item mb-3">
                                    <div class="detail-label">
                                        <i class="bi bi-calendar3"></i> 
                                        {{ app()->getLocale() === 'km' ? 'កាលបរិច្ឆេទ' : 'Date' }}
                                    </div>
                                    <div class="detail-value">{{ $event->formatted_date_range }}</div>
                                </div>
                                
                                @if($event->start_time && !$event->is_all_day)
                                    <div class="detail-item mb-3">
                                        <div class="detail-label">
                                            <i class="bi bi-clock"></i> 
                                            {{ app()->getLocale() === 'km' ? 'ពេលវេលា' : 'Time' }}
                                        </div>
                                        <div class="detail-value">
                                            {{ $event->start_time->format('g:i A') }}
                                            @if($event->end_time)
                                                - {{ $event->end_time->format('g:i A') }}
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                
                                @if($event->location)
                                    <div class="detail-item mb-3">
                                        <div class="detail-label">
                                            <i class="bi bi-geo-alt"></i> 
                                            {{ app()->getLocale() === 'km' ? 'ទីតាំង' : 'Location' }}
                                        </div>
                                        <div class="detail-value">{{ $event->location }}</div>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="col-md-6">
                                @if($event->audience)
                                    <div class="detail-item mb-3">
                                        <div class="detail-label">
                                            <i class="bi bi-people"></i> 
                                            {{ app()->getLocale() === 'km' ? 'អ្នកចូលរួម' : 'Audience' }}
                                        </div>
                                        <div class="detail-value">{{ $event->audience_display }}</div>
                                    </div>
                                @endif
                                
                                @if($event->is_recurring)
                                    <div class="detail-item mb-3">
                                        <div class="detail-label">
                                            <i class="bi bi-arrow-repeat"></i> 
                                            {{ app()->getLocale() === 'km' ? 'ព្រឹត្តិការណ៍មានឡើងវិញ' : 'Recurring Event' }}
                                        </div>
                                        <div class="detail-value">{{ $event->recurring_pattern }}</div>
                                    </div>
                                @endif
                                
                                <div class="detail-item mb-3">
                                    <div class="detail-label">
                                        <i class="bi bi-flag"></i> 
                                        {{ app()->getLocale() === 'km' ? 'ស្ថានភាព' : 'Status' }}
                                    </div>
                                    <div class="detail-value">
                                        @if($event->isToday())
                                            <span class="badge bg-success">
                                                {{ app()->getLocale() === 'km' ? 'ថ្ងៃនេះ' : 'Today' }}
                                            </span>
                                        @elseif($event->isUpcoming())
                                            <span class="badge bg-primary">
                                                {{ app()->getLocale() === 'km' ? 'ខិតមកដល់' : 'Upcoming' }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                {{ app()->getLocale() === 'km' ? 'បានបញ្ចប់' : 'Past' }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($event->description)
                        <div class="mb-4">
                            <h5 class="mb-3">
                                <i class="bi bi-info-circle"></i> 
                                {{ app()->getLocale() === 'km' ? 'ពត៌មានលម្អិត' : 'Details' }}
                            </h5>
                            <div class="event-description">
                                {!! nl2br(e($event->description)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Additional Notes -->
                    @if($event->notes)
                        <div class="alert alert-info">
                            <h6 class="alert-heading">
                                <i class="bi bi-sticky-note"></i> 
                                {{ app()->getLocale() === 'km' ? 'កំណត់ចំណាំ' : 'Additional Notes' }}
                            </h6>
                            <p class="mb-0">{{ $event->notes }}</p>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('public.academic-calendar.index') }}" 
                           class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> 
                            {{ app()->getLocale() === 'km' ? 'ត្រឡប់ទៅប្រតិទិន' : 'Back to Calendar' }}
                        </a>
                        
                        <button class="btn btn-primary" onclick="window.print()">
                            <i class="bi bi-printer"></i> 
                            {{ app()->getLocale() === 'km' ? 'បោះពុម្ព' : 'Print' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4 mt-4 mt-lg-0">
            <!-- Quick Actions -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="card-title mb-3">
                        <i class="bi bi-lightning"></i> 
                        {{ app()->getLocale() === 'km' ? 'សកម្មភាពរហ័ស' : 'Quick Actions' }}
                    </h6>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary btn-sm" data-action="add-to-calendar">
                            <i class="bi bi-calendar-plus"></i> 
                            {{ app()->getLocale() === 'km' ? 'បន្ថែមទៅប្រតិទិនផ្ទាល់ខ្លួន' : 'Add to Personal Calendar' }}
                        </button>
                        <button class="btn btn-outline-secondary btn-sm" data-action="share">
                            <i class="bi bi-share"></i> 
                            {{ app()->getLocale() === 'km' ? 'ចែករំលែក' : 'Share Event' }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Related Events -->
            @if($relatedEvents->count() > 0)
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title mb-3">
                            <i class="bi bi-calendar-check"></i> 
                            {{ app()->getLocale() === 'km' ? 'ព្រឹត្តិការណ៍ដែលពាក់ព័ន្ធ' : 'Related Events' }}
                        </h6>
                        <div class="related-events">
                            @foreach($relatedEvents as $relatedEvent)
                                <div class="related-event-item mb-3 pb-3 border-bottom">
                                    <a href="{{ route('public.academic-calendar.show', $relatedEvent->id) }}" 
                                       class="text-decoration-none">
                                        <div class="fw-bold">{{ $relatedEvent->title }}</div>
                                        <div class="text-muted small">{{ $relatedEvent->formatted_date_range }}</div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('public.academic-calendar.index', ['type' => $event->event_type]) }}" 
                               class="btn btn-sm btn-outline-primary">
                                {{ app()->getLocale() === 'km' ? 'មើលព្រឹត្តិការណ៍ទាំងអស់' : 'View All Events' }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
.event-type-badge {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    background-color: #007bff;
    flex-shrink: 0;
}

.detail-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.25rem;
    font-size: 0.875rem;
}

.detail-value {
    color: #212529;
    font-size: 1rem;
}

.event-description {
    line-height: 1.6;
    color: #495057;
}

.related-event-item:last-child {
    border-bottom: none !important;
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
}

.related-event-item .fw-bold {
    color: #495057;
}

.related-event-item .fw-bold:hover {
    color: #007bff;
}

@media print {
    .d-flex.gap-2.mt-4 {
        display: none !important;
    }
    
    .col-lg-4 {
        display: none !important;
    }
    
    .card {
        box-shadow: none !important;
        border: 1px solid #dee2e6 !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set background color for event type badge
    const eventBadge = document.querySelector('.event-type-badge[data-color]');
    if (eventBadge) {
        const color = eventBadge.getAttribute('data-color');
        if (color) {
            eventBadge.style.backgroundColor = color;
        }
    }
    
    // Simple calendar export functionality
    const addToCalendarBtn = document.querySelector('button[data-action="add-to-calendar"]');
    if (addToCalendarBtn) {
        addToCalendarBtn.addEventListener('click', function() {
            alert('{{ app()->getLocale() === "km" ? "មុខងារនេះនឹងត្រូវបានបន្ថែមនៅក្នុងកំណែអនាគត" : "This feature will be added in a future version" }}');
        });
    }
    
    // Share functionality
    const shareBtn = document.querySelector('button[data-action="share"]');
    if (shareBtn) {
        shareBtn.addEventListener('click', function() {
            const url = window.location.href;
            const title = document.querySelector('h1').textContent;
            
            if (navigator.share) {
                navigator.share({
                    title: title,
                    url: url
                });
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(url).then(() => {
                    alert('{{ app()->getLocale() === "km" ? "តំណត្រូវបានចម្លងទៅក្នុង clipboard!" : "Link copied to clipboard!" }}');
                });
            }
        });
    }
});
</script>
@endpush
@endsection