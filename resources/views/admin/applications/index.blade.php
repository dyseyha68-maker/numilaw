@extends('admin.layouts.app')

@section('title', 'Applications')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Applications</h1>
    <a href="{{ route('admin.applications.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i> New Application
    </a>
</div>

<!-- Status Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">Total Applications</div>
                        <div class="h4 mb-0">{{ array_sum($statusCounts) }}</div>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-people text-primary fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">Pending</div>
                        <div class="h4 mb-0">{{ $statusCounts['pending'] ?? 0 }}</div>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-clock text-warning fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">Reviewing</div>
                        <div class="h4 mb-0">{{ $statusCounts['reviewing'] ?? 0 }}</div>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-eye text-info fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">Approved</div>
                        <div class="h4 mb-0">{{ $statusCounts['approved'] ?? 0 }}</div>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-check-circle text-success fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters and Search -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.applications.index') }}" class="row g-3">
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" placeholder="Search applications...">
                    <label for="search">Search by name, email or reference</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <select class="form-select" id="status" name="status">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="reviewing" {{ request('status') == 'reviewing' ? 'selected' : '' }}>Reviewing</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <label for="status">Status</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <select class="form-select" id="program_id" name="program_id">
                        <option value="">All Programs</option>
                        @php
                            $programs = \App\Models\AcademicProgram::active()->orderBy('title_en')->get();
                        @endphp
                        @foreach($programs as $program)
                            <option value="{{ $program->id }}" {{ request('program_id') == $program->id ? 'selected' : '' }}>
                                {{ $program->title_en }}
                            </option>
                        @endforeach
                    </select>
                    <label for="program_id">Program</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="btn-group w-100" role="group">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.applications.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Applications Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4">Reference</th>
                        <th>Applicant</th>
                        <th>Program</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Applied</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $application)
                        <tr>
                            <td class="px-4">
                                <span class="badge bg-secondary">{{ $application->application_reference }}</span>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $application->full_name }}</div>
                                <small class="text-muted">{{ $application->phone }}</small>
                            </td>
                            <td>{{ $application->program?->title_en ?? 'N/A' }}</td>
                            <td>{{ $application->email }}</td>
                            <td>
                                @switch($application->status)
                                    @case('pending')
                                        <span class="badge bg-warning">{{ $application->status_label }}</span>
                                        @break
                                    @case('reviewing')
                                        <span class="badge bg-info">{{ $application->status_label }}</span>
                                        @break
                                    @case('approved')
                                        <span class="badge bg-success">{{ $application->status_label }}</span>
                                        @break
                                    @case('rejected')
                                        <span class="badge bg-danger">{{ $application->status_label }}</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ $application->status }}</span>
                                @endswitch
                            </td>
                            <td>{{ $application->created_at->format('M d, Y') }}</td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.applications.edit', $application) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="{{ route('admin.applications.show', $application) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                No applications found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($applications->hasPages())
        <div class="card-footer bg-light">
            {{ $applications->links() }}
        </div>
    @endif
</div>
@endsection
