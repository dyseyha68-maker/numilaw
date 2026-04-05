@extends('admin.layouts.app')

@section('title', 'Programs')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 mb-0">Programs</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.admissions.programs.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i> Add Program
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>Name (EN)</th>
                        <th>Name (KH)</th>
                        <th>Degree</th>
                        <th>Tuition</th>
                        <th>Scholarship</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programs as $program)
                    <tr>
                        <td>{{ $program->name_en }}</td>
                        <td>{{ $program->name_kh }}</td>
                        <td>{{ ucfirst($program->degree_level) }}</td>
                        <td>{{ $program->tuition_en }}</td>
                        <td>
                            @if($program->scholarship_available)
                            <span class="badge bg-warning">Yes</span>
                            @else
                            <span class="text-muted">No</span>
                            @endif
                        </td>
                        <td>
                            @if($program->is_active)
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.admissions.programs.edit', $program->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.admissions.programs.destroy', $program->id) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No programs</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
