@extends('admin.layouts.app')

@section('title', 'Application Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Application Details</h1>
        <span class="badge bg-secondary">{{ $application->application_reference }}</span>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.applications.edit', $application) }}" class="btn btn-outline-primary">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <a href="{{ route('admin.applications.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Main Information -->
    <div class="col-lg-8">
        <!-- Personal Information -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-person me-2"></i>Personal Information</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="text-muted small">Full Name (English)</label>
                        <p class="mb-0 fw-semibold">{{ $application->full_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Full Name (Khmer)</label>
                        <p class="mb-0">{{ $application->first_name_km }} {{ $application->last_name_km }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Email</label>
                        <p class="mb-0">{{ $application->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Phone</label>
                        <p class="mb-0">{{ $application->phone }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Date of Birth</label>
                        <p class="mb-0">{{ $application->date_of_birth->format('F d, Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Nationality</label>
                        <p class="mb-0">{{ $application->nationality }}</p>
                    </div>
                    <div class="col-12">
                        <label class="text-muted small">Address</label>
                        <p class="mb-0">{{ $application->address }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Educational Information -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-mortarboard me-2"></i>Educational Information</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="text-muted small">High School</label>
                        <p class="mb-0 fw-semibold">{{ $application->high_school }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Graduation Year</label>
                        <p class="mb-0">{{ $application->graduation_year }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">GPA</label>
                        <p class="mb-0">
                            <span class="badge bg-primary">{{ $application->gpa }} / 4.0</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">English Level</label>
                        <p class="mb-0">{{ $application->english_level_label }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-file-text me-2"></i>Additional Information</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <label class="text-muted small">Motivation Letter</label>
                    <p class="mb-0 bg-light p-3 rounded">{{ $application->motivation_letter }}</p>
                </div>
                @if($application->experience)
                    <div class="mb-4">
                        <label class="text-muted small">Work Experience</label>
                        <p class="mb-0 bg-light p-3 rounded">{{ $application->experience }}</p>
                    </div>
                @endif
                @if($application->achievements)
                    <div>
                        <label class="text-muted small">Achievements or Awards</label>
                        <p class="mb-0 bg-light p-3 rounded">{{ $application->achievements }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Reference Information -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>Reference Information</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="text-muted small">Name</label>
                        <p class="mb-0 fw-semibold">{{ $application->reference_name }}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small">Email</label>
                        <p class="mb-0">{{ $application->reference_email }}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small">Phone</label>
                        <p class="mb-0">{{ $application->reference_phone }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Application Status -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-clipboard-check me-2"></i>Application Status</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.applications.update-status', $application) }}">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-3">
                        <label class="form-label">Current Status</label>
                        <div>
                            @switch($application->status)
                                @case('pending')
                                    <span class="badge bg-warning fs-6">{{ $application->status_label }}</span>
                                    @break
                                @case('reviewing')
                                    <span class="badge bg-info fs-6">{{ $application->status_label }}</span>
                                    @break
                                @case('approved')
                                    <span class="badge bg-success fs-6">{{ $application->status_label }}</span>
                                    @break
                                @case('rejected')
                                    <span class="badge bg-danger fs-6">{{ $application->status_label }}</span>
                                    @break
                            @endswitch
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Update Status</label>
                        <select name="status" class="form-select">
                            <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="reviewing" {{ $application->status == 'reviewing' ? 'selected' : '' }}>Reviewing</option>
                            <option value="approved" {{ $application->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Admin Notes</label>
                        <textarea name="admin_notes" class="form-control" rows="3" placeholder="Add notes about this application...">{{ $application->admin_notes }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-check2-circle me-2"></i>Update Status
                    </button>
                </form>
            </div>
        </div>

        <!-- Application Details -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Application Details</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="text-muted small">Program Applied</label>
                    <p class="mb-0 fw-semibold">{{ $application->program?->title_en ?? 'N/A' }}</p>
                </div>
                <div class="mb-3">
                    <label class="text-muted small">Applied On</label>
                    <p class="mb-0">{{ $application->created_at->format('F d, Y g:i A') }}</p>
                </div>
                @if($application->reviewed_at)
                    <div class="mb-3">
                        <label class="text-muted small">Last Reviewed</label>
                        <p class="mb-0">{{ $application->reviewed_at->format('F d, Y g:i A') }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.applications.destroy', $application) }}" 
                      onsubmit="return confirm('Are you sure you want to delete this application? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100">
                        <i class="bi bi-trash me-2"></i>Delete Application
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
