@extends('layouts.public')

@section('title', $locale === 'kh' ? 'លទ្ធផល' : 'Application Result')

@push('styles')
<style>
    .result-hero {
        background: linear-gradient(135deg, #003A46 0%, #004d5c 100%);
        padding: 60px 0;
    }
    
    .result-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        padding: 40px;
        margin-top: -40px;
    }
    
    .status-badge {
        display: inline-block;
        padding: 10px 25px;
        border-radius: 25px;
        font-weight: bold;
        font-size: 18px;
    }
    
    .status-draft { background: #e5e7eb; color: #374151; }
    .status-submitted { background: #dbeafe; color: #1d4ed8; }
    .status-under_review { background: #fef3c7; color: #d97706; }
    .status-accepted { background: #d1fae5; color: #059669; }
    .status-rejected { background: #fee2e2; color: #dc2626; }
    .status-withdrawn { background: #374151; color: white; }
    
    .timeline {
        position: relative;
        padding-left: 30px;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e5e7eb;
    }
    
    .timeline-item {
        position: relative;
        padding-bottom: 20px;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -24px;
        top: 5px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #e5e7eb;
        border: 2px solid #fff;
    }
    
    .timeline-item.completed::before {
        background: #003A46;
    }
    
    .timeline-item.active::before {
        background: #006d77;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { box-shadow: 0 0 0 0 rgba(0, 109, 119, 0.4); }
        50% { box-shadow: 0 0 0 8px rgba(0, 109, 119, 0); }
    }
</style>
@endpush

@section('content')
<section class="result-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center text-white">
                <h1 class="display-5 fw-bold mb-3">
                    {{ $locale === 'kh' ? 'លទ្ធផលពាក្យ' : 'Application Status' }}
                </h1>
                <p class="mb-0 opacity-75">
                    {{ $application->reference_number }}
                </p>
            </div>
        </div>
    </div>
</section>

<div class="container pb-5">
    <div class="result-card">
        <div class="row mb-4">
            <div class="col-md-8">
                <h4>{{ $application->full_name_en }}</h4>
                <p class="text-muted mb-1">
                    {{ $locale === 'kh' ? $application->program->name_kh : $application->program->name_en }}
                </p>
                <p class="text-muted mb-0">
                    {{ $locale === 'kh' ? $application->intake->intake_name_kh : $application->intake->intake_name_en }}
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <span class="status-badge status-{{ $application->status }}">
                    @if($application->status === 'submitted')
                        {{ $locale === 'kh' ? 'បានដាក់' : 'Submitted' }}
                    @elseif($application->status === 'under_review')
                        {{ $locale === 'kh' ? ' កំពុងពិនិត្យ' : 'Under Review' }}
                    @elseif($application->status === 'accepted')
                        {{ $locale === 'kh' ? ' បានទទួលយក' : 'Accepted' }}
                    @elseif($application->status === 'rejected')
                        {{ $locale === 'kh' ? ' បានច្រាន' : 'Rejected' }}
                    @else
                        {{ ucfirst($application->status) }}
                    @endif
                </span>
            </div>
        </div>
        
        @if($application->admin_notes)
        <div class="alert alert-info">
            <strong>{{ $locale === 'kh' ? 'មតិ' : 'Note' }}:</strong> {{ $application->admin_notes }}
        </div>
        @endif
        
        <hr>
        
        <h5 class="mb-4">{{ $locale === 'kh' ? 'ប្រវត្តិ' : 'Timeline' }}</h5>
        
        <div class="timeline">
            <div class="timeline-item completed">
                <strong>{{ $locale === 'kh' ? ' បានដាក់' : 'Submitted' }}</strong>
                <p class="text-muted small mb-0">
                    {{ $application->submitted_at ? $application->submitted_at->format('d M Y, h:i A') : '-' }}
                </p>
            </div>
            
            <div class="timeline-item {{ in_array($application->status, ['under_review', 'accepted', 'rejected']) ? 'completed' : ($application->status === 'submitted' ? 'active' : '') }}">
                <strong>{{ $locale === 'kh' ? ' កំពុងពិនិត្យ' : 'Under Review' }}</strong>
                <p class="text-muted small mb-0">
                    @if(in_array($application->status, ['under_review', 'accepted', 'rejected']) && $application->reviewed_at)
                        {{ $application->reviewed_at->format('d M Y, h:i A') }}
                    @else
                        {{ $locale === 'kh' ? ' រង់ចាំ' : 'Pending' }}
                    @endif
                </p>
            </div>
            
            <div class="timeline-item {{ in_array($application->status, ['accepted', 'rejected']) ? 'completed' : '' }}">
                <strong>{{ $locale === 'kh' ? ' លទ្ធផល' : 'Decision' }}</strong>
                <p class="text-muted small mb-0">
                    @if(in_array($application->status, ['accepted', 'rejected']))
                        {{ $application->reviewed_at ? $application->reviewed_at->format('d M Y, h:i A') : '-' }}
                    @else
                        {{ $locale === 'kh' ? ' រង់ចាំ' : 'Pending' }}
                    @endif
                </p>
            </div>
        </div>
        
        <hr>
        
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('admissions.apply') }}" class="btn btn-outline-primary">
                {{ $locale === 'kh' ? 'Apply Again' : 'Apply Again' }}
            </a>
            <a href="{{ route('admissions.track') }}" class="btn btn-link">
                {{ $locale === 'kh' ? ' តាមដំណើរផ្សេង' : 'Track Another' }}
            </a>
        </div>
    </div>
</div>
@endsection
