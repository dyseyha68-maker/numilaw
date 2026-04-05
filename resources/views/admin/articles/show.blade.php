@extends('admin.layouts.app')

@section('title', $article->title_en)

@section('css')
<style>
.article-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
}
.article-meta {
    opacity: 0.9;
    font-size: 0.9rem;
}
.article-content {
    line-height: 1.8;
    font-size: 1.1rem;
}
.article-content h1, .article-content h2, .article-content h3 {
    margin-top: 2rem;
    margin-bottom: 1rem;
}
.article-content p {
    margin-bottom: 1.5rem;
}
.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1.5rem 0;
}
.stat-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 12px;
    padding: 1.5rem;
    text-align: center;
    height: 100%;
}
.stat-card h3 {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}
.related-article {
    transition: transform 0.2s ease;
    cursor: pointer;
}
.related-article:hover {
    transform: translateY(-2px);
}
.featured-image {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}
.tag-badge {
    font-size: 0.8rem;
    padding: 0.25rem 0.75rem;
}
.timeline {
    position: relative;
    padding-left: 2rem;
}
.timeline::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 2px;
    background-color: #dee2e6;
}
.timeline-item {
    position: relative;
    margin-bottom: 1.5rem;
}
.timeline-item::before {
    content: '';
    position: absolute;
    left: -2.4rem;
    top: 0.5rem;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #007bff;
}
</style>
@endsection

@section('content')
<!-- Article Header -->
<div class="article-header">
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <div class="d-flex align-items-center gap-3 mb-2">
                <span class="badge bg-light text-dark">
                    {{ ucfirst($article->status) }}
                </span>
                @if($article->is_featured)
                    <span class="badge bg-warning">
                        <i class="bi bi-star-fill"></i> Featured
                    </span>
                @endif
                @if($article->category)
                    <span class="badge bg-info">{{ $article->category->name }}</span>
                @endif
            </div>
            <h1 class="display-5 fw-bold mb-0">{{ $article->title_en }}</h1>
            @if($article->title_km)
                <h2 class="h4 mt-2 opacity-75">{{ $article->title_km }}</h2>
            @endif
        </div>
        <div class="text-end">
            <div class="dropdown">
                <button class="btn btn-light btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('admin.articles.edit', $article) }}" class="dropdown-item">
                            <i class="bi bi-pencil"></i> Edit Article
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.articles.duplicate', $article) }}" class="dropdown-item">
                            <i class="bi bi-files"></i> Duplicate
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.articles.preview', $article) }}" class="dropdown-item" target="_blank">
                            <i class="bi bi-box-arrow-up-right"></i> Preview
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    @if($article->status === 'published')
                        <li>
                            <form action="{{ route('admin.articles.unpublish', $article) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item text-warning">
                                    <i class="bi bi-eye-slash"></i> Unpublish
                                </button>
                            </form>
                        </li>
                    @else
                        <li>
                            <form action="{{ route('admin.articles.publish', $article) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item text-success">
                                    <i class="bi bi-eye"></i> Publish
                                </button>
                            </form>
                        </li>
                    @endif
                    <li>
                        <form action="{{ route('admin.articles.toggle-featured', $article) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="dropdown-item {{ $article->is_featured ? 'text-secondary' : 'text-info' }}">
                                <i class="bi bi-star{{ $article->is_featured ? '-fill' : '' }}"></i> 
                                {{ $article->is_featured ? 'Unfeature' : 'Feature' }}
                            </button>
                        </form>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('Are you sure you want to delete this article? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-trash"></i> Delete Article
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="article-meta">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ $article->author->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($article->author->name) . '&color=7F9CF5&background=EBF4FF' }}" 
                         alt="{{ $article->author->name }}" 
                         class="rounded-circle border border-white border-3" 
                         style="width: 50px; height: 50px; object-fit: cover;">
                    <div>
                        <div class="fw-bold">{{ $article->author->name }}</div>
                        <div>{{ $article->author->email }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="d-flex flex-column flex-md-row gap-3 justify-content-md-end">
                    <div>
                        <i class="bi bi-calendar3"></i> Created: {{ $article->created_at->format('M j, Y') }}
                    </div>
                    <div>
                        <i class="bi bi-clock"></i> Updated: {{ $article->updated_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>
        @if($article->published_at)
            <div class="mt-3">
                <i class="bi bi-check-circle"></i> Published: {{ $article->published_at->format('M j, Y \a\t h:i A') }}
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Featured Image -->
        @if($article->featured_image)
            <div class="featured-image mb-4">
                <img src="{{ url('/laravel-img/' . $article->featured_image) }}" 
                     alt="{{ $article->title_en }}" 
                     class="w-100">
            </div>
        @endif

        <!-- Article Content Tabs -->
        <ul class="nav nav-pills mb-4" id="contentTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="english-tab" data-bs-toggle="tab" data-bs-target="#english" type="button" role="tab">
                    <i class="bi bi-translate"></i> English
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="khmer-tab" data-bs-toggle="tab" data-bs-target="#khmer" type="button" role="tab">
                    <i class="bi bi-translate"></i> Khmer
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button" role="tab">
                    <i class="bi bi-search"></i> SEO
                </button>
            </li>
        </ul>

        <div class="tab-content" id="contentTabContent">
            <!-- English Content -->
            <div class="tab-pane fade show active" id="english" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        @if($article->excerpt_en)
                            <div class="lead text-muted mb-4">{{ $article->excerpt_en }}</div>
                        @endif
                        
                        <div class="article-content">
                            {!! $article->content_en !!}
                        </div>
                        
                        @if($article->tags->count() > 0)
                            <div class="mt-4 pt-4 border-top">
                                <h6>Tags</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($article->tags as $tag)
                                        <span class="badge bg-light text-dark tag-badge">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Khmer Content -->
            <div class="tab-pane fade" id="khmer" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        @if($article->excerpt_km)
                            <div class="lead text-muted mb-4">{{ $article->excerpt_km }}</div>
                        @endif
                        
                        <div class="article-content">
                            {!! $article->content_km !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO Information -->
            <div class="tab-pane fade" id="seo" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">SEO Information</h5>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h6>URL Slug</h6>
                                <code>{{ $article->slug }}</code>
                            </div>
                            <div class="col-md-6">
                                <h6>Canonical URL</h6>
                                <code>{{ url('/public/articles/' . $article->slug) }}</code>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <h6>Meta Title (English)</h6>
                            <div class="bg-light p-3 rounded">{{ Str::limit($article->title_en, 60) }}</div>
                            <small class="text-muted">Length: {{ Str::length($article->title_en) }} / 60 characters</small>
                        </div>
                        
                        <div class="mt-4">
                            <h6>Meta Description (English)</h6>
                            <div class="bg-light p-3 rounded">{{ $article->excerpt_en ?: 'No meta description set' }}</div>
                            <small class="text-muted">Length: {{ Str::length($article->excerpt_en) }} / 160 characters</small>
                        </div>
                        
                        <div class="mt-4">
                            <h6>Google Search Preview</h6>
                            <div class="border rounded p-3" style="background-color: #f8f9fa;">
                                <div class="text-success small">{{ url('/public/articles/' . $article->slug) }}</div>
                                <div class="h5 text-primary mt-1">{{ Str::limit($article->title_en, 60) }}</div>
                                <div class="text-muted">{{ $article->excerpt_en ?: Str::limit(strip_tags($article->content_en), 160) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Articles -->
        @if($relatedArticles->count() > 0)
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Related Articles</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($relatedArticles as $related)
                            <div class="col-md-6 mb-3">
                                <div class="related-article border rounded p-3">
                                    <h6 class="mb-2">
                                        <a href="{{ route('admin.articles.show', $related) }}" class="text-decoration-none">
                                            {{ $related->title_en }}
                                        </a>
                                    </h6>
                                    <div class="text-muted small mb-2">
                                        {{ Str::limit(strip_tags($related->content_en), 100) }}
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="bi bi-eye"></i> {{ $related->views }} views
                                        </small>
                                        <small class="text-muted">
                                            {{ $related->created_at->format('M j, Y') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="col-lg-4">
        <!-- Article Statistics -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-graph-up"></i> Article Statistics
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="stat-card">
                            <h3>{{ number_format($article->views) }}</h3>
                            <small>Total Views</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="stat-card">
                            <h3>{{ $stats['word_count_en'] }}</h3>
                            <small>Words (EN)</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-card">
                            <h3>{{ $stats['word_count_km'] }}</h3>
                            <small>Words (KM)</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-card">
                            <h3>{{ $stats['reading_time_en'] }}m</h3>
                            <small>Read Time (EN)</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Publishing Timeline -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clock-history"></i> Publishing Timeline
                </h5>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="fw-bold">Created</div>
                        <div class="text-muted small">{{ $article->created_at->format('M j, Y \a\t h:i A') }}</div>
                    </div>
                    @if($article->updated_at > $article->created_at)
                        <div class="timeline-item">
                            <div class="fw-bold">Last Updated</div>
                            <div class="text-muted small">{{ $article->updated_at->format('M j, Y \a\t h:i A') }}</div>
                        </div>
                    @endif
                    @if($article->published_at)
                        <div class="timeline-item">
                            <div class="fw-bold">Published</div>
                            <div class="text-muted small">{{ $article->published_at->format('M j, Y \a\t h:i A') }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-lightning"></i> Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit Article
                    </a>
                    <a href="{{ route('admin.articles.duplicate', $article) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-files"></i> Duplicate
                    </a>
                    <a href="{{ route('admin.articles.preview', $article) }}" class="btn btn-outline-info" target="_blank">
                        <i class="bi bi-box-arrow-up-right"></i> Preview
                    </a>
                    @if($article->status === 'draft')
                        <form action="{{ route('admin.articles.publish', $article) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-eye"></i> Publish Now
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.articles.unpublish', $article) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-warning w-100">
                                <i class="bi bi-eye-slash"></i> Unpublish
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Article URL -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-link-45deg"></i> Article URL
                </h5>
            </div>
            <div class="card-body">
                <div class="input-group">
                    <input type="text" class="form-control" value="{{ url('/public/articles/' . $article->slug) }}" readonly id="articleUrl">
                    <button class="btn btn-outline-secondary" type="button" onclick="copyUrl()">
                        <i class="bi bi-clipboard"></i> Copy
                    </button>
                </div>
                <small class="text-muted">Share this link with readers</small>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function copyUrl() {
    const urlInput = document.getElementById('articleUrl');
    urlInput.select();
    document.execCommand('copy');
    
    // Show feedback
    const button = event.target.closest('button');
    const originalHTML = button.innerHTML;
    button.innerHTML = '<i class="bi bi-check"></i> Copied!';
    button.classList.add('btn-success');
    button.classList.remove('btn-outline-secondary');
    
    setTimeout(function() {
        button.innerHTML = originalHTML;
        button.classList.remove('btn-success');
        button.classList.add('btn-outline-secondary');
    }, 2000);
}

// Auto-refresh statistics every 30 seconds if article is published
@if($article->status === 'published')
setInterval(function() {
    fetch('{{ route("admin.articles.show", $article) }}', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    }).then(response => response.text())
      .then(html => {
          // Update statistics if needed
      });
}, 30000);
@endif
</script>
@endsection