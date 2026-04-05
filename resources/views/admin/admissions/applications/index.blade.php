@extends('admin.layouts.app')

@section('title', 'Applications')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 mb-0">Applications</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.admissions.applications.export') }}" class="btn btn-success">
                <i class="bi bi-download me-2"></i> Export CSV
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" class="row g-3 mb-4">
                <div class="col-md-3">
                    <select class="form-select" name="status">
                        <option value="all">All Status</option>
                        <option value="submitted">Submitted</option>
                        <option value="under_review">Under Review</option>
                        <option value="accepted">Accepted</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="program_id">
                        <option value="">All Programs</option>
                        @foreach($programs as $program)
                        <option value="{{ $program->id }}">{{ $program->name_en }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="search" placeholder="Search name, email, reference...">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>Reference</th>
                            <th>Name</th>
                            <th>Program</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $app)
                        <tr>
                            <td><code>{{ $app->reference_number }}</code></td>
                            <td>{{ $app->full_name_en }}</td>
                            <td>{{ $app->program->name_en ?? '-' }}</td>
                            <td>
                                <span class="badge {{ $app->status_badge_color }}">
                                    {{ ucfirst(str_replace('_', ' ', $app->status)) }}
                                </span>
                            </td>
                            <td>{{ $app->submitted_at ? $app->submitted_at->format('d M Y') : '-' }}</td>
                            <td>
                                <a href="{{ route('admin.admissions.applications.show', $app->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No applications found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $applications->links() }}
    </div>
</div>
@endsection
