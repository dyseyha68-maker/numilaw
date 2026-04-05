@extends('admin.layouts.app')

@section('title', 'Create Application')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Create Application</h1>
        <p class="text-muted mb-0">Manually add a new application</p>
    </div>
    <a href="{{ route('admin.applications.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i> Back
    </a>
</div>

<form method="POST" action="{{ route('admin.applications.store') }}">
    @csrf
    
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Program & Status</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Program *</label>
                    <select name="program_id" class="form-select" required>
                        <option value="">Select Program</option>
                        @foreach($programs as $program)
                            <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                {{ $program->title_en }}
                            </option>
                        @endforeach
                    </select>
                    @error('program_id') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="reviewing" {{ old('status') == 'reviewing' ? 'selected' : '' }}>Reviewing</option>
                        <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Personal Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">First Name (English) *</label>
                    <input type="text" name="first_name_en" class="form-control" value="{{ old('first_name_en') }}" required>
                    @error('first_name_en') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Last Name (English) *</label>
                    <input type="text" name="last_name_en" class="form-control" value="{{ old('last_name_en') }}" required>
                    @error('last_name_en') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">First Name (Khmer)</label>
                    <input type="text" name="first_name_km" class="form-control" value="{{ old('first_name_km') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Last Name (Khmer)</label>
                    <input type="text" name="last_name_km" class="form-control" value="{{ old('last_name_km') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone *</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                    @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Date of Birth *</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
                    @error('date_of_birth') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nationality *</label>
                    <input type="text" name="nationality" class="form-control" value="{{ old('nationality') }}" required>
                    @error('nationality') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Address *</label>
                    <textarea name="address" class="form-control" rows="2" required>{{ old('address') }}</textarea>
                    @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Educational Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">High School *</label>
                    <input type="text" name="high_school" class="form-control" value="{{ old('high_school') }}" required>
                    @error('high_school') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Graduation Year *</label>
                    <input type="number" name="graduation_year" class="form-control" value="{{ old('graduation_year') }}" min="1950" max="{{ date('Y') }}" required>
                    @error('graduation_year') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">GPA (0-4.0) *</label>
                    <input type="number" name="gpa" class="form-control" value="{{ old('gpa') }}" min="0" max="4" step="0.01" required>
                    @error('gpa') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">English Level *</label>
                    <select name="english_level" class="form-select" required>
                        <option value="">Select Level</option>
                        <option value="beginner" {{ old('english_level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="intermediate" {{ old('english_level') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                        <option value="advanced" {{ old('english_level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                        <option value="fluent" {{ old('english_level') == 'fluent' ? 'selected' : '' }}>Fluent</option>
                    </select>
                    @error('english_level') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Additional Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Motivation Letter *</label>
                    <textarea name="motivation_letter" class="form-control" rows="5" required>{{ old('motivation_letter') }}</textarea>
                    @error('motivation_letter') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Work Experience</label>
                    <textarea name="experience" class="form-control" rows="3">{{ old('experience') }}</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Achievements or Awards</label>
                    <textarea name="achievements" class="form-control" rows="3">{{ old('achievements') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Reference Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Reference Name *</label>
                    <input type="text" name="reference_name" class="form-control" value="{{ old('reference_name') }}" required>
                    @error('reference_name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Reference Email *</label>
                    <input type="email" name="reference_email" class="form-control" value="{{ old('reference_email') }}" required>
                    @error('reference_email') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Reference Phone *</label>
                    <input type="text" name="reference_phone" class="form-control" value="{{ old('reference_phone') }}" required>
                    @error('reference_phone') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex gap-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-circle me-2"></i> Create Application
        </button>
        <a href="{{ route('admin.applications.index') }}" class="btn btn-secondary">
            Cancel
        </a>
    </div>
</form>
@endsection
