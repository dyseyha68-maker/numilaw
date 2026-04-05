@extends('admin.layouts.app')

@section('title', 'Edit Hero Image - ' . $heroImage->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.hero-images.index') }}" class="btn btn-outline-secondary btn-sm mb-2">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
        <h4 class="fw-bold mb-0">Edit Hero Image</h4>
        <small class="text-muted">{{ $heroImage->title }}</small>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.hero-images.update', $heroImage->id) }}" method="POST" 
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" 
                               value="{{ old('title', $heroImage->title) }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Upload Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Recommended size: 1920x600px (or similar ratio). Max 5MB.</small>
                        @error('image')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Or Use External Image URL</label>
                        <input type="url" name="default_image" class="form-control" 
                               value="{{ old('default_image', $heroImage->default_image) }}" 
                               placeholder="https://example.com/image.jpg">
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" 
                                   value="1" {{ $heroImage->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i> Save Changes
                        </button>
                        <a href="{{ route('admin.hero-images.index') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Current Image</h5>
            </div>
            <div class="card-body text-center">
                @if($heroImage->image)
                    <img src="{{ asset($heroImage->image) }}" alt="{{ $heroImage->title }}" 
                         class="img-fluid rounded" style="max-height: 200px; object-fit: cover;">
                    <form action="{{ route('admin.hero-images.destroy-image', $heroImage->id) }}" 
                          method="POST" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Remove this image?')">
                            <i class="bi bi-trash me-1"></i> Remove Image
                        </button>
                    </form>
                @elseif($heroImage->default_image)
                    <img src="{{ $heroImage->default_image }}" alt="{{ $heroImage->title }}" 
                         class="img-fluid rounded" style="max-height: 200px; object-fit: cover;">
                @else
                    <div class="py-5">
                        <i class="bi bi-image text-muted d-block mb-2" style="font-size: 3rem;"></i>
                        <p class="text-muted mb-0">No image uploaded</p>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="card border-0 shadow-sm mt-3">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Preview</h5>
            </div>
            <div class="card-body p-0">
                <div style="height: 150px; overflow: hidden; border-radius: 8px;">
                    @if($heroImage->image)
                        <img src="{{ asset($heroImage->image) }}" alt="Preview" 
                             class="w-100 h-100" style="object-fit: cover;">
                    @elseif($heroImage->default_image)
                        <img src="{{ $heroImage->default_image }}" alt="Preview" 
                             class="w-100 h-100" style="object-fit: cover;">
                    @else
                        <div class="h-100 d-flex align-items-center justify-content-center bg-light">
                            <span class="text-muted">No preview available</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
