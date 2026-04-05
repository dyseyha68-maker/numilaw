<!-- Hero Slideshow Component -->
<?php
    $slides = \App\Models\HeroSlide::getSlidesForPage($pageKey);
$settings = \App\Models\HeroSettings::getSettingsForPage($pageKey);

$height = $settings?->height ?? ($height ?? '70vh');
$autoplay = $settings?->slideshow_autoplay ?? ($autoplay ?? true);
$interval = $settings?->slideshow_interval ?? ($interval ?? 5000);
$navigation = $settings?->slideshow_navigation ?? ($navigation ?? true);
$pagination = $settings?->slideshow_pagination ?? ($pagination ?? true);

$themeColors = [
    'burgundy' => ['primary' => '#003A46', 'secondary' => '#C5A028', 'text' => '#FFFFFF', 'bg' => 'linear-gradient(135deg, #003A46 0%, #002830 100%)'],
    'gold' => ['primary' => '#C5A028', 'secondary' => '#003A46', 'text' => '#2C2C2C', 'bg' => 'linear-gradient(135deg, #C5A028 0%, #a88620 100%)'],
    'cream' => ['primary' => '#F5F0E6', 'secondary' => '#003A46', 'text' => '#2C2C2C', 'bg' => 'linear-gradient(135deg, #F5F0E6 0%, #e8e0d0 100%)'],
    'dark' => ['primary' => '#2C2C2C', 'secondary' => '#C5A028', 'text' => '#FFFFFF', 'bg' => 'linear-gradient(135deg, #2C2C2C 0%, #1a1a1a 100%)'],
    'gradient' => ['primary' => '#003A46', 'secondary' => '#C5A028', 'text' => '#FFFFFF', 'bg' => 'linear-gradient(135deg, #003A46 0%, #002830 50%, #001a20 100%)'],
];

$overlayOpacities = [
    'none' => '0',
    'light' => '0.2',
    'medium' => '0.4',
    'heavy' => '0.6',
];

$animationClasses = [
    'fade' => 'fade-in',
    'slide-left' => 'slide-in-left',
    'slide-right' => 'slide-in-right',
    'slide-up' => 'slide-in-up',
    'slide-down' => 'slide-in-down',
    'zoom' => 'zoom-in',
    'zoom-out' => 'zoom-out',
];

$uniqueId = 'hero-slideshow-'.uniqid();
?>

<style>
        .hero-slideshow {
            position: relative;
            height: {{ $height }};
            min-height: 500px;
            overflow: hidden;
            background: #003A46;
            z-index: 1;
        }
        
        .hero-slideshow .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.8s ease, visibility 0.8s ease;
            z-index: 1;
        }
    
    .hero-slideshow .slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.8s ease, visibility 0.8s ease;
    }
    
    .hero-slideshow .slide.active {
        opacity: 1;
        visibility: visible;
    }
    
    .hero-slideshow .slide-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .hero-slideshow .slide-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        }
        
        .hero-slideshow {
            position: relative;
            height: {{ $height }};
            min-height: 500px;
            overflow: hidden;
            background: #003A46;
        }
    
    .hero-slideshow .slide-content-left { justify-content: flex-start; }
    .hero-slideshow .slide-content-center { justify-content: center; text-align: center; }
    .hero-slideshow .slide-content-right { justify-content: flex-end; text-align: right; }
    
    .hero-slideshow .container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-height: 100%;
        padding-top: 100px;
        padding-bottom: 80px;
    }
    
    .hero-slideshow .slide-content-center .container {
        align-items: center;
    }
    
    .hero-slideshow .slide-content-left .container {
        align-items: flex-start;
    }
    
    .hero-slideshow .slide-content-right .container {
        align-items: flex-end;
    }
    
    .hero-slideshow .slide-text { max-width: 700px; color: #fff; }
    
    .hero-slideshow .slide-badge {
        display: inline-flex;
        align-items: center;
        background: #C5A028;
        backdrop-filter: blur(10px);
        border: 1px solid #C5A028;
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        color: #003A46;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    
    .hero-slideshow .slide-title {
        font-size: 3.5rem;
        font-weight: 700;
        line-height: 1.15;
        color: #fff;
        margin-bottom: 1rem;
    }
    
    .hero-slideshow .slide-subtitle {
        font-size: 1.5rem;
        color: rgba(255,255,255,0.9);
        margin-bottom: 1rem;
        font-weight: 500;
    }
    
    .hero-slideshow .slide-description {
        font-size: 1.1rem;
        color: rgba(255,255,255,0.8);
        line-height: 1.7;
        margin-bottom: 2rem;
    }
    
    .hero-slideshow .slide-buttons { display: flex; gap: 1rem; flex-wrap: wrap; }
    
    .hero-slideshow .btn-primary-custom {
        padding: 12px 28px;
        border: 0;
        border-radius: 100px;
        background-color: #fff;
        color: #003A46;
        font-weight: 700;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .hero-slideshow .btn-primary-custom:hover {
        background-color: #C5A028;
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        color: #fff;
    }
    
    .hero-slideshow .btn-secondary-custom {
        padding: 12px 28px;
        border: 2px solid #C5A028;
        border-radius: 100px;
        background-color: transparent;
        color: #C5A028;
        font-weight: 700;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .hero-slideshow .btn-secondary-custom:hover {
        background-color: #C5A028;
        border-color: #C5A028;
        color: #003A46;
        transform: translateY(-2px);
    }
    
    .hero-slideshow .nav-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        border: none;
        color: #fff;
        font-size: 1.25rem;
        cursor: pointer;
        z-index: 20;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .hero-slideshow .nav-button:hover {
        background: rgba(255,255,255,0.3);
        transform: translateY(-50%) scale(1.1);
    }
    
    .hero-slideshow .nav-prev { left: 20px; }
    .hero-slideshow .nav-next { right: 20px; }
    
    .hero-slideshow .pagination-dots {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 20;
    }
    
    .hero-slideshow .pagination-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255,255,255,0.4);
        border: none;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .hero-slideshow .pagination-dot.active {
        background: #fff;
        transform: scale(1.2);
    }
    
    .hero-slideshow .pagination-dot:hover {
        background: rgba(255,255,255,0.7);
    }
    
    .hero-slideshow .progress-bar {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        background: #003A46;
        z-index: 20;
        transition: width {{ $interval }}ms linear;
    }
    
    @keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slide-in-left { from { opacity: 0; transform: translateX(-50px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes slide-in-right { from { opacity: 0; transform: translateX(50px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes slide-in-up { from { opacity: 0; transform: translateY(50px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slide-in-down { from { opacity: 0; transform: translateY(-50px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes zoom-in { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }
    @keyframes zoom-out { from { opacity: 0; transform: scale(1.1); } to { opacity: 1; transform: scale(1); } }
    
    .hero-slideshow .animate-text .slide-badge { animation: slide-in-down 0.6s ease-out forwards; }
    .hero-slideshow .animate-text .slide-title { animation: slide-in-up 0.6s ease-out 0.2s forwards; opacity: 0; }
    .hero-slideshow .animate-text .slide-subtitle { animation: slide-in-up 0.6s ease-out 0.3s forwards; opacity: 0; }
    .hero-slideshow .animate-text .slide-description { animation: slide-in-up 0.6s ease-out 0.4s forwards; opacity: 0; }
    .hero-slideshow .animate-text .slide-buttons { animation: slide-in-up 0.6s ease-out 0.5s forwards; opacity: 0; }
    
    @media (max-width: 768px) {
        .hero-slideshow .slide-title { font-size: 2rem; }
        .hero-slideshow .slide-subtitle { font-size: 1.1rem; }
        .hero-slideshow .slide-description { font-size: 0.95rem; }
        .hero-slideshow .nav-button { width: 40px; height: 40px; font-size: 1rem; }
        .hero-slideshow { min-height: 400px; }
        
        .hero-slideshow .slide-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            gap: 2rem;
        }
        
        .hero-slideshow .slide-text {
            flex: 0 0 55%;
            max-width: 55%;
        }
        
        .hero-slideshow .slide-info-card {
            flex: 0 0 40%;
            max-width: 40%;
            background: #F5F0E6;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 25px 50px rgba(0,0,0,0.25);
            border: 2px solid #C5A028;
        }
        
        .hero-slideshow .info-card-header {
            display: flex;
            align-items: center;
            gap: 0;
            margin-bottom: 1.25rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #C5A028;
        }
        
        .hero-slideshow .info-card-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #003A46, #002830);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }
        
        .hero-slideshow .info-card-icon i {
            color: #C5A028;
            font-size: 1.25rem;
        }
        
        .hero-slideshow .info-card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #003A46;
            margin: 0;
            letter-spacing: -0.02em;
        }
        
        .hero-slideshow .info-card-subtitle {
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 0.25rem;
        }
        
        .hero-slideshow .info-event-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: #f8fafc;
            margin-bottom: 0.75rem;
            cursor: pointer;
        }
        
        .hero-slideshow .info-event-item:hover {
            background: #e8e0d0;
            transform: translateX(5px);
        }
        
        .hero-slideshow .info-event-date {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #003A46, #002830);
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #C5A028;
            margin-right: 1rem;
            flex-shrink: 0;
        }
        
        .hero-slideshow .info-event-date .day {
            font-size: 1.1rem;
            font-weight: 700;
            line-height: 1;
            color: #fff;
        }
        
        .hero-slideshow .info-event-date .month {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #C5A028;
        }
        
        .hero-slideshow .info-event-content {
            flex: 1;
            min-width: 0;
        }
        
        .hero-slideshow .info-event-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.3rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .hero-slideshow .info-event-location {
            font-size: 0.75rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        .hero-slideshow .info-stats {
            display: flex;
            gap: 2rem;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid #C5A028;
        }
        
        .hero-slideshow .info-stat-item {
            text-align: center;
            flex: 1;
        }
        
        .hero-slideshow .info-stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #003A46;
            line-height: 1;
        }
        
        .hero-slideshow .info-stat-label {
            font-size: 0.75rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 0.35rem;
        }
        
        @media (max-width: 992px) {
            .hero-slideshow .slide-row {
                flex-direction: column;
                text-align: center;
            }
            .hero-slideshow .slide-text, .hero-slideshow .slide-info-card {
                flex: 0 0 100%;
                max-width: 100%;
            }
            .hero-slideshow .slide-info-card {
                display: none;
            }
        }
    }
</style>

<div class="hero-slideshow" id="{{ $uniqueId }}">
    @php
        $upcomingEvents = \App\Models\Event::upcoming()
            ->orderBy('start_datetime')
            ->take(2)
            ->get();
    @endphp
    
    @forelse($slides as $index => $slide)
        @php
            $useTheme = $slide->use_theme ?? true;
            $theme = $useTheme ? ($themeColors[$slide->theme] ?? $themeColors['burgundy']) : ['primary' => '#003A46', 'secondary' => '#C5A028', 'text' => '#333333', 'bg' => '#FFFFFF'];
            $overlayOpacity = $overlayOpacities[$slide->overlay_opacity] ?? '0.4';
            $contentPosition = match($slide->content_position ?? 'left') {
                'left' => 'slide-content-left',
                'right' => 'slide-content-right',
                default => 'slide-content-center'
            };
        @endphp
        
        <div class="slide {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}">
            @if($slide->image)
                <img src="{{ url('/laravel-img/' . $slide->image) }}" alt="{{ $slide->imageAlt }}" class="slide-image">
            @else
                <div class="slide-image" style="background: {{ $theme['bg'] }};"></div>
            @endif
            
            <div class="slide-overlay" style="background: rgba(0,0,0, {{ $overlayOpacity }});"></div>
            
            @if($slide->show_content ?? true)
            <div class="container">
                <div class="slide-content {{ $contentPosition }} {{ $slide->show_animation ? 'animate-text' : '' }}">
                    <div class="slide-row">
                        <div class="slide-text">
                            @if($slide->subtitle)
                                <div class="slide-badge">
                                    <i class="{{ $slide->button_icon ?? 'bi bi-mortarboard-fill' }} me-2"></i>
                                    {{ $slide->subtitle }}
                                </div>
                            @endif
                            
                            <h1 class="slide-title">{{ $slide->title }}</h1>
                            
                            @if($slide->description)
                                <p class="slide-description">{{ $slide->description }}</p>
                            @endif
                            
                            @if($slide->button_text || $slide->secondary_button_text)
                                <div class="slide-buttons">
                                    @if($slide->button_text)
                                        <a href="{{ $slide->button_url ?? '#' }}" class="btn-primary-custom">
                                            {{ $slide->button_text }}
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    @endif
                                    
                                    @if($slide->secondary_button_text)
                                        <a href="{{ $slide->secondary_button_url ?? '#' }}" class="btn-secondary-custom">
                                            {{ $slide->secondary_button_text }}
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                        
                        <div class="slide-info-card">
                            <div class="info-card-header">
                                <div class="info-card-icon">
                                    <i class="bi bi-calendar-check"></i>
                                </div>
                                <div>
                                    <h4 class="info-card-title">{{ app()->getLocale() === 'km' ? 'ព្រឹត្តិការណ៍សំខាន់' : 'Important Dates' }}</h4>
                                    <p class="info-card-subtitle mb-0">{{ app()->getLocale() === 'km' ? 'កុំឲ្យខកខាន' : "Don't miss out" }}</p>
                                </div>
                            </div>
                            
                            @forelse($upcomingEvents as $event)
                            <div class="info-event-item">
                                <div class="info-event-date">
                                    <span class="day">{{ $event->start_datetime->format('d') }}</span>
                                    <span class="month">{{ $event->start_datetime->format('M') }}</span>
                                </div>
                                <div class="info-event-content">
                                    <div class="info-event-title">{{ Str::limit(app()->getLocale() === 'km' ? $event->title_km : $event->title_en, 30) }}</div>
                                    <div class="info-event-location"><i class="bi bi-geo-alt me-1"></i> {{ $event->location }}</div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-3 text-muted">
                                <i class="bi bi-calendar-x fs-4"></i>
                                <p class="mb-0 mt-1 small">{{ app()->getLocale() === 'km' ? 'គ្មានព្រឹត្តិការណ៍' : 'No upcoming events' }}</p>
                            </div>
                            @endforelse
                            
                            <div class="info-stats">
                                <div class="info-stat-item">
                                    <div class="info-stat-number">50+</div>
                                    <div class="info-stat-label">{{ app()->getLocale() === 'km' ? 'បណ្ឌិត' : 'Faculty' }}</div>
                                </div>
                                <div class="info-stat-item">
                                    <div class="info-stat-number">2,500+</div>
                                    <div class="info-stat-label">{{ app()->getLocale() === 'km' ? 'និស្សិត' : 'Students' }}</div>
                                </div>
                                <div class="info-stat-item">
                                    <div class="info-stat-number">30+</div>
                                    <div class="info-stat-label">{{ app()->getLocale() === 'km' ? 'ឆ្នាំ' : 'Years' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    @empty
        <div class="slide active">
            <div class="slide-image" style="background: linear-gradient(135deg, #003A46 0%, #002830 100%);"></div>
            <div class="slide-overlay" style="background: rgba(0,0,0,0.4);"></div>
            <div class="container">
                <div class="slide-content slide-content-center">
                    <div class="slide-text">
                        <h1 class="slide-title">{{ __('hero.default_slides.welcome.title') ?? 'Welcome to NUMiLaw' }}</h1>
                        <p class="slide-description">{{ __('hero.default_slides.welcome.description') ?? 'National University of Management - International Program of Legal Studies' }}</p>
                        <div class="slide-buttons">
                            <a href="/academic-programs" class="btn-primary-custom">
                                {{ app()->getLocale() === 'km' ? 'ស្វែងយល់បន្ថែម' : 'Explore Programs' }}
                                <i class="bi bi-arrow-right"></i>
                            </a>
                            <a href="/about" class="btn-secondary-custom">
                                {{ app()->getLocale() === 'km' ? 'អំពីយើង' : 'Learn More' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforelse
    
    @if(count($slides) > 1)
        @if($navigation)
            <button class="nav-button nav-prev" onclick="changeSlide('{{ $uniqueId }}', -1)">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button class="nav-button nav-next" onclick="changeSlide('{{ $uniqueId }}', 1)">
                <i class="bi bi-chevron-right"></i>
            </button>
        @endif
        
        @if($pagination)
            <div class="pagination-dots">
                @foreach($slides as $index => $slide)
                    <button class="pagination-dot {{ $index === 0 ? 'active' : '' }}" 
                            onclick="goToSlide('{{ $uniqueId }}', {{ $index }})"
                            aria-label="Go to slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
        @endif
        
        @if($autoplay)
            <div class="progress-bar" style="width: 0%;" id="{{ $uniqueId }}-progress"></div>
        @endif
    @endif
</div>

<script>
(function() {
    const uniqueId = '{{ $uniqueId }}';
    const container = document.getElementById(uniqueId);
    if (!container) return;
    
    const slides = container.querySelectorAll('.slide');
    const dots = container.querySelectorAll('.pagination-dot');
    const progressBar = document.getElementById(`${uniqueId}-progress`);
    
    let currentSlide = 0;
    let autoplayInterval = null;
    
    const autoplayEnabled = {{ $autoplay ? 'true' : 'false' }};
    const interval = {{ $interval }};
    
    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
        
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
        
        currentSlide = index;
        
        if (progressBar) {
            progressBar.style.width = '0%';
            progressBar.style.transition = 'none';
            setTimeout(() => {
                progressBar.style.transition = `width ${interval}ms linear`;
                progressBar.style.width = '100%';
            }, 50);
        }
    }
    
    function nextSlide() {
        const next = (currentSlide + 1) % slides.length;
        showSlide(next);
    }
    
    function prevSlide() {
        const prev = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(prev);
    }
    
    window.changeSlide = function(id, direction) {
        if (id !== uniqueId) return;
        direction === 1 ? nextSlide() : prevSlide();
        resetAutoplay();
    };
    
    window.goToSlide = function(id, index) {
        if (id !== uniqueId) return;
        showSlide(index);
        resetAutoplay();
    };
    
    function resetAutoplay() {
        if (autoplayInterval) clearInterval(autoplayInterval);
        if (autoplayEnabled) autoplayInterval = setInterval(nextSlide, interval);
    }
    
    if (autoplayEnabled && slides.length > 1) {
        setTimeout(() => {
            if (progressBar) {
                progressBar.style.transition = `width ${interval}ms linear`;
                progressBar.style.width = '100%';
            }
        }, 50);
        
        autoplayInterval = setInterval(nextSlide, interval);
    }
    
    container.addEventListener('mouseenter', () => {
        if (autoplayInterval) {
            clearInterval(autoplayInterval);
            autoplayInterval = null;
        }
    });
    
    container.addEventListener('mouseleave', () => {
        if (autoplayEnabled) resetAutoplay();
    });
})();
</script>
