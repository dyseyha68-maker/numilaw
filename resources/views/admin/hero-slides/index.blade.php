@extends('admin.layouts.app')

@section('title', __('hero.title'))

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h4 class="mb-0">{{ __('hero.slides') }} - {{ ucfirst($pageKey) }}</h4>
            </div>
            <div class="col-md-6 text-end">
                    <a href="{{ route('admin.hero-slides.create', ['page' => $pageKey]) }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> {{ __('hero.add_slide') }}
                </a>
            </div>
        </div>
    </div>
    
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5>{{ __('hero.slideshow_settings') }}</h5>
                        <form action="{{ route('admin.hero-slides.update-settings', $settings) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="enable_slideshow" 
                                            name="enable_slideshow" {{ $settings->enable_slideshow ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enable_slideshow">
                                            {{ __('hero.enable_slideshow') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="slideshow_autoplay" 
                                            name="slideshow_autoplay" {{ $settings->slideshow_autoplay ? 'checked' : '' }}>
                                        <label class="form-check-label" for="slideshow_autoplay">
                                            {{ __('hero.autoplay') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="slideshow_navigation" 
                                            name="slideshow_navigation" {{ $settings->slideshow_navigation ? 'checked' : '' }}>
                                        <label class="form-check-label" for="slideshow_navigation">
                                            {{ __('hero.navigation') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="slideshow_pagination" 
                                            name="slideshow_pagination" {{ $settings->slideshow_pagination ? 'checked' : '' }}>
                                        <label class="form-check-label" for="slideshow_pagination">
                                            {{ __('hero.pagination') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label class="form-label">{{ __('hero.interval') }}</label>
                                    <input type="number" class="form-control" name="slideshow_interval" 
                                        value="{{ $settings->slideshow_interval }}" min="1000" max="30000" step="500">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">{{ __('hero.height') }}</label>
                                    <select class="form-select" name="height">
                                        @foreach(\App\Models\HeroSettings::getHeights() as $value => $label)
                                            <option value="{{ $value }}" {{ $settings->height === $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">{{ __('hero.position') }}</label>
                                    <select class="form-select" name="content_position">
                                        @foreach(\App\Models\HeroSettings::getContentPositions() as $value => $label)
                                            <option value="{{ $value }}" {{ $settings->content_position === $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-check-circle me-1"></i> {{ __('common.save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if($slides->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-images display-1 text-muted"></i>
                <p class="mt-3 text-muted">{{ __('hero.no_slides') }}</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover" id="sortable-table">
                    <thead>
                        <tr>
                            <th style="width: 60px;">{{ __('hero.order') }}</th>
                            <th style="width: 100px;">{{ __('hero.image') }}</th>
                            <th>{{ __('hero.title_field') }}</th>
                            <th>{{ __('hero.theme') }}</th>
                            <th>{{ __('hero.animation') }}</th>
                            <th style="width: 100px;">{{ __('common.status') }}</th>
                            <th style="width: 150px;">{{ __('common.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody data-url="{{ route('admin.hero-slides.reorder') }}">
                        @foreach($slides as $slide)
                            <tr data-id="{{ $slide->id }}">
                                <td>
                                    <i class="bi bi-grip-vertical cursor-move"></i>
                                    <span class="ms-2">{{ $slide->order }}</span>
                                </td>
                                <td>
                                    @if($slide->image)
                                        <img src="{{ url('/laravel-img/' . $slide->image) }}" 
                                             alt="{{ $slide->image_alt }}" 
                                             class="img-thumbnail"
                                             style="width: 80px; height: 60px; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                                             style="width: 80px; height: 60px;">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $slide->title_en }}</strong>
                                    @if($slide->subtitle_en)
                                        <br><small class="text-muted">{{ $slide->subtitle_en }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge" style="background: {{ \App\Models\HeroSlide::getThemes()[$slide->theme]['primary'] ?? '#003A46' }}">
                                        {{ ucfirst($slide->theme) }}
                                    </span>
                                </td>
                                <td>
                                    {{ ucfirst(str_replace('-', ' ', $slide->animation_type)) }}
                                </td>
                                <td>
                                    @if($slide->is_active)
                                        <span class="badge bg-success">{{ __('hero.active') }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ __('hero.inactive') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.hero-slides.edit', $slide) }}" 
                                           class="btn btn-outline-primary" title="{{ __('common.edit') }}">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" 
                                            onclick="deleteSlide({{ $slide->id }})" title="{{ __('common.delete') }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function deleteSlide(id) {
    if (confirm('Are you sure you want to delete this slide?')) {
        const pageKey = new URLSearchParams(window.location.search).get('page') || 'home';
        fetch(`/admin/hero-slides/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            window.location.href = `/admin/hero-slides?page=${pageKey}`;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to delete slide');
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const tbody = document.querySelector('#sortable-table tbody');
    if (!tbody) return;
    
    let draggedRow = null;
    
    tbody.querySelectorAll('tr').forEach(row => {
        const handle = row.querySelector('.bi-grip-vertical');
        if (handle) {
            handle.addEventListener('mousedown', function() {
                row.classList.add('dragging');
                draggedRow = row;
            });
        }
    });
    
    document.addEventListener('mouseup', function() {
        if (draggedRow) {
            draggedRow.classList.remove('dragging');
            draggedRow = null;
        }
    });
});
</script>
@endpush

<style>
.cursor-move {
    cursor: move;
}
.dragging {
    opacity: 0.5;
    background: #f8f9fa;
}
</style>
@endsection
