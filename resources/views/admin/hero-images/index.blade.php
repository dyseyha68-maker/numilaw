@extends('admin.layouts.app')

@section('title', 'Hero Section Images')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Hero Section Images</h4>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3">Page</th>
                        <th class="py-3">Preview</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 text-end px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($heroImages as $heroImage)
                    <tr>
                        <td class="px-4">
                            <div class="d-flex align-items-center gap-3">
                                <div>
                                    <h6 class="fw-bold mb-0">{{ $heroImage->title }}</h6>
                                    <small class="text-muted">{{ $heroImage->page_key }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($heroImage->image)
                            <img src="{{ asset($heroImage->image) }}" alt="{{ $heroImage->title }}" 
                                 style="width: 120px; height: 60px; object-fit: cover; border-radius: 8px;">
                            @else
                            <span class="badge bg-light text-dark">No image</span>
                            @endif
                        </td>
                        <td>
                            @if($heroImage->is_active)
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.hero-images.edit', $heroImage->id) }}" 
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil me-1"></i> Edit
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">
                            No hero images configured yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
