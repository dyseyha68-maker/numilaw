@extends('admin.layouts.app')

@section('title', 'Create Moot Court Program')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Create Moot Court Program</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.moot-programs.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Programs
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.moot-programs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <h5 class="border-bottom pb-2">Basic Information</h5>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="logo" class="form-label">Logo Image</label>
                    <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                    <small class="text-muted">Recommended: 200x200px, PNG or JPG</small>
                    <div class="mt-2" id="logo-preview"></div>
                </div>
                <div class="col-md-8">
                    <label for="name_en" class="form-label">Program Name (English) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name_en') is-invalid @enderror" 
                           id="name_en" name="name_en" value="{{ old('name_en') }}" required>
                    @error('name_en')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
                <div class="col-md-6">
                    <label for="name_km" class="form-label">Program Name (Khmer) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name_km') is-invalid @enderror" 
                           id="name_km" name="name_km" value="{{ old('name_km') }}" required>
                    @error('name_km')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="short_name" class="form-label">Short Name</label>
                    <input type="text" class="form-control" id="short_name" name="short_name" 
                           value="{{ old('short_name') }}" placeholder="e.g., Jessup">
                </div>
                <div class="col-md-4">
                    <label for="acronym" class="form-label">Acronym</label>
                    <input type="text" class="form-control" id="acronym" name="acronym" 
                           value="{{ old('acronym') }}" placeholder="e.g., ILSA">
                </div>
                <div class="col-md-4">
                    <label for="first_participation_year" class="form-label">First Participation Year</label>
                    <input type="number" class="form-control" id="first_participation_year" 
                           name="first_participation_year" value="{{ old('first_participation_year') }}" 
                           min="1990" max="2100">
                </div>
            </div>
            
            <div class="row mb-4 mt-4">
                <div class="col-md-12">
                    <h5 class="border-bottom pb-2">Description</h5>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="description_en" class="form-label">Description (English)</label>
                    <textarea class="form-control note-editable" id="description_en" name="description_en" rows="4">{{ old('description_en') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="description_km" class="form-label">Description (Khmer)</label>
                    <textarea class="form-control note-editable" id="description_km" name="description_km" rows="4">{{ old('description_km') }}</textarea>
                </div>
            </div>
            
            <div class="row mb-4 mt-4">
                <div class="col-md-12">
                    <h5 class="border-bottom pb-2">Organizing Body</h5>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="organizing_body_en" class="form-label">Organizing Body (English)</label>
                    <input type="text" class="form-control" id="organizing_body_en" 
                           name="organizing_body_en" value="{{ old('organizing_body_en') }}">
                </div>
                <div class="col-md-6">
                    <label for="organizing_body_km" class="form-label">Organizing Body (Khmer)</label>
                    <input type="text" class="form-control" id="organizing_body_km" 
                           name="organizing_body_km" value="{{ old('organizing_body_km') }}">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="official_url" class="form-label">Official Website URL</label>
                    <input type="url" class="form-control" id="official_url" 
                           name="official_url" value="{{ old('official_url') }}" 
                           placeholder="https://">
                </div>
            </div>
            
            <div class="row mb-4 mt-4">
                <div class="col-md-12">
                    <h5 class="border-bottom pb-2">Settings</h5>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_active" 
                               name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_featured" 
                               name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">Featured</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="display_order" class="form-label">Display Order</label>
                    <input type="number" class="form-control" id="display_order" 
                           name="display_order" value="{{ old('display_order', 0) }}" min="0">
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Create Program
                    </button>
                    <a href="{{ route('admin.moot-programs.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
