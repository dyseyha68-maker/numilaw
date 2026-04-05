@extends('admin.layouts.app')

@section('title', 'Intakes')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 mb-0">Intakes</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.admissions.intakes.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i> Add Intake
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>Intake Name</th>
                        <th>Program</th>
                        <th>Start</th>
                        <th>Deadline</th>
                        <th>Seats</th>
                        <th>Applications</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($intakes as $intake)
                    <tr>
                        <td>{{ $intake->intake_name_en }}</td>
                        <td>{{ $intake->program->name_en ?? '-' }}</td>
                        <td>{{ $intake->application_start }}</td>
                        <td>{{ $intake->application_end }}</td>
                        <td>{{ $intake->max_seats }}</td>
                        <td>{{ $intake->applications_count }}</td>
                        <td>
                            @if($intake->is_open)
                            <span class="badge bg-success">Open</span>
                            @else
                            <span class="badge bg-secondary">Closed</span>
                            @endif
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.admissions.intakes.toggle', $intake->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-{{ $intake->is_open ? 'warning' : 'success' }}">
                                    <i class="bi bi-toggle-{{ $intake->is_open ? 'on' : 'off' }}"></i>
                                </button>
                            </form>
                            <a href="{{ route('admin.admissions.intakes.edit', $intake->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">No intakes</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
