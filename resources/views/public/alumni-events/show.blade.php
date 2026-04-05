@extends('layouts.public')

@section('title', $event->title)

@section('content')
<!-- Event Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-white">{{ __('common.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('public.alumni.index') }}" class="text-white">
                                {{ __('alumni.alumni') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('public.alumni-events.index') }}" class="text-white">
                                {{ __('alumni.events') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-white" aria-current="page">
                            {{ $event->title }}
                        </li>
                    </ol>
                </nav>
                
                <h1 class="display-5 fw-bold mb-3">{{ $event->title }}</h1>
                <div class="d-flex flex-wrap gap-3 align-items-center">
                    @if($event->is_featured)
                        <span class="badge bg-warning text-dark fs-6">
                            <i class="bi bi-star"></i> {{ __('alumni.featured') }}
                        </span>
                    @endif
                    
                    <div class="d-flex align-items-center">
                        <i class="bi bi-calendar3 me-2"></i>
                        <span>{{ $event->start_datetime->format('F j, Y') }}</span>
                    </div>
                    
                    <div class="d-flex align-items-center">
                        <i class="bi bi-clock me-2"></i>
                        <span>{{ $event->start_datetime->format('g:i A') }}
                        @if($event->end_datetime)
                            - {{ $event->end_datetime->format('g:i A') }}
                        @endif</span>
                    </div>
                    
                    <div class="d-flex align-items-center">
                        <i class="bi bi-geo-alt me-2"></i>
                        <span>{{ $event->location }}</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 text-center">
                <div class="bg-white bg-opacity-10 rounded-3 p-4">
                    @if($event->registration_status === 'open')
                        <h5 class="text-white mb-3">{{ __('alumni.registration_open') }}</h5>
                        <button class="btn btn-light btn-lg w-100" onclick="showRegistrationModal()">
                            <i class="bi bi-calendar-plus"></i> {{ __('alumni.register_now') }}
                        </button>
                    @elseif($event->registration_status === 'closed')
                        <h5 class="text-white mb-3">{{ __('alumni.registration_closed') }}</h5>
                        <button class="btn btn-outline-light btn-lg w-100" disabled>
                            <i class="bi bi-x-circle"></i> {{ __('alumni.registration_closed') }}
                        </button>
                    @else
                        <h5 class="text-white mb-3">{{ __('alumni.no_registration_required') }}</h5>
                        <button class="btn btn-outline-light btn-lg w-100">
                            <i class="bi bi-info-circle"></i> {{ __('alumni.free_event') }}
                        </button>
                    @endif
                    
                    <div class="mt-3">
                        <small class="text-white opacity-75">
                            @if($event->max_attendees)
                                {{ __('alumni.limited_seats') }}: {{ $event->max_attendees }}
                            @else
                                {{ __('alumni.unlimited_seats') }}
                            @endif
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Event Details -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Description -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="h4 mb-3">{{ __('alumni.about_event') }}</h3>
                        <div class="content">
                            {!! nl2br(e($event->description)) !!}
                        </div>
                    </div>
                </div>
                
                <!-- Event Details Grid -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="h5 mb-3">
                                    <i class="bi bi-calendar-check text-primary"></i> 
                                    {{ __('alumni.event_details') }}
                                </h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <strong>{{ __('alumni.date') }}:</strong> 
                                        {{ $event->start_datetime->format('l, F j, Y') }}
                                    </li>
                                    <li class="mb-2">
                                        <strong>{{ __('alumni.time') }}:</strong> 
                                        {{ $event->start_datetime->format('g:i A') }}
                                        @if($event->end_datetime)
                                            - {{ $event->end_datetime->format('g:i A') }}
                                        @endif
                                    </li>
                                    <li class="mb-2">
                                        <strong>{{ __('alumni.location') }}:</strong> 
                                        {{ $event->location }}
                                    </li>
                                    @if($event->max_attendees)
                                    <li class="mb-2">
                                        <strong>{{ __('alumni.max_attendees') }}:</strong> 
                                        {{ $event->max_attendees }}
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="h5 mb-3">
                                    <i class="bi bi-info-circle text-primary"></i> 
                                    {{ __('alumni.additional_info') }}
                                </h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <strong>{{ __('alumni.organizer') }}:</strong> 
                                        {{ $event->organizer?->name ?? __('alumni.numilaw_alumni') }}
                                    </li>
                                    <li class="mb-2">
                                        <strong>{{ __('alumni.registration_status') }}:</strong> 
                                        @if($event->registration_status === 'open')
                                            <span class="badge bg-success">{{ __('alumni.open') }}</span>
                                        @elseif($event->registration_status === 'closed')
                                            <span class="badge bg-danger">{{ __('alumni.closed') }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ __('alumni.not_required') }}</span>
                                        @endif
                                    </li>
                                    <li class="mb-2">
                                        <strong>{{ __('alumni.event_type') }}:</strong> 
                                        {{ __('alumni.alumni_exclusive') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Map Placeholder -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="h5 mb-3">
                            <i class="bi bi-map text-primary"></i> {{ __('alumni.event_location') }}
                        </h5>
                        <div class="bg-light rounded-3 p-4 text-center">
                            <i class="bi bi-geo-alt fs-1 text-muted"></i>
                            <p class="mt-3 mb-0">{{ $event->location }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <!-- Quick Actions -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="h5 mb-3">{{ __('alumni.quick_actions') }}</h5>
                        <div class="d-grid gap-2">
                            @if($event->registration_status === 'open')
                                <button class="btn btn-primary" onclick="showRegistrationModal()">
                                    <i class="bi bi-calendar-plus"></i> {{ __('alumni.register_now') }}
                                </button>
                            @endif
                            
                            <button class="btn btn-outline-primary" onclick="shareEvent()">
                                <i class="bi bi-share"></i> {{ __('alumni.share_event') }}
                            </button>
                            
                            <button class="btn btn-outline-secondary" onclick="addToCalendar()">
                                <i class="bi bi-calendar-plus"></i> {{ __('alumni.add_to_calendar') }}
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Organizer Info -->
                @if($event->organizer)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body text-center">
                        <h5 class="h5 mb-3">{{ __('alumni.event_organizer') }}</h5>
                        <div class="mb-3">
                            <i class="bi bi-person-circle fs-1 text-muted"></i>
                        </div>
                        <h6>{{ $event->organizer->name }}</h6>
                        <p class="text-muted small">{{ $event->organizer->email }}</p>
                    </div>
                </div>
                @endif
                
                <!-- Contact Info -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="h5 mb-3">{{ __('alumni.need_help') }}</h5>
                        <p class="text-muted small mb-3">
                            {{ __('alumni.contact_questions') }}
                        </p>
                        <div class="d-grid gap-2">
                            <a href="mailto:alumni@numilaw.edu" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-envelope"></i> alumni@numilaw.edu
                            </a>
                            <a href="tel:+85512345678" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-telephone"></i> +855 12 345 678
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Related Events -->
        @if($relatedEvents->count() > 0)
        <div class="mt-5">
            <h3 class="h4 mb-4">{{ __('alumni.related_events') }}</h3>
            <div class="row">
                @foreach($relatedEvents as $relatedEvent)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="card-title">{{ $relatedEvent->title }}</h6>
                                <p class="card-text small text-muted">
                                    <i class="bi bi-calendar3"></i> 
                                    {{ $relatedEvent->start_datetime->format('M j, Y g:i A') }}
                                </p>
                                <a href="{{ route('public.alumni-events.show', $relatedEvent) }}" 
                                   class="btn btn-outline-primary btn-sm">
                                    {{ __('common.view_details') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
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
            <form action="{{ route('public.alumni-events.register', $event) }}" method="POST">
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
function showRegistrationModal() {
    const modal = new bootstrap.Modal(document.getElementById('registrationModal'));
    modal.show();
}

function shareEvent() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $event->title }}',
            text: '{{ Str::limit($event->description, 100) }}',
            url: window.location.href
        });
    } else {
        // Fallback: Copy to clipboard
        navigator.clipboard.writeText(window.location.href);
        alert('Event link copied to clipboard!');
    }
}

function addToCalendar() {
    // Generate Google Calendar link
    const startDate = '{{ $event->start_datetime->format("Ymd\\THis\\Z") }}';
    const endDate = '{{ $event->end_datetime ? $event->end_datetime->format("Ymd\\THis\\Z") : $event->start_datetime->addHours(1)->format("Ymd\\THis\\Z") }}';
    const title = encodeURIComponent('{{ $event->title }}');
    const description = encodeURIComponent('{{ Str::limit($event->description, 200) }}');
    const location = encodeURIComponent('{{ $event->location }}');
    
    const calendarUrl = `https://calendar.google.com/calendar/render?action=TEMPLATE&dates=${startDate}/${endDate}&text=${title}&details=${description}&location=${location}`;
    
    window.open(calendarUrl, '_blank');
}
</script>
@endsection