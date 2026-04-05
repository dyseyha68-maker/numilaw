@extends('admin.layouts.app')

@section('title', __('partner.admin.edit_activity'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.partners.activities.index', $activity->partner_university_id) }}" class="btn btn-outline-secondary btn-sm mb-2">
            <i class="bi bi-arrow-left me-1"></i> {{ __('partner.form.cancel') }}
        </a>
        <h4 class="fw-bold mb-0">{{ __('partner.admin.edit_activity') }}</h4>
        <small class="text-muted">{{ $activity->university->name }}</small>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.partners.activities.update', $activity->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('partner.activity_title') }} *</label>
                    <input type="text" name="title" class="form-control" required 
                           value="{{ old('title', $activity->title) }}">
                    @error('title')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('partner.activity_type') }} *</label>
                    <select name="type" class="form-select" required>
                        <option value="">Select type</option>
                        @foreach($types as $value => $label)
                        <option value="{{ $value }}" {{ old('type', $activity->type) === $value ? 'selected' : '' }}>
                            {{ __('partner.activity_types.' . $value) }}
                        </option>
                        @endforeach
                    </select>
                    @error('type')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('partner.activity_date') }} *</label>
                    <input type="date" name="activity_date" class="form-control" required 
                           value="{{ old('activity_date', $activity->activity_date->format('Y-m-d')) }}">
                    @error('activity_date')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('partner.location') }}</label>
                    <input type="text" name="location" class="form-control" 
                           value="{{ old('location', $activity->location) }}">
                    @error('location')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">{{ __('partner.visibility') }} *</label>
                <div class="d-flex gap-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="visibility" id="visibility_public" 
                               value="public" {{ old('visibility', $activity->visibility) === 'public' ? 'checked' : '' }}>
                        <label class="form-check-label" for="visibility_public">
                            <span class="badge bg-success">{{ __('partner.visibility.public') }}</span>
                            <small class="text-muted ms-1">Visible on website</small>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="visibility" id="visibility_internal" 
                               value="internal" {{ old('visibility', $activity->visibility) === 'internal' ? 'checked' : '' }}>
                        <label class="form-check-label" for="visibility_internal">
                            <span class="badge bg-warning text-dark">{{ __('partner.visibility.internal') }}</span>
                            <small class="text-muted ms-1">Admin only</small>
                        </label>
                    </div>
                </div>
                @error('visibility')
                <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label class="form-label">{{ __('partner.admin.description') }}</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $activity->description) }}</textarea>
                @error('description')
                <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> {{ __('partner.form.update') }}
                </button>
                <a href="{{ route('admin.partners.activities.index', $activity->partner_university_id) }}" class="btn btn-outline-secondary">
                    {{ __('partner.form.cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
