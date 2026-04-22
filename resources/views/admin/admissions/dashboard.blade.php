@extends('admin.layouts.app')

@section('title', 'Admissions Dashboard')

@push('styles')
<style>
    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border-left: 4px solid var(--brand-primary);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    .stat-card .number {
        font-size: 36px;
        font-weight: 700;
        color: var(--brand-primary);
    }
    
    .stat-card .label {
        font-size: 14px;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .stat-card.total { border-left-color: #003A46; }
    .stat-card.submitted { border-left-color: #006d77; }
    .stat-card.under_review { border-left-color: #f59e0b; }
    .stat-card.accepted { border-left-color: #10b981; }
    .stat-card.rejected { border-left-color: #ef4444; }
    
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .card-header {
        background: #fff;
        border-bottom: 1px solid #f0f0f0;
        border-radius: 12px 12px 0 0 !important;
    }
    
    .table-hover tbody tr:hover {
        background-color: #f8fafc;
    }
    
    .quick-link {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 15px;
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: var(--brand-primary);
        transition: all 0.2s;
    }
    
    .quick-link:hover {
        background: var(--brand-primary);
        color: #fff;
        border-color: var(--brand-primary);
    }
    
    .quick-link i {
        font-size: 20px;
    }
    
    :root {
        --brand-primary: #003A46;
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
            <div class="stat-card total">
                <div class="number">{{ $stats['total'] }}</div>
                <div class="label">Total</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card submitted">
                <div class="number text-info">{{ $stats['submitted'] }}</div>
                <div class="label">Submitted</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card under_review">
                <div class="number text-warning">{{ $stats['under_review'] }}</div>
                <div class="label">Under Review</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card accepted">
                <div class="number text-success">{{ $stats['accepted'] }}</div>
                <div class="label">Accepted</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card rejected">
                <div class="number text-danger">{{ $stats['rejected'] }}</div>
                <div class="label">Rejected</div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Applications</h5>
                    <a href="{{ route('admin.admissions.applications') }}" class="btn btn-sm btn-outline-primary">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentApplications as $app)
                                <tr>
                                    <td><code class="small">{{ $app->reference_number }}</code></td>
                                    <td>{{ $app->full_name_en }}</td>
                                    <td class="small">{{ $app->program->name_en ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ $app->status_badge_color }}">
                                            {{ ucfirst(str_replace('_', ' ', $app->status)) }}
                                        </span>
                                    </td>
                                    <td class="small">{{ $app->submitted_at ? $app->submitted_at->format('d M') : '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.admissions.applications.show', $app->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">No applications yet</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header py-3">
                    <h5 class="mb-0">Quick Links</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column gap-3">
                        <a href="{{ route('admin.admissions.applications') }}" class="quick-link">
                            <i class="bi bi-list-ul"></i>
                            <span>All Applications</span>
                        </a>
                        <a href="{{ route('admin.admissions.programs.index') }}" class="quick-link">
                            <i class="bi bi-book"></i>
                            <span>Manage Programs</span>
                        </a>
                        <a href="{{ route('admin.admissions.intakes.index') }}" class="quick-link">
                            <i class="bi bi-calendar"></i>
                            <span>Manage Intakes</span>
                        </a>
                        <a href="{{ route('admin.admissions.applications.export') }}" class="quick-link">
                            <i class="bi bi-download"></i>
                            <span>Export CSV</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection