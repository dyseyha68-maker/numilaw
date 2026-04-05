@extends('layouts.public')

@section('title', $locale === 'kh' ? $program->name_kh : $program->name_en)

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h1 style="color: #003A46;">{{ $locale === 'kh' ? $program->name_kh : $program->name_en }}</h1>
                <p class="lead">{{ $locale === 'kh' ? $program->duration_kh : $program->duration_en }}</p>
                
                <h4 class="mt-4">{{ $locale === 'kh' ? 'ការពិពណ៌នា' : 'Description' }}</h4>
                <p>{{ $locale === 'kh' ? $program->description_kh : $program->description_en }}</p>
                
                <h4 class="mt-4">{{ $locale === 'kh' ? 'តំរូវការ' : 'Requirements' }}</h4>
                <p>{{ $locale === 'kh' ? $program->requirements_kh : $program->requirements_en }}</p>
                
                @if($program->scholarship_available)
                <div class="alert alert-success mt-4">
                    <h5>{{ $locale === 'kh' ? ' ឧបត្ថម្ភសិក្សា' : 'Scholarship Available' }}</h5>
                    <p class="mb-0">{{ $locale === 'kh' ? $program->scholarship_info_kh : $program->scholarship_info_en }}</p>
                </div>
                @endif
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $locale === 'kh' ? ' ថ្លៃសិក្សា' : 'Tuition' }}</h5>
                        <p class="display-6" style="color: #003A46;">
                            {{ $locale === 'kh' ? $program->tuition_kh : $program->tuition_en }}
                        </p>
                        
                        @if($program->openIntakes->count() > 0)
                        <hr>
                        <h6>{{ $locale === 'kh' ? 'Intakes ដែលកំពុងបើក' : 'Open Intakes' }}</h6>
                        @foreach($program->openIntakes as $intake)
                        <div class="mb-2">
                            <strong>{{ $locale === 'kh' ? $intake->intake_name_kh : $intake->intake_name_en }}</strong>
                            <br><small class="text-muted">{{ $locale === 'kh' ? 'ថ្ងៃបិទ' : 'Deadline' }}: {{ $intake->application_end }}</small>
                        </div>
                        @endforeach
                        @endif
                        
                        <a href="{{ route('admissions.apply') }}" class="btn btn-primary w-100 mt-3">
                            {{ $locale === 'kh' ? 'Apply Now' : 'Apply Now' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
