@extends('admin.layouts.app')

@section('title', 'Faculty Member Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Faculty Details</h1>
        <p class="text-muted mb-0">View faculty member information</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.faculty.edit', $faculty) }}" class="btn btn-primary">
            <i class="bi bi-pencil me-2"></i>Edit
        </a>
        <a href="{{ route('admin.faculty.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Profile Card -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center p-4">
                <div class="position-relative d-inline-block mb-4">
                        @if($faculty->photo)
                            @if(substr($faculty->photo, 0, 4) === 'http')
                                <img src="{{ $faculty->photo }}" 
                                     alt="{{ $faculty->name }}" 
                                     class="rounded-circle shadow"
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <img src="{{ url('/laravel-img/' . $faculty->photo) }}" 
                                     alt="{{ $faculty->name }}" 
                                     class="rounded-circle shadow"
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            @endif
                        @else
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white fw-bold mx-auto"
                                 style="width: 150px; height: 150px; font-size: 3rem;">
                                {{ strtoupper(substr($faculty->name, 0, 2)) }}
                            </div>
                        @endif
                    <span class="position-absolute bottom-0 start-50 translate-middle badge rounded-pill {{ $faculty->status === 'active' ? 'bg-success' : 'bg-secondary' }} fs-6">
                        {{ $faculty->status === 'active' ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                
                <h4 class="mb-1" style="color: #003A46;">{{ $faculty->name }}</h4>
                <p class="text-muted mb-2">{{ $faculty->title }}</p>
                <span class="badge bg-light text-dark mb-3">
                    <i class="bi bi-building me-1"></i>{{ $faculty->department }}
                </span>
                
                <hr class="my-4">
                
                <div class="text-start">
                    @if($faculty->email)
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                            <i class="bi bi-envelope text-primary"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Email</small>
                            <a href="mailto:{{ $faculty->email }}" class="text-decoration-none">{{ $faculty->email }}</a>
                        </div>
                    </div>
                    @endif
                    
                    @if($faculty->phone)
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-success bg-opacity-10 p-2 me-3">
                            <i class="bi bi-telephone text-success"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Phone</small>
                            <span>{{ $faculty->phone }}</span>
                        </div>
                    </div>
                    @endif
                    
                    @if($faculty->office_location)
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-info bg-opacity-10 p-2 me-3">
                            <i class="bi bi-geo-alt text-info"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Office</small>
                            <span>{{ $faculty->office_location }}</span>
                        </div>
                    </div>
                    @endif
                    
                    @if($faculty->office_hours)
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-2 me-3">
                            <i class="bi bi-clock text-warning"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Office Hours</small>
                            <span>{{ $faculty->office_hours }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Details Card -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <ul class="nav nav-pills" id="facultyTabs" role="tablist">
                    <li class="nav-item me-2" role="presentation">
                        <button class="nav-link active" id="bio-tab" data-bs-toggle="pill" data-bs-target="#bio" type="button">
                            <i class="bi bi-person me-2"></i>Biography
                        </button>
                    </li>
                    <li class="nav-item me-2" role="presentation">
                        <button class="nav-link" id="edu-tab" data-bs-toggle="pill" data-bs-target="#education" type="button">
                            <i class="bi bi-mortarboard me-2"></i>Education
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="spec-tab" data-bs-toggle="pill" data-bs-target="#specialization" type="button">
                            <i class="bi bi-lightbulb me-2"></i>Specialization
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content" id="facultyTabsContent">
                    <!-- Biography Tab -->
                    <div class="tab-pane fade show active" id="bio" role="tabpanel">
                        <h5 class="mb-4" style="color: #003A46;">
                            <i class="bi bi-person-badge me-2"></i>Biography
                        </h5>
                        
                        <div class="mb-4">
                            <h6 class="text-muted mb-2 d-flex align-items-center">
                                <img src="{{ url('/laravel-img/flags/us.png') }}" alt="EN" class="me-2" style="width: 20px;" onerror="this.style.display='none'">
                                English
                            </h6>
                            <div class="p-3 bg-light rounded-3">
                                {!! $faculty->bio_en ?? '<span class="text-muted">Not provided</span>' !!}
                            </div>
                        </div>
                        
                        <div>
                            <h6 class="text-muted mb-2 d-flex align-items-center">
                                <img src="{{ url('/laravel-img/flags/kh.png') }}" alt="KH" class="me-2" style="width: 20px;" onerror="this.style.display='none'">
                                Khmer
                            </h6>
                            <div class="p-3 bg-light rounded-3">
                                {!! $faculty->bio_km ?? '<span class="text-muted">Not provided</span>' !!}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Education Tab -->
                    <div class="tab-pane fade" id="education" role="tabpanel">
                        <h5 class="mb-4" style="color: #003A46;">
                            <i class="bi bi-mortarboard me-2"></i>Education
                        </h5>
                        
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">English</h6>
                            <div class="p-3 bg-light rounded-3">
                                {!! $faculty->education_en ?? '<span class="text-muted">Not provided</span>' !!}
                            </div>
                        </div>
                        
                        <div>
                            <h6 class="text-muted mb-2">Khmer</h6>
                            <div class="p-3 bg-light rounded-3">
                                {!! $faculty->education_km ?? '<span class="text-muted">Not provided</span>' !!}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Specialization Tab -->
                    <div class="tab-pane fade" id="specialization" role="tabpanel">
                        <h5 class="mb-4" style="color: #003A46;">
                            <i class="bi bi-lightbulb me-2"></i>Specialization
                        </h5>
                        
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">English</h6>
                            <div class="p-3 bg-light rounded-3">
                                {!! $faculty->specialization_en ?? '<span class="text-muted">Not provided</span>' !!}
                            </div>
                        </div>
                        
                        <div>
                            <h6 class="text-muted mb-2">Khmer</h6>
                            <div class="p-3 bg-light rounded-3">
                                {!! $faculty->specialization_km ?? '<span class="text-muted">Not provided</span>' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Info Card -->
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body p-4">
                <div class="row g-4 text-center">
                    <div class="col-4">
                        <div class="text-muted small mb-1">Sort Order</div>
                        <div class="fw-bold">{{ $faculty->sort_order ?? '-' }}</div>
                    </div>
                    <div class="col-4 border-start border-end">
                        <div class="text-muted small mb-1">Created</div>
                        <div class="fw-bold">{{ $faculty->created_at->format('M j, Y') }}</div>
                    </div>
                    <div class="col-4">
                        <div class="text-muted small mb-1">Updated</div>
                        <div class="fw-bold">{{ $faculty->updated_at->format('M j, Y') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
