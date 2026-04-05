@extends('admin.layouts.app')

@push('styles')
<style>
    .form-floating label {
        color: #6b7280;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #003A46;
        box-shadow: 0 0 0 0.2rem rgba(0,58,70,0.15);
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 mb-0">Edit Gallery Item</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.student-experience.gallery.update', $gallery->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="title_en" name="title_en" value="{{ old('title_en', $gallery->title_en) }}" placeholder="Title (English)" required>
                                    <label for="title_en">Title (English) *</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="title_kh" name="title_kh" value="{{ old('title_kh', $gallery->title_kh) }}" placeholder="Title (Khmer)" required>
                                    <label for="title_kh">Title (Khmer) *</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="media_type" name="media_type" required>
                                        <option value="photo" {{ old('media_type', $gallery->media_type) === 'photo' ? 'selected' : '' }}>Photo</option>
                                        <option value="video" {{ old('media_type', $gallery->media_type) === 'video' ? 'selected' : '' }}>Video</option>
                                    </select>
                                    <label for="media_type">Media Type *</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="category" name="category" required>
                                        <option value="events" {{ old('category', $gallery->category) === 'events' ? 'selected' : '' }}>Events</option>
                                        <option value="moot_court" {{ old('category', $gallery->category) === 'moot_court' ? 'selected' : '' }}>Moot Court</option>
                                        <option value="graduation" {{ old('category', $gallery->category) === 'graduation' ? 'selected' : '' }}>Graduation</option>
                                        <option value="clubs" {{ old('category', $gallery->category) === 'clubs' ? 'selected' : '' }}>Clubs</option>
                                        <option value="general" {{ old('category', $gallery->category) === 'general' ? 'selected' : '' }}>General</option>
                                    </select>
                                    <label for="category">Category *</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="year" name="year" required>
                                        @for($y = date('Y'); $y >= 2000; $y--)
                                        <option value="{{ $y }}" {{ old('year', $gallery->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                                        @endfor
                                    </select>
                                    <label for="year">Year *</label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label">Media File (leave empty to keep current)</label>
                                <input type="file" class="form-control" id="media_path" name="media_path" accept="image/*,video/*">
                                <small class="text-muted">Max size: 10MB. Leave empty to keep current file.</small>
                                @if($gallery->media_path)
                                <div class="mt-2">
                                    <a href="{{ Storage::url($gallery->media_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye me-1"></i> View Current
                                    </a>
                                </div>
                                @endif
                            </div>
                            
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="caption_en" name="caption_en" placeholder="Caption (English)" style="height: 100px">{{ old('caption_en', $gallery->caption_en) }}</textarea>
                                    <label for="caption_en">Caption (English)</label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="caption_kh" name="caption_kh" placeholder="Caption (Khmer)" style="height: 100px">{{ old('caption_kh', $gallery->caption_kh) }}</textarea>
                                    <label for="caption_kh">Caption (Khmer)</label>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-lg me-2"></i>
                                    Update
                                </button>
                                <a href="{{ route('admin.student-experience.gallery.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
