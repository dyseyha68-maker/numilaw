<style>
.card-banner {
    position: relative;
    border-radius: 0;
    overflow: hidden;
    background: #fff;
}
.card-banner__media {
    position: relative;
    height: 100%;
    min-height: 420px;
    overflow: hidden;
}
.card-banner__media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}
.card-banner:hover .card-banner__media img {
    transform: scale(1.05);
}
.card-banner__content {
    padding: 3rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background: #fff;
    height: 100%;
    min-height: 420px;
}
.card-banner__tagline {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #00AACC;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.card-banner__tagline::before {
    content: '';
    width: 24px;
    height: 2px;
    background: #00AACC;
}
.card-banner__title {
    color: #003A46;
    font-size: 1.75rem;
    font-weight: 700;
    line-height: 1.3;
    margin-bottom: 1rem;
}
.card-banner__description {
    color: #64748b;
    font-size: 1rem;
    line-height: 1.7;
    margin-bottom: 1.5rem;
    max-width: 500px;
}
.card-banner__cta {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #003A46;
    font-weight: 600;
    text-decoration: none;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}
.card-banner__cta:hover {
    color: #00AACC;
    gap: 0.75rem;
}
.card-banner__cta-arrow {
    transition: transform 0.3s ease;
}
.card-banner__cta:hover .card-banner__cta-arrow {
    transform: translateX(4px);
}
.card-banner__date-box {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    padding: 1.25rem 1.5rem;
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    border-left: 4px solid #00AACC;
    margin-bottom: 1.5rem;
    max-width: fit-content;
}
.card-banner__date-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: linear-gradient(135deg, #00AACC, #003A46);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.card-banner__date-info {
    flex: 1;
}
.card-banner__date-label {
    font-size: 0.75rem;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.25rem;
}
.card-banner__date-value {
    color: #003A46;
    font-weight: 700;
    font-size: 1.1rem;
}
.card-banner__date-status {
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.03em;
}
.card-banner .carousel-indicators {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    margin: 0;
}
.card-banner .carousel-indicators button {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(0,58,70,0.3);
    border: none;
    margin: 0 4px;
    transition: all 0.3s ease;
}
.card-banner .carousel-indicators button.active {
    background: #003A46;
    width: 24px;
    border-radius: 4px;
}
.card-banner .carousel-control-prev,
.card-banner .carousel-control-next {
    width: 44px;
    height: 44px;
    top: 50%;
    transform: translateY(-50%);
    background: #fff;
    border-radius: 50%;
    opacity: 0;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}
.card-banner:hover .carousel-control-prev,
.card-banner:hover .carousel-control-next {
    opacity: 1;
}
.card-banner .carousel-control-prev {
    left: 20px;
}
.card-banner .carousel-control-next {
    right: 20px;
}
.card-banner .carousel-control-prev-icon,
.card-banner .carousel-control-next-icon {
    background-image: none;
    display: flex;
    align-items: center;
    justify-content: center;
}
.card-banner .carousel-control-prev-icon::before,
.card-banner .carousel-control-next-icon::before {
    content: '';
    display: block;
    width: 10px;
    height: 10px;
    border-right: 2px solid #003A46;
    border-bottom: 2px solid #003A46;
}
.card-banner .carousel-control-prev-icon::before {
    transform: rotate(135deg);
    margin-left: 2px;
}
.card-banner .carousel-control-next-icon::before {
    transform: rotate(-45deg);
    margin-right: 2px;
}
@media (max-width: 991px) {
    .card-banner__media {
        min-height: 280px;
    }
    .card-banner__content {
        padding: 2rem;
        min-height: auto;
    }
    .card-banner__title {
        font-size: 1.35rem;
    }
}
</style>

<div id="cardBannerCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($importantDates as $index => $date)
        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" data-bs-interval="6000">
            <div class="card-banner">
                <div class="row g-0">
                    <div class="col-lg-6">
                        <div class="card-banner__media">
                            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800&q=80" alt="Academic Calendar">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card-banner__content">
                            <div class="card-banner__tagline">
                                {{ $locale === 'km' ? 'កាលបរិច្ឆេទសំខាន់' : 'Important Dates' }}
                            </div>
                            <h3 class="card-banner__title">
                                {{ $locale === 'km' ? $date['title_km'] : $date['title_en'] }}
                            </h3>
                            <p class="card-banner__description">
                                {{ $locale === 'km' ? 'កាលបរិច្ឆេទសំខាន់ៗសម្រាប់ដំណើរការចុះឈ្មោះ និងប្រតិទិនសិក្សា' : 'Key dates for the admission process and academic calendar. Don\'t miss these important deadlines.' }}
                            </p>
                            
                            <div class="card-banner__date-box">
                                <div class="card-banner__date-icon">
                                    <i class="bi bi-calendar3 text-white" style="font-size: 1.25rem;"></i>
                                </div>
                                <div class="card-banner__date-info">
                                    <div class="card-banner__date-label">{{ $locale === 'km' ? 'ថ្ងៃខែ' : 'Date' }}</div>
                                    <div class="card-banner__date-value">{{ \Carbon\Carbon::parse($date['date'])->format('F j, Y') }}</div>
                                </div>
                                <span class="card-banner__date-status" style="background: {{ $date['is_upcoming'] ? '#fef3c7' : '#dcfce7' }}; color: {{ $date['is_upcoming'] ? '#92400e' : '#166534' }};">
                                    {{ $date['is_upcoming'] ? ($locale === 'km' ? 'នាពេលខាងមុខ' : 'Upcoming') : ($locale === 'km' ? 'បើក' : 'Open') }}
                                </span>
                            </div>
                            
                            <a href="#apply" class="card-banner__cta">
                                {{ $locale === 'km' ? 'ដាក់ពាក្យឥឡូវ' : 'Apply Now' }}
                                <span class="card-banner__cta-arrow">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    @if(count($importantDates) > 1)
    <button class="carousel-control-prev" type="button" data-bs-target="#cardBannerCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#cardBannerCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    
    <div class="carousel-indicators">
        @foreach($importantDates as $index => $date)
        <button type="button" data-bs-target="#cardBannerCarousel" data-bs-slide-to="{{ $index }}" {{ $index === 0 ? 'class="active"' : '' }} aria-current="true" aria-label="Slide {{ $index + 1 }}"></button>
        @endforeach
    </div>
    @endif
</div>
