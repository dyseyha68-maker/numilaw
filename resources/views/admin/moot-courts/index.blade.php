@extends('admin.layouts.app')

@section('title', 'Moot Courts')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Moot Courts Management</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.moot-courts.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Create New Moot Court
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>All Moot Courts</h5>
    </div>
    <div class="card-body">
        @if($mootCourts->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title (EN)</th>
                        <th>Competition Date</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mootCourts as $mootCourt)
                    <tr>
                        <td>{{ $mootCourt->id }}</td>
                        <td>{{ $mootCourt->title_en }}</td>
                        <td>{{ $mootCourt->competition_date ? \Carbon\Carbon::parse($mootCourt->competition_date)->format('M d, Y') : '-' }}</td>
                        <td>{{ $mootCourt->location }}</td>
                        <td>
                            @switch($mootCourt->status)
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
                                <a href="{{ route('admin.moot-courts.show', $mootCourt->id) }}" class="btn btn-outline-primary" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.moot-courts.edit', $mootCourt->id) }}" class="btn btn-outline-secondary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.moot-courts.destroy', $mootCourt->id) }}" method="POST" class="d-inline">
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
        {{ $mootCourts->links() }}
        @else
        <p class="text-muted">No moot courts found. Create your first moot court!</p>
        @endif
    </div>
</div>
@endsection
