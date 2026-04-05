@extends('admin.layouts.app')

@section('title', 'Alumni Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-1">Alumni Dashboard</h1>
                <p class="text-muted mb-0">Overview of alumni network and statistics</p>
            </div>
            <div class="btn-group" role="group">
                <a href="{{ route('admin.alumni.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-list"></i> Alumni Directory
                </a>
                <a href="{{ route('admin.alumni.export') }}" class="btn btn-outline-success">
                    <i class="bi bi-download"></i> Export Data
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Total Alumni</p>
                        <h2 class="mb-0">{{ number_format($totalAlumni) }}</h2>
                    </div>
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                        <i class="bi bi-people text-primary fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="text-muted small">All registered alumni</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Approved</p>
                        <h2 class="mb-0">{{ number_format($approvedAlumni) }}</h2>
                    </div>
                    <div class="rounded-circle bg-success bg-opacity-10 p-3">
                        <i class="bi bi-check-circle text-success fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="text-muted small">{{ $totalAlumni > 0 ? round(($approvedAlumni / $totalAlumni) * 100) : 0 }}% of total</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Pending</p>
                        <h2 class="mb-0">{{ number_format($pendingAlumni) }}</h2>
                    </div>
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                        <i class="bi bi-clock text-warning fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="text-muted small">Awaiting approval</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Verified</p>
                        <h2 class="mb-0">{{ number_format($verifiedAlumni) }}</h2>
                    </div>
                    <div class="rounded-circle bg-info bg-opacity-10 p-3">
                        <i class="bi bi-patch-check text-info fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="text-muted small">{{ $totalAlumni > 0 ? round(($verifiedAlumni / $totalAlumni) * 100) : 0 }}% verified</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-3">Quick Actions</h5>
                <div class="row g-3">
                    <div class="col-md-3">
                        <a href="{{ route('admin.alumni.create') }}" class="btn btn-outline-primary w-100 py-3">
                            <i class="bi bi-person-plus fs-5 d-block mb-2"></i>
                            Add New Alumni
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.alumni.testimonials.index') }}" class="btn btn-outline-success w-100 py-3">
                            <i class="bi bi-chat-quote fs-5 d-block mb-2"></i>
                            Manage Testimonials
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.alumni.events.index') }}" class="btn btn-outline-warning w-100 py-3">
                            <i class="bi bi-calendar-event fs-5 d-block mb-2"></i>
                            Alumni Events
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.alumni.job-postings.index') }}" class="btn btn-outline-info w-100 py-3">
                            <i class="bi bi-briefcase fs-5 d-block mb-2"></i>
                            Job Postings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Registrations -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-person-plus text-primary me-2"></i>Recent Alumni</h5>
                    <a href="{{ route('admin.alumni.index') }}" class="btn btn-sm btn-outline-primary">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                @if($recentRegistrations->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentRegistrations as $alumni)
                            <div class="list-group-item border-0 py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        @if($alumni->profile_image_url)
                                            <img src="{{ $alumni->profile_image_url }}" 
                                                 alt="{{ $alumni->full_name }}" 
                                                 class="rounded-circle me-3" 
                                                 width="45" height="45" style="object-fit: cover;">
                                        @else
                                            <div class="rounded-circle bg-secondary bg-opacity-10 me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                                <i class="bi bi-person text-secondary"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ $alumni->full_name }}</h6>
                                            <small class="text-muted">{{ $alumni->program->title ?? 'No Program' }} • Class of {{ $alumni->graduation_year }}</small>
                                        </div>
                                    </div>
                                    <span class="badge bg-{{ $alumni->status === 'approved' ? 'success' : ($alumni->status === 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($alumni->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-people fs-1 d-block mb-2 opacity-50"></i>
                        <p class="mb-0">No alumni registered yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Alumni by Industry -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0"><i class="bi bi-briefcase text-info me-2"></i>Top Industries</h5>
            </div>
            <div class="card-body">
                @if($alumniByIndustry->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($alumniByIndustry->take(6) as $index => $industry)
                            <div class="list-group-item border-0 py-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="rounded-circle bg-opacity-10 d-flex align-items-center justify-content-center me-3" 
                                              style="width: 32px; height: 32px; background-color: var(--bs-primary);">
                                            <span class="text-white small">{{ $index + 1 }}</span>
                                        </span>
                                        <span>{{ $industry->industry }}</span>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">{{ $industry->count }}</span>
                                </div>
                                <div class="progress mt-2" style="height: 6px;">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: {{ ($industry->count / $alumniByIndustry->max('count')) * 100 }}%">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-briefcase fs-1 d-block mb-2 opacity-50"></i>
                        <p class="mb-0">No industry data available</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Alumni by Year -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0"><i class="bi bi-calendar3 text-success me-2"></i>Alumni by Graduation Year</h5>
            </div>
            <div class="card-body">
                @if($alumniByYear->count() > 0)
                    <canvas id="alumniByYearChart" height="200"></canvas>
                @else
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-graph-up fs-1 d-block mb-2 opacity-50"></i>
                        <p class="mb-0">No data available</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Alumni by Program -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0"><i class="bi bi-mortarboard text-warning me-2"></i>Alumni by Program</h5>
            </div>
            <div class="card-body">
                @if($alumniByProgram->count() > 0)
                    <canvas id="alumniByProgramChart" height="200"></canvas>
                @else
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-pie-chart fs-1 d-block mb-2 opacity-50"></i>
                        <p class="mb-0">No program data available</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Alumni by Year Chart
@if($alumniByYear->count() > 0)
const yearCtx = document.getElementById('alumniByYearChart').getContext('2d');
new Chart(yearCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($alumniByYear->pluck('graduation_year')->toArray()) !!},
        datasets: [{
            label: 'Alumni',
            data: {!! json_encode($alumniByYear->pluck('count')->toArray()) !!},
            backgroundColor: 'rgba(13, 110, 253, 0.8)',
            borderRadius: 6,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 }
            }
        }
    }
});
@endif

// Alumni by Program Chart
@if($alumniByProgram->count() > 0)
const programCtx = document.getElementById('alumniByProgramChart').getContext('2d');
new Chart(programCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($alumniByProgram->pluck('program.title')->toArray()) !!},
        datasets: [{
            data: {!! json_encode($alumniByProgram->pluck('count')->toArray()) !!},
            backgroundColor: [
                'rgba(13, 110, 253, 0.8)',
                'rgba(25, 135, 84, 0.8)',
                'rgba(255, 193, 7, 0.8)',
                'rgba(13, 202, 240, 0.8)',
                'rgba(108, 117, 125, 0.8)',
                'rgba(220, 53, 69, 0.8)'
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
@endif
</script>
@endpush
@endsection
