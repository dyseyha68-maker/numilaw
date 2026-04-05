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
            <h1 class="h3 mb-0">Edit Student Experience</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.student-experience.experiences.update', $experience->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="student_name" name="student_name" value="{{ old('student_name', $experience->student_name) }}" placeholder="Student Name" required>
                                    <label for="student_name">Student Name *</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="batch_year" name="batch_year" value="{{ old('batch_year', $experience->batch_year) }}" placeholder="Batch Year" required>
                                    <label for="batch_year">Batch Year *</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="program" name="program" value="{{ old('program', $experience->program) }}" placeholder="Program" required>
                                    <label for="program">Program *</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="pending" {{ old('status', $experience->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ old('status', $experience->status) === 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ old('status', $experience->status) === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    <label for="status">Status *</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $experience->is_featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">Featured</label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label">Photo (leave empty to keep current)</label>
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                @if($experience->photo)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($experience->photo) }}" alt="" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                                    <a href="{{ Storage::url($experience->photo) }}" target="_blank" class="btn btn-sm btn-outline-primary ms-2">View Current</a>
                                </div>
                                @endif
                            </div>
                            
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="story_en" name="story_en" placeholder="Story (English)" style="height: 150px" required>{{ old('story_en', $experience->story_en) }}</textarea>
                                    <label for="story_en">Story (English) *</label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="story_kh" name="story_kh" placeholder="Story (Khmer)" style="height: 150px" required>{{ old('story_kh', $experience->story_kh) }}</textarea>
                                    <label for="story_kh">Story (Khmer) *</label>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-lg me-2"></i>
                                    Update
                                </button>
                                <a href="{{ route('admin.student-experience.experiences') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
