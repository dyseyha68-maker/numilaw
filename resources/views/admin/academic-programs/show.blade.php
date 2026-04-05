@extends('admin.layouts.app')

@section('title', 'Academic Program: ' . $academicProgram->title_en)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Academic Program: {{ $academicProgram->title_en }}</h1>
    <div>
        <a href="{{ route('admin.academic-programs.edit', $academicProgram) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <a href="{{ route('admin.academic-programs.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Basic Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Basic Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>English Title:</strong><br>
                        {{ $academicProgram->title_en }}
                    </div>
                    <div class="col-md-6">
                        <strong>Khmer Title:</strong><br>
                        {{ $academicProgram->title_km }}
                    </div>
                    <div class="col-md-6 mt-3">
                        <strong>Degree Type:</strong><br>
                        <span class="badge bg-info">{{ $academicProgram->degree_type_display }}</span>
                    </div>
                    <div class="col-md-3 mt-3">
                        <strong>Duration:</strong><br>
                        {{ $academicProgram->duration_years }} {{ __('year') }}{{ $academicProgram->duration_years > 1 ? 's' : '' }}
                    </div>
                    <div class="col-md-3 mt-3">
                        <strong>Credits:</strong><br>
                        {{ $academicProgram->credits_required }}
                    </div>
                    @if($academicProgram->tuition_fee)
                        <div class="col-md-6 mt-3">
                            <strong>Tuition Fee:</strong><br>
                            <span class="text-success fw-bold">${{ number_format($academicProgram->tuition_fee, 2) }}</span>
                        </div>
                    @endif
                    <div class="col-md-6 mt-3">
                        <strong>Status:</strong><br>
                        @if($academicProgram->is_active)
                            <span class="badge bg-success"><i class="bi bi-check-circle"></i> Active</span>
                        @else
                            <span class="badge bg-secondary"><i class="bi bi-x-circle"></i> Inactive</span>
                        @endif
                    </div>
                    @if($academicProgram->featured_image)
                        <div class="col-12 mt-3">
                            <strong>Featured Image:</strong><br>
                            <img src="{{ $academicProgram->featured_image }}" alt="{{ $academicProgram->title_en }}" 
                                 class="img-thumbnail mt-2" style="max-height: 200px;">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Description</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>English:</h6>
                        <div class="border rounded p-3 bg-light">
                            {!! nl2br(e($academicProgram->description_en)) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6>Khmer:</h6>
                        <div class="border rounded p-3 bg-light">
                            {!! nl2br(e($academicProgram->description_km)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admission Requirements -->
        @if($academicProgram->admission_requirements_en || $academicProgram->admission_requirements_km)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Admission Requirements</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($academicProgram->admission_requirements_en)
                            <div class="col-md-6">
                                <h6>English:</h6>
                                <div class="border rounded p-3 bg-light">
                                    {!! nl2br(e($academicProgram->admission_requirements_en)) !!}
                                </div>
                            </div>
                        @endif
                        @if($academicProgram->admission_requirements_km)
                            <div class="col-md-6">
                                <h6>Khmer:</h6>
                                <div class="border rounded p-3 bg-light">
                                    {!! nl2br(e($academicProgram->admission_requirements_km)) !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- Curriculum -->
        @if($academicProgram->curriculum_en || $academicProgram->curriculum_km)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Curriculum</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($academicProgram->curriculum_en)
                            <div class="col-md-6">
                                <h6>English:</h6>
                                <div class="border rounded p-3 bg-light">
                                    {!! nl2br(e($academicProgram->curriculum_en)) !!}
                                </div>
                            </div>
                        @endif
                        @if($academicProgram->curriculum_km)
                            <div class="col-md-6">
                                <h6>Khmer:</h6>
                                <div class="border rounded p-3 bg-light">
                                    {!! nl2br(e($academicProgram->curriculum_km)) !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="col-lg-4">
        <!-- Quick Actions -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.academic-programs.edit', $academicProgram) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit Program
                    </a>
                    <a href="{{ route('public.academic-programs.show', $academicProgram->slug) }}" 
                       target="_blank" class="btn btn-outline-success">
                        <i class="bi bi-eye"></i> View on Public Site
                    </a>
                    <form method="POST" action="{{ route('admin.academic-programs.destroy', $academicProgram) }}" 
                          onsubmit="return confirm('Are you sure you want to delete this academic program?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="bi bi-trash"></i> Delete Program
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Program Details -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Program Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th>Slug:</th>
                        <td><code>{{ $academicProgram->slug }}</code></td>
                    </tr>
                    <tr>
                        <th>Sort Order:</th>
                        <td>{{ $academicProgram->sort_order }}</td>
                    </tr>
                    <tr>
                        <th>Created:</th>
                        <td>{{ $academicProgram->created_at->format('M j, Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Updated:</th>
                        <td>{{ $academicProgram->updated_at->format('M j, Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection