@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Edit Category</h1>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Categories
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name_en" class="form-label">Name (English) *</label>
                            <input type="text" class="form-control @error('name_en') is-invalid @enderror" 
                                   id="name_en" name="name_en" value="{{ old('name_en', $category->name_en) }}" required>
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="name_km" class="form-label">Name (Khmer) *</label>
                            <input type="text" class="form-control @error('name_km') is-invalid @enderror" 
                                   id="name_km" name="name_km" value="{{ old('name_km', $category->name_km) }}" required>
                            @error('name_km')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12">
                            <label for="description_en" class="form-label">Description (English)</label>
                            <textarea class="form-control summernote @error('description_en') is-invalid @enderror" 
                                      id="description_en" name="description_en" rows="3">{{ old('description_en', $category->description_en) }}</textarea>
                            @error('description_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12">
                            <label for="description_km" class="form-label">Description (Khmer)</label>
                            <textarea class="form-control @error('description_km') is-invalid @enderror" 
                                      id="description_km" name="description_km" rows="3">{{ old('description_km', $category->description_km) }}</textarea>
                            @error('description_km')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                       {{ $category->is_active ? 'checked' : '' }}>
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
                                <div>
                                    <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-outline-info me-2">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle"></i> Update Category
                                    </button>
                                </div>
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
                <h6 class="mb-0">Category Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label text-muted">Slug</label>
                    <p class="form-control-plaintext">{{ $category->slug }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted">Created</label>
                    <p class="form-control-plaintext">{{ $category->created_at->format('M j, Y g:i A') }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted">Last Updated</label>
                    <p class="form-control-plaintext">{{ $category->updated_at->format('M j, Y g:i A') }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted">Articles Count</label>
                    <p class="form-control-plaintext">{{ $category->articles->count() }} articles</p>
                </div>
            </div>
        </div>
        
        @if($category->articles->count() > 0)
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Warning</h6>
            </div>
            <div class="card-body">
                <p class="small text-danger">
                    <i class="bi bi-exclamation-triangle"></i> This category has {{ $category->articles->count() }} associated article(s). 
                    If you deactivate this category, the articles will still exist but won't be categorized.
                </p>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection