@extends('layouts.public')

@section('title', $project->name)
@section('description', Str::limit(strip_tags($project->description), 160))

@push('styles')
<style>
    .projectshow-header {
        position: relative;
        overflow: hidden;
        background: #f5f8ff;
        min-height: 350px;
        padding: 65px 0;
    }

    .projectshow-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .projectshow-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .projectshow-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .projectshow-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .projectshow-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .projectshow-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .projectshow-header .b5 {
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

    .projectshow-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,248,255,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .projectshow-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .projectshow-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .projectshow-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }

    .reading-progress {
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: linear-gradient(90deg, #003A46, #0a9396);
        z-index: 10000;
        transition: width 0.1s ease;
    }
    
    .project-hero {
        position: relative;
        min-height: 45vh;
        display: flex;
        align-items: flex-end;
    }
    
    .project-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.75) 100%);
    }
    
    .project-hero-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
    }
    
    .project-hero-bg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .project-hero .container {
        position: relative;
        z-index: 1;
    }
    
    .type-badge {
        font-size: 0.75rem;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-weight: 500;
    }
    
    .status-badge {
        font-size: 0.7rem;
        padding: 0.35rem 0.8rem;
        border-radius: 50px;
    }
    
    .info-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }
    
    .info-card:hover {
        border-color: #003A4640;
        box-shadow: 0 8px 30px rgba(0,58,70,0.08);
    }
    
    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .info-item:last-child {
        border-bottom: none;
    }
    
    .info-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .project-content {
        font-size: 1.05rem;
        line-height: 1.85;
        color: #334155;
    }
    
    .project-content p {
        margin-bottom: 1.5rem;
    }
    
    .project-content h2 {
        font-size: 1.6rem;
        font-weight: 700;
        color: #0f172a;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
        position: relative;
        padding-bottom: 0.75rem;
    }
    
    .project-content h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #003A46, #0a9396);
        border-radius: 2px;
    }
    
    .project-content h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1e293b;
        margin-top: 1.75rem;
        margin-bottom: 0.75rem;
    }
    
    .project-content img {
        max-width: 100%;
        height: auto;
        border-radius: 16px;
        margin: 2rem 0;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }
    
    .project-content ul, .project-content ol {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }
    
    .project-content li {
        margin-bottom: 0.5rem;
    }
    
    .project-content blockquote {
        border: none;
        padding: 1.25rem 1.5rem;
        margin: 2rem 0;
        background: #f8fafc;
        border-left: 4px solid #003A46;
        border-radius: 0 12px 12px 0;
    }
    
    .team-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1rem;
        transition: all 0.2s ease;
    }
    
    .team-card:hover {
        background: #f1f5f9;
        transform: translateY(-2px);
    }
    
    .related-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .related-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 40px rgba(0,58,70,0.15);
    }
    
    .related-card img {
        transition: transform 0.5s ease;
    }
    
    .related-card:hover img {
        transform: scale(1.05);
    }
    
    .other-project-item {
        padding: 0.75rem;
        border-radius: 12px;
        transition: all 0.2s ease;
    }
    
    .other-project-item:hover {
        background: #f8fafc;
    }
    
    .nav-project {
        border: none;
        border-radius: 16px;
        background: #fff;
        transition: all 0.3s ease;
    }
    
    .nav-project:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 40px rgba(0,58,70,0.12);
    }
    
    @media (max-width: 768px) {
        .project-hero {
            min-height: 35vh;
        }
        
        .project-content {
            font-size: 1rem;
        }
        
        .project-content h2 {
            font-size: 1.4rem;
        }
    }
</style>
@endpush

@section('content')
<div class="reading-progress" id="progressBar"></div>

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
    $typeColor = $typeColors[$project->type] ?? '#003A46';
    $iconColor = $typeColors[$project->type] ?? '#003A46';
@endphp

@if($project->featured_image)
<!-- Hero Section with Image -->
<section class="projectshow-header">
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
                    <li class="breadcrumb-item"><a href="{{ route('public.projects.index') }}" style="color: #003A46;">{{ __('projects.title') }}</a></li>
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ Str::limit($project->name, 35) }}</li>
                </ol>
            </nav>
            <div class="d-flex align-items-center gap-2 mb-3 flex-wrap">
                <span class="type-badge" style="background: {{ $typeColor }}; color: #fff;">
                    <i class="bi {{ $typeIcons[$project->type] ?? 'bi-folder' }} me-1"></i>{{ $typeLabels[$project->type] ?? $project->type }}
                </span>
                <span class="status-badge {{ $project->status === 'active' ? 'bg-success' : ($project->status === 'completed' ? 'bg-secondary' : 'bg-warning text-dark') }}">
                    @if($project->status === 'active')<i class="bi bi-circle-fill me-1" style="font-size: 0.4rem;"></i>@endif{{ $statusLabels[$project->status] ?? $project->status }}
                </span>
            </div>
            <h1 class="header-title">
                {{ $project->name }}
            </h1>
            <p class="header-subtitle">
                @if($project->supervisor)
                    <i class="bi bi-person-badge me-1"></i>{{ $project->supervisor->name }}
                @endif
                @if($project->start_date)
                    <span class="mx-2">|</span>
                    <i class="bi bi-calendar3 me-1"></i>{{ $project->start_date->format('M j, Y') }}
                @endif
                @if($project->members && count($project->members) > 0)
                    <span class="mx-2">|</span>
                    <i class="bi bi-people me-1"></i>{{ count($project->members) }} {{ app()->getLocale() === 'km' ? 'សមាជិក' : 'members' }}
                @endif
            </p>
        </div>
    </div>
</section>
@else
<section class="projectshow-header">
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
                    <li class="breadcrumb-item"><a href="{{ route('public.projects.index') }}" style="color: #003A46;">{{ __('projects.title') }}</a></li>
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ Str::limit($project->name, 35) }}</li>
                </ol>
            </nav>
            <div class="d-flex align-items-center gap-2 mb-3 flex-wrap">
                <span class="type-badge" style="background: {{ $typeColor }}; color: #fff;">
                    <i class="bi {{ $typeIcons[$project->type] ?? 'bi-folder' }} me-1"></i>{{ $typeLabels[$project->type] ?? $project->type }}
                </span>
                <span class="status-badge {{ $project->status === 'active' ? 'bg-success' : ($project->status === 'completed' ? 'bg-secondary' : 'bg-warning text-dark') }}">
                    @if($project->status === 'active')<i class="bi bi-circle-fill me-1" style="font-size: 0.4rem;"></i>@endif{{ $statusLabels[$project->status] ?? $project->status }}
                </span>
            </div>
            <h1 class="header-title">
                {{ $project->name }}
            </h1>
            <p class="header-subtitle">
                @if($project->supervisor)
                    <i class="bi bi-person-badge me-1"></i>{{ $project->supervisor->name }}
                @endif
                @if($project->start_date)
                    <span class="mx-2">|</span>
                    <i class="bi bi-calendar3 me-1"></i>{{ $project->start_date->format('M j, Y') }}
                @endif
                @if($project->members && count($project->members) > 0)
                    <span class="mx-2">|</span>
                    <i class="bi bi-people me-1"></i>{{ count($project->members) }} {{ app()->getLocale() === 'km' ? 'សមាជិក' : 'members' }}
                @endif
            </p>
        </div>
    </div>
</section>
@endif

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                @if($project->objectives)
                    <div class="mb-5 p-4" style="background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%); border-left: 4px solid {{ $typeColor }}; border-radius: 0 16px 16px 0;">
                        <h6 class="fw-bold mb-2" style="color: {{ $typeColor }};">
                            <i class="bi bi-bullseye me-2"></i>{{ app()->getLocale() === 'km' ? 'គោលបំណង' : 'Objectives' }}
                        </h6>
                        <p class="mb-0" style="color: #475569; line-height: 1.8;">{{ $project->objectives }}</p>
                    </div>
                @endif

                <div class="project-content mb-5">
                    {!! $project->description !!}
                </div>

                @if($project->members && count($project->members) > 0)
                    <div class="mb-5 pt-4" style="border-top: 1px solid #e2e8f0;">
                        <h5 class="fw-bold mb-4" style="color: #0f172a;">
                            <i class="bi bi-people me-2" style="color: {{ $typeColor }};"></i>{{ app()->getLocale() === 'km' ? 'សមាជិកក្រុម' : 'Team Members' }}
                            <span class="badge rounded-pill ms-2" style="background: #f1f5f9; color: #64748b; font-size: 0.75rem;">{{ count($project->members) }}</span>
                        </h5>
                        <div class="row g-3">
                            @foreach($project->members as $member)
                                <div class="col-md-6">
                                    <div class="team-card">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px; background: {{ $typeColor }}15;">
                                                <i class="bi bi-person-fill" style="color: {{ $typeColor }}; font-size: 1.25rem;"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold" style="font-size: 0.95rem; color: #1e293b;">{{ $member['name'] ?? 'Unknown' }}</div>
                                                <small class="text-muted">{{ $member['role'] ?? (app()->getLocale() === 'km' ? 'សមាជិក' : 'Team Member') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-lg-4">
                <div class="position-sticky" style="top: 100px;">
                    <div class="info-card mb-4">
                        <h6 class="fw-bold mb-3" style="color: #0f172a;">
                            <i class="bi bi-info-circle me-2" style="color: {{ $typeColor }};"></i>{{ app()->getLocale() === 'km' ? 'ព័ត៌មាន' : 'Project Info' }}
                        </h6>
                        
                        <div class="info-item">
                            <div class="info-icon" style="background: {{ $typeColor }}15;">
                                <i class="bi {{ $typeIcons[$project->type] ?? 'bi-folder' }}" style="color: {{ $typeColor }};"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block" style="font-size: 0.75rem;">{{ app()->getLocale() === 'km' ? 'ប្រភេទ' : 'Type' }}</small>
                                <span class="fw-semibold" style="font-size: 0.9rem; color: #1e293b;">{{ $typeLabels[$project->type] ?? $project->type }}</span>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon" style="background: {{ $project->status === 'active' ? '#dcfce7' : '#f1f5f9' }};">
                                <i class="bi {{ $project->status === 'active' ? 'bi-check-circle-fill' : 'bi-archive' }}" style="color: {{ $project->status === 'active' ? '#16a34a' : '#64748b' }};"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block" style="font-size: 0.75rem;">{{ __('projects.status') }}</small>
                                <span class="fw-semibold" style="font-size: 0.9rem; color: #1e293b;">{{ $statusLabels[$project->status] ?? $project->status }}</span>
                            </div>
                        </div>
                        
                        @if($project->supervisor)
                        <div class="info-item">
                            <div class="info-icon" style="background: #dbeafe;">
                                <i class="bi bi-person-badge-fill" style="color: #3b82f6;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block" style="font-size: 0.75rem;">{{ app()->getLocale() === 'km' ? 'អ្នកណែនាំ' : 'Supervisor' }}</small>
                                <span class="fw-semibold" style="font-size: 0.9rem; color: #1e293b;">{{ $project->supervisor->name }}</span>
                            </div>
                        </div>
                        @endif
                        
                        @if($project->leader)
                        <div class="info-item">
                            <div class="info-icon" style="background: #fef3c7;">
                                <i class="bi bi-star-fill" style="color: #f59e0b;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block" style="font-size: 0.75rem;">{{ app()->getLocale() === 'km' ? 'ប្រធាន' : 'Project Leader' }}</small>
                                <span class="fw-semibold" style="font-size: 0.9rem; color: #1e293b;">{{ $project->leader->name }}</span>
                            </div>
                        </div>
                        @endif
                        
                        @if($project->start_date)
                        <div class="info-item">
                            <div class="info-icon" style="background: #f3e8ff;">
                                <i class="bi bi-calendar3" style="color: #9333ea;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block" style="font-size: 0.75rem;">{{ app()->getLocale() === 'km' ? 'រយៈពេល' : 'Duration' }}</small>
                                <span class="fw-semibold" style="font-size: 0.9rem; color: #1e293b;">{{ $project->start_date->format('M j, Y') }}</span>
                                @if($project->end_date)
                                    <br><small class="text-muted">{{ app()->getLocale() === 'km' ? 'ដល់' : 'to' }} {{ $project->end_date->format('M j, Y') }}</small>
                                @endif
                            </div>
                        </div>
                        @endif
                        
                        @if($project->members && count($project->members) > 0)
                        <div class="info-item">
                            <div class="info-icon" style="background: {{ $typeColor }}15;">
                                <i class="bi bi-people-fill" style="color: {{ $typeColor }};"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block" style="font-size: 0.75rem;">{{ app()->getLocale() === 'km' ? 'ចំនួន' : 'Team Size' }}</small>
                                <span class="fw-semibold" style="font-size: 0.9rem; color: #1e293b;">{{ count($project->members) }} {{ app()->getLocale() === 'km' ? 'សមាជិក' : 'members' }}</span>
                            </div>
                        </div>
                        @endif
                    </div>

                    @if($otherProjects->count() > 0)
                    <div class="info-card mb-4">
                        <h6 class="fw-bold mb-3" style="color: #0f172a;">
                            <i class="bi bi-folder me-2" style="color: {{ $typeColor }};"></i>{{ app()->getLocale() === 'km' ? 'គម្រោងផ្សេង' : 'Other Projects' }}
                        </h6>
                        <div class="d-flex flex-column gap-2">
                            @foreach($otherProjects as $other)
                                <a href="{{ route('public.projects.show', $other->slug) }}" class="other-project-item d-flex gap-3 text-decoration-none rounded-3">
                                    @if($other->featured_image)
                                        <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $other->featured_image)) }}" alt="{{ $other->name }}" class="rounded-3 flex-shrink-0" style="width: 65px; height: 52px; object-fit: cover;">
                                    @else
                                        @php $ocolor = $typeColors[$other->type] ?? '#003A46'; @endphp
                                        <div class="rounded-3 flex-shrink-0 d-flex align-items-center justify-content-center" style="width: 65px; height: 52px; background: linear-gradient(135deg, {{ $ocolor }}dd, {{ $ocolor }}cc);">
                                            <i class="bi {{ $typeIcons[$other->type] ?? 'bi-folder-fill' }} text-white" style="font-size: 1rem; opacity: 0.5;"></i>
                                        </div>
                                    @endif
                                    <div class="flex-grow-1 min-width-0">
                                        <h6 class="mb-1 fw-semibold" style="color: #1e293b; font-size: 0.85rem; line-height: 1.4;">{{ Str::limit($other->name, 40) }}</h6>
                                        <span class="badge rounded-pill" style="background: {{ $typeColors[$other->type] ?? '#003A46' }}15; color: {{ $typeColors[$other->type] ?? '#003A46' }}; font-size: 0.65rem;">{{ $typeLabels[$other->type] ?? $other->type }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <a href="{{ route('public.projects.index') }}" class="btn w-100 d-flex align-items-center justify-content-center gap-2" style="background: linear-gradient(135deg, #003A46 0%, #006d77 100%); color: #fff; border-radius: 12px; padding: 0.875rem;">
                        <i class="bi bi-arrow-left"></i>{{ app()->getLocale() === 'km' ? 'គម្រោងទាំងអស់' : 'All Projects' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@if($relatedProjects->count() > 0)
<section class="py-5" style="background: #f8fafc;">
    <div class="container">
        <div class="mb-4">
            <h5 class="fw-bold mb-1" style="color: #0f172a;">
                <i class="bi bi-link-45deg me-2" style="color: {{ $typeColor }};"></i>{{ app()->getLocale() === 'km' ? 'គម្រោងពាក់ព័ន្ធ' : 'Related Projects' }}
            </h5>
            <p class="text-muted mb-0">{{ app()->getLocale() === 'km' ? 'គម្រោងដែលទាក់ទង' : 'More projects you might be interested in' }}</p>
        </div>
        <div class="row g-4">
            @foreach($relatedProjects as $related)
                <div class="col-md-4">
                    <a href="{{ route('public.projects.show', $related->slug) }}" class="text-decoration-none">
                        <div class="related-card card border-0 shadow-sm h-100">
                            <div class="position-relative overflow-hidden" style="height: 160px;">
                                @if($related->featured_image)
                                    <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $related->featured_image)) }}" alt="{{ $related->name }}" class="w-100 h-100" style="object-fit: cover;">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, {{ $typeColors[$related->type] ?? '#003A46' }}dd, {{ $typeColors[$related->type] ?? '#006d77' }}cc);">
                                        <i class="bi {{ $typeIcons[$related->type] ?? 'bi-folder-fill' }} text-white" style="opacity: 0.4; font-size: 2rem;"></i>
                                    </div>
                                @endif
                                <span class="position-absolute top-0 start-0 m-3 badge rounded-pill" style="background: rgba(255,255,255,0.95); color: {{ $typeColors[$related->type] ?? '#003A46' }}; font-size: 0.65rem;">
                                    {{ $typeLabels[$related->type] ?? $related->type }}
                                </span>
                            </div>
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-2" style="color: #1e293b; font-size: 1rem; line-height: 1.5;">{{ Str::limit($related->name, 55) }}</h6>
                                <div class="d-flex align-items-center justify-content-between">
                                    <small class="text-muted">
                                        <i class="bi bi-person-badge me-1"></i>{{ $related->supervisor->name ?? 'N/A' }}
                                    </small>
                                    <span class="badge rounded-pill {{ $related->status === 'active' ? 'bg-success' : 'bg-secondary' }}" style="font-size: 0.6rem;">
                                        {{ $statusLabels[$related->status] ?? $related->status }}
                                    </span>
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

@push('scripts')
<script>
    window.addEventListener('scroll', function() {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        document.getElementById('progressBar').style.width = scrolled + '%';
    });
</script>
@endpush
@endsection
