@extends('admin.layouts.app')

@section('title', 'Create About Section')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Create About Section</h2>
        <a href="{{ route('admin.about.sections.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>

    <form action="{{ route('admin.about.sections.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Section Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="title_en" class="form-label">Title (English) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title_en') is-invalid @enderror" 
                                       id="title_en" name="title_en" value="{{ old('title_en') }}" required>
                                @error('title_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="title_km" class="form-label">Title (Khmer) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title_km') is-invalid @enderror" 
                                       id="title_km" name="title_km" value="{{ old('title_km') }}" required>
                                @error('title_km')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="type" class="form-label">Section Type <span class="text-danger">*</span></label>
                                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                    <option value="">Select Type</option>
                                    <option value="overview" {{ old('type') == 'overview' ? 'selected' : '' }}>Overview</option>
                                    <option value="mission" {{ old('type') == 'mission' ? 'selected' : '' }}>Mission</option>
                                    <option value="vision" {{ old('type') == 'vision' ? 'selected' : '' }}>Vision</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="content_en" class="form-label">Content (English) <span class="text-danger">*</span></label>
                                <textarea class="form-control summernote @error('content_en') is-invalid @enderror" 
                                          id="content_en" name="content_en" rows="6" required>{{ old('content_en') }}</textarea>
                                @error('content_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="content_km" class="form-label">Content (Khmer) <span class="text-danger">*</span></label>
                                <textarea class="form-control summernote @error('content_km') is-invalid @enderror" 
                                          id="content_km" name="content_km" rows="6" required>{{ old('content_km') }}</textarea>
                                @error('content_km')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <i class="fas fa-save me-1"></i> Create
                    </button>
                    <a href="{{ route('admin.about.sections.index') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
