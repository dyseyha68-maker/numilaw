@extends('admin.layouts.app')

@section('title', 'Manage Student Experiences')

@push('styles')
<style>
    .filter-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    
    .filter-tabs .btn {
        border-radius: 20px;
        padding: 6px 16px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 mb-0">Student Experiences</h1>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="filter-tabs">
        <a href="{{ route('admin.student-experience.experiences', ['status' => 'all']) }}" 
           class="btn {{ $status === 'all' ? 'btn-primary' : 'btn-outline-secondary' }}">
            All
        </a>
        <a href="{{ route('admin.student-experience.experiences', ['status' => 'pending']) }}" 
           class="btn {{ $status === 'pending' ? 'btn-primary' : 'btn-outline-secondary' }}">
            Pending
        </a>
        <a href="{{ route('admin.student-experience.experiences', ['status' => 'approved']) }}" 
           class="btn {{ $status === 'approved' ? 'btn-primary' : 'btn-outline-secondary' }}">
            Approved
        </a>
        <a href="{{ route('admin.student-experience.experiences', ['status' => 'rejected']) }}" 
           class="btn {{ $status === 'rejected' ? 'btn-primary' : 'btn-outline-secondary' }}">
            Rejected
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Name</th>
                            <th>Batch</th>
                            <th>Program</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($experiences as $experience)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($experience->photo)
                                    <img src="{{ Storage::url($experience->photo) }}" alt="" class="rounded-circle me-2" style="width: 36px; height: 36px; object-fit: cover;">
                                    @else
                                    <div class="rounded-circle bg-secondary me-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                        <i class="bi bi-person text-white"></i>
                                    </div>
                                    @endif
                                    {{ $experience->student_name }}
                                </div>
                            </td>
                            <td>{{ $experience->batch_year }}</td>
                            <td>{{ $experience->program }}</td>
                            <td>
                                @switch($experience->status)
                                    @case('pending')
                                        <span class="badge bg-warning">Pending</span>
                                        @break
                                    @case('approved')
                                        <span class="badge bg-success">Approved</span>
                                        @break
                                    @case('rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                @if($experience->is_featured)
                                <span class="badge bg-primary">Featured</span>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $experience->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.student-experience.experiences.edit', $experience->id) }}" class="btn btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.student-experience.experiences.feature', $experience->id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn {{ $experience->is_featured ? 'btn-warning' : 'btn-outline-secondary' }}" title="{{ $experience->is_featured ? 'Unfeature' : 'Feature' }}">
                                            <i class="bi bi-star{{ $experience->is_featured ? '-fill' : '' }}"></i>
                                        </button>
                                    </form>
                                    @if($experience->status === 'pending')
                                    <form method="POST" action="{{ route('admin.student-experience.experiences.approve', $experience->id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success" title="Approve">
                                            <i class="bi bi-check"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.student-experience.experiences.reject', $experience->id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger" title="Reject">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </form>
                                    @endif
                                    <form method="POST" action="{{ route('admin.student-experience.experiences.destroy', $experience->id) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Delete" onclick="return confirm('Delete this experience?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No experiences found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $experiences->links() }}
    </div>
</div>
@endsection
