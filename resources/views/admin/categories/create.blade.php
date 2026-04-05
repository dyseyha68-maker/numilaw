@extends('admin.layouts.app')

@section('title', 'Create Category')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Create Category</h1>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Categories
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name_en" class="form-label">Name (English) *</label>
                            <input type="text" class="form-control @error('name_en') is-invalid @enderror" 
                                   id="name_en" name="name_en" value="{{ old('name_en') }}" required>
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="name_km" class="form-label">Name (Khmer) *</label>
                            <input type="text" class="form-control @error('name_km') is-invalid @enderror" 
                                   id="name_km" name="name_km" value="{{ old('name_km') }}" required>
                            @error('name_km')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12">
                            <label for="description_en" class="form-label">Description (English)</label>
                            <textarea class="form-control summernote @error('description_en') is-invalid @enderror" 
                                      id="description_en" name="description_en" rows="3">{{ old('description_en') }}</textarea>
                            @error('description_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12">
                            <label for="description_km" class="form-label">Description (Khmer)</label>
                            <textarea class="form-control summernote @error('description_km') is-invalid @enderror" 
                                      id="description_km" name="description_km" rows="3">{{ old('description_km') }}</textarea>
                            @error('description_km')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Create Category
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Help</h6>
            </div>
            <div class="card-body">
                <p class="small text-muted">
                    Categories help organize your articles and content. Each category can have:
                </p>
                <ul class="small text-muted">
                    <li>Bilingual names (English & Khmer)</li>
                    <li>Optional descriptions</li>
                    <li>Active/inactive status</li>
                    <li>Multiple articles</li>
                </ul>
                <p class="small text-muted">
                    The slug will be automatically generated from the English name.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection