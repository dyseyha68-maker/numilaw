@extends('admin.layouts.app')

@section('title', 'Articles')

@section('css')
<style>
.bulk-actions {
    transition: all 0.3s ease;
}
.article-row {
    transition: background-color 0.2s ease;
}
.article-row:hover {
    background-color: #f8f9fa;
}
.article-title {
    max-width: 300px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.article-meta {
    font-size: 0.875rem;
}
.filter-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}
.stats-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}
</style>
@endsection

@section('content')
<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h3 class="mb-0">{{ $articles->total() }}</h3>
                        <small>Total Articles</small>
                    </div>
                    <div class="fs-2 opacity-75">
                        <i class="bi bi-newspaper"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h3 class="mb-0">{{ App\Models\Article::where('status', 'published')->count() }}</h3>
                        <small>Published</small>
                    </div>
                    <div class="fs-2 opacity-75">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h3 class="mb-0">{{ App\Models\Article::where('status', 'draft')->count() }}</h3>
                        <small>Drafts</small>
                    </div>
                    <div class="fs-2 opacity-75">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h3 class="mb-0">{{ App\Models\Article::where('is_featured', true)->count() }}</h3>
                        <small>Featured</small>
                    </div>
                    <div class="fs-2 opacity-75">
                        <i class="bi bi-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Articles Management</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
            <i class="bi bi-plus"></i> New Article
        </a>
        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#filterSection">
            <i class="bi bi-funnel"></i> Filters
        </button>
    </div>
</div>

<!-- Filters Section -->
<div class="collapse mb-4" id="filterSection">
    <div class="card filter-section">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.articles.index') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label text-white">Search</label>
                        <input type="text" name="search" class="form-control" placeholder="Search articles..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label text-white">Status</label>
                        <select name="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label text-white">Category</label>
                        <select name="category_id" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label text-white">Featured</label>
                        <select name="is_featured" class="form-select">
                            <option value="">All</option>
                            <option value="1" {{ request('is_featured') == '1' ? 'selected' : '' }}>Featured</option>
                            <option value="0" {{ request('is_featured') == '0' ? 'selected' : '' }}>Not Featured</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-white">Actions</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-light">
                                <i class="bi bi-search"></i> Search
                            </button>
                            <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-light">
                                <i class="bi bi-x-circle"></i> Clear
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bulk Actions Form -->
<form method="POST" action="{{ route('admin.articles.bulk-action') }}" id="bulkActionForm">
    @csrf
<div class="card">
    <div class="card-body">
        <!-- Bulk Actions Bar -->
        <div class="bulk-actions d-flex justify-content-between align-items-center mb-3" style="display: none;">
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted">
                    <span id="selectedCount">0</span> items selected
                </span>
                <select name="action" class="form-select form-select-sm" style="width: auto;">
                    <option value="">Bulk Actions</option>
                    <option value="publish">Publish</option>
                    <option value="unpublish">Unpublish</option>
                    <option value="feature">Feature</option>
                    <option value="unfeature">Unfeature</option>
                    <option value="delete" class="text-danger">Delete</option>
                </select>
                <button type="submit" class="btn btn-primary btn-sm">Apply</button>
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="clearSelection()">Clear Selection</button>
            </div>
        </div>

        @if($articles->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="40">
                                <input type="checkbox" id="selectAll" class="form-check-input">
                            </th>
                            <th>
                                <div class="d-flex align-items-center gap-2">
                                    Title
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                            <i class="bi bi-arrow-down-up"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="?sort_by=title_en&sort_order=asc">A-Z</a></li>
                                            <li><a class="dropdown-item" href="?sort_by=title_en&sort_order=desc">Z-A</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>
                                <div class="d-flex align-items-center gap-2">
                                    Created
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                            <i class="bi bi-arrow-down-up"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="?sort_by=created_at&sort_order=desc">Newest</a></li>
                                            <li><a class="dropdown-item" href="?sort_by=created_at&sort_order=asc">Oldest</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                            <tr class="article-row">
                                <td>
                                    <input type="checkbox" name="article_ids[]" value="{{ $article->id }}" class="form-check-input article-checkbox">
                                </td>
                                <td>
                                    <div class="article-title" title="{{ $article->title_en }}">
                                        <div class="fw-bold">{{ $article->title_en }}</div>
                                        @if($article->title_km)
                                            <small class="text-muted">{{ Str::limit($article->title_km, 50) }}</small>
                                        @endif
                                    </div>
                                    <div class="article-meta text-muted">
                                        <small>
                                            <i class="bi bi-eye"></i> {{ $article->views }} views
                                            @if($article->tags->count() > 0)
                                                <span class="ms-2">
                                                    <i class="bi bi-tags"></i> {{ $article->tags->count() }} tags
                                                </span>
                                            @endif
                                        </small>
                                    </div>
                                </td>
                                <td>
                                    @if($article->category)
                                        <span class="badge bg-light text-dark">{{ $article->category->name }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ $article->author->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($article->author->name) . '&color=7F9CF5&background=EBF4FF' }}" 
                                             alt="{{ $article->author->name }}" 
                                             class="rounded-circle" 
                                             style="width: 24px; height: 24px; object-fit: cover;">
                                        <small>{{ $article->author->name }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $article->status === 'published' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($article->status) }}
                                    </span>
                                    @if($article->published_at)
                                        <br><small class="text-muted">{{ $article->published_at->format('M j, Y') }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if($article->is_featured)
                                        <span class="badge bg-warning">Featured</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">{{ $article->created_at->format('M j, Y') }}</small>
                                    <br><small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.articles.show', $article) }}" class="btn btn-outline-primary" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-outline-secondary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" title="More">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <form action="{{ route('admin.articles.duplicate', $article) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="bi bi-files me-1"></i> Duplicate
                                                        </button>
                                                    </form>
                                                </li>
                                                <li>
                                                    @if($article->status === 'published')
                                                        <form action="{{ route('admin.articles.unpublish', $article) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item text-warning">
                                                                <i class="bi bi-eye-slash me-1"></i> Unpublish
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('admin.articles.publish', $article) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item text-success">
                                                                <i class="bi bi-eye me-1"></i> Publish
                                                            </button>
                                                        </form>
                                                    @endif
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.articles.toggle-featured', $article) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item {{ $article->is_featured ? 'text-warning' : 'text-info' }}">
                                                            <i class="bi bi-star{{ $article->is_featured ? '-fill' : '' }} me-1"></i> 
                                                            {{ $article->is_featured ? 'Unfeature' : 'Feature' }}
                                                        </button>
                                                    </form>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this article?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="bi bi-trash me-1"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Showing {{ $articles->firstItem() }} to {{ $articles->lastItem() }} of {{ $articles->total() }} results
                </div>
                {{ $articles->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-newspaper display-1 text-muted"></i>
                <h3 class="mt-3">No Articles Found</h3>
                <p class="text-muted">
                    @if(request()->hasAny(['search', 'status', 'category_id', 'is_featured']))
                        No articles match your current filters. 
                        <a href="{{ route('admin.articles.index') }}" class="text-decoration-none">Clear filters</a> to see all articles.
                    @else
                        Get started by creating your first article.
                    @endif
                </p>
                <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Create Article
                </a>
            </div>
        @endif
    </div>
</div>
</form>

<!-- Bulk Action Confirmation Modal -->
<div class="modal fade" id="bulkActionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Bulk Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to <strong id="actionText"></strong> <strong id="actionCount"></strong> selected articles?</p>
                <p class="text-danger mb-0" id="deleteWarning" style="display: none;">
                    This action cannot be undone and will permanently delete the selected articles.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmBulkAction">Confirm</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('selectAll');
    const articleCheckboxes = document.querySelectorAll('.article-checkbox');
    const bulkActions = document.querySelector('.bulk-actions');
    const selectedCount = document.getElementById('selectedCount');
    const bulkActionForm = document.getElementById('bulkActionForm');
    
    // Select all functionality
    selectAll.addEventListener('change', function() {
        articleCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateBulkActions();
    });
    
    // Individual checkbox functionality
    articleCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActions);
    });
    
    // Update bulk actions display
    function updateBulkActions() {
        const checked = document.querySelectorAll('.article-checkbox:checked');
        const count = checked.length;
        
        selectedCount.textContent = count;
        
        if (count > 0) {
            bulkActions.style.display = 'flex';
            selectAll.checked = count === articleCheckboxes.length;
            selectAll.indeterminate = count > 0 && count < articleCheckboxes.length;
        } else {
            bulkActions.style.display = 'none';
            selectAll.checked = false;
            selectAll.indeterminate = false;
        }
    }
    
    // Clear selection
    window.clearSelection = function() {
        selectAll.checked = false;
        articleCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
        updateBulkActions();
    };
    
    // Bulk action confirmation
    bulkActionForm.addEventListener('submit', function(e) {
        const action = document.querySelector('select[name="action"]').value;
        const count = document.querySelectorAll('.article-checkbox:checked').length;
        
        if (!action) {
            e.preventDefault();
            alert('Please select an action');
            return;
        }
        
        if (count === 0) {
            e.preventDefault();
            alert('Please select at least one article');
            return;
        }
        
        if (action === 'delete') {
            e.preventDefault();
            document.getElementById('actionText').textContent = 'delete';
            document.getElementById('actionCount').textContent = count;
            document.getElementById('deleteWarning').style.display = 'block';
            
            const modal = new bootstrap.Modal(document.getElementById('bulkActionModal'));
            modal.show();
            
            document.getElementById('confirmBulkAction').onclick = function() {
                bulkActionForm.submit();
                modal.hide();
            };
        }
    });
});
</script>
@endsection