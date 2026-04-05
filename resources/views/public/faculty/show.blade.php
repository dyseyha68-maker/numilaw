@extends('layouts.public')

@section('title', $faculty->name . ' - Faculty Profile')

@section('description', 'Faculty profile for ' . $faculty->name . ' at NUM Law Faculty')

@section('content')
<div class="faculty-profile">
    <!-- Hero Banner -->
    <div class="profile-hero">
        <div class="hero-pattern"></div>
    </div>

    <div class="container">
        <!-- Breadcrumb -->
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('navigation.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('public.faculty.index') }}">{{ __('faculty.title') }}</a></li>
                        <li class="breadcrumb-item active">{{ $faculty->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
<br><br>
        <!-- Main Profile Card -->
        <div class="profile-main-card">
            <div class="row g-0">
                <!-- Left - Profile Image -->
                <div class="col-lg-4">
                    <div class="profile-image-wrapper">
                        <div class="profile-image">
                            @if($faculty->photo)
                                <img src="{{ Str::startsWith($faculty->photo, 'http') ? $faculty->photo : url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $faculty->photo)) }}" alt="{{ $faculty->name }}">
                            @else
                                <div class="image-placeholder">
                                    {{ strtoupper(substr($faculty->name, 0, 2)) }}
                                </div>
                            @endif
                            @if($faculty->status === 'active')
                                <span class="status-badge active">
                                    <span class="status-dot"></span>
                                    {{ __('faculty.active') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right - Profile Info -->
                <div class="col-lg-8">
                    <div class="profile-info">
                        <div class="profile-header">
                            <h1 class="profile-name {{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">{{ $faculty->name }}</h1>
                            <p class="profile-title {{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">{{ $faculty->title }}</p>
                            <p class="profile-dept {{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                                </svg>
                                {{ $faculty->department }}
                            </p>
                        </div>

                        <div class="profile-contact">
                            @if($faculty->email)
                            <a href="mailto:{{ $faculty->email }}" class="contact-item">
                                <div class="contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                </div>
                                <div class="contact-text">
                                    <span class="contact-label">{{ __('faculty.email') }}</span>
                                    <span class="contact-value {{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">{{ $faculty->email }}</span>
                                </div>
                            </a>
                            @endif
                            @if($faculty->phone)
                            <a href="tel:{{ $faculty->phone }}" class="contact-item">
                                <div class="contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg>
                                </div>
                                <div class="contact-text">
                                    <span class="contact-label">{{ __('faculty.phone') }}</span>
                                    <span class="contact-value {{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">{{ $faculty->phone }}</span>
                                </div>
                            </a>
                            @endif
                            @if($faculty->office_location)
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </div>
                                <div class="contact-text">
                                    <span class="contact-label">{{ __('faculty.office') }}</span>
                                    <span class="contact-value {{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">{{ $faculty->office_location }}</span>
                                </div>
                            </div>
                            @endif
                            @if($faculty->office_hours)
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                </div>
                                <div class="contact-text">
                                    <span class="contact-label">{{ __('faculty.office_hours') }}</span>
                                    <span class="contact-value {{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">{{ $faculty->office_hours }}</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Cards -->
        <div class="row g-4 mt-2">
            <div class="col-lg-8">
                <!-- Biography -->
                <div class="content-card">
                    <div class="card-header">
                        <h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            {{ __('faculty.biography') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <p class="{{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">{!! $faculty->bio ?: __('faculty.not_specified') !!}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Education -->
                <div class="content-card">
                    <div class="card-header">
                        <h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                                <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                            </svg>
                            {{ __('faculty.education') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <p class="{{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">{{ $faculty->education ?: __('faculty.not_specified') }}</p>
                    </div>
                </div>

                <!-- Specialization -->
                <div class="content-card mt-4">
                    <div class="card-header">
                        <h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            {{ __('faculty.specialization') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="tags">
                            @forelse(explode(',', $faculty->specialization ?? '') as $specialization)
                                <span class="tag {{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">{{ trim($specialization) }}</span>
                            @empty
                                <p class="mb-0 {{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">{{ __('faculty.not_specified') }}</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-4 mb-5">
            <a href="{{ route('public.faculty.index') }}" class="back-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                {{ __('faculty.back_to_faculty') }}
            </a>
        </div>
    </div>
</div>

<style>
.faculty-profile {
    background: #f8f9fa;
    min-height: 100vh;
    padding-bottom: 2rem;
}

.profile-hero {
    height: 180px;
    background: linear-gradient(135deg, #003A46 0%, #005f73 50%, #0a9396 100%);
    position: relative;
    overflow: hidden;
}

.hero-pattern {
    position: absolute;
    inset: 0;
    background-image: 
        radial-gradient(circle at 20% 80%, rgba(255,255,255,0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255,255,255,0.05) 0%, transparent 50%);
}

.breadcrumb-nav {
    margin-top: -40px;
    position: relative;
    z-index: 10;
}

.breadcrumb {
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(10px);
    padding: 12px 20px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.breadcrumb-item a {
    color: #666;
    text-decoration: none;
    font-size: 0.85rem;
    transition: color 0.2s;
}

.breadcrumb-item a:hover {
    color: #003A46;
}

.breadcrumb-item.active {
    color: #1a1a2e;
    font-weight: 500;
    font-size: 0.85rem;
}

.profile-main-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    overflow: hidden;
    margin-top: -60px;
    position: relative;
    z-index: 5;
}

.profile-image-wrapper {
    position: relative;
    height: 100%;
    min-height: 320px;
    padding: 20px;
}

.profile-image {
    width: 100%;
    height: 100%;
    min-height: 320px;
    object-fit: cover;
    position: relative;
}

.profile-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 20px;
}

.image-placeholder {
    width: 100%;
    height: 100%;
    min-height: 320px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #e8e8e8 0%, #d4d4d4 100%);
    color: #999;
    font-size: 4rem;
    font-weight: 300;
    border-radius: 20px;
    position: relative;
}

.profile-status {
    position: absolute;
    bottom: 20px;
    left: 20px;
}

.status-badge {
    position: absolute;
    bottom: 30px;
    left: 30px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.status-badge.active {
    color: #10b981;
}

.status-dot {
    width: 8px;
    height: 8px;
    background: #10b981;
    border-radius: 50%;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.profile-info {
    padding: 30px;
}

.profile-header {
    margin-bottom: 24px;
    padding-bottom: 24px;
    border-bottom: 1px solid #eee;
}

.profile-name {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1a1a2e;
    margin: 0 0 8px;
}

.profile-title {
    font-size: 1rem;
    font-weight: 500;
    color: #666;
    margin: 0 0 8px;
}

.profile-dept {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    color: #003A46;
    margin: 0;
    font-weight: 500;
}

.profile-contact {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px;
    background: #f8f9fa;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.2s ease;
}

a.contact-item:hover {
    background: #f0f1f2;
    transform: translateY(-2px);
}

.contact-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    border-radius: 10px;
    color: #003A46;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    flex-shrink: 0;
}

.contact-text {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.contact-label {
    font-size: 0.7rem;
    color: #999;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.contact-value {
    font-size: 0.85rem;
    color: #333;
    font-weight: 500;
}

.content-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    overflow: hidden;
}

.card-header {
    padding: 20px 24px;
    border-bottom: 1px solid #f0f0f0;
    display: flex;
    align-items: center;
}

.card-header h3 {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 1rem;
    font-weight: 600;
    color: #1a1a2e;
    margin: 0;
}

.card-header h3 svg {
    color: #003A46;
}

.card-body {
    padding: 24px;
}

.card-body p {
    font-size: 0.9rem;
    color: #555;
    line-height: 1.7;
    margin: 0;
}

.tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.tag {
    padding: 6px 14px;
    background: linear-gradient(135deg, #e0f2fe, #bae6fd);
    color: #003A46;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 12px;
    color: #555;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.back-btn:hover {
    background: #003A46;
    border-color: #003A46;
    color: #fff;
}

@media (max-width: 991px) {
    .profile-image-wrapper {
        min-height: 280px;
        padding: 15px;
    }
    
    .profile-image,
    .image-placeholder {
        min-height: 280px;
        border-radius: 15px;
    }

    .status-badge {
        bottom: 20px;
        left: 20px;
        padding: 5px 10px;
        font-size: 0.65rem;
    }
}
</style>
@endsection
