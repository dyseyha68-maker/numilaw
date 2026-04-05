@extends('admin.layouts.app')

@section('title', 'Add Team')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.index') }}">Moot Programs</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.show', $moot->id) }}">{{ $moot->name_en }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.participations.show', [$moot->id, $participation->id]) }}">{{ $participation->year }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Team</li>
            </ol>
        </nav>
        <h1>Add Team</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.moot-programs.participations.show', [$moot->id, $participation->id]) }}" 
           class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.moot-programs.teams.store', [$moot->id, $participation->id]) }}" 
              method="POST">
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="team_name" class="form-label">Team Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('team_name') is-invalid @enderror" 
                           id="team_name" name="team_name" value="{{ old('team_name') }}" required>
                    @error('team_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="team_name_local" class="form-label">Team Name (Local)</label>
                    <input type="text" class="form-control" id="team_name_local" name="team_name_local" 
                           value="{{ old('team_name_local') }}">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="coach_name" class="form-label">Coach Name</label>
                    <input type="text" class="form-control" id="coach_name" name="coach_name" 
                           value="{{ old('coach_name') }}">
                </div>
                <div class="col-md-6">
                    <label for="coach_email" class="form-label">Coach Email</label>
                    <input type="email" class="form-control" id="coach_email" name="coach_email" 
                           value="{{ old('coach_email') }}">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="team_type" class="form-label">Team Type</label>
                    <select class="form-select" id="team_type" name="team_type">
                        @foreach(\App\Models\MootTeam::getTeamTypes() as $value => $label)
                        <option value="{{ $value }}" {{ old('team_type', 'main') == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="round_reached" class="form-label">Round Reached</label>
                    <select class="form-select" id="round_reached" name="round_reached">
                        <option value="">Not applicable</option>
                        @foreach(\App\Models\MootTeam::getRoundNames() as $value => $label)
                        <option value="{{ $value }}" {{ old('round_reached') == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="result_en" class="form-label">Result (English)</label>
                    <input type="text" class="form-control" id="result_en" name="result_en" 
                           value="{{ old('result_en') }}">
                </div>
                <div class="col-md-6">
                    <label for="result_km" class="form-label">Result (Khmer)</label>
                    <input type="text" class="form-control" id="result_km" name="result_km" 
                           value="{{ old('result_km') }}">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="awards_en" class="form-label">Awards (English)</label>
                    <input type="text" class="form-control" id="awards_en" name="awards_en" 
                           value="{{ old('awards_en') }}" placeholder="e.g., Best Oralist">
                </div>
                <div class="col-md-6">
                    <label for="awards_km" class="form-label">Awards (Khmer)</label>
                    <input type="text" class="form-control" id="awards_km" name="awards_km" 
                           value="{{ old('awards_km') }}">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control note-editable" id="notes" name="notes" rows="2">{{ old('notes') }}</textarea>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Create Team
                    </button>
                    <a href="{{ route('admin.moot-programs.participations.show', [$moot->id, $participation->id]) }}" 
                       class="btn btn-outline-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
