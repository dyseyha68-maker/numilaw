@extends('admin.layouts.app')

@section('title', 'Edit Project')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Edit Project</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name_en" class="form-label">Name (English) *</label>
                    <input type="text" name="name_en" id="name_en" class="form-control @error('name_en') is-invalid @enderror" value="{{ old('name_en', $project->name_en) }}" required>
                    @error('name_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="name_km" class="form-label">Name (Khmer) *</label>
                    <input type="text" name="name_km" id="name_km" class="form-control @error('name_km') is-invalid @enderror" value="{{ old('name_km', $project->name_km) }}" required>
                    @error('name_km')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="type" class="form-label">Type *</label>
                    <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                        <option value="club" {{ $project->type == 'club' ? 'selected' : '' }}>Club</option>
                        <option value="academic_project" {{ $project->type == 'academic_project' ? 'selected' : '' }}>Academic Project</option>
                        <option value="research_project" {{ $project->type == 'research_project' ? 'selected' : '' }}>Research Project</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="active" {{ $project->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="supervisor_id" class="form-label">Supervisor</label>
                    <select name="supervisor_id" id="supervisor_id" class="form-select">
                        <option value="">Select Supervisor</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $project->supervisor_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="leader_id" class="form-label">Project Leader</label>
                    <select name="leader_id" id="leader_id" class="form-select">
                        <option value="">Select Leader</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $project->leader_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $project->start_date) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $project->end_date) }}">
                </div>
            </div>

            @if($project->featured_image)
            <div class="mb-3">
                <label class="form-label">Current Image</label>
                <div>
                    <img src="{{ Storage::url($project->featured_image) }}" alt="Current Image" class="img-thumbnail" style="max-height: 200px;">
                </div>
            </div>
            @endif

            <div class="mb-3">
                <label for="featured_image" class="form-label">Featured Image</label>
                <input type="file" name="featured_image" id="featured_image" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="description_en" class="form-label">Description (English) *</label>
                <textarea name="description_en" id="description_en" class="form-control summernote @error('description_en') is-invalid @enderror" rows="5" required>{{ old('description_en', $project->description_en) }}</textarea>
                @error('description_en')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description_km" class="form-label">Description (Khmer) *</label>
                <textarea name="description_km" id="description_km" class="form-control summernote @error('description_km') is-invalid @enderror" rows="5" required>{{ old('description_km', $project->description_km) }}</textarea>
                @error('description_km')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="objectives_en" class="form-label">Objectives (English)</label>
                <textarea name="objectives_en" id="objectives_en" class="form-control summernote" rows="3">{{ old('objectives_en', $project->objectives_en) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="objectives_km" class="form-label">Objectives (Khmer)</label>
                <textarea name="objectives_km" id="objectives_km" class="form-control summernote" rows="3">{{ old('objectives_km', $project->objectives_km) }}</textarea>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Update Project</button>
            </div>
        </form>
    </div>
</div>
@endsection
