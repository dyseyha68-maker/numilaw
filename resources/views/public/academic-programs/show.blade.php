@extends('layouts.public')

@section('title', $program->title)

@php
$heroImageUrl = $program->featured_image 
    ? url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $program->featured_image)) 
    : ($heroImage ? url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $heroImage)) : 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&q=80');
@endphp

@section('content')
<!-- Hero Section -->
<section class="position-relative overflow-hidden" style="background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%); padding: 40px 0;">
    <div class="container">
        <!-- Wide Rounded Card -->
        <div class="card border-0 mx-auto" style="max-width: 100%; border-radius: 32px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,58,70,0.1);">
            <!-- Full-Width Banner Image -->
            <div class="position-relative" style="height: 200px; overflow: hidden;" id="heroImageContainer" onmousemove="handleMouseMove(event)" onmouseleave="handleMouseLeave(event)">
                <img src="{{ $heroImageUrl }}" 
                     alt="{{ $program->title }}" 
                     id="heroImage"
                     style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.2s ease-out;">
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(180deg, rgba(0,58,70,0.3) 0%, transparent 60%);"></div>
            </div>
            
            <!-- Card Content -->
            <div class="card-body p-5">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb mb-0" style="--bs-breadcrumb-divider-color: rgba(0,58,70,0.3);">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none" style="color: #64748b;">{{ __('navigation.home') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('public.academic-programs.index') }}" class="text-decoration-none" style="color: #64748b;">{{ __('academic_programs.title') }}</a></li>
                                <li class="breadcrumb-item active" style="color: #003A46;">{{ $program->title }}</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold mb-3" style="color: #003A46; line-height: 1.2;">
                            {{ $program->title }}
                        </h1>
                        <div class="d-flex flex-wrap gap-3 mb-3">
                            <span class="badge px-3 py-2" style="background: #003A46; color: white;">
                                {{ $program->degree_type_display }}
                            </span>
                            <span class="d-flex align-items-center" style="color: #64748b;">
                                <i class="bi bi-clock me-2"></i> {{ $program->duration_years }} {{ __('common.year') }}{{ $program->duration_years > 1 ? 's' : '' }}
                            </span>
                            <span class="d-flex align-items-center" style="color: #64748b;">
                                <i class="bi bi-book me-2"></i> {{ $program->credits_required }} {{ __('academic_programs.credits') }}
                            </span>
                        </div>
                    </div>
                    @if($program->tuition_fee)
                        <div class="col-lg-4 d-none d-lg-block">
                            <div style="padding: 1.5rem; background: linear-gradient(135deg, #003A46, #005f6b); border-radius: 24px; color: white;">
                                <div class="small mb-1 opacity-75">{{ __('academic_programs.tuition_fee') }}</div>
                                <div class="h1 mb-0 fw-bold">${{ number_format($program->tuition_fee, 0) }}</div>
                                <div class="small opacity-75">{{ __('common.per_year') }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function handleMouseMove(e) {
    const container = document.getElementById('heroImageContainer');
    const img = document.getElementById('heroImage');
    const rect = container.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    const centerX = rect.width / 2;
    const centerY = rect.height / 2;
    const moveX = (x - centerX) / 30;
    const moveY = (y - centerY) / 30;
    img.style.transform = `scale(1.05) translate(${moveX}px, ${moveY}px)`;
}

function handleMouseLeave(e) {
    const img = document.getElementById('heroImage');
    img.style.transform = 'scale(1) translate(0px, 0px)';
}
</script>

<!-- Main Content -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Main Content Column -->
            <div class="col-lg-8">
                <!-- Program Overview -->
                <div class="card border-0 shadow-sm mb-4 card-modern">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-box me-3">
                                <i class="bi bi-info-circle"></i>
                            </div>
                            <h2 class="h3 mb-0">{{ __('academic_programs.program_overview') }}</h2>
                        </div>
                        <div class="text-muted fs-5 lh-lg">
                            {!! nl2br(e($program->description)) !!}
                        </div>
                    </div>
                </div>

                <!-- Admission Requirements -->
                @if($program->admission_requirements)
                    <div class="card border-0 shadow-sm mb-4 card-modern">
                        <div class="card-body p-4 p-lg-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-box icon-box-success me-3">
                                    <i class="bi bi-clipboard-check"></i>
                                </div>
                                <h2 class="h3 mb-0">{{ __('admission.title') }} {{ __('requirements.requirements') }}</h2>
                            </div>
                            <div class="content-box">
                                <div class="text-muted lh-lg">
                                    {!! nl2br(e($program->admission_requirements)) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Curriculum -->
                @if($program->curriculum)
                    <div class="card border-0 shadow-sm mb-4 card-modern">
                        <div class="card-body p-4 p-lg-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-box icon-box-warning me-3">
                                    <i class="bi bi-journal-bookmark-fill"></i>
                                </div>
                                <h2 class="h3 mb-0">{{ __('academic_programs.curriculum') }}</h2>
                            </div>
                            <div class="content-box">
                                <div class="text-muted lh-lg">
                                    {!! nl2br(e($program->curriculum)) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Learning Outcomes -->
                <div class="card border-0 shadow-sm mb-4 card-modern">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-box icon-box-info me-3">
                                <i class="bi bi-trophy"></i>
                            </div>
                            <h2 class="h3 mb-0">{{ __('academic_programs.learning_outcomes') }}</h2>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="outcome-item">
                                    <div class="outcome-icon">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div>
                                        <strong>{{ __('academic_programs.legal_knowledge') }}</strong>
                                        <p class="text-muted mb-0 small">{{ __('academic_programs.legal_knowledge_desc') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="outcome-item">
                                    <div class="outcome-icon">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div>
                                        <strong>{{ __('academic_programs.practical_skills') }}</strong>
                                        <p class="text-muted mb-0 small">{{ __('academic_programs.practical_skills_desc') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="outcome-item">
                                    <div class="outcome-icon">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div>
                                        <strong>{{ __('academic_programs.research_ability') }}</strong>
                                        <p class="text-muted mb-0 small">{{ __('academic_programs.research_ability_desc') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="outcome-item">
                                    <div class="outcome-icon">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div>
                                        <strong>{{ __('academic_programs.ethical_understanding') }}</strong>
                                        <p class="text-muted mb-0 small">{{ __('academic_programs.ethical_understanding_desc') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Column -->
            <div class="col-lg-4">
                <!-- Apply Now Card -->
                <div class="card border-0 mb-4 card-cta">
                    <div class="card-body p-4 p-lg-5 text-center">
                        <div class="cta-icon mb-3">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <h4 class="mb-3 text-white">{{ __('admission.apply_now_button') }}</h4>
                        <p class="mb-4 text-white-50">{{ __('academic_programs.start_journey_today') }}</p>
                        <a href="{{ route('public.admission.apply', $program->slug) }}" class="btn btn-light btn-lg w-100 fw-semibold">
                            <i class="bi bi-pencil-square me-2"></i> {{ __('admission.apply') }}
                        </a>
                    </div>
                </div>

                <!-- Quick Info -->
                <div class="card border-0 shadow-sm mb-4 card-modern">
                    <div class="card-body p-4 p-lg-5">
                        <h5 class="card-title mb-4 fw-bold">{{ __('academic_programs.program_details') }}</h5>
                        <div class="info-item">
                            <div class="d-flex align-items-center">
                                <div class="info-icon">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <div>
                                    <div class="small text-muted">{{ __('academic_programs.duration') }}</div>
                                    <div class="fw-bold">{{ $program->duration_years }} {{ __('common.year') }}{{ $program->duration_years > 1 ? 's' : '' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="d-flex align-items-center">
                                <div class="info-icon">
                                    <i class="bi bi-book"></i>
                                </div>
                                <div>
                                    <div class="small text-muted">{{ __('academic_programs.credits_required') }}</div>
                                    <div class="fw-bold">{{ $program->credits_required }} {{ __('academic_programs.credits') }}</div>
                                </div>
                            </div>
                        </div>
                        @if($program->tuition_fee)
                            <div class="info-item">
                                <div class="d-flex align-items-center">
                                    <div class="info-icon">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div>
                                        <div class="small text-muted">{{ __('academic_programs.tuition_fee') }}</div>
                                        <div class="fw-bold">${{ number_format($program->tuition_fee, 0) }}/{{ __('common.year') }}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="info-item">
                            <div class="d-flex align-items-center">
                                <div class="info-icon info-icon-success">
                                    <i class="bi bi-patch-check"></i>
                                </div>
                                <div>
                                    <div class="small text-muted">{{ __('common.status') }}</div>
                                    <div class="fw-bold text-success">{{ __('common.available') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Programs -->
                @if($relatedPrograms->isNotEmpty())
                    <div class="card border-0 shadow-sm mb-4 card-modern">
                        <div class="card-body p-4 p-lg-5">
                            <h5 class="card-title mb-4 fw-bold">{{ __('academic_programs.related_programs') }}</h5>
                            <div class="d-flex flex-column gap-3">
                                @foreach($relatedPrograms as $related)
                                    <a href="{{ route('public.academic-programs.show', $related->slug) }}" 
                                       class="related-program-item p-3 rounded-3 text-decoration-none">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1 text-dark">{{ $related->title }}</h6>
                                                <small class="text-muted">{{ $related->degree_type_display }}</small>
                                            </div>
                                            <span class="badge badge-outline">{{ $related->duration_years }} {{ __('common.year') }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Contact Info -->
                <div class="card border-0 shadow-sm card-modern">
                    <div class="card-body p-4 p-lg-5">
                        <h5 class="card-title mb-4 fw-bold">{{ __('admission.contact_info') }}</h5>
                        <div class="contact-item">
                            <div class="d-flex align-items-center">
                                <div class="contact-icon">
                                    <i class="bi bi-telephone"></i>
                                </div>
                                <div>
                                    <div class="small text-muted">{{ __('common.phone') }}</div>
                                    <div class="fw-bold">+855 23 456 789</div>
                                </div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="d-flex align-items-center">
                                <div class="contact-icon">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div>
                                    <div class="small text-muted">{{ __('common.email') }}</div>
                                    <div class="fw-bold">admissions@numilaw.edu.kh</div>
                                </div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="d-flex align-items-center">
                                <div class="contact-icon">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div>
                                    <div class="small text-muted">{{ __('common.address') }}</div>
                                    <div class="fw-bold">{{ __('common.phnom_penh') }}, {{ __('common.cambodia') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    :root {
        --brand-color: #003A46;
        --brand-light: #005a6e;
        --brand-lighter: #e6f0f3;
    }

    .program-hero-section {
        min-height: 450px;
    }

    .program-hero-image {
        position: relative;
        min-height: 450px;
        background-size: cover;
        background-position: center;
    }

    .hero-gradient {
        background: linear-gradient(135deg, #003A46 0%, #005a6e 50%, #007a8c 100%);
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(180deg, rgba(0,58,70,0.7) 0%, rgba(0,58,70,0.5) 100%);
    }

    .min-vh-50 {
        min-height: 400px;
    }

    .hero-title {
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .breadcrumb-nav .breadcrumb-item {
        font-size: 0.95rem;
    }

    .breadcrumb-nav .breadcrumb-item::before {
        color: rgba(255,255,255,0.5);
    }

    .badge-brand {
        background: rgba(255,255,255,0.2);
        color: white;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.3);
    }

    .badge-brand:hover {
        background: rgba(255,255,255,0.3);
    }

    .tuition-card {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 16px;
        padding: 1.5rem;
        display: inline-block;
        animation: fadeInUp 0.6s ease-out 0.2s both;
    }

    .card-modern {
        border-radius: 16px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,58,70,0.12) !important;
    }

    .icon-box {
        width: 48px;
        height: 48px;
        background: var(--brand-lighter);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: var(--brand-color);
    }

    .icon-box-success {
        background: #d4edda;
        color: #198754;
    }

    .icon-box-warning {
        background: #fff3cd;
        color: #ffc107;
    }

    .icon-box-info {
        background: #cff4fc;
        color: #0dcaf0;
    }

    .content-box {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 12px;
        padding: 1.5rem;
    }

    .outcome-item {
        display: flex;
        align-items: flex-start;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .outcome-item:hover {
        background: var(--brand-lighter);
    }

    .outcome-icon {
        color: var(--brand-color);
        font-size: 1.25rem;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .card-cta {
        background: linear-gradient(135deg, #003A46 0%, #005a6e 100%);
        border-radius: 16px;
        overflow: hidden;
    }

    .card-cta::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.5;
    }

    .card-cta .card-body {
        position: relative;
    }

    .cta-icon {
        width: 72px;
        height: 72px;
        background: rgba(255,255,255,0.15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 2rem;
    }

    .info-item {
        padding: 1rem 0;
        border-bottom: 1px solid #e9ecef;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-icon {
        width: 40px;
        height: 40px;
        background: var(--brand-lighter);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--brand-color);
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .info-icon-success {
        background: #d4edda;
        color: #198754;
    }

    .related-program-item {
        background: #f8f9fa;
        transition: all 0.3s ease;
    }

    .related-program-item:hover {
        background: var(--brand-lighter);
        transform: translateX(4px);
    }

    .badge-outline {
        background: transparent;
        border: 1px solid #dee2e6;
        color: #6c757d;
    }

    .contact-item {
        padding: 1rem 0;
        border-bottom: 1px solid #e9ecef;
    }

    .contact-item:last-child {
        border-bottom: none;
    }

    .contact-icon {
        width: 40px;
        height: 40px;
        background: var(--brand-lighter);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--brand-color);
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .lh-lg {
        line-height: 1.8;
    }
</style>
@endsection
