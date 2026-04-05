@extends('layouts.public')

@section('title', __('projects.title'))

@push('styles')
<style>
    .projects-header {
        position: relative;
        overflow: hidden;
        background: #f5f8ff;
        min-height: 350px;
        padding: 65px 0;
    }

    .projects-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .projects-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .projects-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .projects-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .projects-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .projects-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .projects-header .b5 {
        width: 110%; height: 110%;
        top: 30px; left: -5%;
        animation: moveB5 15s ease-in-out infinite alternate, colorB5 12s ease-in-out infinite alternate;
    }

    @keyframes moveB1 {
        0%   { transform: translate(0px, 0px) scale(1); }
        50%  { transform: translate(-40px, 30px) scale(1.1); }
        100% { transform: translate(20px, -40px) scale(0.92); }
    }
    @keyframes moveB2 {
        0%   { transform: translate(0px, 0px) scale(1); }
        50%  { transform: translate(35px, -25px) scale(0.93); }
        100% { transform: translate(-20px, 40px) scale(1.08); }
    }
    @keyframes moveB3 {
        0%   { transform: translate(0px, 0px) scale(1); }
        50%  { transform: translate(-30px, -35px) scale(1.06); }
        100% { transform: translate(40px, 20px) scale(0.94); }
    }
    @keyframes moveB4 {
        0%   { transform: translate(0px, 0px) scale(1); }
        50%  { transform: translate(25px, 30px) scale(1.05); }
        100% { transform: translate(-35px, -20px) scale(0.96); }
    }
    @keyframes moveB5 {
        0%   { transform: translate(0px, 0px) scale(1); }
        50%  { transform: translate(-50px, 20px) scale(1.08); }
        100% { transform: translate(30px, -30px) scale(0.95); }
    }

    @keyframes colorB1 {
        0%   { background: #50e878; }
        25%  { background: #c8f040; }
        50%  { background: #30d8c0; }
        75%  { background: #a0f060; }
        100% { background: #50e878; }
    }
    @keyframes colorB2 {
        0%   { background: #b8f050; }
        25%  { background: #40e8c0; }
        50%  { background: #f0e060; }
        75%  { background: #60d880; }
        100% { background: #b8f050; }
    }
    @keyframes colorB3 {
        0%   { background: #40d8b0; }
        25%  { background: #70f040; }
        50%  { background: #d8f080; }
        75%  { background: #20c8a0; }
        100% { background: #40d8b0; }
    }
    @keyframes colorB4 {
        0%   { background: #d0f870; }
        25%  { background: #50e890; }
        50%  { background: #a0f8d0; }
        75%  { background: #e8f050; }
        100% { background: #d0f870; }
    }
    @keyframes colorB5 {
        0%   { background: #50e878; }
        25%  { background: #40e8c0; }
        50%  { background: #c8f040; }
        75%  { background: #30d8c0; }
        100% { background: #50e878; }
    }

    .projects-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,248,255,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .projects-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .projects-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .projects-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }

    .project-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    
    .project-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0,58,70,0.18) !important;
    }
    
    .project-card img {
        transition: transform 0.5s ease;
    }
    
    .project-card:hover img {
        transform: scale(1.08);
    }
    
    .project-card .card-body {
        background: #fff;
    }
    
    .type-badge {
        font-size: 0.7rem;
        padding: 0.4rem 0.8rem;
        border-radius: 50px;
        font-weight: 500;
    }
    
    .status-badge {
        font-size: 0.65rem;
        padding: 0.35rem 0.7rem;
        border-radius: 50px;
    }
    
    .filter-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        transition: all 0.3s ease;
    }
    
    .filter-card:focus-within {
        border-color: #003A46;
        box-shadow: 0 4px 20px rgba(0,58,70,0.1);
    }
    
    .filter-input {
        border: none;
        background: #f8fafc;
        border-radius: 12px;
        padding: 0.75rem 1rem 0.75rem 2.75rem;
        transition: all 0.2s ease;
    }
    
    .filter-input:focus {
        background: #f1f5f9;
        box-shadow: none;
    }
    
    .filter-select {
        border: none;
        background: #f8fafc;
        border-radius: 12px;
        padding: 0.75rem 1rem;
    }
    
    .filter-btn {
        background: linear-gradient(135deg, #003A46 0%, #006d77 100%);
        border: none;
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    
    .filter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,58,70,0.25);
    }
    
    .filter-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 50px;
        font-size: 0.85rem;
        text-decoration: none;
        color: #475569;
        transition: all 0.2s ease;
    }
    
    .filter-tag:hover {
        background: #003A46;
        border-color: #003A46;
        color: #fff;
    }
    
    .filter-tag .remove {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 18px;
        height: 18px;
        background: rgba(0,0,0,0.1);
        border-radius: 50%;
        font-size: 0.7rem;
    }
    
    .pagination .page-link {
        border: none;
        border-radius: 10px !important;
        margin: 0 3px;
        color: #003A46;
        padding: 0.5rem 0.85rem;
        font-size: 0.9rem;
    }
    
    .pagination .page-item.active .page-link {
        background: #003A46;
        color: #fff;
    }
    
    .pagination .page-link:hover {
        background: #e8f4f8;
        color: #003A46;
    }
    
    .hero-card {
        border: none;
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 15px 50px rgba(0,58,70,0.12);
    }
    
    .hero-img-container {
        height: 320px;
        overflow: hidden;
        position: relative;
    }
    
    .hero-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .hero-img-container::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0,58,70,0.2) 0%, rgba(0,58,70,0.7) 100%);
    }
    
    .hero-content {
        position: relative;
        z-index: 1;
        margin-top: -120px;
        padding: 0 2rem;
    }
    
    .stat-card {
        background: linear-gradient(135deg, #fff 0%, #f8fafc 100%);
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.25rem;
    }
    
    .empty-state {
        background: #f8fafc;
        border-radius: 24px;
        padding: 4rem 2rem;
    }
    
    .empty-icon {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #e8f4f8 0%, #d1e8f0 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endpush

@section('content')
@php
    $typeLabels = [
        'club' => app()->getLocale() === 'km' ? 'សម្ព័ន្ធនិស្សិត' : 'Student Club',
        'academic_project' => app()->getLocale() === 'km' ? 'គម្រោងសិក្សា' : 'Academic Project',
        'research_project' => app()->getLocale() === 'km' ? 'គម្រោងស្រាវជ្រាវ' : 'Research Project',
    ];
    $typeIcons = [
        'club' => 'bi-people-fill',
        'academic_project' => 'bi-journal-bookmark-fill',
        'research_project' => 'bi-search',
    ];
    $typeColors = [
        'club' => '#e74c3c',
        'academic_project' => '#3498db',
        'research_project' => '#2ecc71',
    ];
    $statusLabels = [
        'active' => app()->getLocale() === 'km' ? 'សកម្ម' : 'Active',
        'completed' => app()->getLocale() === 'km' ? 'បញ្ចប់' : 'Completed',
        'upcoming' => app()->getLocale() === 'km' ? 'នាពេលខាងមុខ' : 'Upcoming',
    ];
@endphp

<!-- Hero Section -->
<section class="projects-header">
    <div class="blob-wrapper">
        <div class="blob b1"></div>
        <div class="blob b2"></div>
        <div class="blob b3"></div>
        <div class="blob b4"></div>
        <div class="blob b5"></div>
    </div>
    <div class="fade-bottom"></div>
    <div class="container">
        <div class="header-content">
            <nav aria-label="breadcrumb" style="position: relative; z-index: 10;">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #003A46;">{{ __('navigation.home') }}</a></li>
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ __('projects.title') }}</li>
                </ol>
            </nav>
            <h1 class="header-title">
                {{ __('projects.title') }}
            </h1>
            <p class="header-subtitle">
                {{ app()->getLocale() === 'km' ? 'សម្ព័ន្ធនិស្សិត និង គម្រោងសិក្សា និង ស្រាវជ្រាវ' : 'Student clubs, academic and research projects' }}
            </p>
        </div>
    </div>
</section>

@if($featuredProjects->count() > 0 && !request()->filled('search') && !request()->filled('type') && !request()->filled('status'))
<section class="py-5">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="h4 fw-bold mb-1" style="color: #0f172a;">
                    <i class="bi bi-lightning-fill me-2" style="color: #f59e0b;"></i>{{ __('projects.active') }}
                </h2>
                <p class="text-muted mb-0 small">{{ app()->getLocale() === 'km' ? 'គម្រោង និង សម្ព័ន្ធនិស្សិតសកម្ម' : 'Currently active projects and clubs' }}</p>
            </div>
        </div>
        <div class="row g-4">
            @foreach($featuredProjects as $fp)
                <div class="col-lg-4">
                    <a href="{{ route('public.projects.show', $fp->slug) }}" class="text-decoration-none">
                        <div class="project-card card border-0 shadow-sm h-100">
                            <div class="position-relative" style="height: 180px; overflow: hidden;">
                                @if($fp->featured_image)
                                    <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $fp->featured_image)) }}" alt="{{ $fp->name }}" class="w-100 h-100" style="object-fit: cover;">
                                @else
                                    @php $color = $typeColors[$fp->type] ?? '#003A46'; @endphp
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, {{ $color }}dd, {{ $color }}cc);">
                                        <i class="bi {{ $typeIcons[$fp->type] ?? 'bi-folder-fill' }} text-white" style="font-size: 3.5rem; opacity: 0.3;"></i>
                                    </div>
                                @endif
                                <div class="position-absolute top-0 start-0 m-3">
                                    <span class="type-badge" style="background: {{ $typeColors[$fp->type] ?? '#003A46' }}; color: #fff;">
                                        <i class="bi {{ $typeIcons[$fp->type] ?? 'bi-folder' }} me-1"></i>{{ $typeLabels[$fp->type] ?? $fp->type }}
                                    </span>
                                </div>
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="status-badge {{ $fp->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                        @if($fp->status === 'active')<i class="bi bi-circle-fill me-1" style="font-size: 0.4rem;"></i>@endif{{ $statusLabels[$fp->status] ?? $fp->status }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-2" style="color: #0f172a; font-size: 1.1rem; line-height: 1.4;">{{ Str::limit($fp->name, 55) }}</h5>
                                <p class="text-muted mb-3" style="line-height: 1.6; font-size: 0.9rem;">{{ Str::limit(strip_tags($fp->description), 85) }}</p>
                                <div class="d-flex align-items-center justify-content-between pt-3" style="border-top: 1px solid #f1f5f9;">
                                    <div class="d-flex align-items-center gap-2">
                                        @if($fp->supervisor)
                                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; background: #f1f5f9;">
                                                <i class="bi bi-person-fill" style="color: #64748b; font-size: 0.75rem;"></i>
                                            </div>
                                            <small class="text-muted" style="font-size: 0.8rem;">{{ Str::limit($fp->supervisor->name, 15) }}</small>
                                        @endif
                                    </div>
                                    <small class="text-muted"><i class="bi bi-people me-1"></i>{{ $fp->members ? count($fp->members) : 0 }}</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-12">
                <div class="filter-card card border-0 shadow-sm" style="border-radius: 16px;">
                    <div class="card-body p-4">
                        <form method="GET" action="{{ route('public.projects.index') }}" id="filterForm">
                            <div class="row g-3 align-items-end">
                                <div class="col-md-4">
                                    <div class="position-relative">
                                        <i class="bi bi-search position-absolute" style="left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                                        <input type="text" name="search" class="form-control filter-input" 
                                               placeholder="{{ app()->getLocale() === 'km' ? 'ស្វែងរកគម្រោង...' : 'Search projects...' }}"
                                               value="{{ request('search') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select name="type" class="form-select filter-select" onchange="document.getElementById('filterForm').submit()">
                                        <option value="">{{ app()->getLocale() === 'km' ? 'ប្រភេទទាំងអស់' : 'All Types' }}</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type }}" {{ request('type') === $type ? 'selected' : '' }}>
                                                {{ $typeLabels[$type] ?? $type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="status" class="form-select filter-select" onchange="document.getElementById('filterForm').submit()">
                                        <option value="">{{ app()->getLocale() === 'km' ? 'ស្ថានភាពទាំងអស់' : 'All Status' }}</option>
                                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>{{ $statusLabels['active'] }}</option>
                                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>{{ $statusLabels['completed'] }}</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn filter-btn w-100 text-white">
                                        <i class="bi bi-search me-1"></i>{{ app()->getLocale() === 'km' ? 'ស្វែង' : 'Search' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @if(request()->filled('search') || request()->filled('type') || request()->filled('status'))
                <div class="mt-4 d-flex align-items-center flex-wrap gap-2">
                    <span class="text-muted small me-2">{{ app()->getLocale() === 'km' ? 'តម្រង:' : 'Filters:' }}</span>
                    @if(request()->filled('search'))
                        <a href="{{ route('public.projects.index', request()->except('search')) }}" class="filter-tag">
                            "{{ request('search') }}" <span class="remove">×</span>
                        </a>
                    @endif
                    @if(request()->filled('type'))
                        <a href="{{ route('public.projects.index', request()->except('type')) }}" class="filter-tag" style="background: {{ $typeColors[request('type')] ?? '#003A46' }}; border-color: {{ $typeColors[request('type')] ?? '#003A46' }}; color: #fff;">
                            {{ $typeLabels[request('type')] ?? request('type') }} <span class="remove" style="background: rgba(255,255,255,0.2);">×</span>
                        </a>
                    @endif
                    @if(request()->filled('status'))
                        <a href="{{ route('public.projects.index', request()->except('status')) }}" class="filter-tag">
                            {{ $statusLabels[request('status')] ?? request('status') }} <span class="remove">×</span>
                        </a>
                    @endif
                    <a href="{{ route('public.projects.index') }}" class="btn btn-sm btn-link text-danger text-decoration-none">
                        <i class="bi bi-x-circle me-1"></i>{{ app()->getLocale() === 'km' ? 'សម្អាត' : 'Clear' }}
                    </a>
                </div>
                @endif

                <div class="d-flex align-items-center justify-content-between mt-5 mb-4">
                    <h2 class="h5 fw-bold mb-0" style="color: #0f172a;">
                        @if(request()->filled('type'))
                            <i class="bi {{ $typeIcons[request('type')] ?? 'bi-folder' }} me-2" style="color: {{ $typeColors[request('type')] ?? '#003A46' }};"></i>{{ $typeLabels[request('type')] ?? request('type') }}
                        @else
                            {{ app()->getLocale() === 'km' ? 'គម្រោង និង សម្ព័ន្ធនិស្សិត' : 'All Projects & Clubs' }}
                        @endif
                    </h2>
                    <span class="text-muted small">{{ $projects->total() }} {{ app()->getLocale() === 'km' ? 'គម្រោង' : 'projects' }}</span>
                </div>

                <div class="row g-4">
                    @forelse($projects as $project)
                        <div class="col-md-6 col-lg-4">
                            <a href="{{ route('public.projects.show', $project->slug) }}" class="text-decoration-none">
                                <div class="project-card card border-0 shadow-sm h-100">
                                    <div class="position-relative" style="height: 170px; overflow: hidden;">
                                        @if($project->featured_image)
                                            <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $project->featured_image)) }}" alt="{{ $project->name }}" class="w-100 h-100" style="object-fit: cover;">
                                        @else
                                            @php $pcolor = $typeColors[$project->type] ?? '#003A46'; @endphp
                                            <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, {{ $pcolor }}dd, {{ $pcolor }}cc);">
                                                <i class="bi {{ $typeIcons[$project->type] ?? 'bi-folder-fill' }} text-white" style="font-size: 2.5rem; opacity: 0.3;"></i>
                                            </div>
                                        @endif
                                        <div class="position-absolute top-0 end-0 m-3">
                                            <span class="status-badge {{ $project->status === 'active' ? 'bg-success' : 'bg-secondary' }}" style="font-size: 0.6rem;">
                                                @if($project->status === 'active')<i class="bi bi-circle-fill me-1" style="font-size: 0.35rem;"></i>@endif{{ $statusLabels[$project->status] ?? $project->status }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex flex-column p-4">
                                        <div class="mb-2">
                                            <span class="type-badge" style="background: {{ ($typeColors[$project->type] ?? '#003A46') . '15' }}; color: {{ $typeColors[$project->type] ?? '#003A46' }};">
                                                <i class="bi {{ $typeIcons[$project->type] ?? 'bi-folder' }} me-1"></i>{{ $typeLabels[$project->type] ?? $project->type }}
                                            </span>
                                        </div>
                                        <h5 class="fw-bold mb-2" style="color: #0f172a; font-size: 1rem; line-height: 1.5;">{{ Str::limit($project->name, 60) }}</h5>
                                        <p class="text-muted small flex-grow-1 mb-3" style="line-height: 1.6;">
                                            {{ Str::limit(strip_tags($project->description), 90) }}
                                        </p>
                                        <div class="d-flex align-items-center justify-content-between pt-3" style="border-top: 1px solid #f1f5f9;">
                                            <div class="d-flex align-items-center gap-2">
                                                @if($project->supervisor)
                                                    <small class="text-muted"><i class="bi bi-person-badge me-1"></i>{{ Str::limit($project->supervisor->name, 12) }}</small>
                                                @endif
                                            </div>
                                            <small class="text-muted"><i class="bi bi-people me-1"></i>{{ $project->members ? count($project->members) : 0 }}</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="empty-state text-center">
                                <div class="empty-icon mx-auto mb-4">
                                    <i class="bi bi-folder2-open" style="font-size: 3rem; color: #64748b;"></i>
                                </div>
                                <h4 class="fw-bold mb-2" style="color: #0f172a;">{{ __('projects.no_projects') }}</h4>
                                <p class="text-muted mb-4">{{ app()->getLocale() === 'km' ? 'សាកល្បងផ្លាស់ប្តូរការស្វែងរក' : 'Try adjusting your search criteria' }}</p>
                                <a href="{{ route('public.projects.index') }}" class="btn filter-btn text-white px-4">
                                    <i class="bi bi-arrow-left me-2"></i>{{ app()->getLocale() === 'km' ? 'មើលទាំងអស់' : 'View All' }}
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                @if($projects->hasPages())
                    <div class="mt-5 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                        <small class="text-muted">
                            {{ app()->getLocale() === 'km' ? 'បង្ហាញ' : 'Showing' }} {{ $projects->firstItem() }}-{{ $projects->lastItem() }} {{ app()->getLocale() === 'km' ? 'នៃ' : 'of' }} {{ $projects->total() }}
                        </small>
                        {{ $projects->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
