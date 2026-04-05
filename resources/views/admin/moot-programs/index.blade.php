@extends('admin.layouts.app')

@section('title', 'Moot Court Programs')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Moot Court Programs</h1>
        <p class="text-muted">Manage permanent moot court programs and their yearly participations</p>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.moot-programs.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> New Moot Program
        </a>
    </div>
</div>

@if($moots->count() > 0)
<div class="row g-4">
    @foreach($moots as $moot)
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center gap-3">
                        @if($moot->logo_path)
                        <img src="{{ asset($moot->logo_path) }}" alt="{{ $moot->name_en }}" 
                             style="width: 50px; height: 50px; object-fit: contain; border-radius: 8px;">
                        @else
                        <div class="bg-light d-flex align-items-center justify-content-center" 
                             style="width: 50px; height: 50px; border-radius: 8px;">
                            <i class="bi bi-gavel text-muted" style="font-size: 1.5rem;"></i>
                        </div>
                        @endif
                        <div>
                            <h5 class="card-title mb-1">{{ $moot->name_en }}</h5>
                            @if($moot->acronym)
                            <span class="badge bg-secondary">{{ $moot->acronym }}</span>
                            @endif
                        </div>
                    </div>
                    @if($moot->is_featured)
                    <span class="badge bg-warning text-dark"><i class="bi bi-star-fill"></i></span>
                    @endif
                </div>
                
                @if($moot->description_en)
                <p class="card-text text-muted small">{{ Str::limit($moot->description_en, 120) }}</p>
                @endif
                
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span class="text-muted small">
                        <i class="bi bi-calendar3"></i> 
                        @if($moot->first_participation_year)
                        Since {{ $moot->first_participation_year }}
                        @else
                        No participation yet
                        @endif
                    </span>
                    <span class="badge bg-primary">{{ $moot->participations->count() }} years</span>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <div class="btn-group btn-group-sm w-100">
                    <a href="{{ route('admin.moot-programs.show', $moot->id) }}" class="btn btn-outline-primary">
                        <i class="bi bi-eye"></i> View
                    </a>
                    <a href="{{ route('admin.moot-programs.edit', $moot->id) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-4">
    {{ $moots->links() }}
</div>
@else
<div class="card">
    <div class="card-body text-center py-5">
        <i class="bi bi-book text-muted" style="font-size: 3rem;"></i>
        <h4 class="mt-3">No Moot Court Programs Yet</h4>
        <p class="text-muted">Create your first moot court program to get started.</p>
        <a href="{{ route('admin.moot-programs.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Create Moot Program
        </a>
    </div>
</div>
@endif
@endsection
