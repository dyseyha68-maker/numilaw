@extends('admin.layouts.app')

@section('title', 'Projects & Clubs')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Projects & Clubs Management</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Create New Project
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>All Projects & Clubs</h5>
    </div>
    <div class="card-body">
        @if($projects->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name (EN)</th>
                        <th>Type</th>
                        <th>Supervisor</th>
                        <th>Start Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->name_en }}</td>
                        <td>
                            @switch($project->type)
                                @case('club')
                                    <span class="badge bg-info">Club</span>
                                    @break
                                @case('academic_project')
                                    <span class="badge bg-primary">Academic Project</span>
                                    @break
                                @case('research_project')
                                    <span class="badge bg-warning">Research Project</span>
                                    @break
                            @endswitch
                        </td>
                        <td>{{ $project->supervisor->name ?? 'N/A' }}</td>
                        <td>{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('M d, Y') : '-' }}</td>
                        <td>
                            @if($project->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Completed</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-outline-primary" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-outline-secondary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Delete" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $projects->links() }}
        @else
        <p class="text-muted">No projects found. Create your first project!</p>
        @endif
    </div>
</div>
@endsection
