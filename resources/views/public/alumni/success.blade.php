@extends('layouts.public')

@section('title', __('alumni.success_stories'))

@push('styles')
<style>
    :root {
        --brand-primary: #003A46;
        --brand-light: #005f73;
        --brand-accent: #0a9396;
        --brand-gradient: linear-gradient(135deg, #003A46 0%, #005f73 50%, #0a9396 100%);
    }
    
    .brand-text { color: var(--brand-primary); }
    .brand-bg { background: var(--brand-primary); }
    .brand-gradient { background: var(--brand-gradient); }
    
    .alumni-success-header {
        position: relative;
        overflow: hidden;
        background: #f5f8ff;
        min-height: 350px;
        padding: 65px 0;
    }

    .alumni-success-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .alumni-success-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .alumni-success-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .alumni-success-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .alumni-success-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .alumni-success-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .alumni-success-header .b5 {
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

    .alumni-success-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,248,255,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .alumni-success-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .alumni-success-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .alumni-success-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }
    
    .success-icon {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #22c55e, #16a34a);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        box-shadow: 0 20px 60px rgba(34, 197, 94, 0.4);
    }
    
    .success-icon i {
        font-size: 3.5rem;
        color: white;
    }
    
    .info-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 58, 70, 0.08);
        border: none;
    }
    
    .info-card .card-body {
        padding: 2rem;
    }
    
    .step-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1.5rem;
    }
    
    .step-number {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: var(--brand-gradient);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.25rem;
        flex-shrink: 0;
        margin-right: 1rem;
    }
    
    .step-content h6 {
        color: var(--brand-primary);
        font-weight: 700;
        margin-bottom: 0.25rem;
    }
    
    .step-content p {
        color: #64748b;
        margin-bottom: 0;
    }
    
    .benefit-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 58, 70, 0.08);
        border: none;
        transition: all 0.3s;
        height: 100%;
    }
    
    .benefit-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 58, 70, 0.15);
    }
    
    .benefit-card .card-body {
        padding: 2rem;
        text-align: center;
    }
    
    .benefit-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }
    
    .benefit-icon i {
        font-size: 2rem;
    }
    
    .benefit-icon.network {
        background: linear-gradient(135deg, #dbeafe, #93c5fd);
        color: #1e40af;
    }
    
    .benefit-icon.career {
        background: linear-gradient(135deg, #dcfce7, #86efac);
        color: #166534;
    }
    
    .benefit-icon.events {
        background: linear-gradient(135deg, #e0f2fe, #7dd3fc);
        color: #0369a1;
    }
    
    .benefit-icon.recognize {
        background: linear-gradient(135deg, #fef3c7, #fcd34d);
        color: #92400e;
    }
    
    .btn-brand {
        background: var(--brand-gradient);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 14px 32px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-brand:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0, 58, 70, 0.3);
        color: white;
    }
    
    .btn-outline-brand {
        background: transparent;
        color: var(--brand-primary);
        border: 2px solid var(--brand-primary);
        border-radius: 12px;
        padding: 14px 32px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-outline-brand:hover {
        background: var(--brand-primary);
        color: white;
    }
</style>
@endpush

@section('content')
<!-- Success Hero Section -->
<section class="alumni-success-header">
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
            <div class="text-center">
                <div class="success-icon mb-4">
                    <i class="bi bi-check-lg"></i>
                </div>
                <h1 class="header-title">{{ __('alumni.registration_successful') }}</h1>
                <p class="header-subtitle mb-5">
                    Your alumni registration has been successfully submitted for review.<br>
                    We will notify you once it's approved.
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('public.alumni.index') }}" class="btn btn-brand btn-lg fw-semibold">
                        <i class="bi bi-arrow-left me-2"></i>{{ __('alumni.alumni_directory') }}
                    </a>
                    <a href="{{ route('public.home') }}" class="btn btn-outline-brand btn-lg fw-semibold">
                        <i class="bi bi-house me-2"></i>{{ __('common.home') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Information Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="info-card">
                    <div class="card-body">
                        <h4 class="brand-text fw-bold mb-4">{{ __('alumni.what_happens_next') }}</h4>
                        
                        <div class="step-item">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <h6>Review Process</h6>
                                <p>Your registration will be reviewed by our alumni administration team.</p>
                            </div>
                        </div>
                        
                        <div class="step-item">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <h6>Approval Notification</h6>
                                <p>You'll receive an email once your registration is approved.</p>
                            </div>
                        </div>
                        
                        <div class="step-item">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <h6>Profile Activation</h6>
                                <p>Your alumni profile will become active and searchable.</p>
                            </div>
                        </div>
                        
                        <div class="step-item">
                            <div class="step-number">4</div>
                            <div class="step-content">
                                <h6>Network Access</h6>
                                <p>You can connect with fellow alumni and access all alumni features.</p>
                            </div>
                        </div>
                        
                        <div class="step-item">
                            <div class="step-number">5</div>
                            <div class="step-content">
                                <h6>Stay Connected</h6>
                                <p>Receive updates about alumni events and opportunities.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="h1 fw-bold brand-text mb-3">{{ __('alumni.benefits_title') }}</h2>
            <p class="lead text-muted">{{ __('alumni.benefits_description') }}</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="benefit-card">
                    <div class="card-body">
                        <div class="benefit-icon network">
                            <i class="bi bi-people"></i>
                        </div>
                        <h5 class="brand-text fw-bold mb-2">{{ __('alumni.network_benefit') }}</h5>
                        <p class="text-muted mb-0">{{ __('alumni.network_benefit_description') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="benefit-card">
                    <div class="card-body">
                        <div class="benefit-icon career">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <h5 class="brand-text fw-bold mb-2">{{ __('alumni.career_benefit') }}</h5>
                        <p class="text-muted mb-0">{{ __('alumni.career_benefit_description') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="benefit-card">
                    <div class="card-body">
                        <div class="benefit-icon events">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <h5 class="brand-text fw-bold mb-2">{{ __('alumni.events_benefit') }}</h5>
                        <p class="text-muted mb-0">{{ __('alumni.events_benefit_description') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="benefit-card">
                    <div class="card-body">
                        <div class="benefit-icon recognize">
                            <i class="bi bi-star"></i>
                        </div>
                        <h5 class="brand-text fw-bold mb-2">{{ __('alumni.recognition_benefit') }}</h5>
                        <p class="text-muted mb-0">{{ __('alumni.recognition_benefit_description') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center">
            <h2 class="h3 fw-bold brand-text mb-3">Questions?</h2>
            <p class="lead text-muted mb-4">
                Our alumni relations team is here to help you succeed.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="mailto:alumni@numilaw.edu" class="btn btn-brand">
                    <i class="bi bi-envelope me-2"></i>{{ __('alumni.contact_us') }}
                </a>
                <a href="{{ route('public.alumni.index') }}" class="btn btn-outline-brand">
                    <i class="bi bi-arrow-left me-2"></i>{{ __('alumni.back_to_directory') }}
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
