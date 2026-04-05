@extends('admin.layouts.app')

@section('title', 'Faculty Members')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Faculty Members</h1>
        <p class="text-muted mb-0">Manage your faculty and staff</p>
    </div>
    <a href="{{ route('admin.faculty.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Add Faculty
    </a>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-3 bg-primary bg-opacity-10 p-3 me-3">
                    <i class="bi bi-people-fill text-primary fs-4"></i>
                </div>
                <div>
                    <h3 class="mb-0">{{ $faculty->total() }}</h3>
                    <small class="text-muted">Total Faculty</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-3 bg-success bg-opacity-10 p-3 me-3">
                    <i class="bi bi-check-circle-fill text-success fs-4"></i>
                </div>
                <div>
                    <h3 class="mb-0">{{ $faculty->where('status', 'active')->count() }}</h3>
                    <small class="text-muted">Active</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-3 bg-secondary bg-opacity-10 p-3 me-3">
                    <i class="bi bi-clock-history text-secondary fs-4"></i>
                </div>
                <div>
                    <h3 class="mb-0">{{ $faculty->where('status', 'inactive')->count() }}</h3>
                    <small class="text-muted">Inactive</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filters -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.faculty.index') }}">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0" 
                               placeholder="Search by name or email..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="department" class="form-select">
                        <option value="">All Departments</option>
                        @foreach($departments ?? [] as $department)
                            <option value="{{ $department }}" {{ request('department') == $department ? 'selected' : '' }}>
                                {{ $department }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-outline-primary me-2">
                        <i class="bi bi-search me-1"></i> Search
                    </button>
                    <a href="{{ route('admin.faculty.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Faculty Grid -->
<div class="row g-4">
    @forelse($faculty as $member)
    <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm h-100 faculty-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-start">
                    <div class="position-relative me-3">
                        @if($member->photo)
                            @if(substr($member->photo, 0, 4) === 'http')
                                <img src="{{ $member->photo }}" 
                                     alt="{{ $member->name }}" 
                                     class="rounded-circle"
                                     style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                                <img src="{{ url('/laravel-img/' . $member->photo) }}" 
                                     alt="{{ $member->name }}" 
                                     class="rounded-circle"
                                     style="width: 80px; height: 80px; object-fit: cover;">
                            @endif
                        @else
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white fw-bold"
                                 style="width: 80px; height: 80px; font-size: 1.5rem;">
                                {{ strtoupper(substr($member->name, 0, 2)) }}
                            </div>
                        @endif
                        <span class="position-absolute bottom-0 end-0 translate-middle badge rounded-pill {{ $member->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                            {{ $member->status === 'active' ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-1" style="color: #003A46;">{{ $member->name }}</h5>
                        <p class="text-muted mb-1 small">{{ $member->title }}</p>
                        <span class="badge bg-light text-dark">
                            <i class="bi bi-building me-1"></i>{{ $member->department }}
                        </span>
                    </div>
                </div>
                
                <hr class="my-3">
                
                <div class="row g-2 small">
                    @if($member->email)
                    <div class="col-12">
                        <i class="bi bi-envelope me-2 text-muted"></i>
                        <a href="mailto:{{ $member->email }}" class="text-decoration-none">{{ $member->email }}</a>
                    </div>
                    @endif
                    @if($member->specialization_en)
                    <div class="col-12">
                        <i class="bi bi-lightbulb me-2 text-muted"></i>
                        <span class="text-muted">{{ Str::limit($member->specialization_en, 40) }}</span>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 p-3 pt-0">
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.faculty.show', $member) }}" 
                       class="btn btn-sm btn-outline-primary flex-grow-1">
                        <i class="bi bi-eye me-1"></i> View
                    </a>
                    <a href="{{ route('admin.faculty.edit', $member) }}" 
                       class="btn btn-sm btn-outline-secondary flex-grow-1">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                    <form method="POST" action="{{ route('admin.faculty.destroy', $member) }}" 
                          class="flex-grow-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100" 
                                onclick="return confirm('Delete this faculty member?')">
                            <i class="bi bi-trash me-1"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="text-center py-5">
            <div class="mb-3">
                <i class="bi bi-people fs-1 text-muted"></i>
            </div>
            <h5 class="text-muted">No faculty members found</h5>
            <p class="text-muted mb-3">Get started by adding your first faculty member</p>
            <a href="{{ route('admin.faculty.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i>Add Faculty
            </a>
        </div>
    </div>
    @endforelse
</div>

<!-- Pagination -->
@if($faculty->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $faculty->withQueryString()->links() }}
</div>
@endif

<style>
.faculty-card {
    transition: transform 0.2s, box-shadow 0.2s;
}
.faculty-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}
</style>
@endsection
