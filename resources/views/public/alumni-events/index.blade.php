@extends('layouts.public')

@section('title', __('alumni.alumni_events'))

@php
$heroImageUrl = $heroImage ? asset($heroImage) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1200&q=80';
@endphp

@section('content')
<!-- Hero Section -->
<section class="position-relative d-flex align-items-center" style="min-height: 50vh; overflow: hidden;">
    <div class="position-absolute top-0 start-0 w-100 h-100">
        <img src="{{ $heroImageUrl }}" alt="Alumni Events" class="w-100 h-100" style="object-fit: cover; object-position: center;">
    </div>
    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="background: linear-gradient(135deg, rgba(0,58,70,0.9) 0%, rgba(0,95,107,0.8) 50%, rgba(0,170,204,0.6) 100%);">
    </div>
    <div class="container position-relative">
        <h1 class="display-4 fw-bold text-white mb-2" style="text-shadow: 0 2px 20px rgba(0,0,0,0.3);">
            {{ __('alumni.alumni_events') }}
        </h1>
        <p class="lead text-white" style="opacity: 0.9;">
            {{ app()->getLocale() === 'km' ? 'រក្សាទំនាក់ទំនងជាមួយមិត្តភេទចាស់' : 'Stay connected with fellow alumni' }}
        </p>
    </div>
</section>
    img.style.transform = 'scale(1) translate(0px, 0px)';
}
</script>

<!-- Featured Events -->
@if($featuredEvents->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="h3">{{ __('alumni.featured_events') }}</h2>
            <p class="text-muted">Don't miss these upcoming highlights</p>
        </div>
        
        <div class="row">
            @foreach($featuredEvents as $event)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="badge bg-primary me-2">
                                    {{ __('alumni.featured') }}
                                </div>
                                <small class="text-muted">
                                    {{ $event->start_datetime->format('M j, Y') }}
                                </small>
                            </div>
                            
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="bi bi-geo-alt"></i> {{ $event->location }}
                                </small>
                                <a href="{{ route('public.alumni-events.show', $event) }}" 
                                   class="btn btn-outline-primary btn-sm">
                                    {{ __('common.learn_more') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Filters and Search -->
<section class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ __('common.filter_events') }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('public.alumni-events.index') }}">
                            <!-- Search -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('common.search') }}</label>
                                <input type="text" name="search" class="form-control" 
                                       value="{{ request('search') }}" 
                                       placeholder="{{ __('alumni.search_events') }}">
                            </div>
                            
                            <!-- Status -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('alumni.event_status') }}</label>
                                <select name="status" class="form-select">
                                    <option value="">{{ __('common.all') }}</option>
                                    <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>
                                        {{ __('alumni.upcoming') }}
                                    </option>
                                    <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>
                                        {{ __('alumni.ongoing') }}
                                    </option>
                                    <option value="past" {{ request('status') == 'past' ? 'selected' : '' }}>
                                        {{ __('alumni.past') }}
                                    </option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="featured" value="1" 
                                           {{ request('featured') ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ __('alumni.featured_only') }}</label>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-funnel"></i> {{ __('common.filter') }}
                                </button>
                                <a href="{{ route('public.alumni-events.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle"></i> {{ __('common.clear') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-9">
                <!-- Results Count -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">
                        {{ $events->total() }} {{ __('alumni.events') }} Found
                    </h5>
                </div>
                
                @if($events->count() > 0)
                    <!-- Events List -->
                    <div class="row">
                        @foreach($events as $event)
                            <div class="col-lg-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm hover-lift">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="card-title">{{ $event->title }}</h5>
                                                <small class="text-muted">
                                                    <i class="bi bi-calendar3"></i> 
                                                    {{ $event->start_datetime->format('M j, Y g:i A') }}
                                                    @if($event->end_datetime)
                                                        - {{ $event->end_datetime->format('g:i A') }}
                                                    @endif
                                                </small>
                                            </div>
                                            
                                            @if($event->is_featured)
                                                <div class="badge bg-warning text-dark">
                                                    {{ __('alumni.featured') }}
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <p class="card-text">{{ Str::limit($event->description, 120) }}</p>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <small class="text-muted">
                                                    <i class="bi bi-geo-alt"></i> {{ $event->location }}
                                                </small>
                                                <br>
                                                <small class="text-muted">
                                                    <i class="bi bi-people"></i> 
                                                    {{ $event->max_attendees ?? __('alumni.unlimited') }} 
                                                    {{ __('alumni.attendees') }}
                                                </small>
                                            </div>
                                            
                                            <div class="text-end">
                                                @if($event->registration_status === 'open')
                                                    <span class="badge bg-success">
                                                        {{ __('alumni.registration_open') }}
                                                    </span>
                                                @elseif($event->registration_status === 'closed')
                                                    <span class="badge bg-danger">
                                                        {{ __('alumni.registration_closed') }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        {{ __('alumni.no_registration_required') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('public.alumni-events.show', $event) }}" 
                                               class="btn btn-primary btn-sm flex-fill">
                                                {{ __('common.view_details') }}
                                            </a>
                                            
                                            @if($event->registration_status === 'open')
                                                <button class="btn btn-outline-primary btn-sm" 
                                                        onclick="showRegistrationModal({{ $event->id }})">
                                                    <i class="bi bi-calendar-plus"></i> {{ __('alumni.register') }}
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $events->links() }}
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="bi bi-calendar-x fs-1 text-muted"></i>
                        <h5 class="mt-3">{{ __('alumni.no_events_found') }}</h5>
                        <p class="text-muted">{{ __('alumni.try_different_filters') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Registration Modal -->
<div class="modal fade" id="registrationModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('alumni.event_registration') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="registrationForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">{{ __('common.name') }} *</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('common.email') }} *</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('common.phone') }}</label>
                        <input type="tel" name="phone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('common.message') }}</label>
                        <textarea name="message" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('common.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary">
                        {{ __('alumni.submit_registration') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showRegistrationModal(eventId) {
    const modal = new bootstrap.Modal(document.getElementById('registrationModal'));
    const form = document.getElementById('registrationForm');
    form.action = `/alumni-events/${eventId}/register`;
    modal.show();
}
</script>
@endsection