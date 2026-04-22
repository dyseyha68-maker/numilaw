@extends('admin.layouts.app')

@section('title', 'Applications')

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .card-header {
        background: #fff;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .form-control, .form-select {
        border-radius: 8px;
        border-color: #e5e7eb;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--brand-primary);
        box-shadow: 0 0 0 3px rgba(0,58,70,0.1);
    }
    
    .btn-primary {
        background: var(--brand-primary);
        border-color: var(--brand-primary);
    }
    
    .btn-primary:hover {
        background: #004d5c;
        border-color: #004d5c;
    }
    
    .table thead th {
        background: #f8fafc;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6b7280;
    }
    
    .table tbody tr:hover {
        background-color: #f8fafc;
    }
    
    code {
        background: #f0f0f0;
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 12px;
    }
    
    :root {
        --brand-primary: #003A46;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Applications</h1>
            <a href="{{ route('admin.admissions.applications.export') }}" class="btn btn-success">
                <i class="bi bi-download me-2"></i> Export CSV
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="GET" class="row g-3 mb-4">
                <div class="col-md-3">
                    <select class="form-select" name="status">
                        <option value="all">All Status</option>
                        <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Submitted</option>
                        <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>Under Review</option>
                        <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="program_id">
                        <option value="">All Programs</option>
                        @foreach($programs as $program)
                        <option value="{{ $program->id }}" {{ request('program_id') == $program->id ? 'selected' : '' }}>{{ $program->name_en }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="search" placeholder="Search name, email, reference..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i> Filter
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="120">Reference</th>
                            <th>Name</th>
                            <th>Program</th>
                            <th>Status</th>
                            <th width="100">Submitted</th>
                            <th width="80">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $app)
                        <tr>
                            <td><code>{{ $app->reference_number }}</code></td>
                            <td>
                                <div class="fw-medium">{{ $app->full_name_en }}</div>
                                <div class="small text-muted">{{ $app->email }}</div>
                            </td>
                            <td>{{ $app->program->name_en ?? '-' }}</td>
                            <td>
                                <span class="badge {{ $app->status_badge_color }}">
                                    {{ ucfirst(str_replace('_', ' ', $app->status)) }}
                                </span>
                            </td>
                            <td class="small">{{ $app->submitted_at ? $app->submitted_at->format('d M Y') : '-' }}</td>
                            <td>
                                <a href="{{ route('admin.admissions.applications.show', $app->id) }}" class="btn btn-sm btn-outline-primary" title="View">
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
        {{ $applications->withQueryString()->links() }}
    </div>
</div>
@endsection