@extends('layouts.public')

@section('title', 'Faculty')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
@endpush

@section('content')
<!-- Compact Header -->
<section class="faculty-header">
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
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ __('faculty.faculty_staff') }}</li>
                </ol>
            </nav>
            <h1 class="header-title">{{ __('faculty.faculty_staff') }}</h1>
            <p class="header-subtitle">{{ __('faculty.meet_our_faculty') }}</p>
        </div>
    </div>
</section>

<!-- Search Bar & Letter Filter -->
<div class="search-bar">
    <div class="container">
        <div class="search-filter-row">
            <div class="letter-buttons-row">
                <a href="{{ route('public.faculty.index', array_filter(['search' => request('search')])) }}" 
                   class="letter-btn {{ !request('letter') ? 'active' : '' }}">All</a>
                @foreach(range('A', 'Z') as $letter)
                    <a href="{{ route('public.faculty.index', array_filter(['letter' => $letter, 'search' => request('search')])) }}" 
                       class="letter-btn {{ request('letter') === $letter ? 'active' : '' }}">{{ $letter }}</a>
                @endforeach
            </div>
            <form method="GET" action="{{ route('public.faculty.index') }}" class="search-form">
                <input type="text" name="search" placeholder="{{ __('faculty.search_placeholder') }}" 
                       value="{{ request('search') }}" class="search-input {{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">
                <input type="hidden" name="letter" id="letter-input" value="{{ request('letter') }}">
                <button type="submit" class="search-btn"><i class="bi bi-search"></i></button>
            </form>
        </div>
        <div class="search-divider"></div>
    </div>
</div>

<!-- Faculty Grid -->
<div class="faculty-section">
    <div class="container">
        <div class="results-info">
            <span class="{{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">Showing {{ $faculty->count() }} of {{ $faculty->total() }} faculty members</span>
        </div>
        <div class="faculty-grid">
            @forelse($faculty as $member)
                <a href="{{ route('public.faculty.show', $member->id) }}" class="faculty-card">
                    <div class="card-content">
                        <div class="card-photo">
                            @if($member->photo)
                                @if(substr($member->photo, 0, 4) === 'http')
                                    <img src="{{ $member->photo }}" alt="{{ $member->name }}">
                                @else
                                    <img src="{{ url('/laravel-img/' . $member->photo) }}" alt="{{ $member->name }}">
                                @endif
                            @else
                                <div class="card-photo-placeholder">
                                    {{ strtoupper(substr($member->name, 0, 2)) }}
                                </div>
                            @endif
                        </div>
                        <div class="card-info">
                            <h3 class="card-name {{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">{{ $member->name }}</h3>
                            <p class="card-title {{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">{{ $member->title }}</p>
                            @if($member->department)
                                <p class="card-dept {{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">{{ $member->department }}</p>
                            @endif
                            <div class="card-contact">
                                @if($member->phone)
                                    <span><i class="bi bi-telephone"></i> {{ $member->phone }}</span>
                                @endif
                                @if($member->email)
                                    <span><i class="bi bi-envelope"></i> {{ $member->email }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="no-results">
                    <h3 class="{{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">{{ __('faculty.no_faculty_found') }}</h3>
                    <p class="{{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">{{ __('faculty.try_adjusting_search') }}</p>
                </div>
            @endforelse
        </div>

        @if($faculty->hasPages())
            <div class="pagination-wrapper">
                {{ $faculty->links() }}
            </div>
        @endif
    </div>
</div>

<style>
/* Header */
.faculty-header {
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
    background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
    z-index: 1;
    pointer-events: none;
}

.header-content {
    position: relative;
    z-index: 2;
    margin-top: 30px;
}

.header-title {
    font-family: var(--current-font);
    font-size: 2.5rem;
    font-weight: 600;
    color: #003A46;
    margin: 0 0 8px;
    letter-spacing: 2px;
    text-transform: uppercase;
}

.header-subtitle {
    font-family: var(--current-font);
    font-size: 1.1rem;
    color: #64748b;
    margin: 0;
}

/* Breadcrumb */
.faculty-breadcrumb {
    background: #f8fafc;
    padding: 10px 0;
}

.faculty-breadcrumb .breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
}

.faculty-breadcrumb .breadcrumb-item a {
    color: #666;
    text-decoration: none;
    font-size: 0.85rem;
    transition: color 0.2s;
}

.faculty-breadcrumb .breadcrumb-item a:hover {
    color: #003A46;
}

.faculty-breadcrumb .breadcrumb-item.active {
    color: #003A46;
    font-weight: 500;
    font-size: 0.85rem;
}

.faculty-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
    color: #999;
}

/* Search Bar */
.search-bar {
    background: linear-gradient(to bottom, rgba(255,255,255,0), rgba(248,250,252,1));
    padding: 16px 0;
    position: sticky;
    top: 0;
    z-index: 100;
}

.search-filter-row {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

.search-divider {
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(0,0,0,0.1), transparent);
    margin-top: 16px;
}

.search-form {
    display: flex;
    gap: 8px;
    flex-shrink: 0;
}

.search-input {
    padding: 10px 16px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    font-size: 0.9rem;
    outline: none;
    transition: border-color 0.2s;
    min-width: 200px;
}

.search-input:focus {
    border-color: #003A46;
}

.search-btn {
    padding: 10px 16px;
    background: #003A46;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 0.9rem;
    cursor: pointer;
    transition: background 0.2s;
}

.search-btn:hover {
    background: #004d5c;
}

/* Letter Filter Bar */
.letter-filter-bar {
    background: #f5f5f5;
    padding: 12px 0;
    border-bottom: 1px solid #e0e0e0;
}

.letter-buttons-row {
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
    justify-content: flex-start;
}

/* Letter Buttons */
.letter-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
}

.letter-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    color: #555;
    background: #f5f5f5;
    border: 1px solid #e0e0e0;
    text-decoration: none;
    transition: all 0.2s ease;
}

.letter-btn:hover {
    background: #e8e8e8;
    color: #003A46;
    border-color: #003A46;
    transform: translateY(-1px);
}

.letter-btn.active {
    background: #003A46;
    color: #fff;
    border-color: #003A46;
    box-shadow: 0 2px 6px rgba(0,58,70,0.3);
}

.letter-btn.active:hover {
    background: #004d5c;
}

/* Department Select */
.dept-select {
    padding: 8px 12px;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    font-size: 0.85rem;
    background: #fff;
    cursor: pointer;
    outline: none;
    min-width: 160px;
}

.dept-select:focus {
    border-color: #003A46;
    box-shadow: 0 0 0 3px rgba(0,58,70,0.1);
}

/* Faculty Section */
.faculty-section {
    background: #f8fafc;
    padding: 40px 0 60px;
    min-height: 100vh;
}

.results-info {
    margin-bottom: 20px;
    font-size: 0.9rem;
    color: #666;
}

.faculty-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.faculty-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.3s ease;
    display: block;
    opacity: 0;
    transform: translateY(20px);
    animation: cardFadeUp 0.5s ease forwards;
    position: relative;
    overflow: hidden;
}

.faculty-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(to bottom, #003A46, #006d77);
    transition: height 0.4s ease;
    z-index: 0;
}

.faculty-card:hover::before,
.faculty-card.active::before {
    height: 100%;
}

.faculty-card:hover,
.faculty-card.active {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(0, 58, 70, 0.25);
}

.card-content {
    position: relative;
    z-index: 1;
}

.faculty-card:hover .card-name,
.faculty-card.active .card-name {
    color: #fff;
}

.faculty-card:hover .card-title,
.faculty-card.active .card-title {
    color: rgba(255, 255, 255, 0.85);
}

.faculty-card:hover .card-dept,
.faculty-card.active .card-dept {
    color: rgba(255, 255, 255, 0.7);
}

.faculty-card:hover .card-contact span,
.faculty-card.active .card-contact span {
    color: rgba(255, 255, 255, 0.9);
}

.faculty-card:hover .card-contact i,
.faculty-card.active .card-contact i {
    color: #fff;
}

.faculty-card:hover .card-photo-placeholder,
.faculty-card.active .card-photo-placeholder {
    background: rgba(255, 255, 255, 0.2);
}

.card-content {
    display: flex;
    gap: 16px;
    padding: 20px;
}

.card-photo {
    width: 120px;
    height: 120px;
    flex-shrink: 0;
    overflow: hidden;
    border-radius: 10px;
}

.card-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.faculty-card:hover .card-photo img,
.faculty-card.active .card-photo img {
    transform: scale(1.05);
}

.card-photo-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #003A46 0%, #006d77 100%);
    color: #fff;
    font-size: 2rem;
    font-weight: 600;
}

.card-info {
    flex: 1;
    min-width: 0;
}

.card-name {
    font-family: 'Playfair Display', serif;
    font-size: 1.05rem;
    font-weight: 600;
    color: #003A46;
    margin: 0 0 4px;
    line-height: 1.3;
}

.card-title {
    font-size: 0.85rem;
    color: #333;
    font-weight: 500;
    margin: 0 0 6px;
}

.card-dept {
    font-size: 0.8rem;
    color: #666;
    margin: 0 0 10px;
}

.card-contact {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.card-contact span {
    font-size: 0.8rem;
    color: #666;
    display: flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
}

.card-contact i {
    color: #003A46;
    font-size: 0.85rem;
    width: 16px;
}

@keyframes cardFadeUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.faculty-card:nth-child(1) { animation-delay: 0.05s; }
.faculty-card:nth-child(2) { animation-delay: 0.1s; }
.faculty-card:nth-child(3) { animation-delay: 0.15s; }
.faculty-card:nth-child(4) { animation-delay: 0.2s; }
.faculty-card:nth-child(5) { animation-delay: 0.25s; }
.faculty-card:nth-child(6) { animation-delay: 0.3s; }
.faculty-card:nth-child(7) { animation-delay: 0.35s; }
.faculty-card:nth-child(8) { animation-delay: 0.4s; }
.faculty-card:nth-child(9) { animation-delay: 0.45s; }
.faculty-card:nth-child(10) { animation-delay: 0.5s; }
.faculty-card:nth-child(11) { animation-delay: 0.55s; }
.faculty-card:nth-child(12) { animation-delay: 0.6s; }

@media (max-width: 1100px) {
    .faculty-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 600px) {
    .faculty-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .card-content {
        flex-direction: row;
        align-items: flex-start;
        padding: 16px;
    }
    
    .card-photo {
        width: 70px;
        height: 70px;
        flex-shrink: 0;
    }
    
    .card-name {
        font-size: 0.95rem;
    }
    
    .card-title {
        font-size: 0.8rem;
    }
    
    .card-dept {
        font-size: 0.75rem;
    }
    
    .card-contact span {
        font-size: 0.75rem;
    }
}

.pagination-wrapper :deep(.page-link) {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: 0 12px;
    border: 1px solid rgba(0,0,0,0.08);
    background: #fff;
    border-radius: 8px;
    color: #666;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.2s;
}

.pagination-wrapper :deep(.page-link:hover) {
    background: #003A46;
    color: #fff;
    border-color: #003A46;
}

.pagination-wrapper :deep(.page-item.active .page-link) {
    background: #003A46;
    color: #fff;
    border-color: #003A46;
}

/* No Results */
.no-results {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

.no-results h3 {
    margin: 0 0 8px;
}

/* Mobile */
@media (max-width: 768px) {
    .faculty-header {
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
    
    .search-filter-row {
        flex-direction: column;
        align-items: stretch;
    }
    
    .search-form {
        width: 100%;
    }
    
    .search-input {
        min-width: auto;
        width: 100%;
    }
    
    .search-btn {
        width: 50px;
        padding: 10px;
    }
    
    .letter-buttons-row {
        justify-content: center;
        overflow-x: auto;
        flex-wrap: nowrap;
        padding-bottom: 8px;
    }
    
    .letter-btn {
        width: 28px;
        height: 28px;
        font-size: 0.7rem;
        flex-shrink: 0;
    }
}
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.faculty-card');
    
    cards.forEach(card => {
        card.addEventListener('click', function(e) {
            // Only toggle if clicking on the card itself, not links inside
            if (this.tagName === 'A') return;
            
            cards.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
</script>
@endpush
