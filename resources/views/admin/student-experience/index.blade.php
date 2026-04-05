@extends('admin.layouts.app')

@section('title', 'Student Experience Management')

@push('styles')
<style>
    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        transition: transform 0.2s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
    }
    
    .stat-card .icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 15px;
    }
    
    .stat-card .number {
        font-size: 32px;
        font-weight: 700;
        color: #003A46;
    }
    
    .stat-card .label {
        color: #6b7280;
        font-size: 14px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 mb-0">Student Experience Management</h1>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="icon" style="background: #fef3c7; color: #d97706;">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="number">{{ $stats['pendingExperiences'] }}</div>
                <div class="label">Pending Experiences</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="icon" style="background: #dbeafe; color: #2563eb;">
                    <i class="bi bi-briefcase"></i>
                </div>
                <div class="number">{{ $stats['pendingInternships'] }}</div>
                <div class="label">Pending Internships</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="icon" style="background: #d1fae5; color: #059669;">
                    <i class="bi bi-images"></i>
                </div>
                <div class="number">{{ $stats['totalGalleries'] }}</div>
                <div class="label">Gallery Items</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="icon" style="background: #fce7f3; color: #db2777;">
                    <i class="bi bi-people"></i>
                </div>
                <div class="number">{{ $stats['activeClubs'] }}</div>
                <div class="label">Active Clubs</div>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Student Experiences</h5>
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.student-experience.experiences') }}" class="btn btn-outline-primary text-start">
                            <i class="bi bi-chat-quote me-2"></i>
                            Manage Experiences
                        </a>
                        <a href="{{ route('admin.student-experience.internships') }}" class="btn btn-outline-primary text-start">
                            <i class="bi bi-briefcase me-2"></i>
                            Manage Internships
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Content Management</h5>
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.student-experience.gallery.index') }}" class="btn btn-outline-success text-start">
                            <i class="bi bi-images me-2"></i>
                            Manage Gallery
                        </a>
                        <a href="{{ route('admin.student-experience.clubs.index') }}" class="btn btn-outline-success text-start">
                            <i class="bi bi-people me-2"></i>
                            Manage Clubs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
