@extends('admin.layouts.app')

@section('title', 'Add Participation Year')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.index') }}">Moot Programs</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.show', $moot->id) }}">{{ $moot->name_en }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Year</li>
            </ol>
        </nav>
        <h1>Add {{ $moot->name_en }} Participation</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.moot-programs.show', $moot->id) }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.moot-programs.participations.store', $moot->id) }}" method="POST">
            @csrf
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <h5 class="border-bottom pb-2">Year Selection</h5>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="year" class="form-label">Competition Year <span class="text-danger">*</span></label>
                    <select class="form-select @error('year') is-invalid @enderror" id="year" name="year" required>
                        <option value="">Select Year</option>
                        @foreach($availableYears as $year)
                        <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                    @error('year')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Each year creates a new participation record. Previous years cannot be edited.</div>
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="planning" {{ old('status') == 'planning' ? 'selected' : '' }}>Planning</option>
                        <option value="registration_open" {{ old('status') == 'registration_open' ? 'selected' : '' }}>Registration Open</option>
                        <option value="preparing" {{ old('status') == 'preparing' ? 'selected' : '' }}>Preparing</option>
                        <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
            </div>
            
            <div class="row mb-4 mt-4">
                <div class="col-md-12">
                    <h5 class="border-bottom pb-2">Competition Details</h5>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="theme_en" class="form-label">Theme (English)</label>
                    <input type="text" class="form-control" id="theme_en" name="theme_en" 
                           value="{{ old('theme_en') }}" placeholder="e.g., International Trade Law">
                </div>
                <div class="col-md-6">
                    <label for="theme_km" class="form-label">Theme (Khmer)</label>
                    <input type="text" class="form-control" id="theme_km" name="theme_km" 
                           value="{{ old('theme_km') }}">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="case_problem_en" class="form-label">Case Problem (English)</label>
                    <textarea class="form-control note-editable" id="case_problem_en" name="case_problem_en" rows="3">{{ old('case_problem_en') }}</textarea>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="case_problem_km" class="form-label">Case Problem (Khmer)</label>
                    <textarea class="form-control note-editable" id="case_problem_km" name="case_problem_km" rows="3">{{ old('case_problem_km') }}</textarea>
                </div>
            </div>
            
            <div class="row mb-4 mt-4">
                <div class="col-md-12">
                    <h5 class="border-bottom pb-2">Competition Dates & Venue</h5>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="competition_start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="competition_start_date" 
                           name="competition_start_date" value="{{ old('competition_start_date') }}">
                </div>
                <div class="col-md-4">
                    <label for="competition_end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="competition_end_date" 
                           name="competition_end_date" value="{{ old('competition_end_date') }}">
                </div>
                <div class="col-md-4">
                    <label for="venue" class="form-label">Venue</label>
                    <input type="text" class="form-control" id="venue" name="venue" 
                           value="{{ old('venue') }}" placeholder="e.g., Washington D.C., USA">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="host_city" class="form-label">Host City</label>
                    <input type="text" class="form-control" id="host_city" name="host_city" 
                           value="{{ old('host_city') }}">
                </div>
                <div class="col-md-6">
                    <label for="host_country" class="form-label">Host Country</label>
                    <input type="text" class="form-control" id="host_country" name="host_country" 
                           value="{{ old('host_country') }}">
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Create Participation
                    </button>
                    <a href="{{ route('admin.moot-programs.show', $moot->id) }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
