@extends('layouts.public')

@section('title', 'Admission Requirements')

@section('description', 'Learn about admission requirements for our law programs including academic requirements, documents needed, and application process.')

@php
$heroImageUrl = $heroImage ? asset($heroImage) : 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=1200&q=80';
@endphp

@push('styles')
<style>
    :root {
        --brand-primary: #003A46;
        --brand-secondary: #00AACC;
        --brand-light: #e8f4f6;
        --brand-dark: #002a33;
    }

    .hero-section {
        background: linear-gradient(135deg, var(--brand-primary) 0%, #005a6e 50%, var(--brand-secondary) 100%);
        position: relative;
        overflow: hidden;
        padding: 80px 0;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 80%, rgba(0,170,204,0.3) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 40%);
        pointer-events: none;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 35%;
        height: 100%;
        background: linear-gradient(180deg, rgba(0,170,204,0.2) 0%, transparent 50%);
        clip-path: polygon(15% 0, 100% 0, 100% 100%, 0% 100%);
    }

    .breadcrumb-custom a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
    }

    .breadcrumb-custom a:hover {
        color: white;
    }

    .breadcrumb-custom .breadcrumb-item::before {
        color: rgba(255,255,255,0.5);
    }

    .breadcrumb-custom .breadcrumb-item.active {
        color: white;
    }

    .requirement-card {
        border: none;
        border-radius: 20px;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .requirement-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,58,70,0.15);
    }

    .requirement-card .card-header {
        border: none;
        padding: 1.5rem;
        position: relative;
    }

    .requirement-card .card-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    }

    .requirement-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .check-item {
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        transition: all 0.2s ease;
    }

    .check-item:last-child {
        border-bottom: none;
    }

    .check-item:hover {
        padding-left: 8px;
    }

    .check-item i {
        transition: all 0.2s ease;
    }

    .check-item:hover i {
        transform: scale(1.2);
    }

    .program-card {
        border-radius: 20px;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .program-card:hover {
        border-color: var(--brand-secondary);
    }

    .program-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin: 0 auto;
    }

    .timeline-step {
        position: relative;
        padding-left: 80px;
    }

    .timeline-step::before {
        content: '';
        position: absolute;
        left: 30px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, var(--brand-primary), var(--brand-secondary));
    }

    .timeline-step:last-child::before {
        display: none;
    }

    .timeline-number {
        position: absolute;
        left: 0;
        top: 0;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--brand-primary), var(--brand-secondary));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        box-shadow: 0 4px 15px rgba(0,58,70,0.3);
    }

    .timeline-content {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
        position: relative;
    }

    .timeline-content::before {
        content: '';
        position: absolute;
        left: -12px;
        top: 20px;
        width: 0;
        height: 0;
        border-top: 12px solid transparent;
        border-bottom: 12px solid transparent;
        border-right: 12px solid white;
    }

    .contact-card {
        border-radius: 20px;
        transition: all 0.3s ease;
        border: none;
    }

    .contact-card:hover {
        transform: translateY(-5px);
    }

    .contact-card .icon-wrapper {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin: 0 auto 1rem;
    }

    .section-title {
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, var(--brand-primary), var(--brand-secondary));
        border-radius: 2px;
    }

    .gradient-text {
        background: linear-gradient(135deg, var(--brand-primary), var(--brand-secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 40px 0;
        }
        
        .timeline-step {
            padding-left: 0;
            padding-top: 70px;
        }
        
        .timeline-step::before {
            display: none;
        }
        
        .timeline-number {
            width: 50px;
            height: 50px;
            font-size: 1.25rem;
        }
        
        .timeline-content::before {
            display: none;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="position-relative d-flex align-items-center" style="min-height: 50vh; overflow: hidden;">
    <div class="position-absolute top-0 start-0 w-100 h-100">
        <img src="{{ $heroImageUrl }}" alt="Admission Requirements" class="w-100 h-100" style="object-fit: cover; object-position: center;">
    </div>
    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="background: linear-gradient(135deg, rgba(0,58,70,0.9) 0%, rgba(0,95,107,0.8) 50%, rgba(0,170,204,0.6) 100%);">
    </div>
    <div class="container position-relative">
        <h1 class="display-4 fw-bold text-white mb-2" style="text-shadow: 0 2px 20px rgba(0,0,0,0.3);">
            {{ app()->getLocale() === 'km' ? 'តម្រូវការការចូលរៀន' : 'Admission Requirements' }}
        </h1>
        <p class="lead text-white" style="opacity: 0.9;">
            {{ app()->getLocale() === 'km' ? 'ស្វែងយល់ពីតម្រូវការទាំងអស់ដើម្បីចូលរៀននៅមហាវិទ្យាល័យច្បាប់របស់យើង' : 'Learn about all the requirements to join our law school' }}
        </p>
    </div>
</section>

<!-- General Requirements Section -->
<section class="py-5" style="background: #f8fafc;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge mb-3 px-4 py-2" style="background: #003A46; color: white; border-radius: 50px; font-size: 0.85rem; font-weight: 600;">
                <i class="bi bi-clipboard-check me-1"></i>{{ app()->getLocale() === 'km' ? 'តម្រូវការទូទៅ' : 'General Requirements' }}
            </span>
            <h2 class="fw-bold mb-3" style="color: #003A46; font-size: 2rem;">
                {{ app()->getLocale() === 'km' ? 'តម្រូវការទូទៅ' : 'General Requirements' }}
            </h2>
            <p class="text-muted" style="max-width: 600px; margin: 0 auto;">
                {{ app()->getLocale() === 'km' ? 'ស្តង់ដារមូលដ្ឋានសម្រាប់គ្រប់កម្មវិធី' : 'Basic standards for all applicants' }}
            </p>
        </div>

        <div class="row g-4">
            @foreach($generalRequirements as $index => $requirement)
            <div class="col-lg-4">
                <div class="card h-100 border-0" style="border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 40px rgba(0,0,0,0.15)';">
                    <div class="card-header border-0 p-4" style="background: linear-gradient(135deg, #003A46, #005f6b);">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-{{ ['checkmark-circle', 'file-earmark-text', 'list-task'][$index % 3] }} fs-5 text-white"></i>
                            </div>
                            <h5 class="mb-0 fw-bold text-white">{{ app()->getLocale() === 'km' ? $requirement['title_km'] : $requirement['title_en'] }}</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @foreach(app()->getLocale() === 'km' ? $requirement['items_km'] : $requirement['items_en'] as $item)
                        <div class="d-flex align-items-start mb-3">
                            <div style="width: 20px; height: 20px; min-width: 20px; border-radius: 50%; background: #00AACC; display: flex; align-items: center; justify-content: center; margin-right: 12px; margin-top: 3px;">
                                <i class="bi bi-check text-white" style="font-size: 0.65rem;"></i>
                            </div>
                            <span style="color: #475569; line-height: 1.5;">{{ $item }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Program-Specific Requirements -->
<section class="py-5" style="background: white;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge mb-3 px-4 py-2" style="background: #00AACC; color: white; border-radius: 50px; font-size: 0.85rem; font-weight: 600;">
                <i class="bi bi-mortarboard me-1"></i>{{ app()->getLocale() === 'km' ? 'កម្មវិធីសិក្សា' : 'Programs' }}
            </span>
            <h2 class="fw-bold mb-3" style="color: #003A46; font-size: 2rem;">
                {{ app()->getLocale() === 'km' ? 'តម្រូវការតាមកម្មវិធី' : 'Program-Specific Requirements' }}
            </h2>
            <p class="text-muted" style="max-width: 600px; margin: 0 auto;">
                {{ app()->getLocale() === 'km' ? 'លក្ខខណ្ឌបន្ថែមសម្រាប់កម្រងជាន់ខ្ពស់' : 'Additional requirements for advanced programs' }}
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($programRequirements as $degreeType => $requirements)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0" style="border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 40px rgba(0,0,0,0.15)';">
                    <div class="card-body p-4 text-center">
                        <div class="mx-auto mb-4" style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #003A46, #00AACC); color: white; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 25px rgba(0,58,70,0.25);">
                            <i class="bi bi-{{ $degreeType === 'bachelor' ? 'book' : ($degreeType === 'master' ? 'award' : 'star') }}-fill fs-3"></i>
                        </div>
                        <h4 class="mb-3 fw-bold" style="color: #003A46;">{{ app()->getLocale() === 'km' ? $requirements['title_km'] : $requirements['title_en'] }}</h4>
                        <hr style="opacity: 0.1;">
                        <div class="text-start">
                            @foreach(app()->getLocale() === 'km' ? $requirements['additional_km'] : $requirements['additional_en'] as $item)
                            <div class="d-flex align-items-center mb-2">
                                <div style="width: 6px; height: 6px; min-width: 6px; border-radius: 50%; background: #00AACC; margin-right: 10px;"></div>
                                <small style="color: #475569;">{{ $item }}</small>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('public.academic-programs.index') }}" class="btn btn-sm" style="background: #003A46; color: white; border-radius: 25px; padding: 0.5rem 1.25rem;">
                                <i class="bi bi-eye me-1"></i>
                                {{ app()->getLocale() === 'km' ? 'មើលកម្មវិធី' : 'View Programs' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Application Process Timeline -->
<section class="py-5" style="background: #f8fafc;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge mb-3 px-4 py-2" style="background: #003A46; color: white; border-radius: 50px; font-size: 0.85rem; font-weight: 600;">
                <i class="bi bi-list-task me-1"></i>{{ app()->getLocale() === 'km' ? 'ដំណើរការ' : 'Process' }}
            </span>
            <h2 class="fw-bold mb-3" style="color: #003A46; font-size: 2rem;">
                {{ app()->getLocale() === 'km' ? 'ដំណើរការដាក់ពាក្យ' : 'Application Process' }}
            </h2>
            <p class="text-muted" style="max-width: 600px; margin: 0 auto;">
                {{ app()->getLocale() === 'km' ? 'ជំហានដោយជំហានដើម្បីចូលរៀន' : 'Your journey to admission in 4 simple steps' }}
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="d-flex align-items-center mb-3">
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: #003A46; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; font-weight: 700; flex-shrink: 0;">1</div>
                    <div class="ms-3 p-3" style="background: white; border-radius: 16px; box-shadow: 0 2px 15px rgba(0,0,0,0.06); flex-grow: 1;">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(0,58,70,0.08); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-search fs-5" style="color: #003A46;"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'ជ្រើសរើសកម្មវិធី' : 'Choose Your Program' }}</h6>
                                <p class="text-muted mb-0 small">{{ app()->getLocale() === 'km' ? 'ជ្រើសរើសកម្មវិធីដែលអ្នកចង់សិក្សា' : 'Browse our programs and find the one that matches your goals' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-3">
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: #003A46; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; font-weight: 700; flex-shrink: 0;">2</div>
                    <div class="ms-3 p-3" style="background: white; border-radius: 16px; box-shadow: 0 2px 15px rgba(0,0,0,0.06); flex-grow: 1;">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(0,58,70,0.08); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-folder-check fs-5" style="color: #003A46;"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'រៀបចំឯកសារ' : 'Prepare Documents' }}</h6>
                                <p class="text-muted mb-0 small">{{ app()->getLocale() === 'km' ? 'រៀបចំឯកសារគ្រប់យ៉ាងត្រូវការ' : 'Gather all required documents and certificates' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-3">
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: #003A46; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; font-weight: 700; flex-shrink: 0;">3</div>
                    <div class="ms-3 p-3" style="background: white; border-radius: 16px; box-shadow: 0 2px 15px rgba(0,0,0,0.06); flex-grow: 1;">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(0,58,70,0.08); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-send-check fs-5" style="color: #003A46;"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'ដាក់ពាក្យ' : 'Submit Application' }}</h6>
                                <p class="text-muted mb-0 small">{{ app()->getLocale() === 'km' ? 'ផ្ញើពាក្យចូលរៀនតрез internet' : 'Submit your application online through our portal' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-3">
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: #003A46; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; font-weight: 700; flex-shrink: 0;">4</div>
                    <div class="ms-3 p-3" style="background: white; border-radius: 16px; box-shadow: 0 2px 15px rgba(0,0,0,0.06); flex-grow: 1;">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(0,58,70,0.08); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-person-check fs-5" style="color: #003A46;"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'ទទួលលិខិត' : 'Get Admitted' }}</h6>
                                <p class="text-muted mb-0 small">{{ app()->getLocale() === 'km' ? 'ទទួលលិខិតទទួលស្គាល់' : 'Receive your admission decision and enrollment details' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('public.admission.index') }}" class="btn btn-lg" style="background: #003A46; color: white; border-radius: 50px; padding: 14px 36px; font-weight: 600;">
                <i class="bi bi-clipboard-plus me-2"></i>{{ app()->getLocale() === 'km' ? 'ចាប់ផ្តើមដាក់ពាក្យ' : 'Start Your Application' }}
            </a>
        </div>
    </div>
</section>
@endsection
