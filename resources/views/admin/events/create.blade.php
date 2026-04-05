@extends('admin.layouts.app')

@section('title', 'Create Event')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Create New Event</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="title_en" class="form-label">Title (English) *</label>
                            <input type="text" class="form-control @error('title_en') is-invalid @enderror" 
                                   id="title_en" name="title_en" value="{{ old('title_en') }}" required>
                            @error('title_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="title_km" class="form-label">Title (Khmer) *</label>
                            <input type="text" class="form-control @error('title_km') is-invalid @enderror" 
                                   id="title_km" name="title_km" value="{{ old('title_km') }}" required>
                            @error('title_km')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="type" class="form-label">Event Type</label>
                            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type">
                                <option value="seminar">Seminar</option>
                                <option value="workshop">Workshop</option>
                                <option value="competition">Competition</option>
                                <option value="conference">Conference</option>
                                <option value="other">Other</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="project_id" class="form-label">Related Project / Club</label>
                            <select class="form-select" id="project_id" name="project_id">
                                <option value="">Select a project...</option>
                                @foreach($projects ?? [] as $project)
                                    <option value="{{ $project->id }}">{{ $project->name_en }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="upcoming">Upcoming</option>
                                <option value="ongoing">Ongoing</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="start_datetime" class="form-label">Start Date & Time *</label>
                            <input type="datetime-local" class="form-control @error('start_datetime') is-invalid @enderror" 
                                   id="start_datetime" name="start_datetime" value="{{ old('start_datetime') }}" required>
                            @error('start_datetime')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="end_datetime" class="form-label">End Date & Time *</label>
                            <input type="datetime-local" class="form-control @error('end_datetime') is-invalid @enderror" 
                                   id="end_datetime" name="end_datetime" value="{{ old('end_datetime') }}" required>
                            @error('end_datetime')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Location *</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" 
                               id="location" name="location" value="{{ old('location') }}" required>
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="description_en" class="form-label">Description (English) *</label>
                            <textarea class="form-control summernote @error('description_en') is-invalid @enderror" 
                                      id="description_en" name="description_en" rows="5" required>{{ old('description_en') }}</textarea>
                            @error('description_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="description_km" class="form-label">Description (Khmer) *</label>
                            <textarea class="form-control summernote @error('description_km') is-invalid @enderror" 
                                      id="description_km" name="description_km" rows="5" required>{{ old('description_km') }}</textarea>
                            @error('description_km')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="featured_image" class="form-label">Featured Image</label>
                            <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                                   id="featured_image" name="featured_image" accept="image/*">
                            @error('featured_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="max_participants" class="form-label">Max Participants</label>
                            <input type="number" class="form-control @error('max_participants') is-invalid @enderror" 
                                   id="max_participants" name="max_participants" value="{{ old('max_participants') }}" min="1">
                            @error('max_participants')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="registration_deadline" class="form-label">Registration Deadline</label>
                            <input type="datetime-local" class="form-control @error('registration_deadline') is-invalid @enderror" 
                                   id="registration_deadline" name="registration_deadline" value="{{ old('registration_deadline') }}">
                            @error('registration_deadline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" id="is_registration_required" name="is_registration_required" value="1" {{ old('is_registration_required') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_registration_required">
                                    Registration Required
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Create Event</button>
                        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
