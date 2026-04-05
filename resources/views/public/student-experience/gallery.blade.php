@extends('layouts.public')

@section('title', $locale === 'kh' ? 'វិចិត្រសាល' : 'Campus Gallery')

@push('styles')
<style>
    .gallery-header {
        position: relative;
        overflow: hidden;
        background: #f5f8ff;
        min-height: 350px;
        padding: 65px 0;
    }

    .gallery-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .gallery-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .gallery-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .gallery-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .gallery-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .gallery-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .gallery-header .b5 {
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

    .gallery-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,248,255,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .gallery-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .gallery-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .gallery-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }

    .gallery-hero {
        background: linear-gradient(135deg, #003A46 0%, #004d5c 100%);
        padding: 60px 0;
    }
    
    .filter-tabs {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 30px;
    }
    
    .filter-tabs .btn {
        border-radius: 25px;
        padding: 8px 20px;
        font-weight: 500;
    }
    
    .filter-tabs .btn.active {
        background: #003A46;
        border-color: #003A46;
    }
    
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    
    .gallery-item {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        aspect-ratio: 16/10;
        cursor: pointer;
    }
    
    .gallery-item img,
    .gallery-item video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .gallery-item:hover img,
    .gallery-item:hover video {
        transform: scale(1.1);
    }
    
    .gallery-item .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.85), transparent);
        padding: 30px 20px 20px;
        color: #fff;
    }
    
    .gallery-item .overlay h5 {
        font-size: 18px;
        margin-bottom: 5px;
    }
    
    .gallery-item .badge {
        position: absolute;
        top: 15px;
        right: 15px;
    }
    
    .video-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60px;
        height: 60px;
        background: rgba(255,255,255,0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: #003A46;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="gallery-header">
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
            <nav aria-label="breadcrumb" style="position: relative; z-index: 10;">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #003A46;">{{ __('navigation.home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('student-experience.index') }}" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'បទពិសោធន៍និស្សិត' : 'Student Experiences' }}</a></li>
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ $locale === 'kh' ? 'វិចិត្រសាល' : 'Campus Gallery' }}</li>
                </ol>
            </nav>
            <h1 class="header-title">
                {{ $locale === 'kh' ? 'វិចិត្រសាល' : 'Campus Gallery' }}
            </h1>
            <p class="header-subtitle">
                {{ $locale === 'kh' 
                    ? 'រូបភាពនិងវីដេអូពីព្រេងនាថ្ងៃក្នុងសាកលវិទ្យាល័យ' 
                    : 'Photos and videos from life at the university' }}
            </p>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-5">
    <div class="container">
        <!-- Filter Tabs -->
        <div class="filter-tabs justify-content-center">
            <a href="{{ route('student-experience.gallery', ['category' => 'all']) }}" 
               class="btn {{ $category === 'all' ? 'btn-primary active' : 'btn-outline-secondary' }}">
                {{ $locale === 'kh' ? 'ទាំងអស់' : 'All' }}
            </a>
            <a href="{{ route('student-experience.gallery', ['category' => 'events']) }}" 
               class="btn {{ $category === 'events' ? 'btn-primary active' : 'btn-outline-secondary' }}">
                {{ $locale === 'kh' ? 'ព្រឹត្តិការណ៍' : 'Events' }}
            </a>
            <a href="{{ route('student-experience.gallery', ['category' => 'moot_court']) }}" 
               class="btn {{ $category === 'moot_court' ? 'btn-primary active' : 'btn-outline-secondary' }}">
                {{ $locale === 'kh' ? 'Moot Court' : 'Moot Court' }}
            </a>
            <a href="{{ route('student-experience.gallery', ['category' => 'graduation']) }}" 
               class="btn {{ $category === 'graduation' ? 'btn-primary active' : 'btn-outline-secondary' }}">
                {{ $locale === 'kh' ? 'បេសកកម្ម' : 'Graduation' }}
            </a>
            <a href="{{ route('student-experience.gallery', ['category' => 'clubs']) }}" 
               class="btn {{ $category === 'clubs' ? 'btn-primary active' : 'btn-outline-secondary' }}">
                {{ $locale === 'kh' ? 'ក្លឹប' : 'Clubs' }}
            </a>
            <a href="{{ route('student-experience.gallery', ['category' => 'general']) }}" 
               class="btn {{ $category === 'general' ? 'btn-primary active' : 'btn-outline-secondary' }}">
                {{ $locale === 'kh' ? 'ទូទៅ' : 'General' }}
            </a>
        </div>
        
        <!-- Gallery Grid -->
        <div class="gallery-grid">
            @forelse($galleries as $gallery)
            <div class="gallery-item" onclick="openLightbox('{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $gallery->media_path)) }}', '{{ $gallery->media_type }}')">
                @if($gallery->media_type === 'video')
                <video src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $gallery->media_path)) }}" muted></video>
                <div class="video-icon"><i class="bi bi-play-fill"></i></div>
                @else
                <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $gallery->media_path)) }}" alt="{{ $locale === 'kh' ? $gallery->title_kh : $gallery->title_en }}">
                @endif
                <span class="badge bg-dark">{{ $gallery->year }}</span>
                <div class="overlay">
                    <h5>{{ $locale === 'kh' ? $gallery->title_kh : $gallery->title_en }}</h5>
                    <small class="opacity-75">{{ $locale === 'kh' ? $gallery->caption_kh : $gallery->caption_en }}</small>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">{{ $locale === 'kh' ? 'មិនទាន់មានទេ' : 'No items found' }}</p>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="mt-5">
            {{ $galleries->links() }}
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div class="modal fade" id="lightboxModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-0">
                <img id="lightboxImage" src="" class="img-fluid d-none" alt="">
                <video id="lightboxVideo" src="" class="img-fluid d-none" controls></video>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function openLightbox(src, type) {
    const modal = new bootstrap.Modal(document.getElementById('lightboxModal'));
    const image = document.getElementById('lightboxImage');
    const video = document.getElementById('lightboxVideo');
    
    if (type === 'video') {
        video.src = src;
        video.classList.remove('d-none');
        image.classList.add('d-none');
    } else {
        image.src = src;
        image.classList.remove('d-none');
        video.classList.add('d-none');
    }
    
    modal.show();
}
</script>
@endpush
@endsection
