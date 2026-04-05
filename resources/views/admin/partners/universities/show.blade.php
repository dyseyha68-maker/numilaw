@extends('admin.layouts.app')

@section('title', $partnerUniversity->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.partners.universities.index') }}" class="btn btn-outline-secondary btn-sm mb-2">
            <i class="bi bi-arrow-left me-1"></i> {{ __('partner.form.cancel') }}
        </a>
        <h4 class="fw-bold mb-0">{{ $partnerUniversity->name }}</h4>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.partners.activities.index', $partnerUniversity->id) }}" 
           class="btn btn-outline-primary">
            <i class="bi bi-calendar-event me-1"></i> {{ __('partner.activities_title') }}
        </a>
        <a href="{{ route('admin.partners.universities.edit', $partnerUniversity->id) }}" 
           class="btn btn-outline-secondary">
            <i class="bi bi-pencil me-1"></i> {{ __('partner.admin.edit') }}
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center">
                @if($partnerUniversity->logo)
                <img src="{{ asset($partnerUniversity->logo) }}" alt="{{ $partnerUniversity->name }}" 
                     style="height: 120px; object-fit: contain;" class="mb-3">
                @else
                <div class="bg-light rounded d-flex align-items-center justify-content-center mx-auto mb-3" 
                     style="width: 120px; height: 120px;">
                    <i class="bi bi-building text-muted" style="font-size: 3rem;"></i>
                </div>
                @endif
                
                <h5 class="fw-bold">{{ $partnerUniversity->name }}</h5>
                <p class="text-muted mb-2">{{ $partnerUniversity->faculty_or_school }}</p>
                
                <div class="d-flex justify-content-center gap-2 mb-3">
                    @if($partnerUniversity->status === 'active')
                    <span class="badge bg-success">{{ __('partner.status.active') }}</span>
                    @else
                    <span class="badge bg-secondary">{{ __('partner.status.inactive') }}</span>
                    @endif
                    <span class="badge bg-light text-dark border">
                        <i class="bi bi-geo-alt me-1"></i>{{ $partnerUniversity->country }}
                    </span>
                </div>
                
                @if($partnerUniversity->official_website)
                <a href="{{ $partnerUniversity->official_website }}" target="_blank" 
                   class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-box-arrow-up-right me-1"></i> {{ __('partner.visit_website') }}
                </a>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">{{ __('partner.admin.description') }}</h5>
            </div>
            <div class="card-body">
                @if($partnerUniversity->description)
                <div class="mb-4">
                    <h6 class="fw-bold text-muted text-uppercase small">{{ __('partner.admin.description') }}</h6>
                    <p class="mb-0">{!! nl2br(e($partnerUniversity->description)) !!}</p>
                </div>
                @endif
                
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold text-muted text-uppercase small">{{ __('partner.admin.country') }}</h6>
                        <p class="mb-3">{{ $partnerUniversity->country }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-muted text-uppercase small">{{ __('partner.admin.faculty_school') }}</h6>
                        <p class="mb-3">{{ $partnerUniversity->faculty_or_school }}</p>
                    </div>
                </div>
                
                @if($partnerUniversity->official_website)
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold text-muted text-uppercase small">{{ __('partner.admin.official_website') }}</h6>
                        <p class="mb-3">
                            <a href="{{ $partnerUniversity->official_website }}" target="_blank">
                                {{ $partnerUniversity->official_website }}
                            </a>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-muted text-uppercase small">{{ __('partner.activities_title') }}</h6>
                        <p class="mb-3">
                            <a href="{{ route('admin.partners.activities.index', $partnerUniversity->id) }}">
                                {{ $partnerUniversity->activities->count() }} {{ __('partner.activities') }}
                            </a>
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
