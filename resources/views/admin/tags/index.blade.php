@extends('admin.layouts.app')

@section('title', 'Tags')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Tags</h1>
    <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> New Tag
    </a>
</div>

<!-- Search and Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.tags.index') }}">
            <div class="row g-3">
                <div class="col-md-8">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Search tags..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-search"></i> Search
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Tags Table -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name (EN)</th>
                        <th>Name (KM)</th>
                        <th>Description</th>
                        <th>Color</th>
                        <th>Articles</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tags as $tag)
                        <tr>
                            <td>
                                <strong>{{ $tag->name_en }}</strong>
                            </td>
                            <td>{{ $tag->name_km }}</td>
                            <td>
                                @if($tag->description_en)
                                    {{ Str::limit($tag->description_en, 50) }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($tag->color)
                                    <span class="badge" style="background-color: {{ $tag->color }};">
                                        <i class="bi bi-palette"></i> {{ $tag->color }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info">
                                    {{ $tag->articles_count }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $tag->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $tag->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-center" style="vertical-align: middle;">
                                <div class="d-flex gap-1 justify-content-center">
                                    <a href="{{ route('admin.tags.show', $tag) }}" 
                                       class="btn btn-sm btn-outline-primary" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.tags.edit', $tag) }}" 
                                       class="btn btn-sm btn-outline-secondary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.tags.destroy', $tag) }}" 
                                          class="d-inline" onsubmit="return confirm('Are you sure you want to delete this tag?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                <i class="bi bi-tags"></i> No tags found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">
                Showing {{ $tags->firstItem() }} to {{ $tags->lastItem() }} of {{ $tags->total() }} entries
            </small>
            {{ $tags->links() }}
        </div>
    </div>
</div>
@endsection