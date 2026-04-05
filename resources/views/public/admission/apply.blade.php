@extends('layouts.public')

@section('title', app()->getLocale() === 'km' ? 'ដាក់ពាក្យចូលរៀន' : 'Apply for Admission')

@section('description', 'Complete your application to join our law school. Fill out the online application form and start your legal education journey.')

@push('styles')
<style>
    :root {
        --primary: #003A46;
        --primary-light: #005f6b;
        --primary-dark: #002830;
        --accent: #00AACC;
        --gold: #D4AF37;
        --gold-light: #F5E6A3;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
    }

    .apply-page {
        background: linear-gradient(180deg, #f0f9ff 0%, #e0f2fe 100%);
        min-height: 100vh;
    }

    .apply-hero {
        position: relative;
        min-height: 60vh;
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    
    .apply-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(0, 58, 70, 0.97) 0%, rgba(0, 95, 107, 0.92) 50%, rgba(0, 170, 204, 0.85) 100%);
    }
    
    .apply-hero-bg {
        position: absolute;
        inset: 0;
    }
    
    .apply-hero-bg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.25;
    }
    
    .apply-hero .container {
        position: relative;
        z-index: 2;
    }
    
    .hero-content {
        max-width: 700px;
    }
    
    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1.25rem;
        background: rgba(212, 175, 55, 0.2);
        border: 1px solid var(--gold);
        border-radius: 50px;
        color: var(--gold-light);
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    
    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.1;
        margin-bottom: 1.5rem;
    }
    
    .hero-title .highlight {
        color: var(--accent);
    }
    
    .hero-description {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.7;
        margin-bottom: 2rem;
    }
    
    .hero-stats {
        display: flex;
        gap: 3rem;
        margin-top: 2.5rem;
    }
    
    .hero-stat {
        text-align: center;
    }
    
    .hero-stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--accent);
        line-height: 1;
    }
    
    .hero-stat-label {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.7);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 0.5rem;
    }

    .program-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 1.5rem;
    }

    .program-card h5 {
        color: #fff;
        font-weight: 700;
    }

    .form-container {
        background: white;
        border-radius: 24px;
        box-shadow: 0 25px 80px rgba(0, 58, 70, 0.15);
        margin-top: -80px;
        position: relative;
        z-index: 10;
        overflow: hidden;
    }

    .form-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 2rem 3rem;
        color: white;
    }

    .form-header h3 {
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .form-header p {
        opacity: 0.85;
        margin-bottom: 0;
    }

    .step-progress {
        display: flex;
        justify-content: space-between;
        padding: 1.5rem 3rem;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        position: relative;
    }

    .step-progress::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 10%;
        right: 10%;
        height: 3px;
        background: #e2e8f0;
        transform: translateY(-50%);
        z-index: 0;
    }

    .step-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        position: relative;
        z-index: 1;
    }

    .step-number {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1rem;
        background: #e2e8f0;
        color: #64748b;
        transition: all 0.3s ease;
        flex-shrink: 0;
        border: 3px solid #f8fafc;
    }

    .step-item.active .step-number {
        background: linear-gradient(135deg, var(--accent), var(--primary));
        color: white;
        box-shadow: 0 4px 15px rgba(0, 170, 204, 0.4);
        transform: scale(1.1);
    }

    .step-item.completed .step-number {
        background: var(--success);
        color: white;
    }

    .step-label {
        font-size: 0.9rem;
        font-weight: 600;
        color: #64748b;
    }

    .step-item.active .step-label {
        color: var(--primary);
    }

    .step-item.completed .step-label {
        color: var(--success);
    }

    .form-content {
        padding: 2.5rem 3rem;
    }

    .section-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }

    .section-card:hover {
        border-color: var(--accent);
        box-shadow: 0 5px 20px rgba(0, 170, 204, 0.1);
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e2e8f0;
    }

    .section-title i {
        color: var(--accent);
        font-size: 1.5rem;
    }

    .section-title h4 {
        margin: 0;
        color: var(--primary);
        font-weight: 700;
    }

    .form-label {
        font-weight: 600;
        color: #334155;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .form-control, .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.875rem 1rem;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 4px rgba(0, 170, 204, 0.1);
    }

    .form-control.is-invalid, .form-select.is-invalid {
        border-color: var(--danger);
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    .invalid-feedback {
        font-size: 0.8rem;
        color: var(--danger);
    }

    .input-group-text {
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-right: none;
        border-radius: 12px 0 0 12px;
        color: var(--primary);
    }

    .input-group .form-control {
        border-left: none;
        border-radius: 0 12px 12px 0;
    }

    .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 4px rgba(0, 58, 70, 0.1);
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        border: none;
        border-radius: 12px;
        padding: 1rem 2.5rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 58, 70, 0.3);
    }

    .btn-primary-custom:disabled {
        opacity: 0.7;
        transform: none;
    }

    .btn-gold {
        background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
        border: none;
        border-radius: 50px;
        padding: 14px 36px;
        font-weight: 700;
        color: var(--primary-dark);
        transition: all 0.3s ease;
    }

    .btn-gold:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        color: var(--primary-dark);
    }

    .btn-outline-light-custom {
        border: 2px solid rgba(255,255,255,0.5);
        border-radius: 50px;
        padding: 12px 28px;
        font-weight: 600;
        color: #fff;
        transition: all 0.3s ease;
    }

    .btn-outline-light-custom:hover {
        background: rgba(255,255,255,0.15);
        border-color: #fff;
        color: #fff;
    }

    .btn-outline-secondary-custom {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem 2rem;
        font-weight: 600;
        color: #64748b;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary-custom:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: #f0f9ff;
    }

    .form-step {
        display: none;
        animation: fadeIn 0.4s ease;
    }

    .form-step.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .info-box {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        border-radius: 16px;
        padding: 1.25rem;
        border-left: 4px solid var(--accent);
    }

    .info-box i {
        color: var(--accent);
    }

    .required-star {
        color: var(--danger);
    }

    .nav-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 1px solid #e2e8f0;
    }

    .required-badge {
        display: inline-block;
        background: #fef2f2;
        color: var(--danger);
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        margin-left: 0.5rem;
    }

    .file-upload {
        border: 2px dashed #e2e8f0;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .file-upload:hover {
        border-color: var(--accent);
        background: #f0f9ff;
    }

    .file-upload i {
        font-size: 2.5rem;
        color: var(--accent);
        margin-bottom: 1rem;
    }

    .review-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
    }

    .review-card h6 {
        color: var(--primary);
        font-weight: 700;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .review-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px dashed #e2e8f0;
    }

    .review-item:last-child {
        border-bottom: none;
    }

    .review-label {
        color: #64748b;
        font-size: 0.9rem;
    }

    .review-value {
        color: #1e293b;
        font-weight: 600;
        font-size: 0.9rem;
    }

    @media (max-width: 991px) {
        .hero-title { font-size: 2.5rem; }
        .hero-stats { gap: 2rem; }
        .hero-stat-number { font-size: 2rem; }
        .apply-hero { min-height: 50vh; }
    }

    @media (max-width: 768px) {
        .hero-title { font-size: 2rem; }
        .hero-description { font-size: 1.1rem; }
        .hero-stats { 
            flex-wrap: wrap; 
            justify-content: center;
            gap: 1.5rem;
        }
        .step-progress {
            padding: 1rem;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
        }
        .step-progress::before { display: none; }
        .form-header, .form-content {
            padding: 1.5rem;
        }
        .step-label { display: none; }
        .step-number {
            width: 40px;
            height: 40px;
            font-size: 0.9rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="position-relative d-flex align-items-center" style="min-height: 50vh; overflow: hidden;">
    <div class="position-absolute top-0 start-0 w-100 h-100">
        <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=1920&q=80" alt="Apply for Admission" class="w-100 h-100" style="object-fit: cover; object-position: center;">
    </div>
    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="background: linear-gradient(135deg, rgba(0,58,70,0.9) 0%, rgba(0,95,107,0.8) 50%, rgba(0,170,204,0.6) 100%);">
    </div>
    <div class="container position-relative">
        <h1 class="display-4 fw-bold text-white mb-2" style="text-shadow: 0 2px 20px rgba(0,0,0,0.3);">
            {{ app()->getLocale() === 'km' ? 'ដាក់ពាក្យ' : 'Apply for' }} {{ $program->title }}
        </h1>
        <p class="lead text-white" style="opacity: 0.9;">
            {{ app()->getLocale() === 'km' ? 'ចាប់ផ្តើមដំណើររបស់អ្នកក្នុងវិស័យច្បាប់' : 'Begin your journey in law' }}
        </p>
    </div>
</section>
                                    <h6 class="fw-bold mb-0" style="font-size: 0.85rem; color: #1e293b;">{{ $program->duration_years }} {{ app()->getLocale() === 'km' ? 'ឆ្នាំ' : 'Years' }}</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center p-2 rounded-2 mb-2" style="background: white;">
                                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, var(--accent), var(--primary)); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; margin-right: 0.75rem; flex-shrink: 0;">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0" style="font-size: 0.85rem; color: #1e293b;">${{ number_format($program->tuition_fee) }}/{{ app()->getLocale() === 'km' ? 'ឆ្នាំ' : 'year' }}</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center p-2 rounded-2 mb-2" style="background: white;">
                                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; margin-right: 0.75rem; flex-shrink: 0;">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0" style="font-size: 0.85rem; color: #1e293b;">50 {{ app()->getLocale() === 'km' ? 'កន្លែង' : 'Seats' }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
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

<!-- Form Section -->
<div class="container pb-5 mt-5" style="margin-top: 80px !important;" id="apply-form">
    <div class="form-container">
        <!-- Form Header -->
        <div class="form-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3><i class="bi bi-pencil-square me-2"></i>{{ app()->getLocale() === 'km' ? 'ពាក្យចូលរៀន' : 'Online Application' }}</h3>
                    <p>{{ app()->getLocale() === 'km' ? 'បំពេញព័ត៌មានខាងក្រោមដើម្បីដាក់ពាក្យ' : 'Complete the form below to submit your application' }}</p>
                </div>
                <div class="text-end d-none d-md-block">
                    <div style="font-size: 0.85rem; opacity: 0.8;">{{ app()->getLocale() === 'km' ? 'ថ្លៃពាក្យ' : 'Application Fee' }}</div>
                    <div style="font-size: 1.75rem; font-weight: 800;">$50</div>
                </div>
            </div>
        </div>

        <!-- Step Progress -->
        <div class="step-progress">
            <div class="step-item active" data-step="1">
                <div class="step-number">1</div>
                <span class="step-label">{{ app()->getLocale() === 'km' ? 'ផ្ទាល់ខ្លួន' : 'Personal' }}</span>
            </div>
            <div class="step-item" data-step="2">
                <div class="step-number">2</div>
                <span class="step-label">{{ app()->getLocale() === 'km' ? 'អប់រំ' : 'Education' }}</span>
            </div>
            <div class="step-item" data-step="3">
                <div class="step-number">3</div>
                <span class="step-label">{{ app()->getLocale() === 'km' ? 'បន្ថែម' : 'Additional' }}</span>
            </div>
            <div class="step-item" data-step="4">
                <div class="step-number">4</div>
                <span class="step-label">{{ app()->getLocale() === 'km' ? 'ពិនិត្យ' : 'Review' }}</span>
            </div>
        </div>

        <!-- Form Content -->
        <div class="form-content">
            <form action="{{ route('public.admission.submit', $program->slug) }}" method="POST" id="applicationForm">
                @csrf
                <input type="hidden" name="program_id" value="{{ $program->id }}">

                <!-- Step 1: Personal Information -->
                <div class="form-step active" data-step="1">
                    <div class="section-card">
                        <div class="section-title">
                            <i class="bi bi-person-fill"></i>
                            <h4>{{ app()->getLocale() === 'km' ? 'ព័ត៌មានផ្ទាល់ខ្លួន' : 'Personal Information' }}</h4>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">
                                    {{ app()->getLocale() === 'km' ? 'នាមត្រកូល (អង់គ្លេស)' : 'First Name (English)' }} 
                                    <span class="required-star">*</span>
                                </label>
                                <input type="text" class="form-control" name="first_name_en" required placeholder="John">
                                <div class="invalid-feedback">Please enter your first name</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    {{ app()->getLocale() === 'km' ? 'នាមខ្លួន (អង់គ្លេស)' : 'Last Name (English)' }} 
                                    <span class="required-star">*</span>
                                </label>
                                <input type="text" class="form-control" name="last_name_en" required placeholder="Doe">
                                <div class="invalid-feedback">Please enter your last name</div>
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label">{{ app()->getLocale() === 'km' ? 'នាមត្រកូល (ខ្មែរ)' : 'First Name (Khmer)' }}</label>
                                <input type="text" class="form-control" name="first_name_km" placeholder="ចន">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">{{ app()->getLocale() === 'km' ? 'នាមខ្លួន (ខ្មែរ)' : 'Last Name (Khmer)' }}</label>
                                <input type="text" class="form-control" name="last_name_km" placeholder="ដូណេ">
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label">
                                    {{ app()->getLocale() === 'km' ? 'អ៊ីមែល' : 'Email Address' }} 
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control" name="email" required placeholder="email@example.com">
                                </div>
                                <div class="invalid-feedback">Please enter a valid email</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    {{ app()->getLocale() === 'km' ? 'ទូរស័ព្ទ' : 'Phone Number' }} 
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                    <input type="tel" class="form-control" name="phone" required placeholder="+855 12 345 678">
                                </div>
                                <div class="invalid-feedback">Please enter your phone number</div>
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label">
                                    {{ app()->getLocale() === 'km' ? 'ថ្ងៃខែឆ្នាំកំណើត' : 'Date of Birth' }} 
                                    <span class="required-star">*</span>
                                </label>
                                <input type="date" class="form-control" name="date_of_birth" required>
                                <div class="invalid-feedback">Please select your date of birth</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    {{ app()->getLocale() === 'km' ? 'សញ្ជាតិ' : 'Nationality' }} 
                                    <span class="required-star">*</span>
                                </label>
                                <select class="form-select" name="nationality" required>
                                    <option value="">{{ app()->getLocale() === 'km' ? 'ជ្រើសរើស' : 'Select nationality' }}</option>
                                    <option value="Cambodian">Cambodian</option>
                                    <option value="Foreign">Foreign</option>
                                </select>
                                <div class="invalid-feedback">Please select your nationality</div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="form-label">
                                {{ app()->getLocale() === 'km' ? 'អាសយដ្ឋានបច្ចុប្បន្ន' : 'Current Address' }} 
                                <span class="required-star">*</span>
                            </label>
                            <textarea class="form-control" name="address" rows="2" required placeholder="{{ app()->getLocale() === 'km' ? 'អាសយដ្ឋានបច្ចុប្បន្ន' : 'Enter your current address' }}"></textarea>
                            <div class="invalid-feedback">Please enter your address</div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Educational Information -->
                <div class="form-step" data-step="2">
                    <div class="section-card">
                        <div class="section-title">
                            <i class="bi bi-book-fill"></i>
                            <h4>{{ app()->getLocale() === 'km' ? 'ព័ត៌មានអប់រំ' : 'Educational Background' }}</h4>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">
                                    {{ app()->getLocale() === 'km' ? 'សាលាបឋមសិក្សា / បណ្ឌិត' : 'High School / University' }} 
                                    <span class="required-star">*</span>
                                </label>
                                <input type="text" class="form-control" name="high_school" required placeholder="School/University Name">
                                <div class="invalid-feedback">Please enter your school/university name</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    {{ app()->getLocale() === 'km' ? 'ឆ្នាំបញ្ចប់' : 'Graduation Year' }} 
                                    <span class="required-star">*</span>
                                </label>
                                <input type="number" class="form-control" name="graduation_year" min="1950" max="{{ date('Y') + 1 }}" required placeholder="{{ date('Y') }}">
                                <div class="invalid-feedback">Please enter graduation year</div>
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label">
                                    {{ app()->getLocale() === 'km' ? 'មេគុណ GPA' : 'Grade Point Average (GPA)' }} 
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="gpa" min="0" max="4" step="0.01" required placeholder="3.5">
                                    <span class="input-group-text">/ 4.0</span>
                                </div>
                                <div class="invalid-feedback">Please enter your GPA (0-4)</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    {{ app()->getLocale() === 'km' ? 'កម្រិតភាសាអង់គ្លេស' : 'English Proficiency' }} 
                                    <span class="required-star">*</span>
                                </label>
                                <select class="form-select" name="english_level" required>
                                    <option value="">{{ app()->getLocale() === 'km' ? 'ជ្រើសរើស' : 'Select level' }}</option>
                                    <option value="beginner">{{ app()->getLocale() === 'km' ? 'ដំបូង' : 'Beginner' }}</option>
                                    <option value="intermediate">{{ app()->getLocale() === 'km' ? 'មធ្យម' : 'Intermediate' }}</option>
                                    <option value="advanced">{{ app()->getLocale() === 'km' ? 'កម្រិតខ្ពស់' : 'Advanced' }}</option>
                                    <option value="fluent">{{ app()->getLocale() === 'km' ? 'ចេះចប់' : 'Fluent' }}</option>
                                </select>
                                <div class="invalid-feedback">Please select your English level</div>
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label">{{ app()->getLocale() === 'km' ? 'ប្រភេទប្រេស្ស' : 'Education Type' }}</label>
                                <select class="form-select" name="education_type">
                                    <option value="high_school">{{ app()->getLocale() === 'km' ? 'បឋមសិក្សា' : 'High School' }}</option>
                                    <option value="bachelor">{{ app()->getLocale() === 'km' ? 'បរិញ្ញាបត្រ' : "Bachelor's Degree" }}</option>
                                    <option value="other">{{ app()->getLocale() === 'km' ? 'ផ្សេងៗ' : 'Other' }}</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">{{ app()->getLocale() === 'km' ? 'ប្រវត្តិការសិក្សា' : 'Study Gap (if any)' }}</label>
                                <input type="text" class="form-control" name="study_gap" placeholder="{{ app()->getLocale() === 'km' ? 'ប្រសិនបើមាន' : 'If you took a break' }}">
                            </div>
                        </div>

                        <div class="info-box mt-4">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-info-circle-fill me-3 mt-1"></i>
                                <div>
                                    <strong>{{ app()->getLocale() === 'km' ? 'ចំណេះដឹងបន្ថែម' : 'Additional Information' }}</strong>
                                    <p class="mb-0 mt-1 small" style="color: #333;">
                                        {{ app()->getLocale() === 'km' ? 
                                            'អ្នកនឹងអាចបង្ហោះឯកសារបន្ថែម (រូបភាព វិញ្ញាបត្រ និងឯកសារផ្សេងៗ) បន្ទាប់ពីដាក់ពាក្យដោយជោគជ។' : 
                                            'You will be able to upload additional documents (photo, certificates, etc.) after successfully submitting your application.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Additional Information -->
                <div class="form-step" data-step="3">
                    <div class="section-card">
                        <div class="section-title">
                            <i class="bi bi-file-text-fill"></i>
                            <h4>{{ app()->getLocale() === 'km' ? 'ព័ត៌មានបន្ថែម' : 'Additional Information' }}</h4>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                {{ app()->getLocale() === 'km' ? 'សំបុត្របំពេចិត្ត / មូលហេតុ' : 'Motivation Letter / Personal Statement' }} 
                                <span class="required-star">*</span>
                            </label>
                            <textarea class="form-control" name="motivation_letter" rows="5" required
                                placeholder="{{ app()->getLocale() === 'km' ? 'សូមពន្យល់ពីមូលហេតុដែលអ្នកចង់សិក្សាផ្នែកច្បាប់...' : 'Please explain why you want to study law and your career aspirations...' }}"></textarea>
                            <div class="invalid-feedback">Please write your motivation letter</div>
                            <small class="text-muted">{{ app()->getLocale() === 'km' ? 'យ៉ាងតិច 200 ពាក្យ' : 'Minimum 200 characters' }}</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">{{ app()->getLocale() === 'km' ? 'បទពិសោធន៍ការងារ' : 'Work Experience' }}</label>
                            <textarea class="form-control" name="experience" rows="3" 
                                placeholder="{{ app()->getLocale() === 'km' ? 'បទពិសោធន៍ការងារ (ប្រសិនបើមាន)' : 'List any relevant work experience...' }}"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">{{ app()->getLocale() === 'km' ? 'សម្រេចការ ឬ រង្វាន់' : 'Achievements & Awards' }}</label>
                            <textarea class="form-control" name="achievements" rows="3" 
                                placeholder="{{ app()->getLocale() === 'km' ? 'សម្រេចការ ឬ រង្វាន់ដែលអ្នកទទួលបាន...' : 'List any achievements, awards, or recognitions...' }}"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">{{ app()->getLocale() === 'km' ? 'ចំណាប់អារម្មណ៍ផ្សេងៗ' : 'Other Interests & Activities' }}</label>
                            <textarea class="form-control" name="interests" rows="2" 
                                placeholder="{{ app()->getLocale() === 'km' ? 'ចំណាប់អារម្មណ៍ និងសកម្មភាពផ្សេងៗ...' : 'Other interests, extracurricular activities...' }}"></textarea>
                        </div>
                    </div>

                    <div class="section-card">
                        <div class="section-title">
                            <i class="bi bi-person-check-fill"></i>
                            <h4>{{ app()->getLocale() === 'km' ? 'ព័ត៌មានអ្នកណែនាំ' : 'Reference Information' }}</h4>
                        </div>
                        <p class="text-muted mb-3">{{ app()->getLocale() === 'km' ? 'បញ្ជាក់អ្នកណែនាំ (គ្រូ ឬ នាយកសាលា)' : 'Please provide a reference (teacher or school principal)' }}</p>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">
                                    {{ app()->getLocale() === 'km' ? 'ឈ្មោះ' : 'Full Name' }} 
                                    <span class="required-star">*</span>
                                </label>
                                <input type="text" class="form-control" name="reference_name" required>
                                <div class="invalid-feedback">Please enter reference name</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">
                                    {{ app()->getLocale() === 'km' ? 'អ៊ីមែល' : 'Email' }} 
                                    <span class="required-star">*</span>
                                </label>
                                <input type="email" class="form-control" name="reference_email" required>
                                <div class="invalid-feedback">Please enter reference email</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">
                                    {{ app()->getLocale() === 'km' ? 'ទូរស័ព្ទ' : 'Phone' }} 
                                    <span class="required-star">*</span>
                                </label>
                                <input type="tel" class="form-control" name="reference_phone" required>
                                <div class="invalid-feedback">Please enter reference phone</div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="form-label">{{ app()->getLocale() === 'km' ? 'តួនាទី' : 'Position/Title' }}</label>
                            <input type="text" class="form-control" name="reference_title" placeholder="{{ app()->getLocale() === 'km' ? 'ឧបករណ៍ ឬ តួនាទី' : 'e.g., School Principal, Teacher' }}">
                        </div>
                    </div>
                </div>

                <!-- Step 4: Review & Submit -->
                <div class="form-step" data-step="4">
                    <div class="section-card">
                        <div class="section-title">
                            <i class="bi bi-check-circle-fill"></i>
                            <h4>{{ app()->getLocale() === 'km' ? 'ពិនិត្យឡើងវិញ' : 'Review Your Application' }}</h4>
                        </div>

                        <div class="alert" style="background: linear-gradient(135deg, #f0f9ff, #e0f2fe); border-radius: 12px; border-left: 4px solid var(--accent);">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-info-circle-fill me-3 mt-1" style="color: var(--accent);"></i>
                                <div>
                                    <strong>{{ app()->getLocale() === 'km' ? 'មតិយោបល់' : 'Please Review' }}</strong>
                                    <p class="mb-0 mt-1 small" style="color: #333;">
                                        {{ app()->getLocale() === 'km' ? 
                                            'សូមពិនិត្យមើលព័ត៌មានទាំងអស់ឡើងវិញ មុនពេលដាក់ពាក្យ។ អ្នកនឹងទទួលបានអ៊ីមែលបញ្ជាក់ បន្ទាប់ពីដាក់ពាក្យដោយជោគជ។' : 
                                            'Please review all information carefully before submitting. You will receive a confirmation email after successful submission.' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="review-card">
                            <h6><i class="bi bi-person me-2"></i>{{ app()->getLocale() === 'km' ? 'ព័ត៌មានផ្ទាល់ខ្លួន' : 'Personal Information' }}</h6>
                            <div class="review-item">
                                <span class="review-label">{{ app()->getLocale() === 'km' ? 'ឈ្មោះ' : 'Name' }}</span>
                                <span class="review-value" id="review-name">-</span>
                            </div>
                            <div class="review-item">
                                <span class="review-label">{{ app()->getLocale() === 'km' ? 'អ៊ីមែល' : 'Email' }}</span>
                                <span class="review-value" id="review-email">-</span>
                            </div>
                            <div class="review-item">
                                <span class="review-label">{{ app()->getLocale() === 'km' ? 'ទូរស័ព្ទ' : 'Phone' }}</span>
                                <span class="review-value" id="review-phone">-</span>
                            </div>
                        </div>

                        <div class="review-card">
                            <h6><i class="bi bi-book me-2"></i>{{ app()->getLocale() === 'km' ? 'ព័ត៌មានអប់រំ' : 'Education' }}</h6>
                            <div class="review-item">
                                <span class="review-label">{{ app()->getLocale() === 'km' ? 'សាលា' : 'School' }}</span>
                                <span class="review-value" id="review-school">-</span>
                            </div>
                            <div class="review-item">
                                <span class="review-label">{{ app()->getLocale() === 'km' ? 'GPA' : 'GPA' }}</span>
                                <span class="review-value" id="review-gpa">-</span>
                            </div>
                            <div class="review-item">
                                <span class="review-label">{{ app()->getLocale() === 'km' ? 'ភាសាអង់គ្លេស' : 'English Level' }}</span>
                                <span class="review-value" id="review-english">-</span>
                            </div>
                        </div>

                        <div class="review-card">
                            <h6><i class="bi bi-calendar me-2"></i>{{ app()->getLocale() === 'km' ? 'កម្មវិធី' : 'Program' }}</h6>
                            <div class="review-item">
                                <span class="review-label">{{ app()->getLocale() === 'km' ? 'កម្មវិធី' : 'Program' }}</span>
                                <span class="review-value">{{ $program->title }}</span>
                            </div>
                            <div class="review-item">
                                <span class="review-label">{{ app()->getLocale() === 'km' ? 'ថ្លៃ' : 'Tuition' }}</span>
                                <span class="review-value">${{ number_format($program->tuition_fee) }}/{{ app()->getLocale() === 'km' ? 'ឆ្នាំ' : 'year' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-check mt-4 p-4" style="background: #f8fafc; border-radius: 12px; border: 2px solid #e2e8f0;">
                        <input class="form-check-input" type="checkbox" name="terms_accepted" value="1" required id="termsCheck">
                        <label class="form-check-label" for="termsCheck">
                            {{ app()->getLocale() === 'km' ? 
                                'ខ្ញុំបានអាន និងយល់ព្រមនឹងលក្ខខណ្ឌ និងបញ្ជាក់ថាព័ត៌មានដែលផ្តល់គឺត្រឹមត្រូវ និងពិតប្រាកដ។' : 
                                'I have read and agree to the terms and conditions, and certify that all information provided is accurate and truthful.' }}
                            <span class="required-star">*</span>
                        </label>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="nav-buttons">
                    <button type="button" class="btn btn-outline-secondary-custom" id="prevBtn">
                        <i class="bi bi-arrow-left me-2"></i>
                        {{ app()->getLocale() === 'km' ? 'ត្រឡប់' : 'Previous' }}
                    </button>
                    <button type="button" class="btn btn-primary-custom" id="nextBtn">
                        {{ app()->getLocale() === 'km' ? 'បន្ត' : 'Next' }}
                        <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                    <button type="submit" class="btn btn-primary-custom" id="submitBtn" style="display: none;">
                        <i class="bi bi-send me-2"></i>
                        {{ app()->getLocale() === 'km' ? 'ដាក់ពាក្យ' : 'Submit Application' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const steps = document.querySelectorAll('.step-item');
    const formSteps = document.querySelectorAll('.form-step');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');
    let currentStep = 1;
    const totalSteps = 4;

    function updateStep(step) {
        steps.forEach((stepEl, index) => {
            const stepNum = index + 1;
            stepEl.classList.remove('active', 'completed');
            if (stepNum < step) {
                stepEl.classList.add('completed');
            } else if (stepNum === step) {
                stepEl.classList.add('active');
            }
        });

        formSteps.forEach(formStep => {
            formStep.classList.remove('active');
            if (parseInt(formStep.dataset.step) === step) {
                formStep.classList.add('active');
            }
        });

        prevBtn.style.visibility = step === 1 ? 'hidden' : 'visible';
        
        if (step === totalSteps) {
            nextBtn.style.display = 'none';
            submitBtn.style.display = 'inline-flex';
            updateReview();
        } else {
            nextBtn.style.display = 'inline-flex';
            submitBtn.style.display = 'none';
        }
        
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function updateReview() {
        const firstName = document.querySelector('input[name="first_name_en"]').value;
        const lastName = document.querySelector('input[name="last_name_en"]').value;
        const email = document.querySelector('input[name="email"]').value;
        const phone = document.querySelector('input[name="phone"]').value;
        const school = document.querySelector('input[name="high_school"]').value;
        const gpa = document.querySelector('input[name="gpa"]').value;
        const englishLevel = document.querySelector('select[name="english_level"]').value;

        document.getElementById('review-name').textContent = firstName + ' ' + lastName;
        document.getElementById('review-email').textContent = email;
        document.getElementById('review-phone').textContent = phone;
        document.getElementById('review-school').textContent = school;
        document.getElementById('review-gpa').textContent = gpa + ' / 4.0';
        
        const englishLabels = {
            'beginner': '{{ app()->getLocale() === "km" ? "ដំបូង" : "Beginner" }}',
            'intermediate': '{{ app()->getLocale() === "km" ? "មធ្យម" : "Intermediate" }}',
            'advanced': '{{ app()->getLocale() === "km" ? "កម្រិតខ្ពស់" : "Advanced" }}',
            'fluent': '{{ app()->getLocale() === "km" ? "ចេះចប់" : "Fluent" }}'
        };
        document.getElementById('review-english').textContent = englishLabels[englishLevel] || '-';
    }

    function validateStep(step) {
        const currentFormStep = document.querySelector(`.form-step[data-step="${step}"]`);
        const inputs = currentFormStep.querySelectorAll('[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            const errorMessage = "{{ app()->getLocale() === 'km' ? 'សូមបំពេញព័ត៌មានចាំបាច់ទាំងអស់' : 'Please fill in all required fields' }}";
            alert(errorMessage);
        }

        return isValid;
    }

    nextBtn.addEventListener('click', function() {
        if (validateStep(currentStep)) {
            if (currentStep < totalSteps) {
                currentStep++;
                updateStep(currentStep);
            }
        }
    });

    prevBtn.addEventListener('click', function() {
        if (currentStep > 1) {
            currentStep--;
            updateStep(currentStep);
        }
    });

    const gpaInput = document.querySelector('input[name="gpa"]');
    if (gpaInput) {
        gpaInput.addEventListener('blur', function() {
            const gpa = parseFloat(this.value);
            if (this.value && (gpa < 0 || gpa > 4)) {
                alert("{{ app()->getLocale() === 'km' ? 'GPA ត្រូវតែនៅចន្លោះ 0 និង 4' : 'GPA must be between 0 and 4' }}");
                this.value = '';
                this.focus();
            }
        });
    }

    const form = document.getElementById('applicationForm');
    form.addEventListener('submit', function() {
        const termsCheck = document.getElementById('termsCheck');
        if (!termsCheck.checked) {
            alert("{{ app()->getLocale() === 'km' ? 'សូមយល់ព្រមនឹងលក្ខខណ្ឌ' : 'Please accept the terms and conditions' }}");
            return false;
        }
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> {{ app()->getLocale() === "km" ? "កំពុងដាក់..." : "Submitting..." }}';
        return true;
    });

    // Remove invalid class on input
    document.querySelectorAll('.form-control, .form-select').forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });
    });
});
</script>
@endpush
@endsection
