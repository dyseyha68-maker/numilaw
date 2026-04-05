@extends('admin.layouts.app')

@section('title', 'Project Details')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Project Details</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
        <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Edit
        </a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5>Project Information</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Type:</strong> 
                    @switch($project->type)
                        @case('club')
                            <span class="badge bg-info">Club</span>
                            @break
                        @case('academic_project')
                            <span class="badge bg-primary">Academic Project</span>
                            @break
                        @case('research_project')
                            <span class="badge bg-warning">Research Project</span>
                            @break
                    @endswitch
                </p>
                <p><strong>Supervisor:</strong> {{ $project->supervisor->name ?? 'N/A' }}</p>
                <p><strong>Project Leader:</strong> {{ $project->leader->name ?? 'N/A' }}</p>
                <p><strong>Status:</strong> 
                    @if($project->status === 'active')
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Completed</span>
                    @endif
                </p>
            </div>
            <div class="col-md-6">
                <p><strong>Start Date:</strong> {{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('M d, Y') : '-' }}</p>
                <p><strong>End Date:</strong> {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('M d, Y') : '-' }}</p>
                <p><strong>Created:</strong> {{ $project->created_at->format('M d, Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>

@if($project->featured_image)
<div class="card mb-4">
    <div class="card-header">
        <h5>Featured Image</h5>
    </div>
    <div class="card-body">
        <img src="{{ Storage::url($project->featured_image) }}" alt="Featured Image" class="img-fluid" style="max-height: 300px;">
    </div>
</div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Name</h5>
            </div>
            <div class="card-body">
                <p><strong>English:</strong> {{ $project->name_en }}</p>
                <p><strong>Khmer:</strong> {{ $project->name_km }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Objectives</h5>
            </div>
            <div class="card-body">
                <p><strong>English:</strong> {{ $project->objectives_en ?? '-' }}</p>
                <p><strong>Khmer:</strong> {{ $project->objectives_km ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5>Description (English)</h5>
    </div>
    <div class="card-body">
        {!! $project->description_en !!}
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5>Description (Khmer)</h5>
    </div>
    <div class="card-body">
        {!! $project->description_km !!}
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project?')">
                <i class="bi bi-trash"></i> Delete Project
            </button>
        </form>
    </div>
</div>
@endsection
