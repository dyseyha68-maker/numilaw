@extends('admin.layouts.app')

@section('title', 'Event Details')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Event Details</h5>
                <div>
                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h3>{{ $event->title_en }}</h3>
                        <h5 class="text-muted">{{ $event->title_km }}</h5>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Type:</strong> <span class="badge bg-info">{{ ucfirst($event->type) }}</span></p>
                        <p><strong>Status:</strong> 
                            @switch($event->status)
                                @case('upcoming')
                                    <span class="badge bg-primary">Upcoming</span>
                                    @break
                                @case('ongoing')
                                    <span class="badge bg-success">Ongoing</span>
                                    @break
                                @case('completed')
                                    <span class="badge bg-secondary">Completed</span>
                                    @break
                                @case('cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                    @break
                            @endswitch
                        </p>
                        <p><strong>Location:</strong> {{ $event->location }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Start:</strong> {{ \Carbon\Carbon::parse($event->start_datetime)->format('F d, Y H:i') }}</p>
                        <p><strong>End:</strong> {{ \Carbon\Carbon::parse($event->end_datetime)->format('F d, Y H:i') }}</p>
                        <p><strong>Max Participants:</strong> {{ $event->max_participants ?? 'Unlimited' }}</p>
                        <p><strong>Registration Required:</strong> {{ $event->is_registration_required ? 'Yes' : 'No' }}</p>
                        @if($event->registration_deadline)
                            <p><strong>Registration Deadline:</strong> {{ \Carbon\Carbon::parse($event->registration_deadline)->format('F d, Y H:i') }}</p>
                        @endif
                    </div>
                </div>

                @if($event->featured_image)
                <div class="row mb-3">
                    <div class="col-md-12">
                        <strong>Featured Image:</strong>
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $event->featured_image) }}" alt="Featured Image" style="max-width: 400px;" class="img-fluid">
                        </div>
                    </div>
                </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6>Description (English)</h6>
                        <p>{{ $event->description_en }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Description (Khmer)</h6>
                        <p>{{ $event->description_km }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <p class="text-muted">
                            <small>
                                Created: {{ $event->created_at->format('F d, Y H:i') }} | 
                                Updated: {{ $event->updated_at->format('F d, Y H:i') }}
                            </small>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this event?')">
                        <i class="bi bi-trash"></i> Delete Event
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
