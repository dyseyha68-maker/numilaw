@extends('layouts.public')

@section('title', 'National University of Management - Faculty of Law')

@section('description', 'Premier legal education in Cambodia - Building tomorrow\'s legal leaders today at NUMiLaw')

@push('styles')
<style>
/* Professional Hero Section */
.hero-section {
    background: linear-gradient(135deg, #003A46 0%, #004d5c 50%, #005f6b 100%);
    position: relative;
    overflow: hidden;
    min-height: 85vh;
    display: flex;
    align-items: center;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        linear-gradient(90deg, rgba(0,0,0,0.03) 1px, transparent 1px),
        linear-gradient(rgba(0,0,0,0.03) 1px, transparent 1px);
    background-size: 60px 60px;
}

.hero-section::after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 50%;
    height: 100%;
    background: linear-gradient(180deg, rgba(0,170,204,0.15) 0%, transparent 50%);
    clip-path: polygon(30% 0, 100% 0, 100% 100%, 0% 100%);
}

.hero-professional {
    position: relative;
    z-index: 2;
    animation: slideUp 0.8s ease-out;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeInRight {
    from { opacity: 0; transform: translateX(30px); }
    to { opacity: 1; transform: translateX(0); }
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    padding: 0.5rem 1.25rem;
    border-radius: 50px;
    color: #fff;
    font-size: 0.875rem;
    font-weight: 500;
    margin-bottom: 1.5rem;
    animation: slideDown 0.6s ease-out;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    line-height: 1.15;
    color: #fff;
    margin-bottom: 1rem;
}

.hero-subtitle {
    font-size: 1.25rem;
    color: rgba(255,255,255,0.85);
    margin-bottom: 1rem;
    font-weight: 400;
}

.hero-description {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.7);
    max-width: 550px;
    line-height: 1.7;
    margin-bottom: 2rem;
}

.hero-btn-primary {
    padding: 8px 24px;
    border: 0;
    border-radius: 100px;
    background-color: #fff;
    color: #003A46;
    font-weight: Bold;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
}

.hero-btn-primary:hover {
    background-color: #6fc5ff;
    box-shadow: 0 0 20px #6fc5ff50;
    transform: scale(1.1);
    color: #003A46;
}

.hero-btn-primary:active {
    background-color: #3d94cf;
    transition: all 0.25s;
    -webkit-transition: all 0.25s;
    box-shadow: none;
    transform: scale(0.98);
}

.hero-btn-secondary {
    padding: 8px 24px;
    border: 2px solid rgba(255,255,255,0.5);
    border-radius: 100px;
    background-color: transparent;
    color: #fff;
    font-weight: Bold;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
}

.hero-btn-secondary:hover {
    background-color: rgba(255,255,255,0.1);
    box-shadow: 0 0 20px rgba(255,255,255,0.2);
    transform: scale(1.1);
    border-color: #fff;
    color: #fff;
}

.hero-btn-secondary:active {
    background-color: rgba(255,255,255,0.2);
    transition: all 0.25s;
    -webkit-transition: all 0.25s;
    box-shadow: none;
    transform: scale(0.98);
}

.hero-btn-secondary:hover {
    background: rgba(255,255,255,0.1);
    border-color: #fff;
    color: #fff;
}

.hero-visual {
    position: relative;
    z-index: 2;
    animation: fadeInRight 0.8s ease-out 0.4s both;
}

.hero-info-card {
    background: rgba(255,255,255,0.98);
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 25px 50px rgba(0,0,0,0.25);
}

.hero-event-item {
    display: flex;
    align-items: center;
    padding: 1rem;
    border-radius: 12px;
    transition: all 0.3s ease;
    background: #f8fafc;
    margin-bottom: 0.75rem;
}

.hero-event-item:hover {
    background: #e2e8f0;
    transform: translateX(5px);
}

.hero-event-date {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #003A46, #005f6b);
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #fff;
    margin-right: 1rem;
    flex-shrink: 0;
}

.hero-event-date .day {
    font-size: 1.1rem;
    font-weight: 700;
    line-height: 1;
}

.hero-event-date .month {
    font-size: 0.65rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.hero-stats-row {
    display: flex;
    gap: 2rem;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e2e8f0;
}

.hero-stat-item {
    text-align: center;
}

.hero-stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: #003A46;
}

.hero-stat-label {
    font-size: 0.75rem;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Stat Cards */
.stat-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
    transition: all 0.4s ease;
    border: none;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #003A46, #00AACC);
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.stat-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
}

.stat-card:hover::before {
    transform: scaleX(1);
}

/* Featured Card */
.featured-card {
    border: 1px solid #e5e7eb;
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.4s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    background: white;
    height: 100%;
}

.featured-card-link {
    text-decoration: none;
    display: block;
    height: 100%;
}

.featured-card-link .featured-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 0 40px rgba(0, 58, 70, 0.15), 0 0 80px rgba(0, 168, 204, 0.1);
    border-color: rgba(0, 168, 204, 0.4);
}

.featured-image {
    border-radius: 12px;
    width: calc(100% - 20px) !important;
    margin: 10px 10px 0 10px;
    display: block;
}

/* Stat Card */
.stat-card {
    transition: all 0.3s ease;
}
.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    background: white !important;
}

/* Program Card */
.program-card {
    border: none;
    border-radius: 24px;
    padding: 2.5rem 2rem;
    text-align: center;
    transition: all 0.4s ease;
    background: white;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    height: 100%;
    position: relative;
    overflow: hidden;
}

.program-card::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #003A46, #00AACC);
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.program-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 60px rgba(0,0,0,0.15);
}

.program-card:hover::after {
    transform: scaleX(1);
}

/* CTA Section */
.cta-modern {
    background: #f8fafc;
    position: relative;
    overflow: hidden;
    padding: 80px 0;
}

.cta-modern .cta-pattern {
    display: none;
}

.cta-glass {
    background: transparent;
    backdrop-filter: none;
    border: none;
    border-radius: 24px;
    padding: 3rem;
    position: relative;
    z-index: 1;
}

.cta-btn-glow {
    background: linear-gradient(135deg, #003A46 0%, #005f6b 100%);
    color: #fff;
    border: none;
    padding: 1rem 2.5rem;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1.1rem;
    position: relative;
    overflow: hidden;
    transition: all 0.4s ease;
    box-shadow: 0 4px 15px rgba(0,58,70,0.3);
}

.cta-btn-glow:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(0,170,204,0.4);
}

/* Quick Links Hover Effects */
.quick-link-item:hover {
    background: rgba(255,255,255,0.2) !important;
    transform: translateX(5px);
}

.quick-link-item:hover i {
    transform: scale(1.2);
}

.event-item:hover {
    border-color: #003A46 !important;
    box-shadow: 0 4px 15px rgba(0,58,70,0.1);
}

/* Project Card Hover Effects */
.project-card:hover {
    background: rgba(255,255,255,0.15) !important;
    transform: translateY(-3px);
    border-color: rgba(255,255,255,0.3) !important;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Counter animation
    function animateCounter(element, target) {
        let current = 0;
        const increment = target / 50;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target + '+';
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current) + '+';
            }
        }, 30);
    }

    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.dataset.target);
                animateCounter(entry.target, target);
                counterObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.stat-number').forEach(el => {
        counterObserver.observe(el);
    });
});
</script>
@endpush

@section('content')
<!-- Hero Slideshow Section -->
@include('components.hero.slideshow', ['pageKey' => 'home', 'height' => '85vh', 'autoplay' => true, 'navigation' => true, 'pagination' => true])

<!-- Partners Section -->
@php
    $partners = \App\Models\PartnerUniversity::where('status', 'active')->take(8)->get();
@endphp
<section class="py-5" style="background: white;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="px-4 py-2 mb-3 d-inline-block" style="background: rgba(0,58,70,0.1); color: #003A46; border-radius: 50px; font-size: 0.875rem; font-weight: 600;">
                <i class="bi bi-hand-thumbs-up me-2"></i>{{ __('home.partners') }}
            </span>
            <h2 class="display-6 fw-bold mb-3" style="color: #003A46;">
                {{ __('home.strategic_partnerships') }}
            </h2>
            <p class="text-muted" style="max-width: 600px; margin: 0 auto;">
                {{ __('home.partners_description') }}
            </p>
        </div>
        
        <div class="partner-slider">
            <div class="partner-slider-fade-left"></div>
            <div class="partner-slider-fade-right"></div>
            <div class="partner-track">
                @forelse($partners as $partner)
                <div class="partner-logo">
                    <div class="partner-logo-inner">
                        @if($partner->logo)
                            <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $partner->logo)) }}" alt="{{ $partner->name }}" style="max-width: 100px; max-height: 60px; object-fit: contain;">
                        @else
                            <i class="bi bi-building" style="font-size: 2.5rem; color: #003A46;"></i>
                        @endif
                        <span class="mt-2" style="font-size: 0.75rem; color: #003A46; font-weight: 600;">{{ $partner->name }}</span>
                    </div>
                </div>
                @empty
                <div class="partner-logo">
                    <div class="partner-logo-inner">
                        <i class="bi bi-building" style="font-size: 2.5rem; color: #003A46;"></i>
                        <span class="mt-2" style="font-size: 0.75rem; color: #003A46; font-weight: 600;">Partner 1</span>
                    </div>
                </div>
                @endforelse
                <!-- Duplicate for seamless loop -->
                @foreach($partners as $partner)
                <div class="partner-logo">
                    <div class="partner-logo-inner">
                        @if($partner->logo)
                            <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $partner->logo)) }}" alt="{{ $partner->name }}" style="max-width: 100px; max-height: 60px; object-fit: contain;">
                        @else
                            <i class="bi bi-building" style="font-size: 2.5rem; color: #003A46;"></i>
                        @endif
                        <span class="mt-2" style="font-size: 0.75rem; color: #003A46; font-weight: 600;">{{ $partner->name }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
.partner-slider {
    overflow: hidden;
    padding: 20px 0;
    position: relative;
}
.partner-slider-fade-left,
.partner-slider-fade-right {
    display: none;
}
.partner-track {
    display: flex;
    gap: 30px;
    animation: scroll 12s linear infinite;
    width: max-content;
}
.partner-logo {
    flex-shrink: 0;
    width: 200px;
    height: 120px;
}
.partner-logo-inner {
    width: 100%;
    height: 100%;
    background: transparent;
    border-radius: 16px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}
.partner-logo-inner:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}
@keyframes scroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
</style>

<!-- Rector Message Section -->
@php
    $rector = \App\Models\Leadership::active()->ordered()->first();
@endphp
@if($rector)
<section style="background: white; padding-top: 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card border-0 rector-card" style="border-radius: 32px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.08);">
                    <div class="row g-0">
                        <div class="col-lg-5">
                            <div style="height: 100%; min-height: 400px; padding: 20px;">
                                <div style="border-radius: 24px; overflow: hidden; height: 100%; box-shadow: 0 10px 40px rgba(0,0,0,0.15);" class="rector-image-wrapper">
                                @if($rector->photo)
                                    <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $rector->photo)) }}" alt="{{ $rector->name }}" class="rector-image" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                                @else
                                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=600&q=80" alt="{{ $rector->name }}" class="rector-image" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="card-body p-3" style="display: flex; flex-direction: column; justify-content: center; height: 100%;">
                                <small style="color: #000; font-weight: 600; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 0.25rem;">{{ __('home.rector_message') }}</small>
                                <h2 style="color: #003A46; font-weight: 700; font-size: 1.75rem; line-height: 1.3; margin-bottom: 0.5rem;">Welcome to NUM International Program of Legal Studies</h2>
                                <p style="font-size: 1rem; line-height: 1.8; color: #000; margin-bottom: 0;">
                                    "{{ Str::limit($rector->bio_en, 350) }}"
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.rector-card {
    transition: all 0.4s ease;
}
.rector-card:hover {
    box-shadow: 0 0 50px rgba(0, 58, 70, 0.5), 0 0 100px rgba(197, 160, 40, 0.2) !important;
}
.rector-image-wrapper {
    transition: all 0.4s ease;
}
.rector-image-wrapper:hover {
    transform: scale(1.02);
}
.rector-image-wrapper:hover .rector-image {
    transform: scale(1.08);
}
</style>
@endif

<!-- Why Choose Us Section -->
<section class="py-5" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="d-inline-block px-4 py-2 mb-3" style="background: rgba(0,58,70,0.1); color: #003A46; border-radius: 50px; font-size: 0.875rem; font-weight: 600;">
                {{ app()->getLocale() === 'km' ? 'ហេតុអ្វីត្រូវជ្រើសរើសយើង' : 'WHY CHOOSE US' }}
            </span>
            <h2 class="fw-bold mb-3" style="color: #003A46; font-size: 2rem;">
                {{ app()->getLocale() === 'km' ? 'អាចសម្រេចគ្រប់យ៉ាង' : 'Unlock Your Potential' }}
            </h2>
            <p class="text-muted" style="max-width: 700px; margin: 0 auto;">
                {{ app()->getLocale() === 'km' ? 'At NUM iLaw, you will be future-ready graduates equipped with knowledge, skills, experiences and networks to unlock limitless possibilities in the 21st century.' : 'At NUM iLaw, you will be future-ready graduates equipped with knowledge, skills, experiences and networks to unlock limitless possibilities in the 21st century.' }}
            </p>
        </div>
        
        <div class="row g-4 justify-content-center">
            <!-- Card 1: Premier Legal Education -->
            <div class="col-lg-6">
                <div class="aws-card h-100">
                    <div class="aws-card-list">
                        <div class="aws-card-list-item">
                            <i class="bi bi-lightbulb" style="color: #f59e0b;"></i>
                            <div>
                                <strong>{{ app()->getLocale() === 'km' ? 'Innovative Curriculum' : 'Innovative Curriculum' }}</strong>
                                <p class="mb-0 text-muted">{{ app()->getLocale() === 'km' ? 'កម្មវិធីសិក្សាថ្មី និងប្រសិទ្ធិភាព' : 'Modern curriculum designed by legal experts' }}</p>
                            </div>
                        </div>
                        <div class="aws-card-list-item">
                            <i class="bi bi-book" style="color: #10b981;"></i>
                            <div>
                                <strong>{{ app()->getLocale() === 'km' ? 'Experiential Learning' : 'Experiential Learning' }}</strong>
                                <p class="mb-0 text-muted">{{ app()->getLocale() === 'km' ? 'ការរៀនតាមបទគតិយុទ្ធ' : 'Hands-on case-based learning approach' }}</p>
                            </div>
                        </div>
                        <div class="aws-card-list-item">
                            <i class="bi bi-award" style="color: #f59e0b;"></i>
                            <div>
                                <strong>{{ app()->getLocale() === 'km' ? 'Legal Professional Exam' : 'Legal Professional Exam' }}</strong>
                                <p class="mb-0 text-muted">{{ app()->getLocale() === 'km' ? 'រៀបចំសម្រាប់ការប្រឡងច្បាប់' : 'Preparation for professional licensing exams' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Card 2: Opportunities & Future -->
            <div class="col-lg-6">
                <div class="aws-card h-100">
                    <div class="aws-card-list">
                        <div class="aws-card-list-item">
                            <i class="bi bi-briefcase" style="color: #6366f1;"></i>
                            <div>
                                <strong>{{ app()->getLocale() === 'km' ? 'Career & Scholarships' : 'Career & Scholarships' }}</strong>
                                <p class="mb-0 text-muted">{{ app()->getLocale() === 'km' ? 'Partnerships with top law firms, NGOs, and scholarship opportunities' : 'Partnerships with top law firms, NGOs, and scholarship opportunities' }}</p>
                            </div>
                        </div>
                        <div class="aws-card-list-item">
                            <i class="bi bi-globe" style="color: #0891b2;"></i>
                            <div>
                                <strong>{{ app()->getLocale() === 'km' ? 'International Exposure' : 'International Exposure' }}</strong>
                                <p class="mb-0 text-muted">{{ app()->getLocale() === 'km' ? 'ការប្រកួតច្បាប់អន្តរជាតិ' : 'International moot court competitions' }}</p>
                            </div>
                        </div>
                        <div class="aws-card-list-item">
                            <i class="bi bi-people" style="color: #ef4444;"></i>
                            <div>
                                <strong>{{ app()->getLocale() === 'km' ? 'Support & Community' : 'Support & Community' }}</strong>
                                <p class="mb-0 text-muted">{{ app()->getLocale() === 'km' ? 'គ្រូបង្គៀប និងទំនាក់ទំនង' : 'Dedicated mentors and peer network' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.aws-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.aws-card:hover {
    box-shadow: 0 0 40px rgba(0, 58, 70, 0.15), 0 0 80px rgba(0, 168, 204, 0.1);
    border-color: rgba(0, 168, 204, 0.4);
    transform: translateY(-4px);
}

.aws-card-list {
    flex: 1;
}

.aws-card-list-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid #f1f5f9;
    transition: padding-left 0.3s ease;
}

.aws-card-list-item:last-child {
    border-bottom: none;
}

.aws-card:hover .aws-card-list-item {
    padding-left: 0.5rem;
}

.aws-card-list-item i {
    font-size: 1.25rem;
    min-width: 24px;
    margin-top: 2px;
}

.aws-card-list-item strong {
    color: #003A46;
    font-size: 1rem;
    display: block;
    margin-bottom: 0.25rem;
}

.aws-card-list-item p {
    font-size: 0.85rem;
    line-height: 1.5;
}
</style>

        <!-- Featured Articles Section -->
        <section class="py-5" style="background: white;">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 style="color: #003A46; font-weight: 700; margin-bottom: 0.5rem;">
                            {{ __('home.latest_news_articles') }}
                        </h2>
                        <p class="text-muted mb-0">{{ __('home.stay_updated') }}</p>
                    </div>
                    <a href="{{ route('public.articles.index') }}" class="btn btn-outline-dark" style="border-radius: 50px; padding: 0.75rem 1.5rem;">
                        {{ __('home.view_all_events') }} <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
                
                <div class="row g-4 mb-5">
                    @php
                        $featuredArticles = \App\Models\Article::published()
                            ->featured()
                            ->with(['author', 'category'])
                            ->take(4)
                            ->get();
                    @endphp
                    
                    @forelse($featuredArticles as $article)
                        <div class="col-md-6 col-lg-3">
                            <a href="{{ route('public.articles.show', $article->slug) }}" class="featured-card-link">
                                <div class="featured-card">
                                    @if($article->featured_image)
                                         <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $article->featured_image)) }}" 
                                              alt="{{ $article->title }}" 
                                              class="featured-image"
                                              style="height: 200px; object-fit: cover; width: 100%;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                            <i class="bi bi-newspaper display-4 text-muted"></i>
                                        </div>
                                    @endif
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            @if($article->category)
                                                <span style="background: #e0f2fe; color: #0284c7; padding: 0.3rem 0.75rem; border-radius: 20px; font-size: 0.7rem; font-weight: 600;">
                                                    {{ $article->category->name }}
                                                </span>
                                            @endif
                                            <small class="text-muted">
                                                {{ $article->published_at->format('d/M/y') }}
                                            </small>
                                        </div>
                                        <h6 style="font-weight: 700; margin-bottom: 0; color: #003A46; line-height: 1.4;">
                                            {{ Str::limit($article->title, 55) }}
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <i class="bi bi-newspaper text-muted fs-1"></i>
                            <p class="text-muted mt-3">{{ __('home.no_articles_found') }}</p>
                        </div>
                    @endforelse
                </div>

    </div>
</section>

<!-- Programs Section -->
<section class="py-5" style="background: white;">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge mb-3 px-4 py-2" style="background: #003A46; color: white; border-radius: 50px; font-size: 0.85rem; font-weight: 600;">
                {{ app()->getLocale() === 'km' ? 'កម្មវិធីសិក្សា' : 'Academic Programs' }}
            </span>
            <h2 style="color: #003A46; font-weight: 700; margin-bottom: 0.5rem; font-size: 2.25rem;">
                {{ app()->getLocale() === 'km' ? 'ស្វែងរកកម្មវិធីសិក្សា' : 'Explore Our Programs' }}
            </h2>
            <p class="text-muted" style="max-width: 600px; margin: 0 auto; font-size: 1.1rem;">
                {{ app()->getLocale() === 'km' ? 'ជ្រើសរើសផ្លូវអាជីពច្បាប់ដ៏ល្អបំផុតសម្រាប់អនាគតរបស់អ្នក' : 'Choose the best legal career path for your future' }}
            </p>
        </div>
        
        <div class="row g-4 justify-content-center">
            <div class="col-lg-5">
                <div class="program-card h-100 position-relative" style="border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.15); transition: all 0.4s ease; overflow: hidden; min-height: 300px;">
                    <img src="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=800&q=80" alt="Law Library" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(0,58,70,0.9) 0%, rgba(0,58,70,0.7) 100%);"></div>
                    <div class="p-4 text-start position-relative" style="z-index: 1; height: 100%; display: flex; flex-direction: column; justify-content: flex-end;">
                        <span class="badge mb-2" style="background: white; color: #003A46; border-radius: 20px; width: fit-content;">4 {{ app()->getLocale() === 'km' ? 'ឆ្នាំ' : 'Years' }}</span>
                        <h4 class="fw-bold d-block" style="color: white;">{{ app()->getLocale() === 'km' ? 'បរិញ្ញាប័ត្រ ច្បាប់' : 'Bachelor of Law' }}</h4>
                        <p class="mb-3" style="line-height: 1.7; color: rgba(255,255,255,0.9);">
                            {{ app()->getLocale() === 'km' ? 'កេរ្តិ៍មគ្គសិក្សាផ្តល់មូលដ្ឋានគ្រឺមករណ៍ច្បាប់ និងការត្រៀមសម្រាប់ការងារផ្នែកច្បាប់' : 'Comprehensive law foundation program preparing for legal careers' }}
                        </p>
                        <a href="{{ route('public.academic-programs.index') }}" class="btn btn-sm" style="background: white; color: #003A46; border-radius: 50px; padding: 10px 24px; width: fit-content;">
                            {{ app()->getLocale() === 'km' ? 'ស្វែងយល់បន្ថែម' : 'Learn More' }} <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-5">
                <div class="program-card h-100 position-relative" style="border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.15); transition: all 0.4s ease; overflow: hidden; min-height: 300px;">
                    <img src="https://images.unsplash.com/photo-1505664194779-8beaceb93744?w=800&q=80" alt="Moot Court" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(0,58,70,0.9) 0%, rgba(0,58,70,0.7) 100%);"></div>
                    <div class="p-4 text-start position-relative" style="z-index: 1; height: 100%; display: flex; flex-direction: column; justify-content: flex-end;">
                        <span class="badge mb-2" style="background: white; color: #003A46; border-radius: 20px; width: fit-content;">{{ app()->getLocale() === 'km' ? 'បណ្ឌិត' : 'Program' }}</span>
                        <h4 class="fw-bold d-block" style="color: white;">{{ app()->getLocale() === 'km' ? 'តុក្កតារម្មយាក' : 'Moot Court' }}</h4>
                        <p class="mb-3" style="line-height: 1.7; color: rgba(255,255,255,0.9);">
                            {{ app()->getLocale() === 'km' ? 'កេរ្តិ៍មគ្គហាត់ប្រសេចសំរាប់ការប្រកួតប្រជែង និងកេរ្តិ៍មគ្គច្បាប់' : 'Practice program for moot court competitions and legal skills development' }}
                        </p>
                        <a href="{{ route('public.moot-programs.index') }}" class="btn btn-sm" style="background: white; color: #003A46; border-radius: 50px; padding: 10px 24px; width: fit-content;">
                            {{ app()->getLocale() === 'km' ? 'ស្វែងយល់បន្ថែម' : 'Learn More' }} <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.program-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(0, 58, 70, 0.2) !important;
}
</style>

<style>
.programs-section {
    position: relative;
    overflow: hidden;
    background: linear-gradient(180deg, #f8fafc 0%, #e2e8f0 100%);
}

.programs-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 50%, rgba(0, 58, 70, 0.03) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(0, 170, 204, 0.05) 0%, transparent 40%);
    pointer-events: none;
}

.programs-badge {
    background: linear-gradient(135deg, #003A46, #005a6e);
    color: white;
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(0, 58, 70, 0.3);
}

.program-card-modern {
    background: white;
    border-radius: 24px;
    padding: 2.5rem 2rem;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(0, 58, 70, 0.08);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
}

.program-card-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--accent), transparent);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.program-card-modern::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(0, 58, 70, 0.02), transparent);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.program-card-modern:hover {
    transform: translateY(-12px);
    box-shadow: 0 25px 50px rgba(0, 58, 70, 0.15);
    border-color: transparent;
}

.program-card-modern:hover::before {
    opacity: 1;
}

.program-card-modern:hover::after {
    opacity: 1;
}

.program-icon-wrapper {
    position: relative;
    width: 100px;
    height: 100px;
    margin: 0 auto 1.75rem;
}

.program-icon {
    width: 100px;
    height: 100px;
    border-radius: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    background: linear-gradient(135deg, #e0f2fe, #bae6fd);
    color: #0284c7;
    position: relative;
    z-index: 1;
    transition: all 0.4s ease;
}

.program-icon-glow {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    background: #0284c7;
    filter: blur(30px);
    opacity: 0.3;
    transition: all 0.4s ease;
}

.program-card-modern:hover .program-icon {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 10px 30px rgba(2, 132, 199, 0.3);
}

.program-card-modern:hover .program-icon-glow {
    opacity: 0.5;
    width: 100px;
    height: 100px;
}

.program-link {
    display: inline-flex;
    align-items: center;
    color: #003A46;
    font-weight: 600;
    text-decoration: none;
    padding: 0.5rem 1rem;
    border-radius: 30px;
    transition: all 0.3s ease;
    background: transparent;
}

.program-link:hover {
    background: #f1f5f9;
    color: #005a6e;
    transform: translateX(5px);
}

.program-link i {
    transition: transform 0.3s ease;
}

.program-link:hover i {
    transform: translateX(5px);
}
</style>

<!-- Featured Stories Section -->
@php
    $featuredStudents = \App\Models\MootTeamMember::with('team.participation.moot')
        ->where('is_team_lead', true)
        ->latest()
        ->take(4)
        ->get();
@endphp
@if($featuredStudents->isNotEmpty())
<section class="py-5" style="background: white;">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge mb-3 px-4 py-2" style="background: #003A46; color: white; border-radius: 50px; font-size: 0.85rem; font-weight: 600;">
                {{ app()->getLocale() === 'km' ? 'រឿងរ៉ាវជោគជ័យ' : 'Featured Stories' }}
            </span>
            <h2 class="fw-bold mb-3" style="color: #003A46; font-size: 2rem;">
                {{ app()->getLocale() === 'km' ? 'រឿងរ៉ាវរបស់និស្សិតឆ្នេរសោះ' : 'Outstanding Student Stories' }}
            </h2>
            <p class="text-muted" style="max-width: 600px; margin: 0 auto;">
                {{ app()->getLocale() === 'km' ? 'ស្វែងយល់ពីរឿងរ៉ាវជោគជ័យរបស់និស្សិតរបស់យើង' : 'Discover the success stories of our brightest students' }}
            </p>
        </div>
        
        <div class="row g-4">
            @foreach($featuredStudents as $member)
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 h-100" style="border-radius: 20px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                    @if($member->image)
                         <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $member->image)) }}" 
                              alt="{{ $member->getNameAttribute() }}" 
                              style="height: 220px; width: 100%; object-fit: cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center" style="height: 220px; background: linear-gradient(135deg, #003A46, #005f6b);">
                            <i class="bi bi-person-circle text-white" style="font-size: 4rem;"></i>
                        </div>
                    @endif
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-2" style="color: #003A46;">
                            {{ $member->getNameAttribute() }}
                        </h5>
                        @if($member->team && $member->team->participation)
                        <p class="small mb-3" style="color: #64748b;">
                            <i class="bi bi-trophy me-1" style="color: #fbbf24;"></i>
                            {{ $member->team->participation->moot->getNameAttribute() }} {{ $member->team->participation->year }}
                        </p>
                        @endif
                        <span class="badge" style="background: #e0f2fe; color: #0284c7; border-radius: 20px; font-size: 0.75rem;">
                            {{ ucfirst($member->role) }}
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Upcoming Events Section -->
<section class="py-5" style="background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div style="width: 4px; height: 28px; background: linear-gradient(180deg, #c5a028, #8b7019); border-radius: 2px;"></div>
                    <h3 class="mb-0 fw-bold" style="color: #003A46;">{{ __('home.upcoming_events_sidebar') }}</h3>
                </div>
                <small class="text-muted">{{ __('home.dont_miss_events') }}</small>
            </div>
            <a href="{{ route('public.events.index') }}" class="btn btn-outline-dark" style="border-radius: 50px; padding: 0.75rem 1.5rem;">
                {{ app()->getLocale() === 'km' ? 'មើលទាំងអស់' : 'View All' }} <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
        
        <div class="row g-4">
            @forelse($upcomingEvents as $event)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('public.events.show', $event->slug) }}" class="text-decoration-none">
                        <div class="event-card h-100" style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb; transition: all 0.3s ease;">
                            <div class="p-4">
                                <div class="d-flex align-items-start gap-3 mb-3">
                                    <!-- Date Box - Playfair Display style -->
                                    <div class="event-date-box" style="min-width: 60px; text-align: center;">
                                        <div style="font-family: 'Playfair Display', serif; font-size: 4.5rem; font-weight: 700; color: #003A46; line-height: 1;">{{ $event['start_datetime']->format('d') }}</div>
                                        <div style="font-size: 0.8rem; color: #c5a028; text-transform: uppercase; font-weight: 600;">{{ $event['start_datetime']->format('M') }}</div>
                                    </div>
                                    <!-- Gold vertical divider -->
                                    <div style="width: 1px; background: linear-gradient(180deg, #c5a028, #d4b84a); height: 50px;"></div>
                                    <!-- Event Info -->
                                    <div class="flex-grow-1">
                                        <span class="badge mb-2" style="background: #f0f9ff; color: #0284c7; border-radius: 20px; font-size: 0.7rem; font-weight: 600; border: 1px solid #e0f2fe;">
                                            {{ $event['type'] ?? 'Event' }}
                                        </span>
                                        <h5 class="mb-2 fw-bold" style="color: #003A46; line-height: 1.3; font-size: 1rem;">
                                            {{ Str::limit(app()->getLocale() === 'km' ? $event['title_km'] : $event['title_en'], 50) }}
                                        </h5>
                                    </div>
                                </div>
                                <!-- Meta icons -->
                                <div class="d-flex flex-wrap gap-3" style="font-size: 0.8rem; color: #64748b;">
                                    <span><i class="bi bi-clock me-1" style="color: #c5a028;"></i>{{ $event['start_datetime']->format('g:i A') }}</span>
                                    <span><i class="bi bi-geo-alt me-1" style="color: #c5a028;"></i>{{ Str::limit($event['location'], 25) }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div style="width: 80px; height: 80px; margin: 0 auto; background: linear-gradient(135deg, #fef3c7, #fde68a); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-calendar-x" style="font-size: 2rem; color: #d97706;"></i>
                    </div>
                    <h5 class="mt-3" style="color: #003A46;">{{ __('home.no_events_found') }}</h5>
                    <p class="text-muted">{{ app()->getLocale() === 'km' ? 'មិនមានព្រឹត្តិការណ៍ទេ' : 'No upcoming events at the moment' }}</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<style>
.event-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 0 40px rgba(0, 58, 70, 0.15), 0 0 80px rgba(197, 160, 40, 0.1) !important;
    border-color: rgba(197, 160, 40, 0.4);
}
</style>

<!-- Our Projects Section - Full Width -->
<section class="py-5" style="background: white;" id="projectsSection">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1 fw-bold" style="color: #003A46;">{{ __('home.our_projects') }}</h3>
                <small class="text-muted">{{ __('home.research_projects') }}</small>
            </div>
            <a href="{{ route('public.projects.index') }}" class="btn btn-outline-dark" style="border-radius: 50px; padding: 0.75rem 1.5rem;">
                {{ __('home.view_all_projects') }} <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
    
    @php
        $projects = \App\Models\Project::active()->with(['supervisor'])->get();
    @endphp
    
    <div class="projects-carousel" id="projectsCarousel">
        @forelse($projects as $project)
            <div class="project-slide">
                <a href="{{ route('public.projects.show', $project->slug) }}" class="text-decoration-none">
                    <div class="project-card" style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.15); transition: all 0.4s ease; width: 320px; flex-shrink: 0;">
                        <div style="height: 170px; overflow: hidden; position: relative;">
                            @if($project->featured_image)
                                <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $project->featured_image)) }}" alt="{{ $project->name_en }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100" style="background: linear-gradient(135deg, #c5a028, #8b7019);">
                                    <i class="bi bi-folder-fill text-white fs-1"></i>
                                </div>
                            @endif
                            <div style="position: absolute; top: 15px; left: 15px;">
                                <span class="badge" style="background: linear-gradient(135deg, #c5a028, #8b7019); border-radius: 20px; font-size: 0.75rem; color: white;">
                                    {{ ucfirst(str_replace('_', ' ', $project->type)) }}
                                </span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h6 class="mb-2 fw-bold" style="color: #003A46; line-height: 1.3; font-size: 1rem;">
                                {{ Str::limit(app()->getLocale() === 'km' ? $project->name_km : $project->name_en, 35) }}
                            </h6>
                            <p class="text-muted mb-0" style="font-size: 0.85rem;">
                                <i class="bi bi-calendar3 me-1"></i> {{ $project->start_date ? $project->start_date->format('M Y') : 'Ongoing' }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="text-center w-100 py-5">
                <i class="bi bi-folder-x text-muted fs-1"></i>
                <p class="text-muted mt-2">{{ __('home.no_projects') }}</p>
            </div>
        @endforelse
    </div>
    
    <div class="container">
        <div class="d-flex gap-2 mt-4">
            <button class="carousel-nav-btn" type="button" onclick="scrollProjects(-1)">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button class="carousel-nav-btn" type="button" onclick="scrollProjects(1)">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<style>
.projects-carousel {
    display: flex;
    gap: 1.5rem;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 15px 24px;
    background: white;
    margin: 0;
    scrollbar-width: none;
    -ms-overflow-style: none;
}
.projects-carousel.loaded {
    opacity: 1;
}
.projects-carousel::-webkit-scrollbar {
    display: none;
}
.project-slide {
    flex-shrink: 0;
}
.project-card {
    cursor: pointer;
}
.project-card:hover {
    transform: translateY(-8px) !important;
    box-shadow: 0 15px 40px rgba(0,0,0,0.25) !important;
}
.project-card:hover img {
    transform: scale(1.08);
}
.carousel-nav-btn {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: white;
    border: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}
.carousel-nav-btn:hover {
    background: #f0f0f0;
    transform: scale(1.05);
}
.carousel-nav-btn i {
    font-size: 1.25rem;
    color: #003A46;
}
</style>

<script>
function adjustCarouselPadding() {
    const carousel = document.getElementById('projectsCarousel');
    const containerEl = document.querySelector('#projectsSection .container');
    const containerRect = containerEl.getBoundingClientRect();
    const viewportWidth = window.innerWidth;
    
    const offset = containerRect.left;
    carousel.style.paddingLeft = offset + 'px';
    carousel.style.paddingRight = (viewportWidth - containerRect.right) + 'px';
    
    carousel.classList.add('loaded');
}

window.addEventListener('load', adjustCarouselPadding);
window.addEventListener('resize', adjustCarouselPadding);
</script>

<script>
function scrollProjects(direction) {
    const carousel = document.getElementById('projectsCarousel');
    const cardWidth = 335;
    carousel.scrollBy({
        left: direction * cardWidth,
        behavior: 'smooth'
    });
}
</script>

<!-- Google Map Section -->
<section class="py-5" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3" style="color: #003A46;">
                {{ app()->getLocale() === 'km' ? 'ទីតាំងរបស់យើង' : 'Find Us' }}
            </h2>
            <p class="text-muted">
                {{ app()->getLocale() === 'km' ? 'មកទស្សនាផ្ទាល់ខ្លួន' : 'Visit us on campus' }}
            </p>
        </div>
        
        <div class="card border-0" style="border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3908.6812596237664!2d104.91609257559912!3d11.574692188626798!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951a778add227%3A0xa0b40866dad0697e!2sNUM%20International%20Program%20of%20Legal%20Studies%20-%20iLaw!5e0!3m2!1sen!2skh!4v1771953331847!5m2!1sen!2skh"
                width="100%" 
                height="400" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

<!-- Floating Apply Now Button -->
<style>
.floating-cta-wrapper {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 1000;
}

/* Pulse Ring Animation */
.floating-cta-pulse {
    position: absolute;
    width: 60px;
    height: 60px;
    background: rgba(0, 58, 70, 0.4);
    border-radius: 50%;
    animation: pulse-ring 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
    top: 0;
    left: 0;
}

@keyframes pulse-ring {
    0% {
        transform: scale(0.8);
        opacity: 1;
    }
    100% {
        transform: scale(2);
        opacity: 0;
    }
}

/* Main Button Animation */
.floating-cta {
    position: relative;
    background: linear-gradient(135deg, #003A46, #005f6b);
    color: white;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    box-shadow: 0 10px 30px rgba(0,58,70,0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s ease;
    animation: float-bounce 3s ease-in-out infinite;
}

@keyframes float-bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

/* Glow Effect */
.floating-cta::before {
    content: '';
    position: absolute;
    inset: -3px;
    background: linear-gradient(135deg, #00AACC, #003A46);
    border-radius: 50%;
    z-index: -1;
    opacity: 0.7;
    filter: blur(8px);
    animation: glow-pulse 2s ease-in-out infinite;
}

@keyframes glow-pulse {
    0%, 100% {
        opacity: 0.5;
        filter: blur(8px);
    }
    50% {
        opacity: 0.9;
        filter: blur(12px);
    }
}

/* Hover Effects */
.floating-cta:hover {
    transform: scale(1.15) translateY(-5px);
    box-shadow: 0 20px 50px rgba(0,58,70,0.6) !important;
}

.floating-cta:hover::before {
    opacity: 1;
    filter: blur(15px);
}

/* Icon Spin on Hover */
.floating-cta i {
    transition: transform 0.3s ease;
}

.floating-cta:hover i {
    transform: rotate(20deg) scale(1.1);
}

/* Mobile Version */
.floating-cta-mobile {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
    background: linear-gradient(135deg, #003A46, #005f6b);
    color: white;
    padding: 14px 28px;
    border-radius: 50px;
    box-shadow: 0 10px 30px rgba(0,58,70,0.4);
    text-decoration: none;
    font-weight: 600;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    gap: 8px;
    animation: float-bounce-mobile 3s ease-in-out infinite;
}

@keyframes float-bounce-mobile {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-8px);
    }
}

.floating-cta-mobile::before {
    content: '';
    position: absolute;
    inset: -3px;
    background: linear-gradient(135deg, #00AACC, #003A46);
    border-radius: 50px;
    z-index: -1;
    opacity: 0.5;
    filter: blur(6px);
    animation: glow-pulse-mobile 2s ease-in-out infinite;
}

@keyframes glow-pulse-mobile {
    0%, 100% {
        opacity: 0.4;
    }
    50% {
        opacity: 0.8;
    }
}

.floating-cta-mobile:hover {
    transform: scale(1.05) translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,58,70,0.5) !important;
    color: white;
}
</style>

<div class="floating-cta-wrapper d-none d-md-flex">
    <div class="floating-cta-pulse"></div>
    <a href="{{ route('public.admission.index') }}" class="floating-cta">
        <i class="bi bi-pencil-square" style="font-size: 1.5rem;"></i>
    </a>
</div>

<a href="{{ route('public.admission.index') }}" class="floating-cta-mobile d-md-none">
    <i class="bi bi-pencil-square"></i>
    <span>Apply Now</span>
</a>
@endsection
