@extends('layouts.public')

@section('title', $locale === 'kh' ? 'ការទទួលយក' : 'Admissions')

@push('styles')
<style>
    .admission-hero {
        background: linear-gradient(135deg, #003A46 0%, #004d5c 50%, #005f6b 100%);
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }
    
    .admission-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    
    .program-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .program-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }
    
    .program-card .badge-scholarship {
        position: absolute;
        top: 15px;
        right: 15px;
    }
    
    .process-step {
        text-align: center;
        padding: 20px;
    }
    
    .process-step .step-number {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #003A46, #006d77);
        color: white;
        font-size: 24px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
    }
    
    .faq-item {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        margin-bottom: 10px;
        overflow: hidden;
    }
    
    .faq-item .question {
        padding: 15px 20px;
        background: #f8fafc;
        cursor: pointer;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .faq-item .answer {
        padding: 15px 20px;
        display: none;
    }
    
    .faq-item.open .answer {
        display: block;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="admission-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center text-white">
                <h1 class="display-4 fw-bold mb-4">
                    {{ $locale === 'kh' ? 'ចាប់ផ្តើមដំណើររបស់អ្នកនៅ NUMiLaw' : 'Begin Your Legal Journey at NUMiLaw' }}
                </h1>
                <p class="lead mb-4">
                    {{ $locale === 'kh' 
                        ? ' បណ្ឌិតសភាច្បាប់ រដ្ឋសាកលវិទ្យាល័យជាតិគ្រប់គ្រង - រៀនច្បាប់ ដើម្បីបង្កើតអនាគត'
                        : 'Faculty of Law, National University of Management - Study Law, Build Your Future' }}
                </p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('admissions.apply') }}" class="btn btn-light btn-lg">
                        {{ $locale === 'kh' ? 'Apply Now' : 'Apply Now' }}
                    </a>
                    <a href="{{ route('admissions.track') }}" class="btn btn-outline-light btn-lg">
                        {{ $locale === 'kh' ? 'Track Application' : 'Track Application' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose NUMiLaw -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #003A46;">
                {{ $locale === 'kh' ? 'ហេតុអ្វីត្រូវជ្រើសរើស NUMiLaw?' : 'Why Choose NUMiLaw?' }}
            </h2>
        </div>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="text-center p-4">
                    <div class="mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #003A46, #006d77); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="bi bi-book text-white" style="font-size: 32px;"></i>
                    </div>
                    <h5>{{ $locale === 'kh' ? 'គ្រូបង្រៀនជំនាញ' : 'Expert Faculty' }}</h5>
                    <p class="text-muted small mb-0">{{ $locale === 'kh' ? 'គ្រូបង្រៀនមានបទពិសោធន៍ជាច្រើន' : 'Experienced legal professionals' }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-4">
                    <div class="mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #003A46, #006d77); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="bi bi-gavel text-white" style="font-size: 32px;"></i>
                    </div>
                    <h5>{{ $locale === 'kh' ? 'កម្មវិធី Moot Court' : 'Moot Court Program' }}</h5>
                    <p class="text-muted small mb-0">{{ $locale === 'kh' ? 'ការហាត់តុលាការ' : 'Practical litigation training' }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-4">
                    <div class="mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #003A46, #006d77); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="bi bi-translate text-white" style="font-size: 32px;"></i>
                    </div>
                    <h5>{{ $locale === 'kh' ? 'ការអប់រំពីរភាសា' : 'Bilingual Education' }}</h5>
                    <p class="text-muted small mb-0">{{ $locale === 'kh' ? 'អង់គ្លេស និង ខ្មែរ' : 'English & Khmer' }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-4">
                    <div class="mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #003A46, #006d77); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="bi bi-briefcase text-white" style="font-size: 32px;"></i>
                    </div>
                    <h5>{{ $locale === 'kh' ? 'ការគាំទ្រអាជីព' : 'Career Support' }}</h5>
                    <p class="text-muted small mb-0">{{ $locale === 'kh' ? 'ជំនួយការងារ' : 'Job placement assistance' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Programs Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #003A46;">
                {{ $locale === 'kh' ? 'កម្មវិធីសិក្សា' : 'Our Programs' }}
            </h2>
        </div>
        
        <ul class="nav nav-pills mb-4 justify-content-center" id="programTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#all">
                    {{ $locale === 'kh' ? 'ទាំងអស់' : 'All' }}
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#bachelor">
                    {{ $locale === 'kh' ? ' បរិញ្ញាប័ត្រ' : 'Bachelor' }}
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#master">
                    {{ $locale === 'kh' ? ' បណ្ឌិត' : 'Master' }}
                </button>
            </li>
        </ul>
        
        <div class="tab-content">
            <div class="tab-pane fade show active" id="all">
                <div class="row g-4">
                    @forelse($programs->flatten() as $program)
                    <div class="col-md-4">
                        <div class="program-card h-100">
                            @if($program->scholarship_available)
                            <span class="badge bg-warning badge-scholarship">{{ $locale === 'kh' ? 'ឧបត្ថម្ភ' : 'Scholarship' }}</span>
                            @endif
                            <div class="p-4">
                                <h5 class="fw-bold mb-2">{{ $locale === 'kh' ? $program->name_kh : $program->name_en }}</h5>
                                <p class="text-muted small mb-3">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $locale === 'kh' ? $program->duration_kh : $program->duration_en }}
                                </p>
                                <p class="text-muted small mb-3">
                                    <i class="bi bi-currency-dollar me-1"></i>
                                    {{ $locale === 'kh' ? $program->tuition_kh : $program->tuition_en }}
                                </p>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admissions.program.detail', $program->id) }}" class="btn btn-outline-primary btn-sm">
                                        {{ $locale === 'kh' ? 'មើលលំអិត' : 'Details' }}
                                    </a>
                                    <a href="{{ route('admissions.apply') }}" class="btn btn-primary btn-sm">
                                        {{ $locale === 'kh' ? 'Apply' : 'Apply' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-4">
                        <p class="text-muted">{{ $locale === 'kh' ? 'មិនទាន់មានទេ' : 'No programs available' }}</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('admissions.programs') }}" class="btn btn-outline-primary">
                {{ $locale === 'kh' ? 'មើលកម្មវិធីទាំងអស់' : 'View All Programs' }}
            </a>
        </div>
    </div>
</section>

<!-- Admission Process -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #003A46;">
                {{ $locale === 'kh' ? 'ដំណើរការទទួលយក' : 'Admission Process' }}
            </h2>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h5>{{ $locale === 'kh' ? 'ជ្រើសរើសកម្មវិធី' : 'Choose Program' }}</h5>
                    <p class="text-muted small">{{ $locale === 'kh' ? 'ជ្រើសរើសកម្មវិធីសិក្សា' : 'Select your desired program' }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h5>{{ $locale === 'kh' ? 'បំពេញពាក្យ' : 'Complete Application' }}</h5>
                    <p class="text-muted small">{{ $locale === 'kh' ? 'បំពេញទំរង់ពាក់កណ្តាល' : 'Fill out the application form' }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h5>{{ $locale === 'kh' ? ' ទទួលលទ្ធផល' : 'Get Results' }}</h5>
                    <p class="text-muted small">{{ $locale === 'kh' ? 'ទទួលបានការទទួលយក' : 'Receive admission decision' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Key Dates -->
@if($openIntakes->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #003A46;">
                {{ $locale === 'kh' ? 'កាលបរិច្ឆេទសំខាន់' : 'Key Dates' }}
            </h2>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>{{ $locale === 'kh' ? 'កម្មវិធី' : 'Program' }}</th>
                        <th>{{ $locale === 'kh' ? ' Intake' : 'Intake' }}</th>
                        <th>{{ $locale === 'kh' ? 'ថ្ងៃបិទ' : 'Deadline' }}</th>
                        <th>{{ $locale === 'kh' ? 'ទីផេយ' : 'Seats' }}</th>
                        <th>{{ $locale === 'kh' ? 'ស្ថាន' : 'Status' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($openIntakes as $intake)
                    <tr>
                        <td>{{ $locale === 'kh' ? $intake->program->name_kh : $intake->program->name_en }}</td>
                        <td>{{ $locale === 'kh' ? $intake->intake_name_kh : $intake->intake_name_en }}</td>
                        <td>{{ \Carbon\Carbon::parse($intake->application_end)->format('d M Y') }}</td>
                        <td>{{ $intake->max_seats }}</td>
                        <td><span class="badge bg-success">{{ $locale === 'kh' ? 'កំពុងបើក' : 'Open' }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endif

<!-- FAQ -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #003A46;">
                {{ $locale === 'kh' ? ' សំណួរដែលសួរញឹកញាប់' : 'Frequently Asked Questions' }}
            </h2>
        </div>
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @foreach($faqs as $index => $faq)
                <div class="faq-item">
                    <div class="question" onclick="this.parentElement.classList.toggle('open')">
                        {{ $locale === 'kh' ? $faq['question_kh'] : $faq['question_en'] }}
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="answer">
                        {{ $locale === 'kh' ? $faq['answer_kh'] : $faq['answer_en'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5" style="background: linear-gradient(135deg, #003A46, #006d77);">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center text-white">
                <h2 class="fw-bold mb-4">
                    {{ $locale === 'kh' ? 'ត្រៀមដាក់ពាក់?' : 'Ready to Apply?' }}
                </h2>
                <p class="mb-4 opacity-75">
                    {{ $locale === 'kh' 
                        ? 'ចាប់ផ្តើមដំណើររបស់អ្នកនៅថ្ងៃនេះ'
                        : 'Start your journey with us today' }}
                </p>
                <a href="{{ route('admissions.apply') }}" class="btn btn-light btn-lg">
                    {{ $locale === 'kh' ? 'Apply Now' : 'Apply Now' }}
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
