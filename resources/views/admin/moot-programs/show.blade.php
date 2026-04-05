@extends('admin.layouts.app')

@section('title', $moot->name_en)

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.index') }}">Moot Programs</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $moot->name_en }}</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center gap-3">
            @if($moot->logo_path)
            <img src="{{ asset($moot->logo_path) }}" alt="{{ $moot->name_en }}" 
                 style="width: 60px; height: 60px; object-fit: contain; border-radius: 8px;">
            @endif
            <div>
                <h1>{{ $moot->name_en }}
                    @if($moot->acronym)
                    <span class="badge bg-secondary">{{ $moot->acronym }}</span>
                    @endif
                </h1>
            </div>
        </div>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('admin.moot-programs.edit', $moot->id) }}" class="btn btn-outline-secondary">
            <i class="bi bi-pencil"></i> Edit Program
        </a>
        <a href="{{ route('admin.moot-programs.participations.create', $moot->id) }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Year
        </a>
    </div>
</div>

@if($moot->description_en)
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Description</h5>
        <p class="card-text">{{ $moot->description_en }}</p>
        @if($moot->organizing_body_en)
        <p class="card-text"><small class="text-muted">Organized by: {{ $moot->organizing_body_en }}</small></p>
        @endif
    </div>
</div>
@endif

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Participations ({{ $moot->participations->count() }})</h5>
                @if($moot->first_participation_year)
                <span class="badge bg-primary">Since {{ $moot->first_participation_year }}</span>
                @endif
            </div>
            <div class="card-body">
                @if($moot->participations->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Year</th>
                                <th>Theme</th>
                                <th>Status</th>
                                <th>Teams</th>
                                <th>Activities</th>
                                <th>Published</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($moot->participations as $participation)
                            <tr>
                                <td><strong>{{ $participation->year }}</strong></td>
                                <td>{{ $participation->theme_en ?? '-' }}</td>
                                <td>
                                    @switch($participation->status)
                                        @case('planning')
                                            <span class="badge bg-secondary">Planning</span>
                                            @break
                                        @case('preparing')
                                            <span class="badge bg-info">Preparing</span>
                                            @break
                                        @case('ongoing')
                                            <span class="badge bg-success">Ongoing</span>
                                            @break
                                        @case('completed')
                                            <span class="badge bg-primary">Completed</span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge bg-danger">Cancelled</span>
                                            @break
                                    @endswitch
                                </td>
                                <td>{{ $participation->teams->count() }}</td>
                                <td>{{ $participation->activities->count() }}</td>
                                <td>
                                    @if($participation->is_published)
                                    <span class="badge bg-success"><i class="bi bi-check-circle"></i> Yes</span>
                                    @else
                                    <span class="badge bg-secondary">No</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.moot-programs.participations.show', [$moot->id, $participation->id]) }}" 
                                           class="btn btn-outline-primary" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.moot-programs.participations.edit', [$moot->id, $participation->id]) }}" 
                                           class="btn btn-outline-secondary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.moot-programs.participations.destroy', [$moot->id, $participation->id]) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Delete" 
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <i class="bi bi-calendar text-muted" style="font-size: 2rem;"></i>
                    <p class="mt-2 text-muted">No participation records yet.</p>
                    <a href="{{ route('admin.moot-programs.participations.create', $moot->id) }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add First Year
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
