@extends('admin.layouts.app')

@section('title', 'Manage Gallery')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 mb-0">Campus Gallery</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.student-experience.gallery.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i>
                Add New
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                @forelse($galleries as $gallery)
                <div class="col-md-3 col-sm-6">
                    <div class="card border-0" style="background: #f8fafc;">
                        <div class="position-relative">
                            @if($gallery->media_type === 'photo')
                            <img src="{{ Storage::url($gallery->media_path) }}" class="card-img-top" alt="" style="height: 180px; object-fit: cover;">
                            @else
                            <video src="{{ Storage::url($gallery->media_path) }}" class="card-img-top" style="height: 180px; object-fit: cover;"></video>
                            @endif
                            <span class="badge bg-dark position-absolute top-0 end-0 m-2">{{ $gallery->year }}</span>
                        </div>
                        <div class="card-body p-3">
                            <h6 class="mb-1">{{ $gallery->title_en }}</h6>
                            <p class="small text-muted mb-2">{{ $gallery->title_kh }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-secondary">{{ str_replace('_', ' ', ucfirst($gallery->category)) }}</span>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.student-experience.gallery.edit', $gallery->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.student-experience.gallery.destroy', $gallery->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this item?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No gallery items yet</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $galleries->links() }}
    </div>
</div>
@endsection
