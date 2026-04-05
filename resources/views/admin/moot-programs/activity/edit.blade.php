@extends('admin.layouts.app')

@section('title', 'Edit Activity')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.index') }}">Moot Programs</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.show', $moot->id) }}">{{ $moot->name_en }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.moot-programs.participations.show', [$moot->id, $participation->id]) }}">{{ $participation->year }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Activity</li>
            </ol>
        </nav>
        <h1>Edit Activity</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.moot-programs.participations.show', [$moot->id, $participation->id]) }}" 
           class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.moot-programs.activities.update', [$moot->id, $participation->id, $activity->id]) }}" 
              method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="title_en" class="form-label">Title (English) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title_en') is-invalid @enderror" 
                           id="title_en" name="title_en" value="{{ old('title_en', $activity->title_en) }}" required>
                    @error('title_en')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="title_km" class="form-label">Title (Khmer)</label>
                    <input type="text" class="form-control" id="title_km" name="title_km" 
                           value="{{ old('title_km', $activity->title_km) }}">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="activity_type" class="form-label">Activity Type</label>
                    <select class="form-select" id="activity_type" name="activity_type">
                        @foreach(\App\Models\MootActivity::getActivityTypes() as $value => $label)
                        <option value="{{ $value }}" {{ $activity->activity_type == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="activity_date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="activity_date" name="activity_date" 
                           value="{{ old('activity_date', $activity->activity_date?->format('Y-m-d')) }}">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" 
                           value="{{ old('location', $activity->location) }}">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="description_en" class="form-label">Description (English)</label>
                    <textarea class="form-control note-editable" id="description_en" name="description_en" rows="3">{{ old('description_en', $activity->description_en) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="description_km" class="form-label">Description (Khmer)</label>
                    <textarea class="form-control note-editable" id="description_km" name="description_km" rows="3">{{ old('description_km', $activity->description_km) }}</textarea>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="order" class="form-label">Display Order</label>
                    <input type="number" class="form-control" id="order" name="order" 
                           value="{{ old('order', $activity->order) }}" min="0">
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch mt-4">
                        <input class="form-check-input" type="checkbox" id="is_completed" 
                               name="is_completed" value="1" {{ $activity->is_completed ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_completed">Completed</label>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Update Activity
                    </button>
                    <a href="{{ route('admin.moot-programs.participations.show', [$moot->id, $participation->id]) }}" 
                       class="btn btn-outline-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
