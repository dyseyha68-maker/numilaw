@extends('admin.layouts.app')

@section('title', 'Manage Internship Stories')

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
            <h1 class="h3 mb-0">Internship Stories</h1>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="filter-tabs">
        <a href="{{ route('admin.student-experience.internships', ['status' => 'all']) }}" 
           class="btn {{ $status === 'all' ? 'btn-primary' : 'btn-outline-secondary' }}">
            All
        </a>
        <a href="{{ route('admin.student-experience.internships', ['status' => 'pending']) }}" 
           class="btn {{ $status === 'pending' ? 'btn-primary' : 'btn-outline-secondary' }}">
            Pending
        </a>
        <a href="{{ route('admin.student-experience.internships', ['status' => 'approved']) }}" 
           class="btn {{ $status === 'approved' ? 'btn-primary' : 'btn-outline-secondary' }}">
            Approved
        </a>
        <a href="{{ route('admin.student-experience.internships', ['status' => 'rejected']) }}" 
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
                            <th>Student</th>
                            <th>Company</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($internships as $internship)
                        <tr>
                            <td>
                                <div>
                                    <strong>{{ $internship->student_name }}</strong>
                                    <br><small class="text-muted">Class of {{ $internship->batch_year }}</small>
                                </div>
                            </td>
                            <td>{{ $internship->company_name }}</td>
                            <td>{{ $internship->duration }}</td>
                            <td>
                                @switch($internship->status)
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
                                @if($internship->is_featured)
                                <span class="badge bg-primary">Featured</span>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $internship->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.student-experience.internships.edit', $internship->id) }}" class="btn btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.student-experience.internships.update', $internship->id) }}" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="student_name" value="{{ $internship->student_name }}">
                                        <input type="hidden" name="batch_year" value="{{ $internship->batch_year }}">
                                        <input type="hidden" name="company_name" value="{{ $internship->company_name }}">
                                        <input type="hidden" name="duration" value="{{ $internship->duration }}">
                                        <input type="hidden" name="story_en" value="{{ $internship->story_en }}">
                                        <input type="hidden" name="story_kh" value="{{ $internship->story_kh }}">
                                        <input type="hidden" name="status" value="{{ $internship->status }}">
                                        <input type="hidden" name="is_featured" value="{{ $internship->is_featured ? '0' : '1' }}">
                                        <button type="submit" class="btn {{ $internship->is_featured ? 'btn-warning' : 'btn-outline-warning' }}" title="{{ $internship->is_featured ? 'Unfeature' : 'Feature' }}">
                                            <i class="bi bi-star{{ $internship->is_featured ? '-fill' : '' }}"></i>
                                        </button>
                                    </form>
                                    @if($internship->status === 'pending')
                                    <form method="POST" action="{{ route('admin.student-experience.internships.approve', $internship->id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success" title="Approve">
                                            <i class="bi bi-check"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.student-experience.internships.reject', $internship->id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger" title="Reject">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </form>
                                    @endif
                                    <form method="POST" action="{{ route('admin.student-experience.internships.destroy', $internship->id) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Delete" onclick="return confirm('Delete this internship?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No internships found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $internships->links() }}
    </div>
</div>
@endsection
