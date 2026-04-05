@extends('admin.layouts.app')

@section('title', 'Category Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Category Details</h1>
    <div>
        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-outline-primary me-2">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Categories
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Category Information</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted">Name (English)</label>
                        <p class="form-control-plaintext">{{ $category->name_en }}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label text-muted">Name (Khmer)</label>
                        <p class="form-control-plaintext">{{ $category->name_km }}</p>
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label text-muted">Slug</label>
                        <p class="form-control-plaintext">{{ $category->slug }}</p>
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label text-muted">Description (English)</label>
                        <p class="form-control-plaintext">
                            {{ $category->description_en ?: 'No description provided' }}
                        </p>
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label text-muted">Description (Khmer)</label>
                        <p class="form-control-plaintext">
                            {{ $category->description_km ?: 'No description provided' }}
                        </p>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label text-muted">Status</label>
                        <p>
                            <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label text-muted">Created</label>
                        <p class="form-control-plaintext">{{ $category->created_at->format('M j, Y g:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Statistics</h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Total Articles</span>
                    <span class="badge bg-info fs-6">{{ $category->articles->count() }}</span>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Published Articles</span>
                    <span class="badge bg-success fs-6">
                        {{ $category->articles->where('status', 'published')->count() }}
                    </span>
                </div>
                
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted">Draft Articles</span>
                    <span class="badge bg-secondary fs-6">
                        {{ $category->articles->where('status', 'draft')->count() }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Articles in this Category -->
@if($category->articles->count() > 0)
<div class="card mt-4">
    <div class="card-header">
        <h6 class="mb-0">Articles in this Category</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Published</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category->articles as $article)
                        <tr>
                            <td>
                                <strong>{{ Str::limit($article->title_en, 50) }}</strong>
                            </td>
                            <td>{{ $article->author->name }}</td>
                            <td>
                                <span class="badge {{ $article->status === 'published' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $article->status }}
                                </span>
                            </td>
                            <td>
                                @if($article->published_at)
                                    {{ $article->published_at->format('M j, Y') }}
                                @else
                                    <span class="text-muted">Not published</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.articles.show', $article) }}" 
                                   class="btn btn-sm btn-outline-primary" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection