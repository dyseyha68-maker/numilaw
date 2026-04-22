@extends('layouts.public')

@section('title', $locale === 'kh' ? 'ដាក់ពាក់' : 'Apply Now')

@push('styles')
<style>
    :root {
        --brand-primary: #003A46;
        --brand-light: #005f73;
        --brand-accent: #0a9396;
    }
    
    .apply-header {
        position: relative;
        overflow: hidden;
        background: #f5f8ff;
        min-height: 280px;
        padding: 65px 0;
    }

    .apply-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .apply-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .apply-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .apply-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .apply-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .apply-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .apply-header .b5 {
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
        25%  { background: #48e8c8; }
        50%  { background: #a8f030; }
        75%  { background: #68f028; }
        100% { background: #b8f050; }
    }
    @keyframes colorB3 {
        0%   { background: #28e8a0; }
        25%  { background: #f0d830; }
        50%  { background: #38e860; }
        75%  { background: #d8f040; }
        100% { background: #28e8a0; }
    }
    @keyframes colorB4 {
        0%   { background: #c0f048; }
        25%  { background: #38e8b8; }
        50%  { background: #88f038; }
        75%  { background: #18e888; }
        100% { background: #c0f048; }
    }
    @keyframes colorB5 {
        0%   { background: #58e870; }
        25%  { background: #d0f028; }
        50%  { background: #40e880; }
        75%  { background: #f05840; }
        100% { background: #58e870; }
    }
    
    .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }
    
    .header-title {
        font-size: 2.5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--brand-primary);
        margin-bottom: 0.5rem;
    }
    
    .header-subtitle {
        font-size: 1.1rem;
        color: #6b7280;
    }
    
    .breadcrumb-nav {
        padding: 0;
        margin: 0;
        list-style: none;
        display: flex;
        gap: 8px;
        align-items: center;
        font-size: 0.875rem;
    }
    
    .breadcrumb-nav li {
        display: flex;
        align-items: center;
    }
    
    .breadcrumb-nav li a {
        color: var(--brand-primary);
        text-decoration: none;
        opacity: 0.7;
        transition: opacity 0.2s;
    }
    
    .breadcrumb-nav li a:hover {
        opacity: 1;
    }
    
    .breadcrumb-nav li::after {
        content: '/';
        margin-left: 8px;
        color: #d1d5db;
    }
    
    .breadcrumb-nav li:last-child::after {
        content: '';
    }
    
    .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, transparent, #f8fafb);
        pointer-events: none;
    }
    
    .form-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        padding: 30px;
        margin-top: -30px;
    }
</style>
@endpush

@section('content')
<!-- Hero Section with Blob Animation -->
<section class="apply-header">
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
            <ul class="breadcrumb-nav">
                <li><a href="{{ url('/') }}">{{ $locale === 'kh' ? 'ទំព័រដេី' : 'Home' }}</a></li>
                <li><a href="{{ route('admissions.index') }}">{{ $locale === 'kh' ? 'ការទទួលយក' : 'Admissions' }}</a></li>
                <li>{{ $locale === 'kh' ? 'ដាក់ពាក់' : 'Apply Now' }}</li>
            </ul>
            <h1 class="header-title">
                {{ $locale === 'kh' ? 'ដាក់ពាក់កម្មវិធី' : 'Apply Now' }}
            </h1>
            <p class="header-subtitle">
                {{ $locale === 'kh' 
                    ? 'បំពេញទំរង់ខាងក្រោមដើម្បីដាក់ពាក់'
                    : 'Fill out the form below to apply' }}
            </p>
        </div>
    </div>
</section>

<div class="container pb-5">
    <div class="form-card">
        @if(session('success'))
        <div class="alert alert-success d-flex align-items-center mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
        @endif
        
        @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <form method="POST" action="{{ route('admissions.store') }}" enctype="multipart/form-data">
            @csrf
            
            <!-- Step 1: Personal Info -->
            <h5 class="fw-bold mb-4" style="color: #003A46;">
                {{ $locale === 'kh' ? '១. ព័ត៌មានផ្ទាល់ខ្លួន' : '1. Personal Information' }}
            </h5>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">{{ $locale === 'kh' ? 'កម្មវិធី *' : 'Program *' }}</label>
                    <select class="form-select" name="program_id" required>
                        <option value="">{{ $locale === 'kh' ? 'ជ្រើសរើស' : 'Select' }}</option>
                        @foreach($programs as $program)
                        <option value="{{ $program->id }}">{{ $locale === 'kh' ? $program->name_kh : $program->name_en }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">{{ $locale === 'kh' ? ' Intake *' : 'Intake *' }}</label>
                    <select class="form-select" name="intake_id" required>
                        <option value="">{{ $locale === 'kh' ? 'ជ្រើសរើស' : 'Select' }}</option>
                        @foreach($intakes as $intake)
                        <option value="{{ $intake->id }}">{{ $locale === 'kh' ? $intake->intake_name_kh : $intake->intake_name_en }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">{{ $locale === 'kh' ? 'ឈ្មោះ (អង់គ្លេស) *' : 'Full Name (English) *' }}</label>
                    <input type="text" class="form-control" name="full_name_en" required>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">{{ $locale === 'kh' ? 'ឈ្មោះ (ខ្មែរ) *' : 'Full Name (Khmer) *' }}</label>
                    <input type="text" class="form-control" name="full_name_kh" required>
                </div>
                
                <div class="col-md-4">
                    <label class="form-label">{{ $locale === 'kh' ? 'ថ្ងៃខែឆ្នេះកើត *' : 'Date of Birth *' }}</label>
                    <input type="date" class="form-control" name="date_of_birth" required>
                </div>
                
                <div class="col-md-4">
                    <label class="form-label">{{ $locale === 'kh' ? 'ភេទ *' : 'Gender *' }}</label>
                    <select class="form-select" name="gender" required>
                        <option value="">{{ $locale === 'kh' ? 'ជ្រើសរើស' : 'Select' }}</option>
                        <option value="male">{{ $locale === 'kh' ? 'ប្រុស' : 'Male' }}</option>
                        <option value="female">{{ $locale === 'kh' ? 'ស្រី' : 'Female' }}</option>
                        <option value="other">{{ $locale === 'kh' ? ' ផ្សេងទៀត' : 'Other' }}</option>
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label class="form-label">{{ $locale === 'kh' ? 'សេចក្តីស្នេហ៍' : 'Nationality' }}</label>
                    <input type="text" class="form-control" name="nationality" value="Cambodian">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">{{ $locale === 'kh' ? 'លេខកាយប្រជាតិ' : 'ID Card Number' }}</label>
                    <input type="text" class="form-control" name="id_card_number">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">{{ $locale === 'kh' ? 'លេខទូរស័ព្ទ *' : 'Phone *' }}</label>
                    <input type="text" class="form-control" name="phone" required>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">{{ $locale === 'kh' ? 'អ៊ីមែល *' : 'Email *' }}</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                
                <div class="col-12">
                    <label class="form-label">{{ $locale === 'kh' ? 'អាស័យដ្ឋាន *' : 'Address *' }}</label>
                    <textarea class="form-control" name="address_en" rows="2" required></textarea>
                </div>
            </div>
            
            <hr class="my-5">
            
            <!-- Step 2: Academic Background -->
            <h5 class="fw-bold mb-4" style="color: #003A46;">
                {{ $locale === 'kh' ? '២. ប្រវត្តិសិក្សា' : '2. Academic Background' }}
            </h5>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">{{ $locale === 'kh' ? ' សាលាចុងកង្ហារ *' : 'Previous School *' }}</label>
                    <input type="text" class="form-control" name="previous_school_en" required>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">{{ $locale === 'kh' ? ' សាលា (ខ្មែរ)' : 'Previous School (KH)' }}</label>
                    <input type="text" class="form-control" name="previous_school_kh">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">{{ $locale === 'kh' ? ' ឆ្នាំបញ្ចប់ *' : 'Graduation Year *' }}</label>
                    <input type="number" class="form-control" name="graduation_year" min="1990" max="2030" required>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">{{ $locale === 'kh' ? ' GPA' : 'GPA' }}</label>
                    <input type="number" class="form-control" name="gpa" step="0.01" min="0" max="4">
                </div>
            </div>
            
            <hr class="my-5">
            
            <!-- Step 3: Documents -->
            <h5 class="fw-bold mb-4" style="color: #003A46;">
                {{ $locale === 'kh' ? '៣. ឯកសារ' : '3. Documents' }}
            </h5>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">{{ $locale === 'kh' ? 'រូបថតបុគ្គល' : 'Passport Photo' }}</label>
                    <input type="file" class="form-control" name="photo" accept="image/*">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">{{ $locale === 'kh' ? 'រូបថតអត្តបទ' : 'ID Card Photo' }}</label>
                    <input type="file" class="form-control" name="id_card" accept="image/*">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">{{ $locale === 'kh' ? ' សញ្ញាប័ត្រ' : 'Certificate' }}</label>
                    <input type="file" class="form-control" name="certificate" accept="pdf,image/*">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">{{ $locale === 'kh' ? ' តារាងពិន្ទុ' : 'Transcript' }}</label>
                    <input type="file" class="form-control" name="transcript" accept="pdf">
                </div>
                
                <div class="col-12">
                    <label class="form-label">{{ $locale === 'kh' ? ' លិខិតណែនាំ' : 'Recommendation Letter' }}</label>
                    <input type="file" class="form-control" name="recommendation_letter" accept="pdf">
                </div>
            </div>
            
            <hr class="my-5">
            
            <!-- Step 4: Submit -->
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                {{ $locale === 'kh' 
                    ? 'បន្ទាប់ពីដាក់ពាក់ អ្នកនឹងទទួលបានលេខយោងមួយ ដើម្បីតាមដំណើរពាក្យរបស់អ្នក។'
                    : 'After submitting, you will receive a reference number to track your application.' }}
            </div>
            
            <button type="submit" class="btn btn-primary btn-lg w-100">
                <i class="bi bi-send me-2"></i>
                {{ $locale === 'kh' ? ' ដាក់ពាក់' : 'Submit Application' }}
            </button>
        </form>
    </div>
</div>
@endsection
