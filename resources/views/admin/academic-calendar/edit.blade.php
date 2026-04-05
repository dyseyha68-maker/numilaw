@extends('admin.layouts.app')

@section('title', 'Edit Academic Calendar Event')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Edit Academic Calendar Event</h1>
    <a href="{{ route('admin.academic-calendar.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Calendar
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <form method="POST" action="{{ route('admin.academic-calendar.update', $academicCalendar) }}">
            @csrf
            @method('PUT')
            
            <!-- Basic Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Basic Information</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="title_en" class="form-label">Title (English) *</label>
                            <input type="text" class="form-control @error('title_en') is-invalid @enderror" 
                                   id="title_en" name="title_en" value="{{ old('title_en', $academicCalendar->title_en) }}" required>
                            @error('title_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="title_km" class="form-label">Title (Khmer) *</label>
                            <input type="text" class="form-control @error('title_km') is-invalid @enderror" 
                                   id="title_km" name="title_km" value="{{ old('title_km', $academicCalendar->title_km) }}" required>
                            @error('title_km')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="event_type" class="form-label">Event Type *</label>
                            <select class="form-select @error('event_type') is-invalid @enderror" 
                                    id="event_type" name="event_type" required>
                                <option value="">Select Event Type</option>
                                @foreach($eventTypes as $key => $label)
                                    <option value="{{ $key }}" {{ old('event_type', $academicCalendar->event_type) == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('event_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="audience" class="form-label">Audience *</label>
                            <select class="form-select @error('audience') is-invalid @enderror" 
                                    id="audience" name="audience" required>
                                <option value="">Select Audience</option>
                                @foreach($audiences as $key => $label)
                                    <option value="{{ $key }}" {{ old('audience', $academicCalendar->audience) == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('audience')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="program_id" class="form-label">Related Program</label>
                            <select class="form-select @error('program_id') is-invalid @enderror" 
                                    id="program_id" name="program_id">
                                <option value="">All Programs</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}" {{ old('program_id', $academicCalendar->program_id) == $program->id ? 'selected' : '' }}>
                                        {{ $program->title_en }}
                                    </option>
                                @endforeach
                            </select>
                            @error('program_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                   id="location" name="location" value="{{ old('location', $academicCalendar->location) }}">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Date and Time -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Date and Time</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Start Date *</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                   id="start_date" name="start_date" value="{{ old('start_date', $academicCalendar->start_date) }}" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                   id="end_date" name="end_date" value="{{ old('end_date', $academicCalendar->end_date) }}">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="start_time" class="form-label">Start Time</label>
                            <input type="time" class="form-control @error('start_time') is-invalid @enderror" 
                                   id="start_time" name="start_time" value="{{ old('start_time', $academicCalendar->start_time) }}">
                            @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="end_time" class="form-label">End Time</label>
                            <input type="time" class="form-control @error('end_time') is-invalid @enderror" 
                                   id="end_time" name="end_time" value="{{ old('end_time', $academicCalendar->end_time) }}">
                            @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" type="checkbox" id="is_all_day" name="is_all_day" 
                                       {{ old('is_all_day', $academicCalendar->is_all_day) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_all_day">
                                    All Day Event
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Description</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="description_en" class="form-label">Description (English)</label>
                            <textarea class="form-control summernote @error('description_en') is-invalid @enderror" 
                                      id="description_en" name="description_en" rows="4">{{ old('description_en', $academicCalendar->description_en) }}</textarea>
                            @error('description_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="description_km" class="form-label">Description (Khmer)</label>
                            <textarea class="form-control summernote @error('description_km') is-invalid @enderror" 
                                      id="description_km" name="description_km" rows="4">{{ old('description_km', $academicCalendar->description_km) }}</textarea>
                            @error('description_km')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Options -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Additional Options</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="color_code" class="form-label">Color Code *</label>
                            <select class="form-select @error('color_code') is-invalid @enderror" id="color_code" name="color_code" required>
                                @foreach($colorCodes as $code => $name)
                                    <option value="{{ $code }}" {{ old('color_code', $academicCalendar->color_code) == $code ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('color_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" name="sort_order" value="{{ old('sort_order', $academicCalendar->sort_order) }}" min="0">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" type="checkbox" id="is_recurring" name="is_recurring" 
                                       {{ old('is_recurring', $academicCalendar->is_recurring) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_recurring">
                                    Recurring Event
                                </label>
                            </div>
                        </div>
                        @if(old('is_recurring', $academicCalendar->is_recurring))
                            <div class="col-md-6">
                                <label for="recurring_pattern" class="form-label">Recurring Pattern *</label>
                                <select class="form-select @error('recurring_pattern') is-invalid @enderror" 
                                        id="recurring_pattern" name="recurring_pattern">
                                    @foreach($recurringPatterns as $key => $label)
                                        <option value="{{ $key }}" {{ old('recurring_pattern', $academicCalendar->recurring_pattern) == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('recurring_pattern')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Additional Notes</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="notes_en" class="form-label">Notes (English)</label>
                            <textarea class="form-control summernote @error('notes_en') is-invalid @enderror" 
                                      id="notes_en" name="notes_en" rows="3">{{ old('notes_en', $academicCalendar->notes_en) }}</textarea>
                            @error('notes_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="notes_km" class="form-label">Notes (Khmer)</label>
                            <textarea class="form-control summernote @error('notes_km') is-invalid @enderror" 
                                      id="notes_km" name="notes_km" rows="3">{{ old('notes_km', $academicCalendar->notes_km) }}</textarea>
                            @error('notes_km')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Event
                    </button>
                    <a href="{{ route('admin.academic-calendar.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
