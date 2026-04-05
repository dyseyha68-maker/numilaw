@extends('admin.layouts.app')

@section('title', isset($program) ? 'Edit Program' : 'Add Program')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 mb-0">{{ isset($program) ? 'Edit Program' : 'Add Program' }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ isset($program) ? route('admin.admissions.programs.update', $program->id) : route('admin.admissions.programs.store') }}">
                        @csrf
                        @if(isset($program))
                        @method('PUT')
                        @endif
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Name (English) *</label>
                                <input type="text" class="form-control" name="name_en" value="{{ $program->name_en ?? old('name_en') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Name (Khmer) *</label>
                                <input type="text" class="form-control" name="name_kh" value="{{ $program->name_kh ?? old('name_kh') }}" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Degree Level *</label>
                                <select class="form-select" name="degree_level" required>
                                    <option value="bachelor" {{ isset($program) && $program->degree_level == 'bachelor' ? 'selected' : '' }}>Bachelor</option>
                                    <option value="master" {{ isset($program) && $program->degree_level == 'master' ? 'selected' : '' }}>Master</option>
                                    <option value="doctorate" {{ isset($program) && $program->degree_level == 'doctorate' ? 'selected' : '' }}>Doctorate</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Duration (EN) *</label>
                                <input type="text" class="form-control" name="duration_en" value="{{ $program->duration_en ?? old('duration_en') }}" placeholder="e.g. 4 Years" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Duration (KH) *</label>
                                <input type="text" class="form-control" name="duration_kh" value="{{ $program->duration_kh ?? old('duration_kh') }}" placeholder="e.g. ៤ ឆ្នាំ" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Tuition (EN) *</label>
                                <input type="text" class="form-control" name="tuition_en" value="{{ $program->tuition_en ?? old('tuition_en') }}" placeholder="e.g. $800/year" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tuition (KH) *</label>
                                <input type="text" class="form-control" name="tuition_kh" value="{{ $program->tuition_kh ?? old('tuition_kh') }}" placeholder="e.g. $800/ឆ្នាំ" required>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label">Description (EN) *</label>
                                <textarea class="form-control" name="description_en" rows="3" required>{{ $program->description_en ?? old('description_en') }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Description (KH) *</label>
                                <textarea class="form-control" name="description_kh" rows="3" required>{{ $program->description_kh ?? old('description_kh') }}</textarea>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label">Requirements (EN) *</label>
                                <textarea class="form-control" name="requirements_en" rows="2" required>{{ $program->requirements_en ?? old('requirements_en') }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Requirements (KH) *</label>
                                <textarea class="form-control" name="requirements_kh" rows="2" required>{{ $program->requirements_kh ?? old('requirements_kh') }}</textarea>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="scholarship_available" value="1" {{ isset($program) && $program->scholarship_available ? 'checked' : '' }}>
                                    <label class="form-check-label">Scholarship Available</label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="is_active" value="1" {{ (!isset($program)) || $program->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label">Active</label>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary">{{ isset($program) ? 'Update' : 'Create' }}</button>
                                <a href="{{ route('admin.admissions.programs.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
