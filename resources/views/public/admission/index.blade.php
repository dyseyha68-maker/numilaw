@extends('layouts.public')

@section('title', __('admission.title'))

@section('description', __('admission.description'))

@php
$heroImageUrl = $heroImage ? asset($heroImage) : 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&q=80';
$locale = app()->getLocale();
$baseUrl = 'https://ilaw.num.edu.kh/laravel/public';
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

// Key Dates Image
$datesImageFolder = public_path('images/admission-keyDate');
$datesImages = [];
if (is_dir($datesImageFolder)) {
    $files = scandir($datesImageFolder);
    foreach ($files as $file) {
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (in_array($ext, $allowedExtensions)) {
            $datesImages[] = $file;
        }
    }
    sort($datesImages);
}
$datesImageUrl = !empty($datesImages) ? $baseUrl . '/images/admission-keyDate/' . $datesImages[0] : 'https://images.unsplash.com/photo-1562774053-701939374585?w=800&q=80';

// Steps Images (3 images for 3 steps)
$stepsImageFolder = public_path('images/admission-application-process');
$stepsImages = [];
if (is_dir($stepsImageFolder)) {
    $files = scandir($stepsImageFolder);
    foreach ($files as $file) {
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (in_array($ext, $allowedExtensions)) {
            $stepsImages[] = $file;
        }
    }
    sort($stepsImages);
}
$step1Image = isset($stepsImages[0]) ? $baseUrl . '/images/admission-application-process/' . $stepsImages[0] : 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=600&q=80';
$step2Image = isset($stepsImages[1]) ? $baseUrl . '/images/admission-application-process/' . $stepsImages[1] : 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=600&q=80';
$step3Image = isset($stepsImages[2]) ? $baseUrl . '/images/admission-application-process/' . $stepsImages[2] : 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=600&q=80';
@endphp

@section('content')
<style>
    :root {
        --primary: #003A46;
        --primary-light: #005f6b;
        --primary-dark: #002830;
        --accent: #00AACC;
        --gold: #D4AF37;
        --gold-light: #F5E6A3;
    }
    .hero-gradient {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 50%, var(--accent) 100%);
        position: relative;
        overflow: hidden;
    }
    .hero-grid {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
        background-size: 60px 60px;
    }
    .hero-diagonal {
        position: absolute;
        top: 0; right: 0;
        width: 50%; height: 100%;
        background: linear-gradient(180deg, rgba(0,170,204,0.2) 0%, transparent 50%);
        clip-path: polygon(30% 0, 100% 0, 100% 100%, 0% 100%);
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
    }
    .hero-btn-primary {
        background: #fff;
        color: var(--primary);
        border: none;
        padding: 1rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    .hero-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        color: var(--primary);
    }
    .hero-btn-secondary {
        background: transparent;
        color: #fff;
        border: 2px solid rgba(255,255,255,0.5);
        padding: 1rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    .hero-btn-secondary:hover {
        background: rgba(255,255,255,0.1);
        border-color: #fff;
        color: #fff;
    }
    .hero-card {
        background: rgba(255,255,255,0.98);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 25px 50px rgba(0,0,0,0.25);
    }
    .hero-event-date {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #fff;
        margin-right: 1rem;
        flex-shrink: 0;
    }
    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        transition: all 0.4s ease;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    }
    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    .program-card {
        border: none;
        border-radius: 24px;
        padding: 2.5rem 2rem;
        text-align: center;
        transition: all 0.4s ease;
        background: white;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        height: 100%;
    }
    .program-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 60px rgba(0,0,0,0.15);
    }
    .timeline-card {
        background: #f8fafc;
        border-left: 4px solid var(--primary);
        transition: all 0.3s ease;
    }
    .timeline-card:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    .cta-section {
        background: var(--primary);
        position: relative;
        overflow: hidden;
    }
    .cta-glow {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: 
            radial-gradient(circle at 20% 80%, rgba(0,170,204,0.3) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 40%),
            radial-gradient(circle at 40% 40%, rgba(0,170,204,0.2) 0%, transparent 30%);
        pointer-events: none;
    }
    .accordion-custom .accordion-item {
        border: none;
        border-radius: 12px !important;
        margin-bottom: 1rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .accordion-custom .accordion-button {
        background: #fff;
        font-weight: 600;
        color: var(--primary);
        padding: 1.25rem 1.5rem;
    }
    .accordion-custom .accordion-button:not(.collapsed) {
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        color: #fff;
        box-shadow: none;
    }
    .accordion-custom .accordion-button::after {
        filter: invert(1);
    }
    .accordion-custom .accordion-button:not(.collapsed)::after {
        filter: invert(0);
    }
    .accordion-custom .accordion-body {
        padding: 1.5rem;
        color: #64748b;
        line-height: 1.7;
    }
    .section-header {
        position: relative;
        display: inline-block;
    }
    .section-header::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, var(--accent), var(--gold));
        border-radius: 2px;
    }
    .requirement-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        transition: all 0.4s ease;
        border: 2px solid transparent;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    }
    .requirement-card:hover {
        transform: translateY(-10px);
        border-color: var(--accent);
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    .requirement-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
    }
    .step-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        position: relative;
        transition: all 0.4s ease;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    }
    .step-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    .step-number {
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary), var(--accent));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        font-weight: 700;
        box-shadow: 0 5px 20px rgba(0,58,70,0.3);
    }
    .timeline-vertical {
        position: relative;
        padding-left: 40px;
    }
    .timeline-vertical::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(180deg, var(--primary) 0%, var(--accent) 100%);
    }
    .timeline-item {
        position: relative;
        padding-bottom: 2rem;
    }
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -33px;
        top: 5px;
        width: 20px;
        height: 20px;
        background: white;
        border: 4px solid var(--primary);
        border-radius: 50%;
    }
    .timeline-item.active::before {
        background: var(--accent);
        border-color: var(--accent);
    }
    .tuition-table {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    }
    .tuition-table thead {
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        color: white;
    }
    .tuition-table tbody tr {
        transition: all 0.3s ease;
    }
    .tuition-table tbody tr:hover {
        background: #f0f9ff;
    }
    .process-flow {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .process-step {
        flex: 1;
        min-width: 200px;
        text-align: center;
        position: relative;
    }
    .process-step::after {
        content: '';
        position: absolute;
        top: 40px;
        right: -50%;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--primary), var(--accent));
    }
    .process-step:last-child::after {
        display: none;
    }
    .process-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 2rem;
        box-shadow: 0 10px 30px rgba(0,58,70,0.3);
    }
    .slider-section {
        margin-top: 45px;
        padding: 0 !important;
        position: relative;
        width: 100vw;
        max-width: 100vw;
        margin-left: calc(-50vw + 50%);
        margin-right: calc(-50vw + 50%);
        overflow: hidden;
    }
    .slider-wrapper {
        position: relative;
        width: 100%;
        padding: 20px 20px 30px;
    }
    .slider-viewport {
        position: relative;
        width: 100%;
        overflow: visible;
        padding: 10px 0;
    }
    .slider-track {
        display: flex;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .slide {
        min-width: 70%;
        flex-shrink: 0;
        margin: 0 1.5%;
        opacity: 0.4;
        transform: scale(0.92);
        transition: all 0.5s ease;
        position: relative;
        z-index: 1;
    }
    .slide.active {
        opacity: 1;
        transform: scale(1);
        z-index: 10;
    }
    .slide.active:hover {
        box-shadow: none;
    }
    .slide-inner {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        height: 480px;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }
    @media (min-width: 768px) {
        .slide-inner {
            height: 520px;
        }
    }
    @media (min-width: 1200px) {
        .slide-inner {
            height: 560px;
        }
    }
    .slide.active:hover .slide-inner {
        transform: scale(1.02);
        box-shadow: 0 0 50px rgba(0, 58, 70, 0.5), 0 0 100px rgba(0, 170, 204, 0.3), 0 20px 60px rgba(0, 0, 0, 0.2);
    }
    .slide-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-size: cover;
        background-position: center;
        transition: transform 0.6s ease;
    }
    .slide.active:hover .slide-bg {
        transform: scale(1.08);
    }
    .slide-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(0, 58, 70, 0.88) 0%, rgba(0, 109, 119, 0.75) 50%, rgba(0, 168, 204, 0.6) 100%);
    }
    .slide-content {
        position: relative;
        z-index: 10;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        min-height: 480px;
        padding: 50px 60px;
    }
    @media (min-width: 768px) {
        .slide-content {
            min-height: 520px;
            padding: 60px 80px;
        }
    }
    @media (min-width: 1200px) {
        .slide-content {
            min-height: 560px;
        }
    }
    .slide-badge {
        display: inline-flex;
        align-items: center;
        background: rgba(0, 168, 204, 0.25);
        border: 1px solid rgba(0, 168, 204, 0.5);
        padding: 8px 20px;
        border-radius: 50px;
        color: #fff;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        margin-bottom: 20px;
    }
    .slide-title {
        font-size: 2rem;
        font-weight: 700;
        color: #fff;
        line-height: 1.2;
        margin-bottom: 16px;
        text-shadow: 0 4px 25px rgba(0,0,0,0.3);
    }
    @media (min-width: 768px) {
        .slide-title {
            font-size: 2.5rem;
        }
    }
    @media (min-width: 1200px) {
        .slide-title {
            font-size: 3rem;
        }
    }
    .slide-desc {
        font-size: 1rem;
        color: rgba(255,255,255,0.9);
        margin-bottom: 28px;
        max-width: 550px;
        line-height: 1.7;
    }
    @media (min-width: 768px) {
        .slide-desc {
            font-size: 1.1rem;
        }
    }
    .slide-cta {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #fff;
        color: #003A46;
        padding: 14px 32px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 8px 30px rgba(0,0,0,0.2);
    }
    .slide-cta:hover {
        background: #00AACC;
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.3);
    }
    .carousel-controls {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 10px;
    }
    .carousel-nav-group {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #fff;
        padding: 8px 16px;
        border-radius: 50px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .carousel-nav {
        width: auto;
        height: auto;
        background: transparent;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 4px;
    }
    .carousel-nav:hover {
        opacity: 0.7;
    }
    .carousel-nav svg {
        width: 20px;
        height: 20px;
    }
    .carousel-nav svg path {
        fill: #003A46;
    }
    .slide-counter {
        padding: 0 12px;
        font-size: 0.9rem;
        color: #64748b;
        font-weight: 500;
    }
</style>

<section class="slider-section">
    <div class="slider-wrapper">
        <div class="slider-viewport">
            <div class="slider-track" id="sliderTrack">
                @php
                $baseUrl = 'https://ilaw.num.edu.kh/laravel/public';
                $imageFolder = public_path('images/admission-slides');
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $images = [];
                
                if (is_dir($imageFolder)) {
                    $files = scandir($imageFolder);
                    foreach ($files as $file) {
                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        if (in_array($ext, $allowedExtensions)) {
                            $images[] = $file;
                        }
                    }
                    sort($images);
                }
                
                $totalImages = count($images);
                
                // Clone last image at beginning
                if ($totalImages > 0) {
                    echo '<div class="slide" data-index="0" data-clone="last">
                        <div class="slide-inner">
                            <div class="slide-bg" style="background-image: url(\'' . $baseUrl . '/images/admission-slides/' . $images[$totalImages - 1] . '\');"></div>
                        </div>
                    </div>';
                }
                
                // Real slides
                foreach ($images as $index => $image) {
                    $isActive = $index === 0 ? 'active' : '';
                    echo '<div class="slide ' . $isActive . '" data-index="' . $index . '" data-real="true">
                        <div class="slide-inner">
                            <div class="slide-bg" style="background-image: url(\'' . $baseUrl . '/images/admission-slides/' . $image . '\');"></div>
                        </div>
                    </div>';
                }
                
                // Clone first image at end
                if ($totalImages > 0) {
                    echo '<div class="slide" data-index="0" data-clone="first">
                        <div class="slide-inner">
                            <div class="slide-bg" style="background-image: url(\'' . $baseUrl . '/images/admission-slides/' . $images[0] . '\');"></div>
                        </div>
                    </div>';
                }
                @endphp
            </div>
        </div>
        
        <div class="carousel-controls">
            <div class="carousel-nav-group">
                <button class="carousel-nav" id="sliderPrev">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
                </button>
                <span class="slide-counter" id="slideCounter">1 / {{ $totalImages ?? 0 }}</span>
                <button class="carousel-nav" id="sliderNext">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                </button>
            </div>
        </div>
    </div>
</section>

<script>
(function() {
    var track = document.getElementById('sliderTrack');
    if (!track) return;
    
    var prevBtn = document.getElementById('sliderPrev');
    var nextBtn = document.getElementById('sliderNext');
    var counter = document.getElementById('slideCounter');
    
    var realSlides = track.querySelectorAll('.slide[data-real="true"]');
    var totalSlides = realSlides.length;
    var currentPos = 1;
    var isAnimating = false;
    
    function goTo(pos, animate, instantReset) {
        currentPos = pos;
        var allSlides = track.querySelectorAll('.slide');
        
        if (animate === false) {
            track.style.transition = 'none';
            track.style.transform = 'translateX(' + ((100 - 70) / 2 - pos * (70 + 3)) + '%)';
            
            if (instantReset) {
                allSlides.forEach(function(s) {
                    s.classList.remove('active');
                    s.style.opacity = '0.4';
                    s.style.transform = 'scale(0.92)';
                });
                
                var realSlide = track.querySelector('.slide[data-real="true"][data-index="' + (pos - 1) + '"]');
                if (realSlide) {
                    realSlide.classList.add('active');
                    realSlide.style.opacity = '1';
                    realSlide.style.transform = 'scale(1)';
                }
            }
        } else {
            track.style.transition = 'transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            track.style.transform = 'translateX(' + ((100 - 70) / 2 - pos * (70 + 3)) + '%)';
            
            allSlides.forEach(function(s) { s.classList.remove('active'); });
            allSlides.forEach(function(s) {
                s.style.opacity = '';
                s.style.transform = '';
            });
            
            var displayPos = currentPos;
            if (currentPos > totalSlides) displayPos = 1;
            if (currentPos < 1) displayPos = totalSlides;
            
            var realIndex = displayPos - 1;
            var realSlide = track.querySelector('.slide[data-real="true"][data-index="' + realIndex + '"]');
            if (realSlide) { realSlide.classList.add('active'); }
            
            if (counter) {
                counter.textContent = displayPos + ' / ' + totalSlides;
            }
        }
    }
    
    function nextSlide() {
        if (isAnimating) return;
        isAnimating = true;
        currentPos++;
        goTo(currentPos, true);
        
        setTimeout(function() {
            if (currentPos > totalSlides) {
                currentPos = 1;
                goTo(currentPos, false, true);
                if (counter) { counter.textContent = '1 / ' + totalSlides; }
            }
            isAnimating = false;
        }, 650);
    }
    
    function prevSlide() {
        if (isAnimating) return;
        isAnimating = true;
        currentPos--;
        goTo(currentPos, true);
        
        setTimeout(function() {
            if (currentPos < 1) {
                currentPos = totalSlides;
                goTo(currentPos, false, true);
                if (counter) { counter.textContent = totalSlides + ' / ' + totalSlides; }
            }
            isAnimating = false;
        }, 650);
    }
    
    prevBtn.addEventListener('click', prevSlide);
    nextBtn.addEventListener('click', nextSlide);
    
    var autoPlay = setInterval(nextSlide, 5000);
    
    var wrapper = document.querySelector('.slider-section');
    wrapper.addEventListener('mouseenter', function() { clearInterval(autoPlay); });
    wrapper.addEventListener('mouseleave', function() { autoPlay = setInterval(nextSlide, 5000); });
    
    goTo(1, false);
})();
</script>

<!-- Key Dates Timeline Section -->
<section id="dates" class="py-5" style="background: transparent;">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="display-5 fw-bold mb-3" style="color: #003A46;">
                {{ __('admission.mark_key_dates') }}
            </h2>
            <p class="text-muted" style="max-width: 700px; margin: 0 auto; font-size: 1rem; line-height: 1.8;">
                {{ $locale === 'km' 
                    ? 'ចូលរួមជាមួយ NUM iLaw និងក្លាយជាផ្នែកមួយនៃគ្រឹះស្ថានច្បាប់ល្អបំផុតនៅកម្ពុជា។ កម្មវិធីសិក្សាទំនើប ភាពជាដៃគូអន្តរជាតិ និងគ្រូឧត្តមធិការនឹងរៀបចំអ្នកសម្រាប់ភាពជោគជ័យក្នុងវិជ្ជាច្បាប់។ ការទទួលពាក្យសម្រាប់ឆ្នាំ 2026 បានបើកហើយ!'
                    : 'Join NUM iLaw and become part of Cambodia\'s premier law institution. Our innovative curriculum, international partnerships, and expert faculty prepare you for success in the legal profession. Applications for 2026 are now open!' }}
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-pill" style="background: rgba(0, 170, 204, 0.1); border: 1px solid rgba(0, 170, 204, 0.3);">
                    <i class="bi bi-award" style="color: #00AACC;"></i>
                    <span style="color: #003A46; font-size: 0.85rem; font-weight: 500;">{{ $locale === 'km' ? 'សញ្ញាបត្រទទួលស្គាល់អន្តរជាតិ' : 'Internationally Recognized' }}</span>
                </div>
                <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-pill" style="background: rgba(0, 170, 204, 0.1); border: 1px solid rgba(0, 170, 204, 0.3);">
                    <i class="bi bi-globe" style="color: #00AACC;"></i>
                    <span style="color: #003A46; font-size: 0.85rem; font-weight: 500;">{{ $locale === 'km' ? 'កេទ្វេអន្តរជាតិ' : 'International Exchange' }}</span>
                </div>
                <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-pill" style="background: rgba(0, 170, 204, 0.1); border: 1px solid rgba(0, 170, 204, 0.3);">
                    <i class="bi bi-briefcase" style="color: #00AACC;"></i>
                    <span style="color: #003A46; font-size: 0.85rem; font-weight: 500;">{{ $locale === 'km' ? 'ផ្តោតលើអាជីព' : 'Career Focused' }}</span>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="p-3" style="background: white; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                    <div class="row g-3">
                        <div class="col-lg-5">
                            <div class="h-100 rounded-4 overflow-hidden position-relative" style="min-height: 180px;">
                                <img src="{{ $datesImageUrl }}" alt="Key Dates" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="h-100" style="min-height: 180px;">
                                <div class="d-flex flex-column justify-content-between h-100 gap-2">
                                    @foreach($importantDates as $index => $date)
                                    <div class="p-3 bg-white rounded-3" style="box-shadow: 0 2px 10px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; flex: 1;">
                                        <div class="d-flex align-items-center h-100">
                                            <div class="flex-shrink-0 me-3" style="width: 40px; height: 40px; border-radius: 8px; background: linear-gradient(135deg, {{ $date['is_upcoming'] ? '#00AACC' : '#10b981' }}, {{ $date['is_upcoming'] ? '#0088aa' : '#059669' }}); display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-calendar3" style="color: white; font-size: 1rem;"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold mb-0" style="color: #003A46; font-size: 0.9rem;">
                                                    {{ $locale === 'km' ? $date['title_km'] : $date['title_en'] }}
                                                </h6>
                                                <p class="text-muted mb-0" style="font-size: 0.8rem;">
                                                    {{ \Carbon\Carbon::parse($date['date'])->format('F j, Y') }}
                                                </p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <span class="px-2 py-1 rounded-pill" style="background: {{ $date['is_upcoming'] ? '#e0f2fe' : '#dcfce7' }}; color: {{ $date['is_upcoming'] ? '#00AACC' : '#10b981' }}; font-size: 0.7rem; font-weight: 600;">
                                                    {{ $date['is_upcoming'] ? ($locale === 'km' ? 'នាពេល' : 'Upcoming') : ($locale === 'km' ? 'បើក' : 'Open') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How to Apply Section -->
<section id="apply" class="py-5" style="background: transparent;">
    <div class="container">
        <div class="text-center mb-5">
            <div class="d-inline-flex align-items-center gap-2 px-4 py-2 mb-3" style="background: white; border-radius: 50px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border: 1px solid #e2e8f0;">
                <i class="bi bi-pencil-square" style="color: #003A46;"></i>
                <span style="color: #003A46; font-weight: 600; font-size: 0.875rem;">{{ __('admission.how_to_apply') }}</span>
            </div>
            <h2 class="display-5 fw-bold mb-3" style="color: #003A46;">
                {{ $locale === 'km' ? 'របៀបដាក់ពាក្យ' : 'Application Process' }}
            </h2>
            <p class="text-muted" style="max-width: 600px; margin: 0 auto; font-size: 1.1rem;">
                {{ $locale === 'km' ? 'ជំហ៊ានៗដើម្បីដាក់ពាក្យ' : 'Follow these simple steps to submit your application' }}
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-11">
                <div class="row g-4">
                    <!-- Step 1 -->
                    <div class="col-md-4">
                        <div class="h-100 bg-white" style="border-radius: 25px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                            <div style="height: 280px; overflow: hidden; position: relative; padding: 10px;">
                                <img src="{{ $step1Image }}" alt="Fill Application" style="width: 100%; height: 100%; object-fit: cover; border-radius: 25px;">
                                <div style="position: absolute; top: 25px; left: 25px; width: 40px; height: 40px; border-radius: 50%; background: #003A46; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;">1</div>
                            </div>
                            <div class="p-4">
                                <h5 class="fw-bold mb-2" style="color: #003A46;">{{ $locale === 'km' ? 'បំពេញពាក្យ' : 'Fill Application' }}</h5>
                                <p class="text-muted mb-0" style="line-height: 1.6; font-size: 0.9rem;">
                                    {{ $locale === 'km' ? 'បំពេញពាក្យចូលរៀនតាមអ៊ីនធឺណិត ជាមួយព័ត៌មានផាសុខុន និងឯកសារចាំបាច់ ។' : 'Complete our online application form with your personal details and required documents.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Step 2 -->
                    <div class="col-md-4">
                        <div class="h-100 bg-white" style="border-radius: 25px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                            <div style="height: 280px; overflow: hidden; position: relative; padding: 10px;">
                                <img src="{{ $step2Image }}" alt="Entrance Exam & Interview" style="width: 100%; height: 100%; object-fit: cover; border-radius: 25px;">
                                <div style="position: absolute; top: 25px; left: 25px; width: 40px; height: 40px; border-radius: 50%; background: #00AACC; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;">2</div>
                            </div>
                            <div class="p-4">
                                <h5 class="fw-bold mb-2" style="color: #003A46;">{{ $locale === 'km' ? 'ប្រឡង & សម្ភាស' : 'Entrance Exam & Interview' }}</h5>
                                <p class="text-muted mb-0" style="line-height: 1.6; font-size: 0.9rem;">
                                    {{ $locale === 'km' ? 'ចូលរួមប្រឡង និងសម្ភាសជាមួយគ្រូឧត្តមធិការ ដើម្បីវាយតម្លៃសមត្ថភាព ។' : 'Take the entrance exam and interview with our faculty to assess your readiness.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Step 3 -->
                    <div class="col-md-4">
                        <div class="h-100 bg-white" style="border-radius: 25px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                            <div style="height: 280px; overflow: hidden; position: relative; padding: 10px;">
                                <img src="{{ $step3Image }}" alt="Pay Tuition & Fees" style="width: 100%; height: 100%; object-fit: cover; border-radius: 25px;">
                                <div style="position: absolute; top: 25px; left: 25px; width: 40px; height: 40px; border-radius: 50%; background: #D4AF37; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;">3</div>
                            </div>
                            <div class="p-4">
                                <h5 class="fw-bold mb-2" style="color: #003A46;">{{ $locale === 'km' ? 'បង់' : 'Pay Tuition & Fees' }}</h5>
                                <p class="text-muted mb-0" style="line-height: 1.6; font-size: 0.9rem;">
                                    {{ $locale === 'km' ? 'បង់ថ្លៃសិក្សា និងទទួលបានការបញ្ជាក់ ។' : 'Pay your tuition and fees securely to confirm your enrollment.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Admission Requirements Section -->
<section id="requirements" class="py-4" style="background: transparent;">
    <div class="container">
        <div class="text-center mb-3">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-2" style="background: white; border-radius: 50px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border: 1px solid #e2e8f0;">
                <i class="bi bi-clipboard-check" style="color: #003A46;"></i>
                <span style="color: #003A46; font-weight: 600; font-size: 0.75rem;">{{ $locale === 'km' ? 'តម្រូវការចូល' : 'Admission Requirements' }}</span>
            </div>
            
            </div>

        <!-- Tab Navigation -->
        <div class="container mb-4">
            <div class="row justify-content-center">
                <div class="col-lg-auto">
                    <ul class="nav nav-pills gap-2" id="requirementsTab" role="tablist" style="background: #f1f5f9; padding: 8px 16px; border-radius: 50px; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active px-4 py-2 rounded-pill" id="academic-tab" data-bs-toggle="pill" data-bs-target="#academic" type="button" role="tab" style="font-weight: 500; background: #003A46; color: white; cursor: pointer; transition: all 0.3s ease;">
                                <i class="bi bi-mortarboard me-2"></i>{{ $locale === 'km' ? 'កេទ្វេ' : 'Academic' }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-4 py-2 rounded-pill" id="english-tab" data-bs-toggle="pill" data-bs-target="#english" type="button" role="tab" style="font-weight: 500; color: #64748b; background: transparent; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.background='#003A46';this.style.color='white'" onmouseout="this.style.background='transparent';this.style.color='#64748b'">
                                <i class="bi bi-translate me-2"></i>{{ $locale === 'km' ? 'ភាសា' : 'English' }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-4 py-2 rounded-pill" id="personal-tab" data-bs-toggle="pill" data-bs-target="#personal" type="button" role="tab" style="font-weight: 500; color: #64748b; background: transparent; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.background='#003A46';this.style.color='white'" onmouseout="this.style.background='transparent';this.style.color='#64748b'">
                                <i class="bi bi-file-earmark-text me-2"></i>{{ $locale === 'km' ? 'ឯកសារ' : 'Personal' }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-4 py-2 rounded-pill" id="additional-tab" data-bs-toggle="pill" data-bs-target="#additional" type="button" role="tab" style="font-weight: 500; color: #64748b; background: transparent; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.background='#003A46';this.style.color='white'" onmouseout="this.style.background='transparent';this.style.color='#64748b'">
                                <i class="bi bi-plus-circle me-2"></i>{{ $locale === 'km' ? 'បន្ថែម' : 'Additional' }}
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Tab Content -->
        <div class="row">
            <div class="col-12">
                <div class="tab-content" id="requirementsTabContent">
                    <!-- Academic Tab -->
                    <div class="tab-pane fade show active" id="academic" role="tabpanel">
                        <div class="p-3" style="background: white; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                            <div class="row g-0">
                                <div class="col-lg-6 p-4">
                                    <h4 class="fw-bold mb-4" style="color: #003A46;">
                                        <i class="bi bi-mortarboard me-2" style="color: #003A46;"></i>
                                        {{ $locale === 'km' ? 'កេទ្វេ' : 'Academic Background' }}
                                    </h4>
                                    <p class="text-muted mb-4" style="line-height: 1.8;">
                                        {{ $locale === 'km' ? 'បេសកកម្មរបស់យើងគឺផ្តល់ការអប់រំដែលមានគុណភាពខ្ពស់ ។ យើងទាមទារឱ្យបេក្ខជនមាន ប្រវត្តិសិក្សាគ្រប់គ្រាប់ ។' : 'We are committed to providing quality education. Applicants must meet the following academic criteria to be considered for admission.' }}
                                    </p>
                                    <div class="d-flex flex-column gap-3">
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background: #f8fafc;">
                                            <div class="me-3" style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #003A46, #005f6b); display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-award text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0" style="color: #003A46; font-size: 0.95rem;">{{ $locale === 'km' ? 'សញ្ញាបត្រមធ្យម' : 'High School Diploma' }}</h6>
                                                <p class="mb-0 text-muted" style="font-size: 0.8rem;">{{ $locale === 'km' ? 'បញ្ចប់ថ្នាក់ទី12' : 'Completed Grade 12 or equivalent' }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background: #f8fafc;">
                                            <div class="me-3" style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #003A46, #005f6b); display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-graph-up-arrow text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0" style="color: #003A46; font-size: 0.95rem;">{{ $locale === 'km' ? 'មេគុណ GPA' : 'Minimum GPA 2.5/4.0' }}</h6>
                                                <p class="mb-0 text-muted" style="font-size: 0.8rem;">{{ $locale === 'km' ? 'ពិន្ទុមេគុណតិចបំផុត' : 'Minimum grade point average' }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background: #f8fafc;">
                                            <div class="me-3" style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #003A46, #005f6b); display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-file-earmark-text text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0" style="color: #003A46; font-size: 0.95rem;">{{ $locale === 'km' ? 'ប្រវត្តិសិក្សា' : 'Academic Transcripts' }}</h6>
                                                <p class="mb-0 text-muted" style="font-size: 0.8rem;">{{ $locale === 'km' ? 'ប្រវត្តិសិក្សាផ្លូវការ' : 'Official academic records' }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background: #f8fafc;">
                                            <div class="me-3" style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #003A46, #005f6b); display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-person-badge text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0" style="color: #003A46; font-size: 0.95rem;">{{ $locale === 'km' ? 'បណ្ណាចារ្យ' : 'Teacher Recommendation' }}</h6>
                                                <p class="mb-0 text-muted" style="font-size: 0.8rem;">{{ $locale === 'km' ? 'លិខិតណែនាំពីគ្រូ' : 'Letter from your teacher' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="h-100" style="min-height: 400px;">
                                        <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=800&q=80" alt="Academic" class="w-100 h-100" style="object-fit: cover; border-radius: 20px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- English Tab -->
                    <div class="tab-pane fade" id="english" role="tabpanel">
                        <div class="p-3" style="background: white; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                            <div class="row g-0">
                                <div class="col-lg-6 p-4">
                                    <h4 class="fw-bold mb-4" style="color: #003A46;">
                                        <i class="bi bi-translate me-2" style="color: #00AACC;"></i>
                                        {{ $locale === 'km' ? 'ភាសាអង់គ្លេស' : 'English Proficiency' }}
                                    </h4>
                                    <p class="text-muted mb-4" style="line-height: 1.8;">
                                        {{ $locale === 'km' ? 'ភាសាអង់គ្លេសគឺជាមេត្រេះដែលសំខាន់សម្រាប់ការសិក្សា ។ យើងទាមទារឱ្យបេក្ខជនបង្ហាញ សមត្ថភាពភាសា ។' : 'English is the primary language of instruction. Applicants must demonstrate proficiency in English to succeed in their studies.' }}
                                    </p>
                                    <div class="d-flex flex-column gap-3">
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background: #f0f9ff;">
                                            <div class="me-3" style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #00AACC, #0088aa); display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-lightbulb text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0" style="color: #003A46; font-size: 0.95rem;">IELTS 5.5+</h6>
                                                <p class="mb-0 text-muted" style="font-size: 0.8rem;">{{ $locale === 'km' ? 'ពិន្ទុតិចបំផុត5.5' : 'Minimum score 5.5' }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background: #f0f9ff;">
                                            <div class="me-3" style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #00AACC, #0088aa); display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-pc-display text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0" style="color: #003A46; font-size: 0.95rem;">TOEFL 70+</h6>
                                                <p class="mb-0 text-muted" style="font-size: 0.8rem;">{{ $locale === 'km' ? 'ពិន្ទុ70+' : 'Internet-based score 70+' }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background: #f0f9ff;">
                                            <div class="me-3" style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #00AACC, #0088aa); display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-book text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0" style="color: #003A46; font-size: 0.95rem;">Cambridge FCE</h6>
                                                <p class="mb-0 text-muted" style="font-size: 0.8rem;">{{ $locale === 'km' ? 'Cambridge First Certificate' : 'First Certificate in English' }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background: #f0f9ff;">
                                            <div class="me-3" style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #00AACC, #0088aa); display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-check2-circle text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0" style="color: #003A46; font-size: 0.95rem;">{{ $locale === 'km' ? ' ឬ ស evel ស equivalent' : 'Or equivalent' }}</h6>
                                                <p class="mb-0 text-muted" style="font-size: 0.8rem;">{{ $locale === 'km' ? 'វិញ្ញាបត្រមួយផ្សេង' : 'Other accepted certifications' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="h-100" style="min-height: 400px;">
                                        <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=800&q=80" alt="English" class="w-100 h-100" style="object-fit: cover; border-radius: 20px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Documents Tab -->
                    <div class="tab-pane fade" id="personal" role="tabpanel">
                        <div class="p-3" style="background: white; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                            <div class="row g-0">
                                <div class="col-lg-6 p-4">
                                    <h4 class="fw-bold mb-4" style="color: #003A46;">
                                        <i class="bi bi-file-earmark-text me-2" style="color: #D4AF37;"></i>
                                        {{ $locale === 'km' ? 'ឯកសារផ្ទាល់' : 'Personal Documents' }}
                                    </h4>
                                    <p class="text-muted mb-4" style="line-height: 1.8;">
                                        {{ $locale === 'km' ? 'ត្រូវការឯកសារផ្ទាល់ដើម្បីបញ្ជាក់អត្តសញ្ញាណ និងស្ថានភាពគូរ ។' : 'Personal identification documents are required to verify your identity and eligibility for admission.' }}
                                    </p>
                                    <div class="d-flex flex-column gap-3">
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background: #fffbeb;">
                                            <div class="me-3" style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #D4AF37, #b8962e); display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-person-circle text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0" style="color: #003A46; font-size: 0.95rem;">{{ $locale === 'km' ? 'រូបថត' : 'Passport-sized Photo' }}</h6>
                                                <p class="mb-0 text-muted" style="font-size: 0.8rem;">{{ $locale === 'km' ? 'រូប3x4 ស គ្មាន មេត្រេះ' : '3x4 cm, white background' }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background: #fffbeb;">
                                            <div class="me-3" style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #D4AF37, #b8962e); display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-file-earmark-person text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0" style="color: #003A46; font-size: 0.95rem;">{{ $locale === 'km' ? 'ប្រវត្តិស្នា' : 'Birth Certificate' }}</h6>
                                                <p class="mb-0 text-muted" style="font-size: 0.8rem;">{{ $locale === 'km' ? 'ប្រវត្តិស្នា ផ្លូវការ' : 'Official birth certificate' }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background: #fffbeb;">
                                            <div class="me-3" style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #D4AF37, #b8962e); display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-card-heading text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0" style="color: #003A46; font-size: 0.95rem;">{{ $locale === 'km' ? 'ប័ណ្ណសមាជិក' : 'National ID/Passport' }}</h6>
                                                <p class="mb-0 text-muted" style="font-size: 0.8rem;">{{ $locale === 'km' ? 'ប័ណ្ណបាន ឬ លេខប៉ាស្ប៉ត' : 'Valid ID or passport number' }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background: #fffbeb;">
                                            <div class="me-3" style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #D4AF37, #b8962e); display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-shield-check text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0" style="color: #003A46; font-size: 0.95rem;">{{ $locale === 'km' ? 'លិខិតបញ្ជាក់' : 'Police Clearance' }}</h6>
                                                <p class="mb-0 text-muted" style="font-size: 0.8rem;">{{ $locale === 'km' ? 'លិខិតពីបេតុង' : 'Certificate from authorities' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="h-100" style="min-height: 400px;">
                                        <img src="https://images.unsplash.com/photo-1562774053-701939374585?w=800&q=80" alt="Personal" class="w-100 h-100" style="object-fit: cover; border-radius: 20px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Tab -->
                    <div class="tab-pane fade" id="additional" role="tabpanel">
                        <div class="p-3" style="background: white; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                            <div class="row g-0">
                                <div class="col-lg-6 p-4">
                                    <h4 class="fw-bold mb-4" style="color: #003A46;">
                                        <i class="bi bi-plus-circle me-2" style="color: #10b981;"></i>
                                        {{ $locale === 'km' ? 'ឯកសារបន្ថែម' : 'Additional Items' }}
                                    </h4>
                                    <p class="text-muted mb-4" style="line-height: 1.8;">
                                        {{ $locale === 'km' ? 'ឯកសារបន្ថែមទាំងនេះនឹងជួយឱ្យយើងយល់កាន់តែច្បាស់ អំពីបេក្ខជន ។' : 'These additional documents help us better understand your application and qualifications.' }}
                                    </p>
                                    <div class="d-flex flex-column gap-3">
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background: #ecfdf5;">
                                            <div class="me-3" style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #10b981, #059669); display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-file-earmark-ruled text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0" style="color: #003A46; font-size: 0.95rem;">{{ $locale === 'km' ? 'ពាក្យចូល' : 'Completed Application Form' }}</h6>
                                                <p class="mb-0 text-muted" style="font-size: 0.8rem;">{{ $locale === 'km' ? 'បំពេញពេញ' : 'Fully completed form' }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background: #ecfdf5;">
                                            <div class="me-3" style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #10b981, #059669); display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-envelope text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0" style="color: #003A46; font-size: 0.95rem;">{{ $locale === 'km' ? 'លិខិតមេត្តា' : 'Motivation Letter' }}</h6>
                                                <p class="mb-0 text-muted" style="font-size: 0.8rem;">{{ $locale === 'km' ? 'លិខិត1-2 ទំព័រ' : '1-2 pages explaining your goals' }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background: #ecfdf5;">
                                            <div class="me-3" style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #10b981, #059669); display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-file-earmark-person text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0" style="color: #003A46; font-size: 0.95rem;">{{ $locale === 'km' ? 'CV / ប្រវត្តិរូប' : 'Updated CV/Resume' }}</h6>
                                                <p class="mb-0 text-muted" style="font-size: 0.8rem;">{{ $locale === 'km' ? 'ប្រវត្តិការងារ' : 'Work experience & achievements' }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center p-3 rounded-3" style="background: #ecfdf5;">
                                            <div class="me-3" style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #10b981, #059669); display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-currency-dollar text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0" style="color: #003A46; font-size: 0.95rem;">{{ $locale === 'km' ? 'ថ្លៃ$50' : 'Application Fee ($50)' }}</h6>
                                                <p class="mb-0 text-muted" style="font-size: 0.8rem;">{{ $locale === 'km' ? 'បង់តាមអ៊ីនធឺណិត' : 'Pay online securely' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="h-100" style="min-height: 400px;">
                                        <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=800&q=80" alt="Additional" class="w-100 h-100" style="object-fit: cover; border-radius: 20px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Admission Office Section -->
<style>
.admission-contact-card {
    background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(248,250,252,0.85) 100%);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(0, 58, 70, 0.1);
    border-radius: 24px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 20px rgba(0, 58, 70, 0.08);
}
.admission-contact-card:hover {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    backdrop-filter: blur(30px);
    box-shadow: 0 20px 50px rgba(0, 58, 70, 0.15);
    transform: translateY(-5px);
}
.contact-info-item {
    background: rgba(0, 58, 70, 0.03);
    border-radius: 16px;
    padding: 16px 20px;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}
.contact-info-item:hover {
    background: white;
    border-color: rgba(0, 58, 70, 0.1);
    box-shadow: 0 4px 15px rgba(0, 58, 70, 0.08);
}
</style>
<section class="py-5" style="background: transparent;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="admission-contact-card p-4 p-md-5">
                    <div class="row align-items-center">
                        <div class="col-lg-7">
                            <div class="d-flex align-items-center mb-4">
                                <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #003A46, #005f6b); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-building" style="color: white; font-size: 1.5rem;"></i>
                                </div>
                                <div class="ms-3">
                                    <h4 class="fw-bold mb-0" style="color: #003A46;">Admission Office</h4>
                                    <p class="mb-0 text-muted" style="font-size: 0.9rem;">We're here to help you</p>
                                </div>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="contact-info-item">
                                        <p class="mb-1 text-muted" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Phone</p>
                                        <p class="mb-0 fw-bold" style="color: #003A46; font-size: 0.95rem;">+855 23 888 888</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-info-item">
                                        <p class="mb-1 text-muted" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Email</p>
                                        <p class="mb-0 fw-bold" style="color: #003A46; font-size: 0.95rem;">admission@numilaw.edu.kh</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-info-item">
                                        <p class="mb-1 text-muted" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Location</p>
                                        <p class="mb-0 fw-bold" style="color: #003A46; font-size: 0.95rem;">NUM, Phnom Penh</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-info-item">
                                        <p class="mb-1 text-muted" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Hours</p>
                                        <p class="mb-0 fw-bold" style="color: #003A46; font-size: 0.95rem;">Mon - Fri: 8AM - 5PM</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 text-lg-end mt-4 mt-lg-0">
                            <div style="background: linear-gradient(135deg, #003A46, #005f6b); border-radius: 20px; padding: 30px; color: white;">
                                <h5 class="fw-bold mb-2">Have Questions?</h5>
                                <p class="mb-3" style="font-size: 0.9rem; opacity: 0.9;">Our team is ready to assist you with any inquiries about admissions.</p>
                                <a href="#" class="btn w-100" style="background: white; color: #003A46; padding: 14px 24px; border-radius: 50px; font-weight: 600;">
                                    <i class="bi bi-chat-dots me-2"></i>Chat with Us
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const hash = window.location.hash;
    if (hash) {
        const element = document.querySelector(hash);
        if (element) {
            element.scrollIntoView({ behavior: 'smooth' });
        }
    }
});
</script>
@endpush
@endsection
