@extends('admin.layouts.app')

@section('title', 'Create Tag')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Create Tag</h1>
    <a href="{{ route('admin.tags.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Tags
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.tags.store') }}">
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
                        
                        <div class="col-md-6">
                            <label for="color" class="form-label">Color</label>
                            <div class="input-group">
                                <input type="color" class="form-control form-control-color" 
                                       id="color" name="color" value="{{ old('color', '#6c757d') }}">
                                <input type="text" class="form-control" 
                                       id="color_text" name="color_text" value="{{ old('color', '#6c757d') }}"
                                       placeholder="#000000">
                            </div>
                            <small class="text-muted">Choose a color for the tag badge</small>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.tags.index') }}" class="btn btn-outline-secondary">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Create Tag
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
                    Tags help organize and categorize your articles. Each tag can have:
                </p>
                <ul class="small text-muted">
                    <li>Bilingual names (English & Khmer)</li>
                    <li>Optional descriptions</li>
                    <li>Custom color for visual identification</li>
                    <li>Active/inactive status</li>
                    <li>Multiple articles</li>
                </ul>
                <p class="small text-muted">
                    Tags are more flexible than categories and can be applied to multiple articles.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const colorInput = document.getElementById('color');
    const colorTextInput = document.getElementById('color_text');
    
    colorInput.addEventListener('change', function() {
        colorTextInput.value = this.value;
    });
    
    colorTextInput.addEventListener('change', function() {
        if (/^#[0-9A-F]{6}$/i.test(this.value)) {
            colorInput.value = this.value;
        }
    });
});
</script>
@endsection