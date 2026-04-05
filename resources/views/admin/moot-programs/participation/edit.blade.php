@extends('admin.layouts.app')

@section('title', 'Edit: ' . $moot->name_en . ' ' . $participation->year)

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.index') }}">Moot Programs</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.show', $moot->id) }}">{{ $moot->name_en }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.participations.show', [$moot->id, $participation->id]) }}">{{ $participation->year }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <h1>Edit {{ $moot->name_en }} {{ $participation->year }}</h1>
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
        <form action="{{ route('admin.moot-programs.participations.update', [$moot->id, $participation->id]) }}" 
              method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <h5 class="border-bottom pb-2">Competition Details</h5>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="planning" {{ $participation->status == 'planning' ? 'selected' : '' }}>Planning</option>
                        <option value="registration_open" {{ $participation->status == 'registration_open' ? 'selected' : '' }}>Registration Open</option>
                        <option value="preparing" {{ $participation->status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                        <option value="ongoing" {{ $participation->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ $participation->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $participation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="competition_start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="competition_start_date" 
                           name="competition_start_date" value="{{ old('competition_start_date', $participation->competition_start_date?->format('Y-m-d')) }}">
                </div>
                <div class="col-md-4">
                    <label for="competition_end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="competition_end_date" 
                           name="competition_end_date" value="{{ old('competition_end_date', $participation->competition_end_date?->format('Y-m-d')) }}">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="theme_en" class="form-label">Theme (English)</label>
                    <input type="text" class="form-control" id="theme_en" name="theme_en" 
                           value="{{ old('theme_en', $participation->theme_en) }}">
                </div>
                <div class="col-md-6">
                    <label for="theme_km" class="form-label">Theme (Khmer)</label>
                    <input type="text" class="form-control" id="theme_km" name="theme_km" 
                           value="{{ old('theme_km', $participation->theme_km) }}">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="case_problem_en" class="form-label">Case Problem (English)</label>
                    <textarea class="form-control note-editable" id="case_problem_en" name="case_problem_en" rows="3">{{ old('case_problem_en', $participation->case_problem_en) }}</textarea>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="case_problem_km" class="form-label">Case Problem (Khmer)</label>
                    <textarea class="form-control note-editable" id="case_problem_km" name="case_problem_km" rows="3">{{ old('case_problem_km', $participation->case_problem_km) }}</textarea>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="venue" class="form-label">Venue</label>
                    <input type="text" class="form-control" id="venue" name="venue" 
                           value="{{ old('venue', $participation->venue) }}">
                </div>
                <div class="col-md-4">
                    <label for="host_city" class="form-label">Host City</label>
                    <input type="text" class="form-control" id="host_city" name="host_city" 
                           value="{{ old('host_city', $participation->host_city) }}">
                </div>
                <div class="col-md-4">
                    <label for="host_country" class="form-label">Host Country</label>
                    <input type="text" class="form-control" id="host_country" name="host_country" 
                           value="{{ old('host_country', $participation->host_country) }}">
                </div>
            </div>
            
            <div class="row mb-4 mt-4">
                <div class="col-md-12">
                    <h5 class="border-bottom pb-2">Summary</h5>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="summary_en" class="form-label">Summary (English)</label>
                    <textarea class="form-control note-editable" id="summary_en" name="summary_en" rows="4">{{ old('summary_en', $participation->summary_en) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="summary_km" class="form-label">Summary (Khmer)</label>
                    <textarea class="form-control note-editable" id="summary_km" name="summary_km" rows="4">{{ old('summary_km', $participation->summary_km) }}</textarea>
                </div>
            </div>
            
            <div class="row mb-4 mt-4">
                <div class="col-md-12">
                    <h5 class="border-bottom pb-2">Results & Achievements</h5>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="result_en" class="form-label">Result (English)</label>
                    <input type="text" class="form-control" id="result_en" name="result_en" 
                           value="{{ old('result_en', $participation->result_en) }}" 
                           placeholder="e.g., Quarterfinalist, 8th Place">
                </div>
                <div class="col-md-6">
                    <label for="result_km" class="form-label">Result (Khmer)</label>
                    <input type="text" class="form-control" id="result_km" name="result_km" 
                           value="{{ old('result_km', $participation->result_km) }}">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="achievements_en" class="form-label">Achievements (English)</label>
                    <textarea class="form-control note-editable" id="achievements_en" name="achievements_en" rows="3"
                              placeholder="e.g., Best Oralist, Best Memorial">{{ old('achievements_en', $participation->achievements_en) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="achievements_km" class="form-label">Achievements (Khmer)</label>
                    <textarea class="form-control note-editable" id="achievements_km" name="achievements_km" rows="3">{{ old('achievements_km', $participation->achievements_km) }}</textarea>
                </div>
            </div>
            
            <div class="row mb-4 mt-4">
                <div class="col-md-12">
                    <h5 class="border-bottom pb-2">Visibility</h5>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_published" 
                               name="is_published" value="1" {{ $participation->is_published ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_published">Published (Visible on public site)</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_featured" 
                               name="is_featured" value="1" {{ $participation->is_featured ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">Featured</label>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Update Participation
                    </button>
                    <a href="{{ route('admin.moot-programs.participations.show', [$moot->id, $participation->id]) }}" 
                       class="btn btn-outline-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
