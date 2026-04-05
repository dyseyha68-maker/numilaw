@extends('admin.layouts.app')

@section('title', 'Academic Programs')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Academic Programs</h1>
    <a href="{{ route('admin.academic-programs.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> New Program
    </a>
</div>

<!-- Filters and Search -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.academic-programs.index') }}" class="row g-3">
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" placeholder="Search programs...">
                    <label for="search">Search Programs</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <select class="form-select" id="degree_type_filter" name="degree_type">
                        <option value="">All Degree Types</option>
                        @foreach(['bachelor' => 'Bachelor\'s Degree', 'master' => 'Master\'s Degree', 'doctorate' => 'Doctorate', 'certificate' => 'Certificate'] as $key => $label)
                            <option value="{{ $key }}" {{ request('degree_type') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <label for="degree_type_filter">Degree Type</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <select class="form-select" id="status_filter" name="status">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <label for="status_filter">Status</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="btn-group w-100" role="group">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.academic-programs.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i> Clear
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Programs Table -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Program</th>
                        <th>Degree Type</th>
                        <th>Duration</th>
                        <th>Credits</th>
                        <th>Active</th>
                        <th>Sort Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programs as $program)
                        <tr>
                            <td>
                                <div>
                                    <strong>{{ Str::limit($program->title_en, 40) }}</strong>
                                    @if($program->featured_image)
                                        <br><small class="text-muted"><i class="bi bi-image"></i> Has image</small>
                                    @endif
                                    @if($program->tuition_fee)
                                        <br><small class="text-success"><i class="bi bi-currency-dollar"></i> ${{ number_format($program->tuition_fee, 2) }}</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $program->degree_type_display }}</span>
                            </td>
                            <td>{{ $program->duration_years }} {{ __('year') }}{{ $program->duration_years > 1 ? 's' : '' }}</td>
                            <td>{{ $program->credits_required }} credits</td>
                            <td>
                                @if($program->is_active)
                                    <span class="badge bg-success"><i class="bi bi-check-circle"></i> Active</span>
                                @else
                                    <span class="badge bg-secondary"><i class="bi bi-x-circle"></i> Inactive</span>
                                @endif
                            </td>
                            <td>{{ $program->sort_order }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-gear"></i> Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.academic-programs.show', $program) }}">
                                                <i class="bi bi-eye"></i> View Details
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.academic-programs.edit', $program) }}">
                                                <i class="bi bi-pencil"></i> Edit Program
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('public.academic-programs.show', $program->slug) }}" target="_blank">
                                                <i class="bi bi-box-arrow-up-right"></i> View Public Page
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('admin.academic-programs.destroy', $program) }}" 
                                                  onsubmit="return confirm('Are you sure you want to delete this academic program? This action cannot be undone.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="bi bi-trash"></i> Delete Program
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                <i class="bi bi-mortarboard"></i> No academic programs found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">
                @if($programs->hasPages())
                    Showing {{ $programs->firstItem() }} to {{ $programs->lastItem() }} of {{ $programs->total() }} entries
                @else
                    @if($programs->count() > 0)
                        Showing all {{ $programs->count() }} entries
                    @else
                        No entries found
                    @endif
                @endif
            </small>
            {{ $programs->links() }}
        </div>
    </div>
</div>
@endsection