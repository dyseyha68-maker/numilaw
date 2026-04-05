@extends('layouts.public')

@section('title', $moot->name_en . ' ' . $participation->year)

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('public.moot-programs.index') }}">Moot Court Programs</a></li>
            <li class="breadcrumb-item"><a href="{{ route('public.moot-programs.show', $moot->slug) }}">{{ $moot->name_en }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $participation->year }}</li>
        </ol>
    </nav>

    <div class="row mb-5">
        <div class="col-lg-8">
            <h1 class="display-4 fw-bold" style="color: var(--primary);">
                {{ $moot->name_en }} {{ $participation->year }}
            </h1>
            
            @switch($participation->status)
                @case('completed')
                    <span class="badge bg-success mb-3">Competition Completed</span>
                    @break
                @case('ongoing')
                    <span class="badge bg-primary mb-3">Competition Ongoing</span>
                    @break
                @case('registration_open')
                    <span class="badge bg-success mb-3">Registration Open</span>
                    @break
                @case('cancelled')
                    <span class="badge bg-secondary mb-3">Cancelled</span>
                    @break
                @default
                    <span class="badge bg-warning text-dark mb-3">{{ ucfirst($participation->status) }}</span>
            @endswitch
            
            @if($participation->theme_en)
            <p class="lead text-muted mt-3">
                <i class="bi bi-bookmark me-2"></i>{{ $participation->theme_en }}
            </p>
            @endif
            
            @if($participation->venue || $participation->host_country)
            <p class="text-muted">
                <i class="bi bi-geo-alt me-2"></i>
                {{ $participation->venue ?? 'TBD' }}
                @if($participation->host_city || $participation->host_country)
                    , {{ $participation->host_city ?? '' }} {{ $participation->host_country ?? '' }}
                @endif
            </p>
            @endif
            
            @if($participation->competition_start_date || $participation->competition_end_date)
            <p class="text-muted">
                <i class="bi bi-calendar3 me-2"></i>
                @if($participation->competition_start_date)
                    {{ $participation->competition_start_date->format('M d, Y') }}
                @endif
                @if($participation->competition_end_date)
                    - {{ $participation->competition_end_date->format('M d, Y') }}
                @endif
            </p>
            @endif
            
            @if($moot->case_file_path)
            <a href="{{ asset($moot->case_file_path) }}" target="_blank" class="btn btn-outline-primary mt-2">
                <i class="bi bi-file-earmark-text me-2"></i>View Case File
            </a>
            @endif
        </div>
        
        @if($otherYears->count() > 0)
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body">
                    <h6 class="card-title mb-3">Other Years</h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($otherYears as $otherYear)
                        <a href="{{ route('public.moot-programs.participations.show', [$moot->slug, $otherYear->year]) }}" 
                           class="btn btn-sm btn-outline-secondary">
                            {{ $otherYear->year }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    @if($participation->case_problem_en)
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-file-earmark-text me-2"></i>Case Problem</h5>
                    <p class="mb-0">{{ $participation->case_problem_en }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($participation->summary_en)
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body">
                    <h5 class="card-title">Overview</h5>
                    <p class="mb-0">{{ $participation->summary_en }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($participation->teams->count() > 0)
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="h4 border-bottom pb-2 mb-4">
                <i class="bi bi-people me-2"></i>Our Teams
            </h2>
        </div>
        
        @foreach($participation->teams as $team)
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="card-title mb-1">{{ $team->team_name }}</h5>
                                    @if($team->team_type !== 'main')
                                    <span class="badge bg-secondary">{{ ucfirst($team->team_type) }}</span>
                                    @endif
                                </div>
                                @if($team->round_reached)
                                <span class="badge bg-primary">
                                    {{ \App\Models\MootTeam::getRoundNames()[$team->round_reached] ?? 'Round ' . $team->round_reached }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        @if($team->coach_name || $team->advisor_name || $team->mentor_name)
                        <div class="col-md-4 mb-3">
                            <h6 class="text-muted small mb-3">Coaching Team</h6>
                            <div class="d-flex flex-column gap-2">
                                @if($team->coach_name)
                                <div class="d-flex align-items-center">
                                    @if($team->coach_image)
                                    <img src="{{ asset($team->coach_image) }}" alt="{{ $team->coach_name }}" 
                                         class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                        <i class="bi bi-person text-white"></i>
                                    </div>
                                    @endif
                                    <div>
                                        <small class="text-muted d-block">Coach</small>
                                        <strong>{{ $team->coach_name }}</strong>
                                    </div>
                                </div>
                                @endif
                                
                                @if($team->advisor_name)
                                <div class="d-flex align-items-center">
                                    @if($team->advisor_image)
                                    <img src="{{ asset($team->advisor_image) }}" alt="{{ $team->advisor_name }}" 
                                         class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                        <i class="bi bi-person text-white"></i>
                                    </div>
                                    @endif
                                    <div>
                                        <small class="text-muted d-block">Academic Advisor</small>
                                        <strong>{{ $team->advisor_name }}</strong>
                                    </div>
                                </div>
                                @endif
                                
                                @if($team->mentor_name)
                                <div class="d-flex align-items-center">
                                    @if($team->mentor_image)
                                    <img src="{{ asset($team->mentor_image) }}" alt="{{ $team->mentor_name }}" 
                                         class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                        <i class="bi bi-person text-white"></i>
                                    </div>
                                    @endif
                                    <div>
                                        <small class="text-muted d-block">Mentor</small>
                                        <strong>{{ $team->mentor_name }}</strong>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                        
                        @if($team->members->count() > 0)
                        <div class="col-md-8">
                            <h6 class="text-muted small mb-3">Team Members ({{ $team->members->count() }})</h6>
                            <div class="row g-2">
                                @foreach($team->members as $member)
                                <div class="col-6 col-md-4">
                                    <div class="d-flex align-items-center p-2 bg-light rounded">
                                        @if($member->image)
                                        <img src="{{ url('/laravel-img/' . str_replace(['storage/', 'images/'], '', $member->image)) }}" alt="{{ $member->name_en }}" 
                                             class="rounded-circle me-2" style="width: 36px; height: 36px; object-fit: cover;">
                                        @else
                                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px; min-width: 36px;">
                                            <i class="bi bi-person text-white small"></i>
                                        </div>
                                        @endif
                                        <div class="overflow-hidden">
                                            <div class="text-truncate small fw-bold">{{ $member->name_en }}</div>
                                            <small class="text-muted">
                                                @switch($member->role)
                                                    @case('speaker')
                                                        <i class="bi bi-mic"></i> Speaker
                                                        @break
                                                    @case('researcher')
                                                        <i class="bi bi-book"></i> Researcher
                                                        @break
                                                    @case('reserve')
                                                        <i class="bi bi-person"></i> Reserve
                                                        @break
                                                    @default
                                                        {{ ucfirst($member->role) }}
                                                @endswitch
                                            </small>
                                            @if($member->is_team_lead)
                                            <span class="badge bg-warning text-dark ms-1" style="font-size: 0.6rem;">Lead</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    @if($team->awards_en)
                    <div class="mt-3 pt-3 border-top">
                        <span class="badge bg-warning text-dark">
                            <i class="bi bi-trophy me-1"></i>{{ $team->awards_en }}
                        </span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    @if($participation->activities->count() > 0)
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="h4 border-bottom pb-2 mb-4">
                <i class="bi bi-list-task me-2"></i>Timeline of Activities
            </h2>
        </div>
        <div class="col-12">
            <div class="timeline">
                @foreach($participation->activities->sortBy('order') as $activity)
                <div class="timeline-item mb-4">
                    <div class="d-flex">
                        <div class="timeline-marker">
                            @if($activity->is_completed)
                            <span class="badge bg-success rounded-circle p-2">
                                <i class="bi bi-check"></i>
                            </span>
                            @else
                            <span class="badge bg-secondary rounded-circle p-2">
                                <i class="bi bi-circle"></i>
                            </span>
                            @endif
                        </div>
                        <div class="timeline-content flex-grow-1 ms-3">
                            <div class="card border-0 shadow-sm" style="border-radius: 8px;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h6 class="mb-0">{{ $activity->title_en }}</h6>
                                            @switch($activity->activity_type)
                                                @case('training')
                                                    <span class="badge bg-info">Training</span>
                                                    @break
                                                @case('submission')
                                                    <span class="badge bg-warning">Submission</span>
                                                    @break
                                                @case('preliminary')
                                                    <span class="badge bg-primary">Preliminary</span>
                                                    @break
                                                @case('quarterfinal')
                                                    <span class="badge bg-primary">Quarterfinal</span>
                                                    @break
                                                @case('semifinal')
                                                    <span class="badge bg-primary">Semifinal</span>
                                                    @break
                                                @case('final')
                                                    <span class="badge bg-success">Final</span>
                                                    @break
                                                @case('ceremony')
                                                    <span class="badge bg-secondary">Ceremony</span>
                                                    @break
                                                @case('announcement')
                                                    <span class="badge bg-dark">Announcement</span>
                                                    @break
                                                @case('meeting')
                                                    <span class="badge bg-light text-dark">Meeting</span>
                                                    @break
                                                @default
                                                    <span class="badge bg-secondary">Other</span>
                                            @endswitch
                                        </div>
                                        @if($activity->activity_date)
                                        <span class="text-muted small">
                                            <i class="bi bi-calendar3 me-1"></i>
                                            {{ $activity->activity_date->format('M d, Y') }}
                                        </span>
                                        @endif
                                    </div>
                                    @if($activity->description_en)
                                    <p class="text-muted small mb-0">{!! $activity->description_en !!}</p>
                                    @endif
                                    @if($activity->location)
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-geo-alt me-1"></i>{{ $activity->location }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @if($participation->result_en || $participation->achievements_en)
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 12px; background: linear-gradient(135deg, var(--primary) 0%, #005f6b 100%); color: white;">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-trophy me-2"></i>Results & Achievements
                    </h5>
                    @if($participation->result_en)
                    <p class="mb-2">
                        <strong>Result:</strong> {{ $participation->result_en }}
                    </p>
                    @endif
                    @if($participation->achievements_en)
                    <p class="mb-0">
                        <strong>Achievements:</strong> {{ $participation->achievements_en }}
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
