@extends('layouts.public')

@section('title', __('articles.title'))

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    .articles-header {
        position: relative;
        overflow: hidden;
        background: #f5fff5;
        min-height: 350px;
        padding: 65px 0;
    }
    
    .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }
    
    .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }
    
    .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .b5 {
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
    
    .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,255,245,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }
    
    .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }
    
    .articles-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }
    
    .articles-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }
    
    @media (max-width: 768px) {
        .articles-header {
            padding: 50px 0 20px;
            min-height: 200px;
        }
        
        .blob {
            filter: blur(60px);
            opacity: 0.6;
        }
        
        .b1 { width: 90%; height: 100%; top: -50px; left: 5%; }
        .b2 { width: 80%; height: 90%; top: -30px; left: 10%; }
        .b3 { width: 70%; height: 80%; top: -10px; left: 15%; }
        .b4 { width: 60%; height: 70%; top: 10px; left: 20%; }
        .b5 { width: 50%; height: 60%; top: 30px; left: 25%; }
        
        .header-title {
            font-size: 1.8rem;
        }
        
        .header-subtitle {
            font-size: 1rem;
        }
        
        .fade-bottom {
            height: 50%;
        }
    }
</style>
@endpush

@section('content')
<!-- Header Section -->
<section class="articles-header">
    <div class="blob-wrapper">
        <div class="blob b1"></div>
        <div class="blob b2"></div>
        <div class="blob b3"></div>
        <div class="blob b4"></div>
        <div class="blob b5"></div>
    </div>
    <div class="fade-bottom"></div>
    <div class="container">
        <div class="header-content">
            <nav aria-label="breadcrumb" class="header-breadcrumb" style="position: relative; z-index: 10;">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #003A46;">{{ __('navigation.home') }}</a></li>
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ __('articles.title') }}</li>
                </ol>
            </nav>
            <h1 class="header-title">{{ __('articles.title') }}</h1>
            <p class="header-subtitle">
                {{ app()->getLocale() === 'km' ? 'ព័ត៌មានចុងក្រោយ សេចក្តីប្រកាស និងការបោះពុម្ពផ្សាយពីគណៈអ្នកច្បាប់' : 'Latest news, announcements, and publications from our faculty' }}
            </p>
        </div>
    </div>
</section>

@if($featuredArticles->count() > 0 && !request()->filled('search') && !request()->filled('category') && !request()->filled('tag') && request('filter') !== 'featured')
<section class="py-5" style="background: #f8fafb;">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="h4 fw-bold mb-1" style="color: #003A46;">
                    <i class="bi bi-star-fill text-warning me-2"></i>{{ app()->getLocale() === 'km' ? 'អត្ថបទពិសេស' : 'Featured Articles' }}
                </h2>
                <p class="text-muted mb-0 small">{{ app()->getLocale() === 'km' ? 'អត្ថបទដែលបានជ្រើសរើសពិសេស' : 'Hand-picked stories and highlights' }}</p>
            </div>
            <a href="{{ route('public.articles.index', ['filter' => 'featured']) }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                {{ app()->getLocale() === 'km' ? 'មើលទាំងអស់' : 'View All' }} <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="row g-4">
            @foreach($featuredArticles as $index => $featured)
                @if($index === 0)
                <div class="col-lg-7">
                    <a href="{{ route('public.articles.show', $featured->slug) }}" class="text-decoration-none">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden article-card-hero" style="border-radius: 16px;">
                            <div class="position-relative">
                                @if($featured->featured_image)
                                    <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $featured->featured_image)) }}" alt="{{ $featured->title }}" class="w-100" style="height: 360px; object-fit: cover;">
                                @else
                                    <div class="w-100 d-flex align-items-center justify-content-center" style="height: 360px; background: linear-gradient(135deg, #003A46, #0a9396);">
                                        <i class="bi bi-newspaper text-white" style="font-size: 4rem; opacity: 0.3;"></i>
                                    </div>
                                @endif
                                <div class="position-absolute bottom-0 start-0 end-0 p-4" style="background: linear-gradient(transparent, rgba(0,0,0,0.85));">
                                    <div class="mb-2">
                                        @if($featured->category)
                                            <span class="badge rounded-pill px-3 py-1" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(10px);">{{ $featured->category->name }}</span>
                                        @endif
                                        <span class="badge rounded-pill bg-warning text-dark px-3 py-1"><i class="bi bi-star-fill me-1"></i>{{ app()->getLocale() === 'km' ? 'ពិសេស' : 'Featured' }}</span>
                                    </div>
                                    <h3 class="text-white fw-bold mb-2" style="font-size: 1.4rem;">{{ Str::limit($featured->title, 80) }}</h3>
                                    <div class="d-flex align-items-center gap-3">
                                        <small class="text-white-50"><i class="bi bi-person-circle me-1"></i>{{ $featured->author->name ?? 'Unknown' }}</small>
                                        <small class="text-white-50"><i class="bi bi-calendar3 me-1"></i>{{ $featured->published_at->format('M j, Y') }}</small>
                                        <small class="text-white-50"><i class="bi bi-eye me-1"></i>{{ number_format($featured->views) }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex flex-column gap-4 h-100">
                @else
                        <a href="{{ route('public.articles.show', $featured->slug) }}" class="text-decoration-none flex-fill">
                            <div class="card border-0 shadow-sm h-100 overflow-hidden article-card" style="border-radius: 16px;">
                                <div class="row g-0 h-100">
                                    <div class="col-5">
                                        @if($featured->featured_image)
                                            <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $featured->featured_image)) }}" alt="{{ $featured->title }}" class="w-100 h-100" style="object-fit: cover; min-height: 160px;">
                                        @else
                                            <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="min-height: 160px; background: linear-gradient(135deg, #003A46, #0a9396);">
                                                <i class="bi bi-newspaper text-white" style="font-size: 2rem; opacity: 0.3;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-7 d-flex flex-column justify-content-center p-3">
                                        @if($featured->category)
                                            <span class="badge rounded-pill mb-2 align-self-start" style="background: #e8f4f8; color: #003A46; font-size: 0.7rem;">{{ $featured->category->name }}</span>
                                        @endif
                                        <h5 class="fw-bold mb-2" style="color: #1a1a2e; font-size: 0.95rem; line-height: 1.4;">{{ Str::limit($featured->title, 55) }}</h5>
                                        <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>{{ $featured->published_at->format('M j, Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                @endif
                @if($index === $featuredArticles->count() - 1)
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
                    <div class="card-body p-4">
                        <form method="GET" action="{{ route('public.articles.index') }}" id="searchForm">
                            <div class="row g-3 align-items-end">
                                <div class="col-md-5">
                                    <div class="position-relative">
                                        <i class="bi bi-search position-absolute" style="left: 14px; top: 50%; transform: translateY(-50%); color: #adb5bd;"></i>
                                        <input type="text" name="search" class="form-control border-0 ps-5" style="background: #f5f6f8; border-radius: 12px; height: 46px;"
                                               placeholder="{{ app()->getLocale() === 'km' ? 'ស្វែងរកអត្ថបទ...' : 'Search articles...' }}"
                                               value="{{ request('search') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select name="category" class="form-select border-0" style="background: #f5f6f8; border-radius: 12px; height: 46px;" onchange="document.getElementById('searchForm').submit()">
                                        <option value="">{{ app()->getLocale() === 'km' ? 'ប្រភេទទាំងអស់' : 'All Categories' }}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }} ({{ $category->articles_count }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="filter" class="form-select border-0" style="background: #f5f6f8; border-radius: 12px; height: 46px;" onchange="document.getElementById('searchForm').submit()">
                                        <option value="">{{ app()->getLocale() === 'km' ? 'ទាំងអស់' : 'All' }}</option>
                                        <option value="featured" {{ request('filter') === 'featured' ? 'selected' : '' }}>{{ app()->getLocale() === 'km' ? 'ពិសេស' : 'Featured' }}</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn w-100" style="background: #003A46; color: #fff; border-radius: 12px; height: 46px;">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                            @if(request()->filled('tag'))
                                <input type="hidden" name="tag" value="{{ request('tag') }}">
                            @endif
                        </form>
                    </div>
                </div>

                @if(request()->filled('search') || request()->filled('category') || request()->filled('tag') || request('filter') === 'featured')
                <div class="mb-4 d-flex align-items-center flex-wrap gap-2">
                    <span class="text-muted small">{{ app()->getLocale() === 'km' ? 'តម្រង:' : 'Filters:' }}</span>
                    @if(request()->filled('search'))
                        <a href="{{ route('public.articles.index', request()->except('search')) }}" class="badge rounded-pill bg-light text-dark border px-3 py-2 text-decoration-none">
                            "{{ request('search') }}" <i class="bi bi-x ms-1"></i>
                        </a>
                    @endif
                    @if(request()->filled('category'))
                        <a href="{{ route('public.articles.index', request()->except('category')) }}" class="badge rounded-pill bg-light text-dark border px-3 py-2 text-decoration-none">
                            {{ $categories->firstWhere('id', request('category'))?->name }} <i class="bi bi-x ms-1"></i>
                        </a>
                    @endif
                    @if(request('filter') === 'featured')
                        <a href="{{ route('public.articles.index', request()->except('filter')) }}" class="badge rounded-pill bg-warning text-dark border-0 px-3 py-2 text-decoration-none">
                            <i class="bi bi-star-fill me-1"></i>{{ app()->getLocale() === 'km' ? 'ពិសេស' : 'Featured' }} <i class="bi bi-x ms-1"></i>
                        </a>
                    @endif
                    <a href="{{ route('public.articles.index') }}" class="btn btn-sm btn-link text-danger text-decoration-none">
                        <i class="bi bi-x-circle me-1"></i>{{ app()->getLocale() === 'km' ? 'សម្អាតទាំងអស់' : 'Clear all' }}
                    </a>
                </div>
                @endif

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h2 class="h5 fw-bold mb-0" style="color: #003A46;">
                        @if(request('filter') === 'featured')
                            <i class="bi bi-star-fill text-warning me-2"></i>{{ app()->getLocale() === 'km' ? 'អត្ថបទពិសេស' : 'Featured Articles' }}
                        @else
                            {{ __('articles.latest') }}
                        @endif
                    </h2>
                    <span class="text-muted small">{{ $articles->total() }} {{ app()->getLocale() === 'km' ? 'អត្ថបទ' : 'articles' }}</span>
                </div>

                <div class="row g-4">
                    @forelse($articles as $article)
                        <div class="col-lg-4 col-md-6">
                            <a href="{{ route('public.articles.show', $article->slug) }}" class="text-decoration-none">
                                <div class="card border-0 shadow-sm h-100 article-card overflow-hidden" style="border-radius: 16px;">
                                    <div class="position-relative">
                                        @if($article->featured_image)
                                            <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $article->featured_image)) }}" alt="{{ $article->title }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                        @else
                                            <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, #003A46 0%, #0a9396 100%);">
                                                <i class="bi bi-newspaper text-white" style="font-size: 3rem; opacity: 0.3;"></i>
                                            </div>
                                        @endif
                                        @if($article->is_featured)
                                            <span class="position-absolute top-0 end-0 m-3 badge rounded-pill bg-warning text-dark px-2 py-1" style="font-size: 0.7rem;">
                                                <i class="bi bi-star-fill"></i>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="card-body d-flex flex-column p-4">
                                        <div class="d-flex align-items-center gap-2 mb-3">
                                            @if($article->category)
                                                <span class="badge rounded-pill px-3 py-1" style="background: #e8f4f8; color: #003A46; font-size: 0.75rem;">{{ $article->category->name }}</span>
                                            @endif
                                        </div>
                                        <h5 class="fw-bold mb-2" style="color: #1a1a2e; font-size: 1.05rem; line-height: 1.5;">{{ Str::limit($article->title, 65) }}</h5>
                                        <p class="text-muted small flex-grow-1 mb-3" style="line-height: 1.6;">
                                            {{ Str::limit($article->excerpt ?? strip_tags($article->content), 100) }}
                                        </p>
                                        <div class="d-flex align-items-center justify-content-between pt-3" style="border-top: 1px solid #f0f0f0;">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; background: #e8f4f8;">
                                                    <i class="bi bi-person-fill" style="color: #003A46; font-size: 0.75rem;"></i>
                                                </div>
                                                <small class="text-muted">{{ $article->author->name ?? 'Unknown' }}</small>
                                            </div>
                                            <small class="text-muted">{{ $article->published_at->format('M j, Y') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center py-5">
                                <div class="mb-4">
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 100px; height: 100px; background: #f5f6f8;">
                                        <i class="bi bi-newspaper" style="font-size: 2.5rem; color: #adb5bd;"></i>
                                    </div>
                                </div>
                                <h4 class="fw-bold mb-2" style="color: #1a1a2e;">{{ __('articles.no_articles') }}</h4>
                                <p class="text-muted mb-4">{{ app()->getLocale() === 'km' ? 'សាកល្បងផ្លាស់ប្តូរការស្វែងរករបស់អ្នក' : 'Try adjusting your search or filter criteria' }}</p>
                                <a href="{{ route('public.articles.index') }}" class="btn rounded-pill px-4" style="background: #003A46; color: #fff;">
                                    <i class="bi bi-arrow-left me-2"></i>{{ app()->getLocale() === 'km' ? 'មើលអត្ថបទទាំងអស់' : 'View All Articles' }}
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                @if($articles->hasPages())
                    <div class="mt-5 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                        <small class="text-muted">
                            {{ app()->getLocale() === 'km' ? 'បង្ហាញ' : 'Showing' }} {{ $articles->firstItem() }}-{{ $articles->lastItem() }} {{ app()->getLocale() === 'km' ? 'នៃ' : 'of' }} {{ $articles->total() }}
                        </small>
                        {{ $articles->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .article-card {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    .article-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 40px rgba(0, 58, 70, 0.15) !important;
    }
    .article-card-hero {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    .article-card-hero:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 48px rgba(0, 58, 70, 0.2) !important;
    }
    .article-card-hero:hover img,
    .article-card:hover .card-img-top img {
        transform: scale(1.03);
    }
    .article-card-hero img,
    .article-card .card-img-top img {
        transition: transform 0.5s ease;
    }
    .sidebar-category:hover {
        background: #003A46 !important;
    }
    .sidebar-category:hover span:first-child {
        color: #fff !important;
    }
    .sidebar-category:hover .badge {
        background: #fff !important;
        color: #003A46 !important;
    }
    .pagination .page-link {
        border: none;
        border-radius: 10px !important;
        margin: 0 3px;
        color: #003A46;
        padding: 0.5rem 0.85rem;
        font-size: 0.9rem;
    }
    .pagination .page-item.active .page-link {
        background: #003A46;
        color: #fff;
    }
    .pagination .page-link:hover {
        background: #e8f4f8;
        color: #003A46;
    }
</style>
@endpush
@endsection
