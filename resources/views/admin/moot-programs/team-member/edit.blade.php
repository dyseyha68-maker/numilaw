@extends('admin.layouts.app')

@section('title', 'Edit Team Member')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.index') }}">Moot Programs</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.show', $moot->id) }}">{{ $moot->name_en }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.participations.show', [$moot->id, $participation->id]) }}">{{ $participation->year }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.teams.edit', [$moot->id, $participation->id, $team->id]) }}">{{ $team->team_name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Member</li>
            </ol>
        </nav>
        <h1>Edit Team Member</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.moot-programs.teams.edit', [$moot->id, $participation->id, $team->id]) }}" 
           class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.moot-programs.team-members.update', [$moot->id, $participation->id, $team->id, $member->id]) }}" 
              method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name_en" class="form-label">Name (English) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name_en') is-invalid @enderror" 
                           id="name_en" name="name_en" value="{{ old('name_en', $member->name_en) }}" required>
                    @error('name_en')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="name_km" class="form-label">Name (Khmer)</label>
                    <input type="text" class="form-control" id="name_km" name="name_km" 
                           value="{{ old('name_km', $member->name_km) }}">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="{{ old('email', $member->email) }}">
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" 
                           value="{{ old('phone', $member->phone) }}">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role">
                        @foreach(\App\Models\MootTeamMember::getRoles() as $value => $label)
                        <option value="{{ $value }}" {{ $member->role == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch mt-4">
                        <input class="form-check-input" type="checkbox" id="is_team_lead" 
                               name="is_team_lead" value="1" {{ $member->is_team_lead ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_team_lead">Team Lead</label>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Update Member
                    </button>
                    <a href="{{ route('admin.moot-programs.teams.edit', [$moot->id, $participation->id, $team->id]) }}" 
                       class="btn btn-outline-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
