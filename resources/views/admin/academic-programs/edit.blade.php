@extends('admin.layouts.app')

@section('title', 'Edit Academic Program: ' . $academicProgram->title_en)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Edit Academic Program</h1>
        <p class="text-muted mb-0">Update program information</p>
    </div>
    <a href="{{ route('admin.academic-programs.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i> Back
    </a>
</div>

<form method="POST" action="{{ route('admin.academic-programs.update', $academicProgram) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Basic Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Title (English) *</label>
                    <input type="text" name="title_en" class="form-control" value="{{ old('title_en', $academicProgram->title_en) }}" required>
                    @error('title_en') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Title (Khmer) *</label>
                    <input type="text" name="title_km" class="form-control" value="{{ old('title_km', $academicProgram->title_km) }}" required>
                    @error('title_km') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Degree Type *</label>
                    <input type="text" name="degree_type" class="form-control" value="{{ old('degree_type', $academicProgram->degree_type) }}" required>
                    @error('degree_type') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Duration (Years) *</label>
                    <input type="number" name="duration_years" class="form-control" value="{{ old('duration_years', $academicProgram->duration_years) }}" min="1" max="10" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Credits Required *</label>
                    <input type="text" name="credits_required" class="form-control" value="{{ old('credits_required', $academicProgram->credits_required) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tuition Fee ($)</label>
                    <input type="number" name="tuition_fee" class="form-control" value="{{ old('tuition_fee', $academicProgram->tuition_fee) }}" step="0.01" min="0">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $academicProgram->sort_order) }}" min="0">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Featured Image</label>
                    <input type="file" name="featured_image" class="form-control" accept="image/*">
                    @if($academicProgram->featured_image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $academicProgram->featured_image) }}" alt="Current Image" style="max-width: 200px;">
                            <p class="text-muted small">Current image - upload new to replace</p>
                        </div>
                    @endif
                    @error('featured_image') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Description</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Description (English) *</label>
                    <textarea name="description_en" class="form-control summernote" rows="5" required>{{ old('description_en', $academicProgram->description_en) }}</textarea>
                    @error('description_en') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Description (Khmer) *</label>
                    <textarea name="description_km" class="form-control summernote" rows="5" required>{{ old('description_km', $academicProgram->description_km) }}</textarea>
                    @error('description_km') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Admission Requirements</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Admission Requirements (English)</label>
                    <textarea name="admission_requirements_en" class="form-control summernote" rows="4">{{ old('admission_requirements_en', $academicProgram->admission_requirements_en) }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Admission Requirements (Khmer)</label>
                    <textarea name="admission_requirements_km" class="form-control summernote" rows="4">{{ old('admission_requirements_km', $academicProgram->admission_requirements_km) }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Curriculum</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Curriculum (English)</label>
                    <textarea name="curriculum_en" class="form-control summernote" rows="4">{{ old('curriculum_en', $academicProgram->curriculum_en) }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Curriculum (Khmer)</label>
                    <textarea name="curriculum_km" class="form-control summernote" rows="4">{{ old('curriculum_km', $academicProgram->curriculum_km) }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ old('is_active', $academicProgram->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                    Active
                </label>
            </div>
        </div>
    </div>

    <div class="d-flex gap-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-circle me-2"></i> Update Program
        </button>
        <a href="{{ route('admin.academic-programs.index') }}" class="btn btn-secondary">
            Cancel
        </a>
    </div>
</form>
@endsection
