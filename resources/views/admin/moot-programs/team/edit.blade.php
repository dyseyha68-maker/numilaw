@extends('admin.layouts.app')

@section('title', 'Manage Team: ' . $team->team_name)

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.index') }}">Moot Programs</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.show', $moot->id) }}">{{ $moot->name_en }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.participations.show', [$moot->id, $participation->id]) }}">{{ $participation->year }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Team</li>
            </ol>
        </nav>
        <h1>Team: {{ $team->team_name }}</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.moot-programs.participations.show', [$moot->id, $participation->id]) }}" 
           class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-people"></i> Team Members</h5>
                <a href="{{ route('admin.moot-programs.team-members.create', [$moot->id, $participation->id, $team->id]) }}" 
                   class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-circle"></i> Add Member
                </a>
            </div>
            <div class="card-body">
                @if($team->members->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($team->members as $member)
                            <tr>
                                <td>
                                    {{ $member->name_en }}
                                    @if($member->is_team_lead)
                                    <span class="badge bg-warning text-dark ms-1">Lead</span>
                                    @endif
                                </td>
                                <td>
                                    @switch($member->role)
                                        @case('speaker')
                                            <span class="badge bg-primary">Speaker</span>
                                            @break
                                        @case('researcher')
                                            <span class="badge bg-info">Researcher</span>
                                            @break
                                        @case('reserve')
                                            <span class="badge bg-secondary">Reserve</span>
                                            @break
                                        @case('coach')
                                            <span class="badge bg-dark">Coach</span>
                                            @break
                                        @default
                                            <span class="badge bg-light text-dark">Observer</span>
                                    @endswitch
                                </td>
                                <td>{{ $member->email ?? '-' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.moot-programs.team-members.edit', [$moot->id, $participation->id, $team->id, $member->id]) }}" 
                                           class="btn btn-outline-secondary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.moot-programs.team-members.destroy', [$moot->id, $participation->id, $team->id, $member->id]) }}" 
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
                    <i class="bi bi-person-plus text-muted" style="font-size: 2rem;"></i>
                    <p class="mt-2 text-muted">No team members yet.</p>
                    <a href="{{ route('admin.moot-programs.team-members.create', [$moot->id, $participation->id, $team->id]) }}" 
                       class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add First Member
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Team Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.moot-programs.teams.update', [$moot->id, $participation->id, $team->id]) }}" 
                      method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="team_name" class="form-label">Team Name</label>
                        <input type="text" class="form-control" id="team_name" name="team_name" 
                               value="{{ old('team_name', $team->team_name) }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="coach_name" class="form-label">Coach Name</label>
                        <input type="text" class="form-control" id="coach_name" name="coach_name" 
                               value="{{ old('coach_name', $team->coach_name) }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="team_type" class="form-label">Team Type</label>
                        <select class="form-select" id="team_type" name="team_type">
                            @foreach(\App\Models\MootTeam::getTeamTypes() as $value => $label)
                            <option value="{{ $value }}" {{ $team->team_type == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="round_reached" class="form-label">Round Reached</label>
                        <select class="form-select" id="round_reached" name="round_reached">
                            <option value="">Not applicable</option>
                            @foreach(\App\Models\MootTeam::getRoundNames() as $value => $label)
                            <option value="{{ $value }}" {{ $team->round_reached == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="awards_en" class="form-label">Awards</label>
                        <input type="text" class="form-control" id="awards_en" name="awards_en" 
                               value="{{ old('awards_en', $team->awards_en) }}">
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-check-circle"></i> Update Team
                    </button>
                </form>
                
                <hr>
                
                <form action="{{ route('admin.moot-programs.teams.destroy', [$moot->id, $participation->id, $team->id]) }}" 
                      method="POST" class="d-inline w-100">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure? This will delete all team members.')">
                        <i class="bi bi-trash"></i> Delete Team
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
