@extends('admin.layouts.app')

@section('title', __('alumni.alumni_directory'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">{{ __('alumni.alumni_directory') }}</h1>
    <div class="btn-group" role="group">
        <a href="{{ route('admin.alumni.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-speedometer2"></i> {{ __('alumni.dashboard') }}
        </a>
        <a href="{{ route('admin.alumni.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Alumni
        </a>
        <a href="{{ route('admin.alumni.export') }}" class="btn btn-outline-success">
            <i class="bi bi-download"></i> {{ __('alumni.export') }}
        </a>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-2">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title text-primary">{{ $stats['total'] }}</h5>
                <p class="card-text small">{{ __('alumni.total_alumni') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title text-success">{{ $stats['approved'] }}</h5>
                <p class="card-text small">{{ __('alumni.approved') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title text-warning">{{ $stats['pending'] }}</h5>
                <p class="card-text small">{{ __('alumni.pending_approval') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title text-danger">{{ $stats['rejected'] }}</h5>
                <p class="card-text small">{{ __('alumni.rejected') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title text-info">{{ $stats['featured'] }}</h5>
                <p class="card-text small">{{ __('alumni.featured') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title text-secondary">{{ $stats['verified'] }}</h5>
                <p class="card-text small">{{ __('alumni.verified') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title mb-0">{{ __('alumni.filter_by') }}</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.alumni.index') }}">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">{{ __('alumni.search_alumni') }}</label>
                    <input type="text" name="search" class="form-control" 
                           value="{{ request('search') }}" placeholder="{{ __('alumni.search_alumni') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">{{ __('alumni.status') }}</label>
                    <select name="status" class="form-select">
                        <option value="">{{ __('common.all') }}</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>{{ __('alumni.approved') }}</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ __('alumni.pending_approval') }}</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>{{ __('alumni.rejected') }}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">{{ __('alumni.program') }}</label>
                    <select name="program_id" class="form-select">
                        <option value="">{{ __('alumni.all_programs') }}</option>
                        @foreach($programs as $program)
                            <option value="{{ $program->id }}" {{ request('program_id') == $program->id ? 'selected' : '' }}>
                                {{ $program->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">{{ __('alumni.graduation_year') }}</label>
                    <select name="graduation_year" class="form-select">
                        <option value="">{{ __('alumni.all_years') }}</option>
                        @foreach($graduationYears as $year)
                            <option value="{{ $year }}" {{ request('graduation_year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">{{ __('alumni.industry') }}</label>
                    <select name="industry" class="form-select">
                        <option value="">{{ __('alumni.all_industries') }}</option>
                        @foreach($industries as $industry)
                            <option value="{{ $industry }}" {{ request('industry') == $industry ? 'selected' : '' }}>
                                {{ $industry }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="featured" value="1" 
                               {{ request('featured') ? 'checked' : '' }}>
                        <label class="form-check-label">{{ __('alumni.featured_only') }}</label>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-funnel"></i> {{ __('common.filter') }}
                    </button>
                    <a href="{{ route('admin.alumni.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> {{ __('common.clear') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Alumni Table -->
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            {{ $alumni->total() }} {{ __('alumni.alumni') }} Found
        </h5>
    </div>
    <div class="card-body">
        @if($alumni->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>{{ __('common.photo') }}</th>
                            <th>{{ __('common.name') }}</th>
                            <th>{{ __('alumni.program') }}</th>
                            <th>{{ __('alumni.graduation_year') }}</th>
                            <th>{{ __('alumni.current_job_title') }}</th>
                            <th>{{ __('alumni.company') }}</th>
                            <th>{{ __('alumni.status') }}</th>
                            <th>{{ __('common.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumni as $alumnus)
                            <tr>
                                <td>
                                    <img src="{{ $alumnus->profile_image_url }}" 
                                         alt="{{ $alumnus->full_name }}" 
                                         class="rounded-circle" 
                                         width="40" height="40">
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $alumnus->full_name }}</strong>
                                        @if($alumnus->is_featured)
                                            <i class="bi bi-star-fill text-warning" title="Featured"></i>
                                        @endif
                                        @if($alumnus->is_verified)
                                            <i class="bi bi-patch-check-fill text-success" title="Verified"></i>
                                        @endif
                                    </div>
                                    <small class="text-muted">{{ $alumnus->email }}</small>
                                </td>
                                <td>{{ $alumnus->program ? $alumnus->program->title : 'N/A' }}</td>
                                <td>{{ $alumnus->graduation_year }}</td>
                                <td>{{ $alumnus->current_job_title ?: 'N/A' }}</td>
                                <td>{{ $alumnus->company ?: 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-{{ $alumnus->status === 'approved' ? 'success' : ($alumnus->status === 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($alumnus->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.alumni.show', $alumnus) }}" 
                                           class="btn btn-outline-primary" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.alumni.edit', $alumnus) }}" 
                                           class="btn btn-outline-secondary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        
                                        @if($alumnus->status === 'pending')
                                            <form action="{{ route('admin.alumni.approve', $alumnus) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-success" title="Approve"
                                                        onclick="return confirm('Approve this alumni?')">
                                                    <i class="bi bi-check-circle"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.alumni.reject', $alumnus) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger" title="Reject"
                                                        onclick="return confirm('Reject this alumni?')">
                                                    <i class="bi bi-x-circle"></i>
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if($alumnus->status === 'approved')
                                            <form action="{{ route('admin.alumni.toggle-featured', $alumnus) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-warning" title="Toggle Featured">
                                                    <i class="bi bi-{{ $alumnus->is_featured ? 'star-fill' : 'star' }}"></i>
                                                </button>
                                            </form>
                                            
                                            @if(!$alumnus->is_verified)
                                                <form action="{{ route('admin.alumni.verify', $alumnus) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-info" title="Verify"
                                                            onclick="return confirm('Verify this alumni?')">
                                                        <i class="bi bi-patch-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Showing {{ $alumni->firstItem() }} to {{ $alumni->lastItem() }} of {{ $alumni->total() }} entries
                </div>
                {{ $alumni->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-people fs-1 text-muted d-block mb-3"></i>
                <h5>{{ __('alumni.no_alumni_found') }}</h5>
                <p class="text-muted">No alumni match your current filters.</p>
                <a href="{{ route('admin.alumni.index') }}" class="btn btn-primary">
                    <i class="bi bi-arrow-clockwise"></i> {{ __('common.clear_filters') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection