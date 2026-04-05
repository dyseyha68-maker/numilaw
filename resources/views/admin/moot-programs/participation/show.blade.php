@extends('admin.layouts.app')

@section('title', $moot->name_en . ' ' . $participation->year)

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.index') }}">Moot Programs</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.show', $moot->id) }}">{{ $moot->name_en }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $participation->year }}</li>
            </ol>
        </nav>
        <h1>{{ $moot->name_en }} {{ $participation->year }}
            @switch($participation->status)
                @case('planning')
                    <span class="badge bg-secondary">Planning</span>
                    @break
                @case('registration_open')
                    <span class="badge bg-success">Registration Open</span>
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
        </h1>
    </div>
    <div class="col-md-4 text-end">
        <div class="btn-group">
            <a href="{{ route('admin.moot-programs.participations.edit', [$moot->id, $participation->id]) }}" 
               class="btn btn-outline-secondary">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <form action="{{ route('admin.moot-programs.participations.toggle-publish', [$moot->id, $participation->id]) }}" 
                  method="POST" class="d-inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn {{ $participation->is_published ? 'btn-warning' : 'btn-success' }}">
                    <i class="bi {{ $participation->is_published ? 'bi-eye-slash' : 'bi-eye' }}"></i>
                    {{ $participation->is_published ? 'Unpublish' : 'Publish' }}
                </button>
            </form>
        </div>
    </div>
</div>

@if($participation->theme_en || $participation->venue)
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            @if($participation->theme_en)
            <div class="col-md-6">
                <h6 class="text-muted mb-1">Theme</h6>
                <p class="mb-0">{{ $participation->theme_en }}</p>
            </div>
            @endif
            @if($participation->venue)
            <div class="col-md-3">
                <h6 class="text-muted mb-1">Venue</h6>
                <p class="mb-0">{{ $participation->venue }}</p>
            </div>
            @endif
            @if($participation->host_country)
            <div class="col-md-3">
                <h6 class="text-muted mb-1">Host Country</h6>
                <p class="mb-0">{{ $participation->host_country }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endif

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-list-task"></i> Activities Timeline</h5>
                <a href="{{ route('admin.moot-programs.activities.create', [$moot->id, $participation->id]) }}" 
                   class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-circle"></i> Add Activity
                </a>
            </div>
            <div class="card-body">
                @if($participation->activities->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover" id="activitiesTable">
                        <thead>
                            <tr>
                                <th width="60">Order</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($participation->activities->sortBy('order') as $activity)
                            <tr data-id="{{ $activity->id }}">
                                <td>{{ $activity->order + 1 }}</td>
                                <td>{{ $activity->title_en }}</td>
                                <td>
                                    @switch($activity->activity_type)
                                        @case('training')
                                            <span class="badge bg-info">Training</span>
                                            @break
                                        @case('submission')
                                            <span class="badge bg-warning">Submission</span>
                                            @break
                                        @case('preliminary')
                                            <span class="badge bg-primary">Preliminary</span>
                                            @break
                                        @case('quarterfinal')
                                            <span class="badge bg-primary">Quarterfinal</span>
                                            @break
                                        @case('semifinal')
                                            <span class="badge bg-primary">Semifinal</span>
                                            @break
                                        @case('final')
                                            <span class="badge bg-success">Final</span>
                                            @break
                                        @case('ceremony')
                                            <span class="badge bg-secondary">Ceremony</span>
                                            @break
                                        @case('announcement')
                                            <span class="badge bg-dark">Announcement</span>
                                            @break
                                        @case('meeting')
                                            <span class="badge bg-light text-dark">Meeting</span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary">Other</span>
                                    @endswitch
                                </td>
                                <td>{{ $activity->activity_date?->format('M d, Y') ?? '-' }}</td>
                                <td>
                                    @if($activity->is_completed)
                                    <span class="badge bg-success"><i class="bi bi-check-circle"></i> Completed</span>
                                    @else
                                    <span class="badge bg-secondary">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.moot-programs.activities.edit', [$moot->id, $participation->id, $activity->id]) }}" 
                                           class="btn btn-outline-secondary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.moot-programs.activities.destroy', [$moot->id, $participation->id, $activity->id]) }}" 
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
                    <p class="mt-2 text-muted">No activities added yet.</p>
                    <a href="{{ route('admin.moot-programs.activities.create', [$moot->id, $participation->id]) }}" 
                       class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add First Activity
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-people"></i> Teams</h5>
                <a href="{{ route('admin.moot-programs.teams.create', [$moot->id, $participation->id]) }}" 
                   class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-circle"></i> Add Team
                </a>
            </div>
            <div class="card-body">
                @if($participation->teams->count() > 0)
                <div class="row g-3">
                    @foreach($participation->teams as $team)
                    <div class="col-md-6">
                        <div class="border rounded p-3">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="mb-0">{{ $team->team_name }}</h6>
                                    @if($team->team_type !== 'main')
                                    <span class="badge bg-secondary">{{ $team->team_type }}</span>
                                    @endif
                                </div>
                                @if($team->round_reached)
                                <span class="badge bg-primary">
                                    {{ \App\Models\MootTeam::getRoundNames()[$team->round_reached] ?? 'Round ' . $team->round_reached }}
                                </span>
                                @endif
                            </div>
                            
                            @if($team->coach_name)
                            <p class="small text-muted mb-2"><i class="bi bi-person"></i> Coach: {{ $team->coach_name }}</p>
                            @endif
                            
                            <p class="small mb-2">
                                <strong>Members ({{ $team->members->count() }}):</strong>
                                {{ $team->members->pluck('name_en')->implode(', ') }}
                            </p>
                            
                            @if($team->awards_en)
                            <p class="small mb-2"><span class="badge bg-warning text-dark">{{ $team->awards_en }}</span></p>
                            @endif
                            
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.moot-programs.teams.edit', [$moot->id, $participation->id, $team->id]) }}" 
                                   class="btn btn-outline-secondary">
                                    <i class="bi bi-pencil"></i> Manage Members
                                </a>
                                <form action="{{ route('admin.moot-programs.teams.destroy', [$moot->id, $participation->id, $team->id]) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" 
                                            onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-4">
                    <i class="bi bi-people text-muted" style="font-size: 2rem;"></i>
                    <p class="mt-2 text-muted">No teams added yet.</p>
                    <a href="{{ route('admin.moot-programs.teams.create', [$moot->id, $participation->id]) }}" 
                       class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add First Team
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($participation->result_en || $participation->achievements_en)
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card border-success">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Results & Achievements</h5>
            </div>
            <div class="card-body">
                @if($participation->result_en)
                <h6>Result</h6>
                <p>{{ $participation->result_en }}</p>
                @endif
                @if($participation->achievements_en)
                <h6>Achievements</h6>
                <p>{{ $participation->achievements_en }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
@endsection
