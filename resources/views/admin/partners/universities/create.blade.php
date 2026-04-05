@extends('admin.layouts.app')

@section('title', __('partner.admin.add_university'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">{{ __('partner.admin.add_university') }}</h4>
    <a href="{{ route('admin.partners.universities.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> {{ __('partner.form.cancel') }}
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.partners.universities.store') }}" method="POST" 
              enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('partner.admin.university_name') }} *</label>
                    <input type="text" name="name" class="form-control" required 
                           value="{{ old('name') }}">
                    @error('name')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('partner.admin.country') }} *</label>
                    <input type="text" name="country" class="form-control" required 
                           value="{{ old('country') }}">
                    @error('country')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('partner.admin.faculty_school') }} *</label>
                    <input type="text" name="faculty_or_school" class="form-control" required 
                           value="{{ old('faculty_or_school') }}" placeholder="e.g., Faculty of Law">
                    @error('faculty_or_school')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('partner.admin.official_website') }}</label>
                    <input type="url" name="official_website" class="form-control" 
                           value="{{ old('official_website') }}" placeholder="https://...">
                    @error('official_website')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">{{ __('partner.admin.logo') }}</label>
                <input type="file" name="logo" class="form-control" accept="image/*">
                <small class="text-muted">Accepted formats: JPEG, PNG, JPG, GIF, SVG (Max 2MB)</small>
                @error('logo')
                <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">{{ __('partner.admin.description') }}</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                @error('description')
                <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label class="form-label">{{ __('partner.admin.status') }} *</label>
                <select name="status" class="form-select" required>
                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>{{ __('partner.status.active') }}</option>
                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>{{ __('partner.status.inactive') }}</option>
                </select>
                @error('status')
                <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> {{ __('partner.admin.add_university') }}
                </button>
                <a href="{{ route('admin.partners.universities.index') }}" class="btn btn-outline-secondary">
                    {{ __('partner.form.cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
