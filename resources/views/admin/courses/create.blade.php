@extends('admin.layouts.app')

@section('title', 'Create Course')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Create New Course</h1>
    <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Courses
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.courses.store') }}">
            @csrf
            
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <select class="form-select @error('program_id') is-invalid @enderror" 
                                id="program_id" name="program_id" required>
                            <option value="">Select Program</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                    {{ app()->getLocale() === 'km' ? $program->title_km : $program->title_en }}
                                </option>
                            @endforeach
                        </select>
                        <label for="program_id">Program <span class="text-danger">*</span></label>
                        @error('program_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-floating">
                        <select class="form-select @error('year') is-invalid @enderror" 
                                id="year" name="year" required>
                            <option value="">Select</option>
                            @for($i = 1; $i <= 6; $i++)
                                <option value="{{ $i }}" {{ old('year') == $i ? 'selected' : '' }}>Year {{ $i }}</option>
                            @endfor
                        </select>
                        <label for="year">Year <span class="text-danger">*</span></label>
                        @error('year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-floating">
                        <select class="form-select @error('semester') is-invalid @enderror" 
                                id="semester" name="semester" required>
                            <option value="">Select</option>
                            @for($i = 1; $i <= 2; $i++)
                                <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                            @endfor
                        </select>
                        <label for="semester">Semester <span class="text-danger">*</span></label>
                        @error('semester')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('code') is-invalid @enderror" 
                               id="code" name="code" value="{{ old('code') }}" placeholder="Course Code">
                        <label for="code">Course Code</label>
                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="number" class="form-control @error('credits') is-invalid @enderror" 
                               id="credits" name="credits" value="{{ old('credits', 3) }}" min="1" max="10" required>
                        <label for="credits">Credits <span class="text-danger">*</span></label>
                        @error('credits')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-floating">
                        <select class="form-select" id="phase" name="phase">
                            <option value="">Select Phase</option>
                            <option value="Foundation" {{ old('phase') == 'Foundation' ? 'selected' : '' }}>Foundation</option>
                            <option value="Development" {{ old('phase') == 'Development' ? 'selected' : '' }}>Development</option>
                            <option value="Specialization" {{ old('phase') == 'Specialization' ? 'selected' : '' }}>Specialization</option>
                            <option value="Capstone" {{ old('phase') == 'Capstone' ? 'selected' : '' }}>Capstone</option>
                        </select>
                        <label for="phase">Phase</label>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('name_en') is-invalid @enderror" 
                               id="name_en" name="name_en" value="{{ old('name_en') }}" placeholder="Course Name (English)" required>
                        <label for="name_en">Course Name (English) <span class="text-danger">*</span></label>
                        @error('name_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('name_km') is-invalid @enderror" 
                               id="name_km" name="name_km" value="{{ old('name_km') }}" placeholder="Course Name (Khmer)" required>
                        <label for="name_km">Course Name (Khmer) <span class="text-danger">*</span></label>
                        @error('name_km')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Description (English)" 
                                  id="description_en" name="description_en" style="height: 100px">{{ old('description_en') }}</textarea>
                        <label for="description_en">Description (English)</label>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Description (Khmer)" 
                                  id="description_km" name="description_km" style="height: 100px">{{ old('description_km') }}</textarea>
                        <label for="description_km">Description (Khmer)</label>
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active
                        </label>
                    </div>
                </div>
                
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Create Course
                    </button>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
