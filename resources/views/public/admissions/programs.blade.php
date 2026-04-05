@extends('layouts.public')

@section('title', $locale === 'kh' ? 'កម្មវិធី' : 'Programs')

@section('content')
<div class="py-5">
    <div class="container">
        <h2 class="text-center mb-5" style="color: #003A46;">
            {{ $locale === 'kh' ? 'កម្មវិធីទាំងអស់' : 'All Programs' }}
        </h2>
        
        <div class="row g-4">
            @forelse($programs as $program)
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5>{{ $locale === 'kh' ? $program->name_kh : $program->name_en }}</h5>
                        <p class="text-muted">{{ $locale === 'kh' ? $program->duration_kh : $program->duration_en }}</p>
                        <p>{{ $locale === 'kh' ? $program->tuition_kh : $program->tuition_en }}</p>
                        <a href="{{ route('admissions.program.detail', $program->id) }}" class="btn btn-primary">
                            {{ $locale === 'kh' ? 'មើល' : 'View Details' }}
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>{{ $locale === 'kh' ? 'មិនទាន់មាន' : 'No programs available' }}</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
