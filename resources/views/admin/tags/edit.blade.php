@extends('admin.layouts.app')

@section('title', 'Edit Tag')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Edit Tag</h1>
    <a href="{{ route('admin.tags.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Tags
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.tags.update', $tag) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name_en" class="form-label">Name (English) *</label>
                            <input type="text" class="form-control @error('name_en') is-invalid @enderror" 
                                   id="name_en" name="name_en" value="{{ old('name_en', $tag->name_en) }}" required>
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="name_km" class="form-label">Name (Khmer) *</label>
                            <input type="text" class="form-control @error('name_km') is-invalid @enderror" 
                                   id="name_km" name="name_km" value="{{ old('name_km', $tag->name_km) }}" required>
                            @error('name_km')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12">
                            <label for="description_en" class="form-label">Description (English)</label>
                            <textarea class="form-control summernote @error('description_en') is-invalid @enderror" 
                                      id="description_en" name="description_en" rows="3">{{ old('description_en', $tag->description_en) }}</textarea>
                            @error('description_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12">
                            <label for="description_km" class="form-label">Description (Khmer)</label>
                            <textarea class="form-control summernote @error('description_km') is-invalid @enderror" 
                                      id="description_km" name="description_km" rows="3">{{ old('description_km', $tag->description_km) }}</textarea>
                            @error('description_km')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="color" class="form-label">Color</label>
                            <div class="input-group">
                                <input type="color" class="form-control form-control-color" 
                                       id="color" name="color" value="{{ old('color', $tag->color ?: '#6c757d') }}">
                                <input type="text" class="form-control" 
                                       id="color_text" name="color_text" value="{{ old('color', $tag->color ?: '#6c757d') }}"
                                       placeholder="#000000">
                            </div>
                            <small class="text-muted">Choose a color for the tag badge</small>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                       {{ $tag->is_active ? 'checked' : '' }}>
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
                                <div>
                                    <a href="{{ route('admin.tags.show', $tag) }}" class="btn btn-outline-info me-2">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle"></i> Update Tag
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
                <h6 class="mb-0">Tag Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label text-muted">Created</label>
                    <p class="form-control-plaintext">{{ $tag->created_at->format('M j, Y g:i A') }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted">Last Updated</label>
                    <p class="form-control-plaintext">{{ $tag->updated_at->format('M j, Y g:i A') }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted">Articles Count</label>
                    <p class="form-control-plaintext">{{ $tag->articles->count() }} articles</p>
                </div>
                
                @if($tag->color)
                <div class="mb-3">
                    <label class="form-label text-muted">Current Color</label>
                    <p>
                        <span class="badge" style="background-color: {{ $tag->color }};">
                            <i class="bi bi-palette"></i> {{ $tag->color }}
                        </span>
                    </p>
                </div>
                @endif
            </div>
        </div>
        
        @if($tag->articles->count() > 0)
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Warning</h6>
            </div>
            <div class="card-body">
                <p class="small text-danger">
                    <i class="bi bi-exclamation-triangle"></i> This tag is used in {{ $tag->articles->count() }} article(s). 
                    If you delete this tag, it will be removed from all associated articles.
                </p>
            </div>
        </div>
        @endif
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