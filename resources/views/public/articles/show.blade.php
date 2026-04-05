@extends('layouts.public')

@section('title', $article->title)
@section('description', Str::limit(strip_tags($article->excerpt ?? $article->content), 160))

@php
$heroImageUrl = $heroImage ? url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $heroImage)) : ($article->featured_image ? url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $article->featured_image)) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=1200&q=80');
@endphp

@push('styles')
<style>
    .reading-progress {
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: linear-gradient(90deg, #003A46, #0a9396);
        z-index: 10000;
        transition: width 0.1s ease;
    }
    
    .article-header-animated {
        position: relative;
        overflow: hidden;
        background: #f5fff5;
        min-height: 280px;
        padding: 80px 0 40px;
    }
    
    .article-header-animated .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }
    
    .article-header-animated .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }
    
    .article-header-animated .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .article-header-animated .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .article-header-animated .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .article-header-animated .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .article-header-animated .b5 {
        width: 110%; height: 110%;
        top: 30px; left: -5%;
        animation: moveB5 15s ease-in-out infinite alternate, colorB5 12s ease-in-out infinite alternate;
    }
    
    @keyframes moveB1 {
        0%   { transform: translate(0px, 0px) scale(1); }
        50%  { transform: translate(-40px, 30px) scale(1.1); }
        100% { transform: translate(20px, -40px) scale(0.92); }
    }
    @keyframes moveB2 {
        0%   { transform: translate(0px, 0px) scale(1); }
        50%  { transform: translate(35px, -25px) scale(0.93); }
        100% { transform: translate(-20px, 40px) scale(1.08); }
    }
    @keyframes moveB3 {
        0%   { transform: translate(0px, 0px) scale(1); }
        50%  { transform: translate(-30px, -35px) scale(1.06); }
        100% { transform: translate(40px, 20px) scale(0.94); }
    }
    @keyframes moveB4 {
        0%   { transform: translate(0px, 0px) scale(1); }
        50%  { transform: translate(25px, 30px) scale(1.05); }
        100% { transform: translate(-35px, -20px) scale(0.96); }
    }
    @keyframes moveB5 {
        0%   { transform: translate(0px, 0px) scale(1); }
        50%  { transform: translate(-50px, 20px) scale(1.08); }
        100% { transform: translate(30px, -30px) scale(0.95); }
    }
    
    @keyframes colorB1 {
        0%   { background: #50e878; }
        25%  { background: #c8f040; }
        50%  { background: #30d8c0; }
        75%  { background: #a0f060; }
        100% { background: #50e878; }
    }
    @keyframes colorB2 {
        0%   { background: #b8f050; }
        25%  { background: #40e8c0; }
        50%  { background: #f0e060; }
        75%  { background: #60d880; }
        100% { background: #b8f050; }
    }
    @keyframes colorB3 {
        0%   { background: #40d8b0; }
        25%  { background: #70f040; }
        50%  { background: #d8f080; }
        75%  { background: #20c8a0; }
        100% { background: #40d8b0; }
    }
    @keyframes colorB4 {
        0%   { background: #d0f870; }
        25%  { background: #50e890; }
        50%  { background: #a0f8d0; }
        75%  { background: #e8f050; }
        100% { background: #d0f870; }
    }
    @keyframes colorB5 {
        0%   { background: #50e878; }
        25%  { background: #40e8c0; }
        50%  { background: #c8f040; }
        75%  { background: #30d8c0; }
        100% { background: #50e878; }
    }
    
    .article-header-animated::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,255,245,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }
    
    .article-hero {
        position: relative;
        min-height: 50vh;
        display: flex;
        align-items: flex-end;
        overflow: hidden;
    }
    
    .article-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.7) 100%);
    }
    
    .article-hero img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .article-hero .container {
        position: relative;
        z-index: 1;
    }
    
    .author-card {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    
    .author-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 40px rgba(0,58,70,0.1);
    }
    
    .floating-share {
        position: fixed;
        left: 2rem;
        top: 50%;
        transform: translateY(-50%);
        z-index: 100;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .floating-share.visible {
        opacity: 1;
    }
    
    .floating-share .share-btn {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        border: 1px solid #e2e8f0;
        color: #64748b;
        text-decoration: none;
        transition: all 0.2s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    
    .floating-share .share-btn:hover {
        transform: scale(1.1);
        color: #fff;
    }
    
    .floating-share .share-btn.facebook:hover { background: #1877f2; border-color: #1877f2; }
    .floating-share .share-btn.twitter:hover { background: #1da1f2; border-color: #1da1f2; }
    .floating-share .share-btn.linkedin:hover { background: #0a66c2; border-color: #0a66c2; }
    .floating-share .share-btn.copy:hover { background: #003A46; border-color: #003A46; }
    
    .article-content {
        font-size: 1.125rem;
        line-height: 1.85;
        color: #334155;
    }
    
    .article-content p {
        margin-bottom: 1.75rem;
    }
    
    .article-content h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #0f172a;
        margin-top: 3rem;
        margin-bottom: 1.25rem;
        position: relative;
        padding-bottom: 0.75rem;
    }
    
    .article-content h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #003A46, #0a9396);
        border-radius: 2px;
    }
    
    .article-content h3 {
        font-size: 1.35rem;
        font-weight: 600;
        color: #1e293b;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    
    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 16px;
        margin: 2.5rem 0;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }
    
    .article-content img.clickable-image {
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .article-content img.clickable-image:hover {
        transform: scale(1.02);
        box-shadow: 0 15px 50px rgba(0,0,0,0.2);
    }
    
    .article-image-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin: 2rem 0;
    }
    
    .article-image-grid img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 12px;
        margin: 0;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .article-image-grid img:hover {
        transform: scale(1.05);
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    }
    
    /* Lightbox */
    .lightbox-overlay {
        display: none;
        position: fixed;
        z-index: 10000;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.9);
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .lightbox-overlay.active {
        display: flex;
        opacity: 1;
    }
    
    .lightbox-overlay img {
        max-width: 90%;
        max-height: 90%;
        border-radius: 8px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        margin: 0;
        cursor: default;
    }
    
    .lightbox-close {
        position: absolute;
        top: 20px;
        right: 30px;
        color: #fff;
        font-size: 40px;
        cursor: pointer;
        z-index: 10001;
        opacity: 0.8;
        transition: opacity 0.2s;
    }
    
    .lightbox-close:hover {
        opacity: 1;
    }
    
    .lightbox-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: #fff;
        font-size: 50px;
        cursor: pointer;
        opacity: 0.6;
        transition: opacity 0.2s;
        padding: 20px;
    }
    
    .lightbox-nav:hover {
        opacity: 1;
    }
    
    .lightbox-prev {
        left: 20px;
    }
    
    .lightbox-next {
        right: 20px;
    }
    
    .article-content blockquote {
        border: none;
        padding: 1.5rem 2rem;
        margin: 2.5rem 0;
        background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%);
        border-left: 4px solid #003A46;
        border-radius: 0 16px 16px 0;
        font-size: 1.15rem;
        font-style: italic;
        color: #475569;
        position: relative;
    }
    
    .article-content blockquote::before {
        content: '"';
        font-size: 4rem;
        color: #003A46;
        opacity: 0.1;
        position: absolute;
        top: -10px;
        left: 20px;
        font-family: var(--current-font);
    }
    
    .article-content ul, .article-content ol {
        margin-bottom: 1.75rem;
        padding-left: 1.5rem;
    }
    
    .article-content li {
        margin-bottom: 0.75rem;
        padding-left: 0.5rem;
    }
    
    .article-content a {
        color: #003A46;
        text-decoration: underline;
        text-decoration-color: #003A4640;
        text-underline-offset: 3px;
        transition: all 0.2s ease;
    }
    
    .article-content a:hover {
        color: #0a9396;
        text-decoration-color: #0a9396;
    }
    
    .article-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 2rem 0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    
    .article-content th {
        background: linear-gradient(135deg, #003A46 0%, #006d77 100%);
        color: #fff;
        padding: 1rem 1.25rem;
        text-align: left;
        font-weight: 600;
    }
    
    .article-content td {
        padding: 0.875rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .article-content tr:last-child td {
        border-bottom: none;
    }
    
    .article-content tr:hover td {
        background: #f8fafc;
    }
    
    .article-content pre {
        background: #1e293b;
        color: #e2e8f0;
        padding: 1.5rem;
        border-radius: 12px;
        overflow-x: auto;
        margin: 2rem 0;
        font-size: 0.9rem;
    }
    
    .article-content code {
        background: #f1f5f9;
        color: #003A46;
        padding: 0.2rem 0.4rem;
        border-radius: 4px;
        font-size: 0.9em;
    }
    
    .article-content pre code {
        background: none;
        color: inherit;
        padding: 0;
    }
    
    .tag-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #64748b;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.875rem;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    
    .tag-item:hover {
        background: #003A46;
        border-color: #003A46;
        color: #fff;
    }
    
    .related-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .related-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(0,58,70,0.15);
    }
    
    .related-card img {
        transition: transform 0.5s ease;
    }
    
    .related-card:hover img {
        transform: scale(1.05);
    }
    
    .nav-article {
        border: none;
        border-radius: 16px;
        background: #fff;
        transition: all 0.3s ease;
    }
    
    .nav-article:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 40px rgba(0,58,70,0.12);
    }
    
    .nav-article .category-badge {
        font-size: 0.7rem;
        padding: 0.35rem 0.75rem;
    }
    
    .sidebar-widget {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }
    
    .sidebar-widget:hover {
        border-color: #003A4640;
        box-shadow: 0 8px 30px rgba(0,58,70,0.08);
    }
    
    .latest-item {
        padding: 0.75rem;
        border-radius: 12px;
        transition: all 0.2s ease;
    }
    
    .latest-item:hover {
        background: #f8fafc;
    }
    
    @media (max-width: 991px) {
        .floating-share {
            display: none;
        }
        
        .article-hero {
            min-height: 40vh;
        }
    }
    
    @media (max-width: 768px) {
        .article-content {
            font-size: 1rem;
        }
        
        .article-content h2 {
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Article Header -->
<section class="article-header-animated">
    <div class="blob-wrapper">
        <div class="blob b1"></div>
        <div class="blob b2"></div>
        <div class="blob b3"></div>
        <div class="blob b4"></div>
        <div class="blob b5"></div>
    </div>
    <div class="container" style="position: relative; z-index: 2;">
        <h1 class="display-6 fw-bold mb-3" style="color: #003A46;">
            {{ $article->title }}
        </h1>
        <p class="text-muted mb-0">
            {{ $article->published_at->format('F j, Y') }} - {{ number_format($article->views) }} {{ app()->getLocale() === 'km' ? 'ទស្សនីយ' : 'views' }} - By {{ $article->author->name ?? 'Unknown' }}
        </p>
    </div>
</section>

<!-- Article Content -->
</script>

<!-- Lightbox -->
<div class="lightbox-overlay" id="lightbox">
    <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
    <span class="lightbox-nav lightbox-prev" id="lightboxPrev" onclick="prevImage()">&#10094;</span>
    <img id="lightboxImage" src="" alt="">
    <span class="lightbox-nav lightbox-next" id="lightboxNext" onclick="nextImage()">&#10095;</span>
</div>

<div class="floating-share" id="floatingShare">
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" class="share-btn facebook" title="Facebook">
        <i class="bi bi-facebook"></i>
    </a>
    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" target="_blank" rel="noopener" class="share-btn twitter" title="Twitter">
        <i class="bi bi-twitter-x"></i>
    </a>
    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" class="share-btn linkedin" title="LinkedIn">
        <i class="bi bi-linkedin"></i>
    </a>
    <button class="share-btn copy" onclick="copyLink(this)" title="Copy Link">
        <i class="bi bi-link-45deg"></i>
    </button>
</div>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                @if($article->excerpt)
                    <div class="mb-5 p-4" style="background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%); border-left: 4px solid #003A46; border-radius: 0 16px 16px 0;">
                        <p class="mb-0 fst-italic" style="font-size: 1.15rem; color: #475569; line-height: 1.7;">{{ $article->excerpt }}</p>
                    </div>
                @endif

                <div class="article-content mb-5">
                    {!! $article->content !!}
                </div>

                @if($article->gallery_images && count($article->gallery_images) > 0)
                <div class="mb-5">
                    <h5 class="fw-bold mb-3" style="color: #0f172a;">
                        <i class="bi bi-images me-2" style="color: #003A46;"></i>{{ app()->getLocale() === 'km' ? 'វិចិត្រសាលរូបភាព' : 'Photo Gallery' }}
                    </h5>
                    <div class="row g-3" id="galleryGrid">
                        @foreach($article->gallery_images as $index => $image)
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="javascript:void(0)" onclick="openGalleryLightbox({{ $index }})" class="d-block position-relative overflow-hidden" style="border-radius: 12px; aspect-ratio: 1; overflow: hidden;">
                                <img src="{{ $image }}" alt="{{ $article->title }} - Image {{ $index + 1 }}" class="w-100 h-100" style="object-fit: cover; transition: transform 0.3s ease;">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif



                <div class="row g-3 mb-5">
                    <div class="col-6">
                        @if($previousArticle)
                            <a href="{{ route('public.articles.show', $previousArticle->slug) }}" class="nav-article card border-0 shadow-sm h-100 text-decoration-none p-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: #f8fafc;">
                                        <i class="bi bi-arrow-left" style="color: #003A46;"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block mb-1"><i class="bi bi-arrow-left me-1"></i>{{ app()->getLocale() === 'km' ? 'អត្ថបទមុន' : 'Previous' }}</small>
                                        <h6 class="fw-bold mb-0" style="color: #1a1a2e; font-size: 0.9rem; line-height: 1.4;">{{ Str::limit($previousArticle->title, 45) }}</h6>
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="col-6">
                        @if($nextArticle)
                            <a href="{{ route('public.articles.show', $nextArticle->slug) }}" class="nav-article card border-0 shadow-sm h-100 text-decoration-none p-3">
                                <div class="d-flex align-items-center justify-content-end gap-3 text-end">
                                    <div>
                                        <small class="text-muted d-block mb-1">{{ app()->getLocale() === 'km' ? 'បន្ទាប់' : 'Next' }}<i class="bi bi-arrow-right ms-1"></i></small>
                                        <h6 class="fw-bold mb-0" style="color: #1a1a2e; font-size: 0.9rem; line-height: 1.4;">{{ Str::limit($nextArticle->title, 45) }}</h6>
                                    </div>
                                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: #f8fafc;">
                                        <i class="bi bi-arrow-right" style="color: #003A46;"></i>
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="position-sticky" style="top: 100px;">
                    @if($latestArticles->count() > 0)
                    <div class="sidebar-widget mb-4">
                        <h6 class="fw-bold mb-3" style="color: #0f172a;">
                            <i class="bi bi-clock-history me-2" style="color: #003A46;"></i>{{ __('articles.latest') }}
                        </h6>
                        <div class="d-flex flex-column gap-2">
                            @foreach($latestArticles as $latest)
                                <a href="{{ route('public.articles.show', $latest->slug) }}" class="latest-item d-flex gap-3 text-decoration-none rounded-3">
                                    @if($latest->featured_image)
                                        <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $latest->featured_image)) }}" alt="{{ $latest->title }}" class="rounded-3 flex-shrink-0" style="width: 75px; height: 60px; object-fit: cover;">
                                    @else
                                        <div class="rounded-3 flex-shrink-0 d-flex align-items-center justify-content-center" style="width: 75px; height: 60px; background: linear-gradient(135deg, #003A46, #0a9396);">
                                            <i class="bi bi-newspaper text-white" style="font-size: 1rem; opacity: 0.5;"></i>
                                        </div>
                                    @endif
                                    <div class="flex-grow-1 min-width-0">
                                        <h6 class="mb-1 fw-semibold" style="color: #1a1a2e; font-size: 0.85rem; line-height: 1.4;">{{ Str::limit($latest->title, 50) }}</h6>
                                        <small class="text-muted" style="font-size: 0.75rem;">{{ $latest->published_at->format('M j, Y') }}</small>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($article->category || $article->tags->count() > 0)
                    <div class="sidebar-widget">
                        @if($article->category)
                        <h6 class="fw-bold mb-3" style="color: #0f172a;">
                            <i class="bi bi-grid me-2" style="color: #003A46;"></i>{{ __('articles.categories') }}
                        </h6>
                        <a href="{{ route('public.articles.index', ['category' => $article->category->id]) }}" 
                           class="d-flex align-items-center justify-content-between p-3 rounded-3 text-decoration-none mb-3"
                           style="background: #f8fafc; color: #003A46;">
                            <span class="fw-semibold">{{ $article->category->name }}</span>
                            <span class="badge rounded-pill" style="background: #003A46; color: #fff;">{{ $article->category->articles_count ?? '' }}</span>
                        </a>
                        @endif
                        
                        @if($article->tags->count() > 0)
                        <h6 class="fw-bold mb-3" style="color: #0f172a;">
                            <i class="bi bi-tags me-2" style="color: #003A46;"></i>{{ __('articles.tags') }}
                        </h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($article->tags as $tag)
                                <a href="{{ route('public.articles.index', ['tag' => $tag->id]) }}" class="tag-item">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@if($relatedArticles->count() > 0)
<section class="py-5" style="background: #f8fafc;">
    <div class="container">
        <div class="mb-4">
            <h5 class="fw-bold mb-1" style="color: #0f172a;">
                <i class="bi bi-link-45deg me-2" style="color: #003A46;"></i>{{ app()->getLocale() === 'km' ? 'អត្ថបទពាក់ព័ន្ធ' : 'Related Articles' }}
            </h5>
            <p class="text-muted mb-0">{{ app()->getLocale() === 'km' ? 'អត្ថបទដែលទាក់ទង' : 'More articles you might enjoy' }}</p>
        </div>
        <div class="row g-4">
            @foreach($relatedArticles as $related)
                <div class="col-md-4">
                    <a href="{{ route('public.articles.show', $related->slug) }}" class="text-decoration-none">
                        <div class="related-card card border-0 shadow-sm h-100">
                            <div class="position-relative overflow-hidden" style="height: 180px;">
                                @if($related->featured_image)
                                    <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $related->featured_image)) }}" alt="{{ $related->title }}" class="w-100 h-100" style="object-fit: cover;">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #003A46, #0a9396);">
                                        <i class="bi bi-newspaper text-white" style="opacity: 0.4; font-size: 2.5rem;"></i>
                                    </div>
                                @endif
                                @if($related->category)
                                    <span class="position-absolute top-0 start-0 m-3 badge rounded-pill category-badge" style="background: rgba(255,255,255,0.95); color: #003A46;">
                                        {{ $related->category->name }}
                                    </span>
                                @endif
                            </div>
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-2" style="color: #1a1a2e; font-size: 1rem; line-height: 1.5;">{{ Str::limit($related->title, 60) }}</h6>
                                <div class="d-flex align-items-center justify-content-between">
                                    <small class="text-muted">
                                        <i class="bi bi-person me-1"></i>{{ $related->author->name ?? 'Unknown' }}
                                    </small>
                                    <small class="text-muted">{{ $related->published_at->format('M j, Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@push('scripts')
<script>
    window.addEventListener('scroll', function() {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        document.getElementById('progressBar').style.width = scrolled + '%';
    });

    window.addEventListener('scroll', function() {
        const shareButtons = document.getElementById('floatingShare');
        if (window.scrollY > 300) {
            shareButtons.classList.add('visible');
        } else {
            shareButtons.classList.remove('visible');
        }
    });

    function copyLink(btn) {
        navigator.clipboard.writeText(window.location.href).then(function() {
            btn.innerHTML = '<i class="bi bi-check-lg"></i>';
            btn.classList.add('text-success');
            setTimeout(function() {
                btn.innerHTML = '<i class="bi bi-link-45deg"></i>';
                btn.classList.remove('text-success');
            }, 2000);
        });
    }
    
    // Lightbox functionality
    let currentImageIndex = 0;
    let galleryImages = [];
    
    function openLightbox(imgElement, images, index) {
        galleryImages = images;
        currentImageIndex = index;
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightboxImage');
        lightboxImg.src = imgElement.src;
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
        updateNavButtons();
    }
    
    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    function prevImage() {
        if (galleryImages.length > 0) {
            currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
            document.getElementById('lightboxImage').src = galleryImages[currentImageIndex].src;
        }
    }
    
    function nextImage() {
        if (galleryImages.length > 0) {
            currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
            document.getElementById('lightboxImage').src = galleryImages[currentImageIndex].src;
        }
    }
    
    function updateNavButtons() {
        const prevBtn = document.getElementById('lightboxPrev');
        const nextBtn = document.getElementById('lightboxNext');
        if (galleryImages.length <= 1) {
            prevBtn.style.display = 'none';
            nextBtn.style.display = 'none';
        } else {
            prevBtn.style.display = 'block';
            nextBtn.style.display = 'block';
        }
    }
    
    // Close lightbox on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') prevImage();
        if (e.key === 'ArrowRight') nextImage();
    });
    
    // Close lightbox when clicking outside image
    document.getElementById('lightbox').addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
    });
    
    // Make images in article content clickable
    document.addEventListener('DOMContentLoaded', function() {
        const content = document.querySelector('.article-content');
        if (content) {
            const images = Array.from(content.querySelectorAll('img'));
            
            // Make each image clickable
            images.forEach(function(img, index) {
                img.classList.add('clickable-image');
                img.addEventListener('click', function() {
                    openLightbox(this, images, index);
                });
            });
        }
        
        // Initialize gallery images array for gallery lightbox
        const galleryGrid = document.getElementById('galleryGrid');
        if (galleryGrid) {
            const galleryImgs = Array.from(galleryGrid.querySelectorAll('img'));
            galleryImgs.forEach(function(img) {
                img.addEventListener('click', function() {
                    const index = Array.from(galleryGrid.querySelectorAll('img')).indexOf(this);
                    openGalleryLightbox(index);
                });
            });
        }
    });
    
    // Gallery images array
    let galleryImageElements = [];
    
    function openGalleryLightbox(index) {
        const galleryGrid = document.getElementById('galleryGrid');
        if (galleryGrid) {
            galleryImageElements = Array.from(galleryGrid.querySelectorAll('img'));
            if (galleryImageElements.length > 0) {
                openLightbox(galleryImageElements[index], galleryImageElements, index);
            }
        }
    }
</script>
@endpush
@endsection
