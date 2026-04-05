@extends('admin.layouts.app')

@section('title', __('hero.edit_slide'))

@section('content')
<div class="container-fluid">
    <form action="{{ route('admin.hero-slides.update', $heroSlide) }}" method="POST" enctype="multipart/form-data" id="editForm">
    @csrf
    @method('PUT')
    
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- English Content -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-translate me-2"></i>English Content</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ __('hero.title_field') }} (EN) *</label>
                        <input type="text" class="form-control form-control-lg" name="title_en" value="{{ $heroSlide->title_en }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('hero.subtitle') }} (EN)</label>
                        <input type="text" class="form-control" name="subtitle_en" value="{{ $heroSlide->subtitle_en }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('hero.description') }} (EN)</label>
                        <textarea class="form-control" name="description_en" rows="4">{{ $heroSlide->description_en }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('hero.button_text') }} (EN)</label>
                                <input type="text" class="form-control" name="button_text_en" value="{{ $heroSlide->button_text_en }}" placeholder="e.g., Learn More">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('hero.button_url') }}</label>
                                <input type="text" class="form-control" name="button_url" value="{{ $heroSlide->button_url }}" placeholder="/page-url">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('hero.secondary_button') }} (EN)</label>
                                <input type="text" class="form-control" name="secondary_button_text_en" value="{{ $heroSlide->secondary_button_text_en }}" placeholder="e.g., Contact Us">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Secondary Button URL</label>
                                <input type="text" class="form-control" name="secondary_button_url" value="{{ $heroSlide->secondary_button_url }}" placeholder="/page-url">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Khmer Content -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-translate me-2"></i>Khmer Content (ខ្មែរ)</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ __('hero.title_field') }} (KM) *</label>
                        <input type="text" class="form-control form-control-lg" name="title_km" value="{{ $heroSlide->title_km }}" required dir="ltr">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('hero.subtitle') }} (KM)</label>
                        <input type="text" class="form-control" name="subtitle_km" value="{{ $heroSlide->subtitle_km }}" dir="ltr">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('hero.description') }} (KM)</label>
                        <textarea class="form-control" name="description_km" rows="4" dir="ltr">{{ $heroSlide->description_km }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('hero.button_text') }} (KM)</label>
                                <input type="text" class="form-control" name="button_text_km" value="{{ $heroSlide->button_text_km }}" dir="ltr">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Button Icon</label>
                                <input type="text" class="form-control" name="button_icon" value="{{ $heroSlide->button_icon }}" placeholder="bi bi-arrow-right">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Image -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-image me-2"></i>{{ __('hero.image') }}</h5>
                </div>
                <div class="card-body">
                    @if($heroSlide->image)
                        <div class="mb-3 text-center">
                            <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $heroSlide->image)) }}" alt="{{ $heroSlide->image_alt }}" class="img-fluid rounded" style="max-height: 200px;">
                            <div class="mt-2">
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteImage({{ $heroSlide->id }}">
                                    <i class="bi bi-trash me-1"></i> Remove Image
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4 bg-light rounded mb-3">
                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mb-0 mt-2">No image uploaded</p>
                        </div>
                    @endif
                    
                    <label class="form-label">Upload New Image</label>
                    <input type="file" class="form-control" name="image" accept="image/*">
                    <small class="text-muted d-block mt-2">Recommended: 1920x1080px</small>
                    
                    <hr>
                    
                    <div class="mb-3">
                        <label class="form-label">Image Alt (EN)</label>
                        <input type="text" class="form-control" name="image_alt_en" value="{{ $heroSlide->image_alt_en }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image Alt (KM)</label>
                        <input type="text" class="form-control" name="image_alt_km" value="{{ $heroSlide->image_alt_km }}" dir="ltr">
                    </div>
                </div>
            </div>
            
            <!-- Display Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-palette me-2"></i>Display Settings</h5>
                </div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="use_theme" id="use_theme" 
                            {{ $heroSlide->use_theme ? 'checked' : '' }}>
                        <label class="form-check-label" for="use_theme">
                            {{ __('hero.use_theme') }}
                        </label>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="show_content" id="show_content" 
                            {{ $heroSlide->show_content ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_content">
                            {{ __('hero.show_content') }}
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('hero.theme') }}</label>
                        <select class="form-select" name="theme">
                            @foreach($themes as $key => $theme)
                                <option value="{{ $key }}" {{ $heroSlide->theme === $key ? 'selected' : '' }}>
                                    {{ $theme['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('hero.position') }}</label>
                        <select class="form-select" name="content_position">
                            <option value="left" {{ $heroSlide->content_position === 'left' ? 'selected' : '' }}>Left</option>
                            <option value="center" {{ $heroSlide->content_position === 'center' ? 'selected' : '' }}>Center</option>
                            <option value="right" {{ $heroSlide->content_position === 'right' ? 'selected' : '' }}>Right</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('hero.overlay') }}</label>
                        <select class="form-select" name="overlay_opacity">
                            @foreach($overlayOpacities as $key => $label)
                                <option value="{{ $key }}" {{ $heroSlide->overlay_opacity === $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('hero.animation') }}</label>
                        <select class="form-select" name="animation_type">
                            @foreach($animationTypes as $key => $label)
                                <option value="{{ $key }}" {{ $heroSlide->animation_type === $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('hero.order') }}</label>
                        <input type="number" class="form-control" name="order" value="{{ $heroSlide->order }}" min="0">
                    </div>
                </div>
            </div>
            
            <!-- Status -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-toggle-on me-2"></i>Status</h5>
                </div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" 
                            {{ $heroSlide->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            {{ __('hero.active') }}
                        </label>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="show_animation" id="show_animation" 
                            {{ $heroSlide->show_animation ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_animation">
                            {{ __('hero.animation') }}
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- Schedule -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-calendar me-2"></i>Schedule</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">{{ __('hero.publish_at') }}</label>
                        <input type="datetime-local" class="form-control" name="publish_at" 
                            value="{{ $heroSlide->publish_at ? $heroSlide->publish_at->format('Y-m-d\TH:i') : '' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('hero.expire_at') }}</label>
                        <input type="datetime-local" class="form-control" name="expire_at" 
                            value="{{ $heroSlide->expire_at ? $heroSlide->expire_at->format('Y-m-d\TH:i') : '' }}">
                    </div>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg" onclick="this.disabled=true; this.form.submit();">
                    <i class="bi bi-check-circle me-2"></i>{{ __('common.save') }}
                </button>
                <a href="{{ route('admin.hero-slides.index', ['page' => $heroSlide->slide_key]) }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>{{ __('common.cancel') }}
                </a>
            </div>
        </div>
    </div>
</form>
</div>

<script>
function deleteImage(id) {
    if (confirm('Are you sure you want to remove this image?')) {
        fetch('/admin/hero-slides/' + id + '/delete-image', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to delete image');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting image');
        });
    }
}
</script>
@endsection
