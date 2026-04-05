@extends('admin.layouts.app')

@section('title', 'Academic Calendar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Academic Calendar</h1>
    <a href="{{ route('admin.academic-calendar.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> New Event
    </a>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.academic-calendar.index') }}">
            <div class="row g-3">
                <div class="col-md-3">
                    <label for="event_type" class="form-label">Event Type</label>
                    <select name="event_type" id="event_type" class="form-select">
                        <option value="">All Types</option>
                        @foreach($eventTypes as $key => $label)
                            <option value="{{ $key }}" {{ request('event_type') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="program_id" class="form-label">Program</label>
                    <select name="program_id" id="program_id" class="form-select">
                        <option value="">All Programs</option>
                        @foreach($programs as $program)
                            <option value="{{ $program->id }}" {{ request('program_id') == $program->id ? 'selected' : '' }}>
                                {{ $program->title_en }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="month" class="form-label">Month</label>
                    <select name="month" id="month" class="form-select">
                        <option value="">All Months</option>
                        @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $month)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="year" class="form-label">Year</label>
                    <select name="year" id="year" class="form-select">
                        <option value="">All Years</option>
                        @foreach(range(date('Y') - 2, date('Y') + 2) as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-funnel"></i> Filter Events
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Events Table -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Event</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Audience</th>
                        <th>Location</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                        <tr>
                            <td>
                                <div>
                                    <strong>{{ Str::limit($event->title_en, 40) }}</strong>
                                    @if($event->is_recurring)
                                        <br><small class="text-muted"><i class="bi bi-arrow-repeat"></i> Recurring</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <?php $evtColor = $event->color_code ?: '#007bff'; ?>
                                <span class="badge" style="background-color: {{ $evtColor }};">
                                    {{ $eventTypes[$event->event_type] ?? $event->event_type }}
                                </span>
                            </td>
                            <td>
                                <div>
                                    {{ $event->start_date->format('M j, Y') }}
                                    @if($event->end_date && $event->end_date->format('Y-m-d') !== $event->start_date->format('Y-m-d'))
                                        <br><small class="text-muted">to {{ $event->end_date->format('M j, Y') }}</small>
                                    @endif
                                    @if($event->is_all_day)
                                        <br><small class="text-muted"><i class="bi bi-clock"></i> All day</small>
                                    @elseif($event->start_time)
                                        <br><small class="text-muted"><i class="bi bi-clock"></i> {{ $event->start_time->format('g:i A') }}</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ ucfirst($event->audience) }}
                                </span>
                            </td>
                            <td>
                                @if($event->location)
                                    <small>{{ Str::limit($event->location, 25) }}</small>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($event->is_active)
                                    <span class="badge bg-success"><i class="bi bi-check-circle"></i></span>
                                @else
                                    <span class="badge bg-secondary"><i class="bi bi-x-circle"></i></span>
                                @endif
                            </td>
                            <td class="text-center" style="vertical-align: middle;">
                                <div class="d-flex gap-1 justify-content-center">
                                    <a href="{{ route('admin.academic-calendar.show', $event) }}" 
                                       class="btn btn-sm btn-outline-primary" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.academic-calendar.edit', $event) }}" 
                                       class="btn btn-sm btn-outline-secondary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.academic-calendar.destroy', $event) }}" 
                                          class="d-inline" onsubmit="return confirm('Are you sure you want to delete this event?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                <i class="bi bi-calendar"></i> No events found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">
                Showing {{ $events->firstItem() }} to {{ $events->lastItem() }} of {{ $events->total() }} entries
            </small>
            {{ $events->links() }}
        </div>
    </div>
</div>
@endsection