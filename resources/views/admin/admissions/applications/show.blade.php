@extends('admin.layouts.app')

@section('title', 'Application Details')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <a href="{{ route('admin.admissions.applications') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i> Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Applicant Information</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Reference Number</label>
                            <p class="fw-bold"><code>{{ $application->reference_number }}</code></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Status</label>
                            <p><span class="badge {{ $application->status_badge_color }}">{{ ucfirst(str_replace('_', ' ', $application->status)) }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Full Name (EN)</label>
                            <p>{{ $application->full_name_en }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Full Name (KH)</label>
                            <p>{{ $application->full_name_kh }}</p>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Date of Birth</label>
                            <p>{{ $application->date_of_birth }}</p>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Gender</label>
                            <p>{{ ucfirst($application->gender) }}</p>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Nationality</label>
                            <p>{{ $application->nationality }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Email</label>
                            <p>{{ $application->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Phone</label>
                            <p>{{ $application->phone }}</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted">Address</label>
                            <p>{{ $application->address_en }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Academic Background</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Previous School</label>
                            <p>{{ $application->previous_school_en }}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-muted">Graduation Year</label>
                            <p>{{ $application->graduation_year }}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-muted">GPA</label>
                            <p>{{ $application->gpa ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Update Status</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.admissions.applications.status', $application->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="submitted" {{ $application->status == 'submitted' ? 'selected' : '' }}>Submitted</option>
                                <option value="under_review" {{ $application->status == 'under_review' ? 'selected' : '' }}>Under Review</option>
                                <option value="accepted" {{ $application->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="withdrawn" {{ $application->status == 'withdrawn' ? 'selected' : '' }}>Withdrawn</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" name="admin_notes" rows="3">{{ $application->admin_notes }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Status</button>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Status History</h5>
                </div>
                <div class="card-body">
                    @forelse($application->statusLogs as $log)
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="fw-bold">{{ ucfirst($log->status) }}</div>
                        <small class="text-muted">{{ $log->created_at->format('d M Y, h:i A') }}</small>
                        @if($log->notes)
                        <p class="mb-0 small">{{ $log->notes }}</p>
                        @endif
                        <small class="text-muted">By: {{ $log->changed_by }}</small>
                    </div>
                    @empty
                    <p class="text-muted">No history</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
