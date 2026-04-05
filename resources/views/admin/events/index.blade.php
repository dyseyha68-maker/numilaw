@extends('admin.layouts.app')

@section('title', 'Events')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Events Management</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Create New Event
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>All Events</h5>
    </div>
    <div class="card-body">
        @if($events->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title (EN)</th>
                        <th>Type</th>
                        <th>Start Date</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->title_en }}</td>
                        <td>
                            <span class="badge bg-info">{{ ucfirst($event->type) }}</span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($event->start_datetime)->format('M d, Y H:i') }}</td>
                        <td>{{ $event->location }}</td>
                        <td>
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
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-outline-primary" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-outline-secondary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Delete" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $events->links() }}
        @else
        <p class="text-muted">No events found. Create your first event!</p>
        @endif
    </div>
</div>
@endsection
