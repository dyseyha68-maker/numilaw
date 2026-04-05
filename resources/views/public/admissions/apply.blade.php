@extends('layouts.public')

@section('title', $locale === 'kh' ? 'ដាក់ពាក់' : 'Apply Now')

@push('styles')
<style>
    .apply-hero {
        background: linear-gradient(135deg, #003A46 0%, #004d5c 100%);
        padding: 60px 0;
    }
    
    .step-indicator {
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
    }
    
    .step-indicator .step {
        text-align: center;
        position: relative;
    }
    
    .step-indicator .step::after {
        content: '';
        position: absolute;
        top: 20px;
        left: 50%;
        width: 100%;
        height: 2px;
        background: #e5e7eb;
    }
    
    .step-indicator .step:last-child::after {
        display: none;
    }
    
    .step-indicator .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #e5e7eb;
        color: #6b7280;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        font-weight: bold;
        position: relative;
        z-index: 1;
    }
    
    .step-indicator .step.active .step-number,
    .step-indicator .step.completed .step-number {
        background: #003A46;
        color: white;
    }
    
    .step-indicator .step.active::after {
        background: #003A46;
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
<section class="apply-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center text-white">
                <h1 class="display-5 fw-bold mb-3">
                    {{ $locale === 'kh' ? 'ដាក់ពាក់កម្មវិធី' : 'Apply Now' }}
                </h1>
                <p class="mb-0 opacity-75">
                    {{ $locale === 'kh' 
                        ? 'បំពេញទំរង់ខាងក្រោមដើម្បីដាក់ពាក់'
                        : 'Fill out the form below to apply' }}
                </p>
            </div>
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
