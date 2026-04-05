@extends('admin.layouts.app')

@section('title', isset($intake) ? 'Edit Intake' : 'Add Intake')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 mb-0">{{ isset($intake) ? 'Edit Intake' : 'Add Intake' }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ isset($intake) ? route('admin.admissions.intakes.update', $intake->id) : route('admin.admissions.intakes.store') }}">
                        @csrf
                        @if(isset($intake))
                        @method('PUT')
                        @endif
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Intake Name (EN) *</label>
                                <input type="text" class="form-control" name="intake_name_en" value="{{ $intake->intake_name_en ?? old('intake_name_en') }}" placeholder="e.g. 2025 Intake" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Intake Name (KH) *</label>
                                <input type="text" class="form-control" name="intake_name_kh" value="{{ $intake->intake_name_kh ?? old('intake_name_kh') }}" placeholder="e.g. ទិសេស ២០២៥" required>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label">Program *</label>
                                <select class="form-select" name="program_id" required>
                                    <option value="">Select Program</option>
                                    @foreach($programs as $program)
                                    <option value="{{ $program->id }}" {{ isset($intake) && $intake->program_id == $program->id ? 'selected' : '' }}>{{ $program->name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label">Application Start *</label>
                                <input type="date" class="form-control" name="application_start" value="{{ $intake->application_start ?? old('application_start') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Application End *</label>
                                <input type="date" class="form-control" name="application_end" value="{{ $intake->application_end ?? old('application_end') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Semester Start *</label>
                                <input type="date" class="form-control" name="semester_start" value="{{ $intake->semester_start ?? old('semester_start') }}" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Max Seats *</label>
                                <input type="number" class="form-control" name="max_seats" value="{{ $intake->max_seats ?? old('max_seats') }}" min="1" required>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="is_open" value="1" {{ (!isset($intake)) || $intake->is_open ? 'checked' : '' }}>
                                    <label class="form-check-label">Open for Applications</label>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary">{{ isset($intake) ? 'Update' : 'Create' }}</button>
                                <a href="{{ route('admin.admissions.intakes.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
