@extends('admin.layouts.app')

@section('title', 'Manage Student Clubs')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 mb-0">Student Clubs</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.student-experience.clubs.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i>
                Add Club
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Logo</th>
                            <th>Name (EN)</th>
                            <th>Name (KH)</th>
                            <th>President</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clubs as $club)
                        <tr>
                            <td>
                                @if($club->logo)
                                <img src="{{ Storage::url($club->logo) }}" alt="" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                                @else
                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="bi bi-people text-white"></i>
                                </div>
                                @endif
                            </td>
                            <td>{{ $club->name_en }}</td>
                            <td>{{ $club->name_kh }}</td>
                            <td>{{ $club->president_name ?: '-' }}</td>
                            <td>
                                @if($club->is_active)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.student-experience.clubs.edit', $club->id) }}" class="btn btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.student-experience.clubs.destroy', $club->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Delete this club?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No clubs found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $clubs->links() }}
    </div>
</div>
@endsection
