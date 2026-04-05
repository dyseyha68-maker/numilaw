@extends('layouts.public')

@section('title', __('alumni.job_board'))

@php
$heroImageUrl = $heroImage ? asset($heroImage) : 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=1200&q=80';
@endphp

@section('content')
<!-- Hero Section -->
<section class="position-relative d-flex align-items-center" style="min-height: 50vh; overflow: hidden;">
    <div class="position-absolute top-0 start-0 w-100 h-100">
        <img src="{{ $heroImageUrl }}" alt="Job Board" class="w-100 h-100" style="object-fit: cover; object-position: center;">
    </div>
    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="background: linear-gradient(135deg, rgba(0,58,70,0.9) 0%, rgba(0,95,107,0.8) 50%, rgba(0,170,204,0.6) 100%);">
    </div>
    <div class="container position-relative">
        <h1 class="display-4 fw-bold text-white mb-2" style="text-shadow: 0 2px 20px rgba(0,0,0,0.3);">
            {{ __('alumni.job_board') }}
        </h1>
        <p class="lead text-white" style="opacity: 0.9;">
            {{ app()->getLocale() === 'km' ? 'រកឃើញឱកាសការងារ' : 'Discover career opportunities' }}
        </p>
    </div>
</section>

<!-- Featured Jobs -->
@if($featuredJobs->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="h3">{{ __('alumni.featured') }} {{ __('alumni.job_opportunities') }}</h2>
            <p class="text-muted">Highlighted positions from our alumni network</p>
        </div>
        
        <div class="row">
            @foreach($featuredJobs as $job)
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="card-title">{{ $job->title }}</h5>
                                    <p class="text-muted mb-1">
                                        <strong>{{ $job->company }}</strong> • {{ $job->location_display }}
                                    </p>
                                </div>
                                <span class="badge bg-primary">{{ $job->job_type_display }}</span>
                            </div>
                            
                            <p class="card-text">{{ Str::limit($job->description, 150) }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="text-muted small">
                                    <i class="bi bi-clock"></i> {{ $job->posted_date }}
                                    @if($job->is_urgent)
                                        <span class="badge bg-danger ms-2">Urgent</span>
                                    @endif
                                </div>
                                <a href="{{ route('public.jobs.show', $job) }}" class="btn btn-primary btn-sm">
                                    {{ __('alumni.apply_now') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Search and Filters -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ __('alumni.filter_by') }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('public.jobs.index') }}">
                            <div class="mb-3">
                                <label class="form-label">{{ __('alumni.search') }}</label>
                                <input type="text" name="search" class="form-control" 
                                       value="{{ request('search') }}" 
                                       placeholder="Search jobs...">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">{{ __('alumni.job_type') }}</label>
                                <select name="job_type" class="form-select">
                                    <option value="">{{ __('common.all') }}</option>
                                    @foreach($jobTypes as $type)
                                        <option value="{{ $type }}" {{ request('job_type') == $type ? 'selected' : '' }}>
                                            {{ __('alumni.' . str_replace('-', '_', $type)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">{{ __('alumni.experience_level') }}</label>
                                <select name="experience_level" class="form-select">
                                    <option value="">{{ __('common.all') }}</option>
                                    @foreach($experienceLevels as $level)
                                        <option value="{{ $level }}" {{ request('experience_level') == $level ? 'selected' : '' }}>
                                            {{ __('alumni.' . str_replace('-', '_', $level)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3">
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
                            
                            <div class="mb-3">
                                <label class="form-label">{{ __('alumni.location') }}</label>
                                <select name="location" class="form-select">
                                    <option value="">{{ __('alumni.all_locations') }}</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                                            {{ $location }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remote" value="1" 
                                           {{ request('remote') ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ __('alumni.remote') }} Only</label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="featured" value="1" 
                                           {{ request('featured') ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ __('alumni.featured_only') }}</label>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-funnel"></i> {{ __('common.filter') }}
                                </button>
                                <a href="{{ route('public.jobs.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle"></i> {{ __('common.clear') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">
                        {{ $jobs->total() }} {{ __('alumni.job_opportunities') }} Found
                    </h5>
                    <div class="btn-group" role="group">
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" 
                           class="btn btn-outline-success {{ request('sort') === 'latest' ? 'active' : '' }}">
                            <i class="bi bi-clock"></i> Latest
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'popular']) }}" 
                           class="btn btn-outline-success {{ request('sort') === 'popular' ? 'active' : '' }}">
                            <i class="bi bi-fire"></i> Popular
                        </a>
                    </div>
                </div>
                
                @if($jobs->count() > 0)
                    <div class="row">
                        @foreach($jobs as $job)
                            <div class="col-lg-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm hover-lift">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div class="flex-grow-1">
                                                <h6 class="card-title mb-2">
                                                    <a href="{{ route('public.jobs.show', $job) }}" class="text-decoration-none">
                                                        {{ $job->title }}
                                                    </a>
                                                    @if($job->is_featured)
                                                        <i class="bi bi-star-fill text-warning ms-2"></i>
                                                    @endif
                                                </h6>
                                                <p class="text-muted small mb-2">
                                                    <strong>{{ $job->company }}</strong> • {{ $job->location_display }}
                                                </p>
                                            </div>
                                            <div class="text-end">
                                                <span class="badge bg-primary mb-2 d-block">{{ $job->job_type_display }}</span>
                                                <span class="badge bg-info d-block">{{ $job->experience_level_display }}</span>
                                            </div>
                                        </div>
                                        
                                        <p class="card-text">{{ Str::limit($job->description, 120) }}</p>
                                        
                                        @if($job->salary_range !== 'Negotiable')
                                            <div class="mb-2">
                                                <span class="text-success fw-bold">{{ $job->salary_range }}</span>
                                            </div>
                                        @endif
                                        
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="text-muted small">
                                                <i class="bi bi-clock"></i> {{ $job->posted_date }}
                                                @if($job->application_deadline)
                                                    <br>
                                                    <i class="bi bi-calendar-x"></i> 
                                                    {{ __('alumni.application_deadline') }}: {{ $job->days_until_deadline }}
                                                @endif
                                            </div>
                                            <div>
                                                @if($job->is_urgent)
                                                    <span class="badge bg-danger me-2">Urgent</span>
                                                @endif
                                                @if($job->is_expired)
                                                    <span class="badge bg-secondary">Expired</span>
                                                @else
                                                    <a href="{{ route('public.jobs.show', $job) }}" 
                                                       class="btn btn-success btn-sm">
                                                        {{ __('alumni.apply_now') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                Posted by {{ $job->alumni_name }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Showing {{ $jobs->firstItem() }} to {{ $jobs->lastItem() }} of {{ $jobs->total() }} opportunities
                        </div>
                        {{ $jobs->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-search fs-1 text-muted d-block mb-3"></i>
                        <h5>No job opportunities found</h5>
                        <p class="text-muted">No jobs match your current filters.</p>
                        <a href="{{ route('public.jobs.index') }}" class="btn btn-success">
                            <i class="bi bi-arrow-clockwise"></i> {{ __('common.clear_filters') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
@if(!auth()->check())
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="h3 mb-4">Join Our Alumni Network</h2>
        <p class="lead mb-4">
            Register as an alumni to access exclusive job opportunities and connect with fellow graduates.
        </p>
        <a href="{{ route('public.alumni.register') }}" class="btn btn-light btn-lg">
            <i class="bi bi-person-plus"></i> {{ __('alumni.register_as_alumni') }}
        </a>
    </div>
</section>
@endif

<style>
.hover-lift {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}
</style>
@endsection