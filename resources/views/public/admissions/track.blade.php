@extends('layouts.public')

@section('title', $locale === 'kh' ? 'តាមដំណើរ' : 'Track Application')

@push('styles')
<style>
    .track-hero {
        background: linear-gradient(135deg, #003A46 0%, #004d5c 100%);
        padding: 60px 0;
    }
    
    .track-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        padding: 40px;
        margin-top: -40px;
    }
</style>
@endpush

@section('content')
<section class="track-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center text-white">
                <h1 class="display-5 fw-bold mb-3">
                    {{ $locale === 'kh' ? 'តាមដំណើរពាក្យ' : 'Track Your Application' }}
                </h1>
                <p class="mb-0 opacity-75">
                    {{ $locale === 'kh' 
                        ? 'ប្រើលេខយោងដែលបានផ្ញើទៅអ៊ីមែលរបស់អ្នក'
                        : 'Use your reference number sent to your email' }}
                </p>
            </div>
        </div>
    </div>
</section>

<div class="container pb-5">
    <div class="track-card">
        @if(session('error'))
        <div class="alert alert-danger d-flex align-items-center mb-4">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ session('error') }}
        </div>
        @endif
        
        <form method="POST" action="{{ route('admissions.track.result') }}">
            @csrf
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">{{ $locale === 'kh' ? 'លេខយោង *' : 'Reference Number *' }}</label>
                    <input type="text" class="form-control" name="reference_number" 
                           value="{{ request('ref') }}" required
                           placeholder="{{ $locale === 'kh' ? 'ឧ.ប. NUM-LAW-2025-00001' : 'e.g. NUM-LAW-2025-00001' }}">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">{{ $locale === 'kh' ? 'អ៊ីមែល ឬ លេខទូរស័ព្ទ *' : 'Email or Phone *' }}</label>
                    <input type="text" class="form-control" name="contact" required>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary btn-lg mt-4">
                <i class="bi bi-search me-2"></i>
                {{ $locale === 'kh' ? ' ស្វែងរក' : 'Search' }}
            </button>
        </form>
        
        <div class="alert alert-warning mt-4">
            <i class="bi bi-info-circle me-2"></i>
            {{ $locale === 'kh' 
                ? 'លេខយោង និង អ៊ីមែល/លេខទូរស័ព្ទ គឺជាព័ត៌មានដែលអ្នកបានផ្តល់ពេលដាក់ពាក់'
                : 'Use the reference number and email/phone you provided when applying' }}
        </div>
    </div>
</div>
@endsection
