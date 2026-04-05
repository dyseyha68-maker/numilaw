@extends('admin.layouts.app')

@section('title', 'Create Moot Court')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Create Moot Court</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.moot-courts.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.moot-courts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title_en" class="form-label">Title (English) *</label>
                    <input type="text" name="title_en" id="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ old('title_en') }}" required>
                    @error('title_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="title_km" class="form-label">Title (Khmer) *</label>
                    <input type="text" name="title_km" id="title_km" class="form-control @error('title_km') is-invalid @enderror" value="{{ old('title_km') }}" required>
                    @error('title_km')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="organizer_name" class="form-label">Organizer Name *</label>
                    <input type="text" name="organizer_name" id="organizer_name" class="form-control @error('organizer_name') is-invalid @enderror" value="{{ old('organizer_name') }}" placeholder="Enter organizer name" required>
                    @error('organizer_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="upcoming">Upcoming</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="competition_date" class="form-label">Competition Date *</label>
                    <input type="date" name="competition_date" id="competition_date" class="form-control @error('competition_date') is-invalid @enderror" value="{{ old('competition_date') }}" required>
                    @error('competition_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="registration_deadline" class="form-label">Registration Deadline</label>
                    <input type="datetime-local" name="registration_deadline" id="registration_deadline" class="form-control" value="{{ old('registration_deadline') }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location *</label>
                <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" required>
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="featured_image" class="form-label">Featured Image</label>
                <input type="file" name="featured_image" id="featured_image" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="document_pdf" class="form-label">Case Document (PDF)</label>
                <input type="file" name="document_pdf" id="document_pdf" class="form-control" accept="application/pdf">
            </div>

            <div class="mb-3">
                <label for="case_summary_en" class="form-label">Case Summary (English)</label>
                <textarea name="case_summary_en" id="case_summary_en" class="form-control summernote" rows="4">{{ old('case_summary_en') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="case_summary_km" class="form-label">Case Summary (Khmer)</label>
                <textarea name="case_summary_km" id="case_summary_km" class="form-control summernote" rows="4">{{ old('case_summary_km') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="case_details_en" class="form-label">Case Details (English)</label>
                <textarea name="case_details_en" id="case_details_en" class="form-control summernote" rows="6">{{ old('case_details_en') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="case_details_km" class="form-label">Case Details (Khmer)</label>
                <textarea name="case_details_km" id="case_details_km" class="form-control summernote" rows="6">{{ old('case_details_km') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="rules_en" class="form-label">Rules (English)</label>
                <textarea name="rules_en" id="rules_en" class="form-control summernote" rows="4">{{ old('rules_en') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="rules_km" class="form-label">Rules (Khmer)</label>
                <textarea name="rules_km" id="rules_km" class="form-control summernote" rows="4">{{ old('rules_km') }}</textarea>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Create Moot Court</button>
            </div>
        </form>
    </div>
</div>
@endsection
