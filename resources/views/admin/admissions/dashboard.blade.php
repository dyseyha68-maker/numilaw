@extends('admin.layouts.app')

@section('title', 'Admissions Dashboard')

@push('styles')
<style>
    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .stat-card .number {
        font-size: 36px;
        font-weight: 700;
        color: #003A46;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 mb-0">Admissions Dashboard</h1>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-2">
            <div class="stat-card">
                <div class="number">{{ $stats['total'] }}</div>
                <div class="text-muted">Total</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card">
                <div class="number text-info">{{ $stats['submitted'] }}</div>
                <div class="text-muted">Submitted</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card">
                <div class="number text-warning">{{ $stats['under_review'] }}</div>
                <div class="text-muted">Under Review</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card">
                <div class="number text-success">{{ $stats['accepted'] }}</div>
                <div class="text-muted">Accepted</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card">
                <div class="number text-danger">{{ $stats['rejected'] }}</div>
                <div class="text-muted">Rejected</div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Recent Applications</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Reference</th>
                                    <th>Name</th>
                                    <th>Program</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentApplications as $app)
                                <tr>
                                    <td><code>{{ $app->reference_number }}</code></td>
                                    <td>{{ $app->full_name_en }}</td>
                                    <td>{{ $app->program->name_en ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ $app->status_badge_color }}">
                                            {{ ucfirst(str_replace('_', ' ', $app->status)) }}
                                        </span>
                                    </td>
                                    <td>{{ $app->submitted_at ? $app->submitted_at->format('d M') : '-' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No applications yet</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Quick Links</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.admissions.applications') }}" class="btn btn-outline-primary text-start">
                            <i class="bi bi-list-ul me-2"></i> All Applications
                        </a>
                        <a href="{{ route('admin.admissions.programs.index') }}" class="btn btn-outline-success text-start">
                            <i class="bi bi-book me-2"></i> Manage Programs
                        </a>
                        <a href="{{ route('admin.admissions.intakes.index') }}" class="btn btn-outline-warning text-start">
                            <i class="bi bi-calendar me-2"></i> Manage Intakes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
