@extends('admin.layouts.app')

@section('title', 'Preview: ' . $article->title_en)

@section('css')
<style>
.preview-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1rem;
    border-radius: 8px 8px 0 0;
    position: sticky;
    top: 0;
    z-index: 1000;
}
.article-preview {
    font-family: var(--font-admin);
    line-height: 1.8;
    color: #333;
    max-width: 800px;
    margin: 0 auto;
}
.article-preview h1 {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 1rem;
    color: #1a1a1a;
}
.article-preview h2 {
    font-size: 2rem;
    font-weight: 600;
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #1a1a1a;
}
.article-preview h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
    color: #1a1a1a;
}
.article-preview p {
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
    color: #4a4a4a;
}
.article-preview img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 2rem 0;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.article-meta {
    background-color: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 2rem;
}
.author-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}
.author-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
}
.article-tags {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #dee2e6;
}
.tag-badge {
    display: inline-block;
    background-color: #e9ecef;
    color: #495057;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
    text-decoration: none;
    transition: background-color 0.2s ease;
}
.tag-badge:hover {
    background-color: #dee2e6;
    color: #212529;
}
.featured-image {
    margin: 2rem 0;
    text-align: center;
}
.featured-image img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}
.seo-preview {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 2rem;
}
.seo-preview .url {
    color: #006621;
    font-size: 14px;
    margin-bottom: 0.5rem;
}
.seo-preview .title {
    color: #1a0dab;
    font-size: 18px;
    font-weight: 400;
    margin-bottom: 0.5rem;
}
.seo-preview .description {
    color: #545454;
    font-size: 14px;
    line-height: 1.4;
}
</style>
@endsection

@section('content')
<!-- Preview Header -->
<div class="preview-header d-flex justify-content-between align-items-center">
    <div>
        <h4 class="mb-0">
            <i class="bi bi-eye"></i> Article Preview
        </h4>
        <small class="opacity-75">This is how your article will appear to readers</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.articles.show', $article) }}" class="btn btn-light">
            <i class="bi bi-arrow-left"></i> Back to Admin
        </a>
        <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-light">
            <i class="bi bi-pencil"></i> Edit
        </a>
        @if($article->status === 'draft')
            <form action="{{ route('admin.articles.publish', $article) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Publish
                </button>
            </form>
        @endif
    </div>
</div>

<!-- SEO Preview Section -->
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="seo-preview">
                <h6 class="mb-3">Google Search Preview</h6>
                <div class="url">{{ url('/public/articles/' . $article->slug) }}</div>
                <div class="title">{{ Str::limit($article->title_en, 60) }}</div>
                <div class="description">
                    {{ $article->excerpt_en ?: Str::limit(strip_tags($article->content_en), 160) }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Article Preview -->
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="article-preview">
                <!-- Article Title -->
                <h1>{{ $article->title_en }}</h1>
                @if($article->title_km)
                    <h2 class="text-muted h4">{{ $article->title_km }}</h2>
                @endif

                <!-- Article Meta -->
                <div class="article-meta">
                    <div class="author-info">
                        <img src="{{ $article->author->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($article->author->name) . '&color=7F9CF5&background=EBF4FF' }}" 
                             alt="{{ $article->author->name }}" 
                             class="author-avatar">
                        <div>
                            <div class="fw-bold">{{ $article->author->name }}</div>
                            <div class="text-muted">{{ $article->author->email }}</div>
                            <div class="text-muted small">
                                {{ $article->published_at ? $article->published_at->format('F j, Y') : $article->created_at->format('F j, Y') }}
                                @if($article->category)
                                    <span class="ms-2">• {{ $article->category->name }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3 text-center">
                        <div class="col-4">
                            <div class="fw-bold">{{ number_format($article->views) }}</div>
                            <div class="text-muted small">Views</div>
                        </div>
                        <div class="col-4">
                            <div class="fw-bold">{{ str_word_count(strip_tags($article->content_en)) }}</div>
                            <div class="text-muted small">Words</div>
                        </div>
                        <div class="col-4">
                            <div class="fw-bold">{{ ceil(str_word_count(strip_tags($article->content_en)) / 200) }}m</div>
                            <div class="text-muted small">Read Time</div>
                        </div>
                    </div>
                </div>

                <!-- Featured Image -->
                @if($article->featured_image)
                    <div class="featured-image">
                        <img src="{{ url('/laravel-img/' . $article->featured_image) }}" 
                             alt="{{ $article->title_en }}">
                    </div>
                @endif

                <!-- Article Excerpt -->
                @if($article->excerpt_en)
                    <div class="lead text-muted mb-4">
                        {{ $article->excerpt_en }}
                    </div>
                @endif

                <!-- Article Content -->
                <div class="article-content">
                    {!! $article->content_en !!}
                </div>

                <!-- Article Tags -->
                @if($article->tags->count() > 0)
                    <div class="article-tags">
                        <h6 class="mb-3">Tags</h6>
                        @foreach($article->tags as $tag)
                            <span class="tag-badge">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                @endif

                <!-- Share Section -->
                <div class="mt-5 pt-4 border-top">
                    <h6 class="mb-3">Share this article</h6>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>
                        <a href="#" class="btn btn-outline-info btn-sm">
                            <i class="bi bi-twitter"></i> Twitter
                        </a>
                        <a href="#" class="btn btn-outline-success btn-sm">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-link-45deg"></i> Copy Link
                        </a>
                    </div>
                </div>

                <!-- Author Bio -->
                <div class="mt-5 p-4 bg-light rounded">
                    <h6 class="mb-3">About the Author</h6>
                    <div class="d-flex align-items-start gap-3">
                        <img src="{{ $article->author->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($article->author->name) . '&color=7F9CF5&background=EBF4FF' }}" 
                             alt="{{ $article->author->name }}" 
                             class="rounded-circle" 
                             style="width: 80px; height: 80px; object-fit: cover;">
                        <div>
                            <h6 class="mb-1">{{ $article->author->name }}</h6>
                            <p class="text-muted mb-0">
                                {{ $article->author->bio ?: 'Faculty member at NUM International Program of Legal Studies.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Action Buttons -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1000;">
    <div class="d-flex flex-column gap-2">
        <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-primary rounded-circle" style="width: 50px; height: 50px;" title="Edit Article">
            <i class="bi bi-pencil"></i>
        </a>
        @if($article->status === 'draft')
            <form action="{{ route('admin.articles.publish', $article) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success rounded-circle" style="width: 50px; height: 50px;" title="Publish Article">
                    <i class="bi bi-check"></i>
                </button>
            </form>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
// Copy link functionality
document.addEventListener('click', function(e) {
    if (e.target.closest('a')?.textContent?.includes('Copy Link')) {
        e.preventDefault();
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(function() {
            // Show feedback
            const button = e.target.closest('a');
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="bi bi-check"></i> Copied!';
            button.classList.add('btn-success');
            button.classList.remove('btn-outline-secondary');
            
            setTimeout(function() {
                button.innerHTML = originalText;
                button.classList.remove('btn-success');
                button.classList.add('btn-outline-secondary');
            }, 2000);
        });
    }
});

// Smooth scroll for internal links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Reading progress indicator
window.addEventListener('scroll', function() {
    const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrolled = (winScroll / height) * 100;
    
    // You could add a progress bar here if needed
});
</script>
@endsection