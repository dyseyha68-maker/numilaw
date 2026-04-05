@extends('layouts.public')

@section('title', __('academic_programs.title'))

@push('styles')
<style>
/* Program Header */
.program-header-animated {
    position: relative;
    overflow: hidden;
    background: #f5fff5;
    min-height: 350px;
    padding: 65px 0;
}

.program-header-animated .blob-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
}

.program-header-animated .blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.038;
    mix-blend-mode: multiply;
}

.program-header-animated .b1 {
    width: 150%; height: 150%;
    top: -50px; left: -25%;
    animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
}
.program-header-animated .b2 {
    width: 140%; height: 140%;
    top: -30px; left: -20%;
    animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
}
.program-header-animated .b3 {
    width: 130%; height: 130%;
    top: -10px; left: -15%;
    animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
}
.program-header-animated .b4 {
    width: 120%; height: 120%;
    top: 10px; left: -10%;
    animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
}
.program-header-animated .b5 {
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
    25%  { background: #40e8c0; }
    50%  { background: #f0e060; }
    75%  { background: #60d880; }
    100% { background: #b8f050; }
}
@keyframes colorB3 {
    0%   { background: #40d8b0; }
    25%  { background: #70f040; }
    50%  { background: #d8f080; }
    75%  { background: #20c8a0; }
    100% { background: #40d8b0; }
}
@keyframes colorB4 {
    0%   { background: #d0f870; }
    25%  { background: #50e890; }
    50%  { background: #a0f8d0; }
    75%  { background: #e8f050; }
    100% { background: #d0f870; }
}
@keyframes colorB5 {
    0%   { background: #50e878; }
    25%  { background: #40e8c0; }
    50%  { background: #c8f040; }
    75%  { background: #30d8c0; }
    100% { background: #50e878; }
}

.program-header-animated .fade-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 50%;
    background: linear-gradient(to bottom, rgba(245,255,245,0) 0%, rgba(248,250,251,1) 100%);
    z-index: 1;
    pointer-events: none;
}

.program-header-animated .header-content {
    position: relative;
    z-index: 2;
    margin-top: 30px;
}

.program-header-animated .header-title {
    font-family: var(--current-font);
    font-size: 2.5rem;
    font-weight: 600;
    color: #003A46;
    margin: 0 0 8px;
    letter-spacing: 2px;
    text-transform: uppercase;
}

.program-header-animated .header-subtitle {
    font-family: var(--current-font);
    font-size: 1.1rem;
    color: #64748b;
    margin: 0;
}

.program-card {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.program-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.program-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 2rem;
}

.degree-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.program-stats {
    display: flex;
    justify-content: space-around;
    padding: 1rem 0;
    border-top: 1px solid #f0f0f0;
    margin-top: 1rem;
}

.program-stats .stat {
    text-align: center;
}

.program-stats .stat-value {
    font-size: 1.25rem;
    font-weight: 700;
    color: #003A46;
}

.program-stats .stat-label {
    font-size: 0.75rem;
    color: #64748b;
}

.filter-btn {
    border-radius: 25px;
    padding: 0.5rem 1.5rem;
    border: 2px solid #e2e8f0;
    background: white;
    color: #64748b;
    transition: all 0.3s ease;
}

.filter-btn:hover, .filter-btn.active {
    background: #003A46;
    border-color: #003A46;
    color: white;
}
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="program-header-animated">
    <div class="blob-wrapper">
        <div class="blob b1"></div>
        <div class="blob b2"></div>
        <div class="blob b3"></div>
        <div class="blob b4"></div>
        <div class="blob b5"></div>
    </div>
    <div class="fade-bottom"></div>
    <div class="container" style="position: relative; z-index: 2;">
        <div class="header-content">
            <nav aria-label="breadcrumb" style="position: relative; z-index: 10;">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #003A46;">{{ __('navigation.home') }}</a></li>
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ __('academic_programs.title') }}</li>
                </ol>
            </nav>
            <h1 class="header-title">
                {{ app()->getLocale() === 'km' ? 'បរិញ្ញាបត្រ ច្បាប់ (LL.B)' : 'Bachelor of Laws (LL.B)' }}
            </h1>
            <p class="header-subtitle">
                {{ app()->getLocale() === 'km' ? 'កសាងមូលដ្ឋាន ច្បាប់ សម្រាប់ អនាគត' : 'Build Your Legal Foundation for the Future' }}
            </p>
        </div>
    </div>
</section>

<!-- Program Overview Section -->
<section id="overview" class="pt-5 pb-4" style="background: #f8fafb;">
    <div class="container">
        <div class="row g-5 align-items-start">
            <!-- Left - Program Overview Text -->
            <div class="col-lg-6">
                <h4 class="fw-bold mb-3" style="color: #003A46;">NUM iLAW - {{ app()->getLocale() === 'km' ? 'កម្មវិធីអន្9' : 'International Program for Legal Studies' }}</h4>
                <p class="text-muted" style="line-height: 1.8; font-size: 1rem;">
                    {{ app()->getLocale() === 'km' ? 
                        'កម្មវិធី អន្9 អន្9 រ ជ ត ិ ន ឃ វ ី (NUM iLAW) គ ឺ ជ ា ក ម វ ិ ធ ី ដ ល យ ើ ន ទ ា ង អ ភ ឌ ្ ឍ ដ ើ ម ធ ប ី ក ា រ អ ប រ ំ ន ឹ ង ខ ា ង ក ា រ ព ង ា វ ី ន ុ ត ប ី ក ា រ ស ិ ក ស ា រ ច ា រ ស ា ង វ ី ខ ែ រ ស ើ រ ច ុ ង ក ា រ ណ ា ត ល ើ វ ី ន ទ ា ង អ ត ប ត ា ង ក ា រ យ ក ល វ ឺ ស ដ ូ ន ខេ ម រ ភ ា ព ខេ ម រ ន ិ យ ន ុ ត ន ិ ច ន ា រ ច ា រ ស ា ង វ ី ។ រ ប ី យ ើ ន ទ ា ង ធ ា រ ស ា ង វ ី ន ុ ត ប ី ក ា រ ន ិ ស ិ ត ត ា ង ធ ូ រ ស ី ន ា រ ច ា រ ស ា ង វ ី គ ឺ ជ ា ថ ា ប រ ិ ច ន ា រ ន ិ ត ា ង រ ប ស ា ង ច ុ ង ក ា រ ណ ា ត ល ើ វ ី ន ខេ ម រ ភេ ទ ប ើ ន ន ិ ង ខេ ម រ ន ិ យ ។' : 
                        'The NUM International Program for Legal Studies (NUM iLAW) is dedicated to excellence in legal education. It aims to equip graduates with comprehensive legal knowledge, alongside an understanding of Khmer language, culture, virtue, and morality. This approach ensures that students are well-prepared for their intellectual and professional journeys.' }}
                </p>
            </div>
            
            <!-- Right - Video -->
            <div class="col-lg-6">
                <div id="videoContainer" class="rounded-4 overflow-hidden" 
                     style="height: 350px; box-shadow: 0 20px 60px rgba(0,0,0,0.08); transition: all 0.4s ease;"
                     onmouseover="this.style.boxShadow='0 0 50px rgba(0, 58, 70, 0.5), 0 0 100px rgba(0, 170, 204, 0.3)'; this.style.transform='translateY(-5px)'"
                     onmouseout="this.style.boxShadow='0 20px 60px rgba(0,0,0,0.08)'; this.style.transform='translateY(0)'">
                    <img id="videoThumbnail" src="https://img.youtube.com/vi/oE2GSF48usI/maxresdefault.jpg" 
                         alt="NUM iLAW Video" 
                         class="w-100 h-100"
                         style="object-fit: cover; cursor: pointer;"
                         onclick="playVideo()">
                    <div id="playButton" class="position-absolute" style="bottom: 15px; right: 15px; cursor: pointer;" onclick="playVideo()">
                        <div style="width: 50px; height: 50px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                            <i class="bi bi-play-fill" style="color: #003A46; font-size: 1.5rem; margin-left: 3px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function playVideo() {
    var container = document.getElementById('videoContainer');
    container.innerHTML = '<iframe class="w-100 h-100" style="border: none;" src="https://www.youtube.com/embed/oE2GSF48usI?autoplay=1&rel=0&modestbranding=1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
}
</script>
        
        <!-- Program Educational Objectives (PEOs) -->
        <section class="py-5" style="background: #ffffff;">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold mb-3" style="color: #003A46;">
                        {{ app()->getLocale() === 'km' ? 'គោលបំណងកម្មវិធីសិក្សា' : 'Program Educational Objectives (PEOs)' }}
                    </h2>
                    <p class="text-muted mx-auto" style="max-width: 700px; line-height: 1.8;">
                        {{ app()->getLocale() === 'km' ? 
                            'PEOs គឺ ជា សេចក្តី ថ្លែង ក្រៅ ពី រ យ ព ល ដ ល ន ា ង ស ម ភ ា ព ខេ ម រ ដ ល ច ា រ ស ា ង វ ី ន ុ ត ប ី ក ា រ ន ិ ស ិ ត ត ា ង រ ប ស ា ង ច ុ ង ក ា រ ណ ា ត ល ើ វ ី ន ខេ ម រ ន ិ យ ប ី ប ើ យ ន ា ង រ ប ស ា ង ច ុ ង ក ា រ ណ ា ត ល ើ វ ី ន ប ី ច ា រ ។ ក ម វ ិ ធ ី នេះ ត្រ ូ វ ប ា ន ទ ា ង ន ិ ស ិ ត ត ា ង ន ិ ស ិ ត រ ប ស ា ង ច ុ ង ក ា រ ណ ា ត ដ ើ ម ន ិ ង រ ប ស ា ង ន ិ យ ន ា ង ប ី ប ើ យ ខេ ម រ ន ិ យ ដ ូ ន ស ទ ី ង ប រ ី យ ើ ន ទ ា ង ន ិ យ ។' : 
                            'PEOs are broad statements that describe what graduates are expected to achieve a few years after graduation. The program is designed to equip students with the knowledge, skills, and attributes that enable them to pursue one or more of the following career paths based on their individual interests and aspirations.' }}
                    </p>
                </div>
                
                <div class="row g-4 justify-content-center">
                    <!-- PEO 1 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="bg-white p-3 mx-auto" style="border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 280px;">
                            <h6 class="fw-bold mb-2" style="color: #003A46; font-size: 0.95rem;">{{ app()->getLocale() === 'km' ? '១. ប្រឡងវិជ្ជា' : 'Professional Exams' }}</h6>
                            <p class="text-muted mb-0" style="line-height: 1.5; font-size: 0.8rem;">
                                {{ app()->getLocale() === 'km' ? 'និស្សិត នឹង អភិវឌ្ឍ សមត្ថភាព ដើម្បី ឆ្លង ការ ប្រឡង វិជ្ជា ច្បាប់ ។' : 'Graduates will develop the capability to pass their legal professional examinations.' }}
                            </p>
                        </div>
                    </div>
                    
                    <!-- PEO 2 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="bg-white p-3 mx-auto" style="border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 280px;">
                            <h6 class="fw-bold mb-2" style="color: #003A46; font-size: 0.95rem;">{{ app()->getLocale() === 'km' ? '២. អប់រំ' : 'Academic Career' }}</h6>
                            <p class="text-muted mb-0" style="line-height: 1.5; font-size: 0.8rem;">
                                {{ app()->getLocale() === 'km' ? 'និស្សិត នឹង ត្រៀម ខ្លួន សម្រាប់ អាជីព ក្នុង វិស័យ អប់រំ ។' : 'Graduates will be prepared for careers in academia and legal education.' }}
                            </p>
                        </div>
                    </div>
                    
                    <!-- PEO 3 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="bg-white p-3 mx-auto" style="border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 280px;">
                            <h6 class="fw-bold mb-2" style="color: #003A46; font-size: 0.95rem;">{{ app()->getLocale() === 'km' ? '៣. ឯកា' : 'Private Sector' }}</h6>
                            <p class="text-muted mb-0" style="line-height: 1.5; font-size: 0.8rem;">
                                {{ app()->getLocale() === 'km' ? 'និស្សិត នឹង ម ា ន ភ ា ព ច ា រ ប ស ា ង ស ម ត ថ ភ ា ព ដ ល ន ា ង អ ា ជ ី ព ឯ ក ា ។' : 'Graduates will possess the capabilities required for private sector careers.' }}
                            </p>
                        </div>
                    </div>
                    
                    <!-- PEO 4 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="bg-white p-3 mx-auto" style="border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 280px;">
                            <h6 class="fw-bold mb-2" style="color: #003A46; font-size: 0.95rem;">{{ app()->getLocale() === 'km' ? '៤. សាធារណៈ' : 'Public Sector' }}</h6>
                            <p class="text-muted mb-0" style="line-height: 1.5; font-size: 0.8rem;">
                                {{ app()->getLocale() === 'km' ? 'និស្សិត នឹង ម ា ន ភ ា ព ច ា រ ប ស ា ង ស ម ត ថ ភ ា ព ដ ល ន ា ង អ ា ជ ី ព ស ា ធ ា រ ។' : 'Graduates will possess the capabilities required for public sector careers.' }}
                            </p>
                        </div>
                    </div>
                    
                    <!-- PEO 5 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="bg-white p-3 mx-auto" style="border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 280px;">
                            <h6 class="fw-bold mb-2" style="color: #003A46; font-size: 0.95rem;">{{ app()->getLocale() === 'km' ? '៥. សិក្សា បន្ត' : 'Graduate Studies' }}</h6>
                            <p class="text-muted mb-0" style="line-height: 1.5; font-size: 0.8rem;">
                                {{ app()->getLocale() === 'km' ? 'និស្សិត នឹង ត្រៀម ខ្លួន យ ៉ ា ង ស ម ស ម វ ី ច ុ ង ក ា រ ន ិ ច ន ា ង ។' : 'Graduates will be well-prepared for prestigious graduate studies.' }}
                            </p>
                        </div>
                    </div>
                    
                    <!-- PEO 6 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="bg-white p-3 mx-auto" style="border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 280px;">
                            <h6 class="fw-bold mb-2" style="color: #003A46; font-size: 0.95rem;">{{ app()->getLocale() === 'km' ? '៦. អន្9រជាតិ' : 'International' }}</h6>
                            <p class="text-muted mb-0" style="line-height: 1.5; font-size: 0.8rem;">
                                {{ app()->getLocale() === 'km' ? 'និស្សិត នឹង អ ា ច ា រ ច ា រ ប ស ា ង អ ា ជ ី ព ច្បាប់ អ ន ្ ត រ ជ ា ត ។' : 'Graduates will pursue legal careers in international or cross-border contexts.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
</section>

<!-- Curriculum Section -->
        <section id="curriculum" class="py-5" style="background: white;">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="px-4 py-2 mb-3 d-inline-block" 
                          style="background: linear-gradient(135deg, #003A46, #005f6b); color: white; border-radius: 50px; font-size: 0.875rem; font-weight: 600;">
                        <i class="bi bi-book me-2"></i>{{ app()->getLocale() === 'km' ? 'រចនាសម្ព័ន្ធ' : 'Curriculum' }}
                    </span>
                    <h2 class="fw-bold mb-3" style="color: #003A46;">
                        {{ app()->getLocale() === 'km' ? 'តារាង កម្ម វិធី សិក្សា' : 'Program Structure' }}
                    </h2>
                    <p class="text-muted" style="max-width: 600px; margin: 0 auto;">
                        {{ app()->getLocale() === 'km' ? 
                            'កម្ម វិ ធី ស ិ ក ស ា រ យ ពេ ល 4 ឆ ្ ន ា ត ូ រ ប ា ន រ រ ច រ ច រ រ ច ន ប ា ប រ ូ ប ។' : 
                            'A comprehensive 4-year law program designed to develop legal professionals with theoretical knowledge and practical skills' }}
                    </p>
                </div>

                <div class="table-responsive" style="border-radius: 20px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
                    <table class="table table-hover mb-0" style="background: white;">
                        <thead style="background: linear-gradient(135deg, #003A46, #005f6b); color: white;">
                            <tr>
                                <th class="py-4 px-4" style="width: 15%; font-weight: 600;">
                                    <i class="bi bi-calendar me-2"></i>{{ app()->getLocale() === 'km' ? 'ឆ្នាំ' : 'Year' }}
                                </th>
                                <th class="py-4 px-4" style="width: 20%; font-weight: 600;">
                                    <i class="bi bi-tag me-2"></i>{{ app()->getLocale() === 'km' ? 'ប្រភេទ' : 'Phase' }}
                                </th>
                                <th class="py-4 px-4" style="width: 65%; font-weight: 600;">
                                    <i class="bi bi-book me-2"></i>{{ app()->getLocale() === 'km' ? ' មេ ន ា ស ន' : 'Courses' }}
                                </th>
                            </tr>
                        </thead>
                        <tbody style="color: #64748b;">
                            @if($courses->count() > 0)
                                @foreach($courses as $year => $yearCourses)
                                    <tr style="transition: all 0.3s ease; {{ $loop->even ? 'background: #f8fafc;' : '' }}">
                                        <td class="py-4 px-4">
                                            <span class="badge px-3 py-2" style="background: {{ $loop->iteration == 1 ? '#003A46' : ($loop->iteration == 2 ? '#005f6b' : ($loop->iteration == 3 ? '#00AACC' : '#D4AF37')); }}; color: white; font-size: 0.9rem;">{{ app()->getLocale() === 'km' ? 'ឆ្នាំ ' . $year : 'Year ' . $year }}</span>
                                        </td>
                                        <td class="py-4 px-4 fw-bold" style="color: #003A46;">
                                            @php
                                                $phase = $yearCourses->first()->phase;
                                                $phaseKh = ['Foundation' => ' ម ូ ល ដ ្ ឋ ា ន', 'Development' => ' ក ា រ អ ភ ឌ ្ ឍ', 'Specialization' => ' ជ ន ា ញ', 'Capstone' => ' ប េ ស ៈ'];
                                                if ($phase) {
                                                    echo app()->getLocale() === 'km' ? ($phaseKh[$phase] ?? $phase) : $phase;
                                                } else {
                                                    echo $year == 1 ? 'Foundation' : ($year == 2 ? 'Development' : ($year == 3 ? 'Specialization' : 'Capstone'));
                                                }
                                            @endphp
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach($yearCourses as $course)
                                                    <span class="course-badge px-3 py-1 rounded-pill" 
                                                          style="background: {{ $year == 4 ? '#fef9e7' : '#f8fafc' }}; color: {{ $year == 4 ? '#D4AF37' : '#003A46' }}; font-size: 0.85rem; border: {{ $year == 4 ? '1px solid #D4AF37' : 'none' }}; cursor: pointer;"
                                                          data-bs-toggle="popover" 
                                                          data-bs-title="{{ app()->getLocale() === 'km' ? $course->name_km : $course->name_en }}"
                                                          data-bs-content="{{ app()->getLocale() === 'km' ? ($course->description_km ?: 'គ្មានការពិពណ៌នា។') : ($course->description_en ?: 'No description available.') }}"
                                                          data-bs-placement="top">
                                                        {{ app()->getLocale() === 'km' ? $course->name_km : $course->name_en }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            <tr style="transition: all 0.3s ease;">
                                <td class="py-4 px-4">
                                    <span class="badge px-3 py-2" style="background: #003A46; color: white; font-size: 0.9rem;">{{ app()->getLocale() === 'km' ? 'ឆ្នាំ ១' : 'Year 1' }}</span>
                                </td>
                                <td class="py-4 px-4 fw-bold" style="color: #003A46;">
                                    {{ app()->getLocale() === 'km' ? ' ម ូ ល ដ ្ ឋ ា ន' : 'Foundation' }}
                                </td>
                                <td class="py-4 px-4">
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="course-badge px-3 py-1 rounded-pill" style="background: #f8fafc; color: #003A46; font-size: 0.85rem; cursor: pointer;" data-bs-toggle="popover" data-bs-title="Introduction to Law" data-bs-content="An introduction to the fundamental principles of law, legal systems, and the role of law in society." data-bs-placement="top">{{ app()->getLocale() === 'km' ? ' ប ទ ច ធ ប ា ច' : 'Introduction to Law' }}</span>
                                        <span class="course-badge px-3 py-1 rounded-pill" style="background: #f8fafc; color: #003A46; font-size: 0.85rem; cursor: pointer;" data-bs-toggle="popover" data-bs-title="Legal System" data-bs-content="Study of the Cambodian legal system, judicial structures, and sources of law." data-bs-placement="top">{{ app()->getLocale() === 'km' ? ' ប រ ព ន ្ ធ ច' : 'Legal System' }}</span>
                                        <span class="course-badge px-3 py-1 rounded-pill" style="background: #f8fafc; color: #003A46; font-size: 0.85rem; cursor: pointer;" data-bs-toggle="popover" data-bs-title="Torts" data-bs-content="Understanding civil wrongs, negligence, liability, and compensation mechanisms." data-bs-placement="top">{{ app()->getLocale() === 'km' ? ' ច ា ប ទ ង ស' : 'Torts' }}</span>
                                        <span class="course-badge px-3 py-1 rounded-pill" style="background: #f8fafc; color: #003A46; font-size: 0.85rem; cursor: pointer;" data-bs-toggle="popover" data-bs-title="Contracts" data-bs-content="Principles of contract law, formation, interpretation, and enforcement." data-bs-placement="top">{{ app()->getLocale() === 'km' ? ' ក ិ ច យ ស ន យ' : 'Contracts' }}</span>
                                    </div>
                                </td>
                            </tr>
                            <tr style="transition: all 0.3s ease; background: #f8fafc;">
                                <td class="py-4 px-4">
                                    <span class="badge px-3 py-2" style="background: #005f6b; color: white; font-size: 0.9rem;">{{ app()->getLocale() === 'km' ? 'ឆ្នាំ ២' : 'Year 2' }}</span>
                                </td>
                                <td class="py-4 px-4 fw-bold" style="color: #003A46;">
                                    {{ app()->getLocale() === 'km' ? ' ក ា រ អ ភ ឌ ្ ឍ' : 'Development' }}
                                </td>
                                <td class="py-4 px-4">
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="course-badge px-3 py-1 rounded-pill" style="background: #f8fafc; color: #003A46; font-size: 0.85rem; cursor: pointer;" data-bs-toggle="popover" data-bs-title="Constitutional Law" data-bs-content="Study of the constitution, fundamental rights, and governmental structures." data-bs-placement="top">{{ app()->getLocale() === 'km' ? ' ច ា ប រ ដ ធ ម ន ុ ត' : 'Constitutional Law' }}</span>
                                        <span class="course-badge px-3 py-1 rounded-pill" style="background: #f8fafc; color: #003A46; font-size: 0.85rem; cursor: pointer;" data-bs-toggle="popover" data-bs-title="Criminal Law" data-bs-content="Understanding criminal offenses, penalties, and the criminal justice system." data-bs-placement="top">{{ app()->getLocale() === 'km' ? ' ច ា ប ប រ ហ ទ ប' : 'Criminal Law' }}</span>
                                        <span class="course-badge px-3 py-1 rounded-pill" style="background: #f8fafc; color: #003A46; font-size: 0.85rem; cursor: pointer;" data-bs-toggle="popover" data-bs-title="Property Law" data-bs-content="Legal principles governing property ownership, transfers, and disputes." data-bs-placement="top">{{ app()->getLocale() === 'km' ? ' ច ា ប អ ច ិ ន ្ រ យ' : 'Property Law' }}</span>
                                        <span class="course-badge px-3 py-1 rounded-pill" style="background: #f8fafc; color: #003A46; font-size: 0.85rem; cursor: pointer;" data-bs-toggle="popover" data-bs-title="Administrative Law" data-bs-content="Law governing administrative agencies, regulatory powers, and judicial review." data-bs-placement="top">{{ app()->getLocale() === 'km' ? ' ច ា ប ស វ ក ម ធ' : 'Administrative Law' }}</span>
                                    </div>
                                </td>
                            </tr>
                            <tr style="transition: all 0.3s ease;">
                                <td class="py-4 px-4">
                                    <span class="badge px-3 py-2" style="background: #00AACC; color: white; font-size: 0.9rem;">{{ app()->getLocale() === 'km' ? 'ឆ្នាំ ៣' : 'Year 3' }}</span>
                                </td>
                                <td class="py-4 px-4 fw-bold" style="color: #003A46;">
                                    {{ app()->getLocale() === 'km' ? ' ជ ន ា ញ' : 'Specialization' }}
                                </td>
                                <td class="py-4 px-4">
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="course-badge px-3 py-1 rounded-pill" style="background: #f8fafc; color: #003A46; font-size: 0.85rem; cursor: pointer;" data-bs-toggle="popover" data-bs-title="Commercial Law" data-bs-content="Understanding business law, commercial transactions, and trade regulations." data-bs-placement="top">{{ app()->getLocale() === 'km' ? ' ច ា ប ព ា ណ ជ ក' : 'Commercial Law' }}</span>
                                        <span class="course-badge px-3 py-1 rounded-pill" style="background: #f8fafc; color: #003A46; font-size: 0.85rem; cursor: pointer;" data-bs-toggle="popover" data-bs-title="International Law" data-bs-content="Principles governing relations between nations and international organizations." data-bs-placement="top">{{ app()->getLocale() === 'km' ? ' ច ា ប អ ន ្ ត ប រ ស ស' : 'International Law' }}</span>
                                        <span class="course-badge px-3 py-1 rounded-pill" style="background: #f8fafc; color: #003A46; font-size: 0.85rem; cursor: pointer;" data-bs-toggle="popover" data-bs-title="Human Rights Law" data-bs-content="Study of fundamental human rights, protections, and international conventions." data-bs-placement="top">{{ app()->getLocale() === 'km' ? ' ច ា ប ម ន ុ ស' : 'Human Rights Law' }}</span>
                                        <span class="course-badge px-3 py-1 rounded-pill" style="background: #f8fafc; color: #003A46; font-size: 0.85rem; cursor: pointer;" data-bs-toggle="popover" data-bs-title="Corporate Law" data-bs-content="Legal aspects of business formation, governance, and compliance." data-bs-placement="top">{{ app()->getLocale() === 'km' ? ' ច ា ប គ ្ រ ប គ រ' : 'Corporate Law' }}</span>
                                    </div>
                                </td>
                            </tr>
                            <tr style="transition: all 0.3s ease; background: #f8fafc;">
                                <td class="py-4 px-4">
                                    <span class="badge px-3 py-2" style="background: #D4AF37; color: white; font-size: 0.9rem;">{{ app()->getLocale() === 'km' ? 'ឆ្នាំ ៤' : 'Year 4' }}</span>
                                </td>
                                <td class="py-4 px-4 fw-bold" style="color: #003A46;">
                                    {{ app()->getLocale() === 'km' ? ' ប េ ស ៈ' : 'Capstone' }}
                                </td>
                                <td class="py-4 px-4">
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="course-badge px-3 py-1 rounded-pill" style="background: #fef9e7; color: #D4AF37; font-size: 0.85rem; border: 1px solid #D4AF37; cursor: pointer;" data-bs-toggle="popover" data-bs-title="Capstone Project" data-bs-content="A comprehensive final project integrating all learned legal concepts and skills." data-bs-placement="top">{{ app()->getLocale() === 'km' ? ' ប Ḟ ស ៈ ច ុ ង ក រ' : 'Capstone Project' }}</span>
                                        <span class="course-badge px-3 py-1 rounded-pill" style="background: #fef9e7; color: #D4AF37; font-size: 0.85rem; border: 1px solid #D4AF37; cursor: pointer;" data-bs-toggle="popover" data-bs-title="Practical Training" data-bs-content="Hands-on legal practice through internships and court observations." data-bs-placement="top">{{ app()->getLocale() === 'km' ? ' ក ា រ អ ន ុ វ ត ត' : 'Practical Training' }}</span>
                                        <span class="course-badge px-3 py-1 rounded-pill" style="background: #fef9e7; color: #D4AF37; font-size: 0.85rem; border: 1px solid #D4AF37; cursor: pointer;" data-bs-toggle="popover" data-bs-title="Legal Ethics" data-bs-content="Professional responsibility and ethical standards in legal practice." data-bs-placement="top">{{ app()->getLocale() === 'km' ? ' ច ា ប ប រ ត ិ ស' : 'Legal Ethics' }}</span>
                                        <span class="course-badge px-3 py-1 rounded-pill" style="background: #fef9e7; color: #D4AF37; font-size: 0.85rem; border: 1px solid #D4AF37; cursor: pointer;" data-bs-toggle="popover" data-bs-title="Final Thesis" data-bs-content="An independent research project on a selected legal topic." data-bs-placement="top">{{ app()->getLocale() === 'km' ? ' ច ា ប ប រ ហ ទ ប' : 'Final Thesis' }}</span>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

<!-- Entry Requirements Section -->
<section class="py-5" style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3" style="color: #003A46;">
                <i class="bi bi-clipboard-check me-2"></i>{{ app()->getLocale() === 'km' ? 'តម្រូវការ ចូល' : 'Entry Requirements' }}
            </h2>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-8">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="p-4 h-100" style="background: white; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
                            <div class="d-flex align-items-center mb-3">
                                <div style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, #003A46, #005f6b); display: flex; align-items: center; justify-content: center; color: white; margin-right: 15px;">
                                    <i class="bi bi-mortarboard"></i>
                                </div>
                                <h5 class="fw-bold mb-0" style="color: #003A46;">{{ app()->getLocale() === 'km' ? ' តម្រូវ អប់រំ' : 'Academic Requirements' }}</h5>
                            </div>
                            <ul class="list-unstyled" style="color: #64748b; font-size: 0.95rem;">
                                <li class="mb-2"><i class="bi bi-check-circle me-2" style="color: #003A46;"></i>{{ app()->getLocale() === 'km' ? ' សញ្ញាបត្រ មធ្យម សិក្សា' : 'High School Diploma' }}</li>
                                <li class="mb-2"><i class="bi bi-check-circle me-2" style="color: #003A46;"></i>{{ app()->getLocale() === 'km' ? ' GPA យ៉ាង តិច 2.5' : 'Minimum GPA 2.5/4.0' }}</li>
                                <li class="mb-2"><i class="bi bi-check-circle me-2" style="color: #003A46;"></i>{{ app()->getLocale() === 'km' ? ' ប្រវត្តិ ការ សិក្សា' : 'Academic Transcripts' }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-4 h-100" style="background: white; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
                            <div class="d-flex align-items-center mb-3">
                                <div style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, #003A46, #005f6b); display: flex; align-items: center; justify-content: center; color: white; margin-right: 15px;">
                                    <i class="bi bi-translate"></i>
                                </div>
                                <h5 class="fw-bold mb-0" style="color: #003A46;">{{ app()->getLocale() === 'km' ? ' ភាសា អង់គ្លេស' : 'English Proficiency' }}</h5>
                            </div>
                            <ul class="list-unstyled" style="color: #64748b; font-size: 0.95rem;">
                                <li class="mb-2"><i class="bi bi-check-circle me-2" style="color: #003A46;"></i>IELTS: 5.5+</li>
                                <li class="mb-2"><i class="bi bi-check-circle me-2" style="color: #003A46;"></i>TOEFL: 70+</li>
                                <li class="mb-2"><i class="bi bi-check-circle me-2" style="color: #003A46;"></i>{{ app()->getLocale() === 'km' ? ' ឬ សម មោទ ន ប' : 'Or equivalent' }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Areas of Study / Tracks -->
<section id="specializations" class="py-5" style="background: #ffffff;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="px-4 py-2 mb-3 d-inline-block" 
                  style="background: rgba(0,58,70,0.1); color: #003A46; border-radius: 50px; font-size: 0.875rem; font-weight: 600;">
                <i class="bi bi-compass me-2"></i>{{ app()->getLocale() === 'km' ? 'ការិតសម្រាប់' : 'Areas of Study' }}
            </span>
            <h2 class="fw-bold mb-3" style="color: #003A46;">
                {{ app()->getLocale() === 'km' ? 'ជំនាញផ្នែកច្បាប់' : 'Law Specializations' }}
            </h2>
            <p class="text-muted" style="max-width: 600px; margin: 0 auto;">
                {{ app()->getLocale() === 'km' ? 
                    'ជ្រើសរើសជំនាញដែលសាកសមសម្រាប់អ្នក' : 
                    'Choose your specialization path within the law program' }}
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="p-4 h-100" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 20px; border: 1px solid #e2e8f0; transition: all 0.3s ease;">
                    <div style="width: 60px; height: 60px; border-radius: 16px; background: linear-gradient(135deg, #003A46, #005f6b); display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="bi bi-building text-white fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-2" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'ច្បាប់ពាណិជ្ជ' : 'Corporate Law' }}</h5>
                    <p class="text-muted small mb-0">{{ app()->getLocale() === 'km' ? 'ច្បាប់ក្រុងសហគ្រាស និង ពាណិជ្ជកម្ម' : 'Business law, contracts, mergers, and commercial regulations' }}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="p-4 h-100" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 20px; border: 1px solid #e2e8f0; transition: all 0.3s ease;">
                    <div style="width: 60px; height: 60px; border-radius: 16px; background: linear-gradient(135deg, #D4AF37, #b8962e); display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="bi bi-shield-check text-white fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-2" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'ច្បាប់ពេទ្យ' : 'Criminal Law' }}</h5>
                    <p class="text-muted small mb-0">{{ app()->getLocale() === 'km' ? 'ច្បាប់ពេទ្យ និង យុត្តិកម្មពេទ្យ' : 'Criminal procedure, prosecution, and defense strategies' }}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="p-4 h-100" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 20px; border: 1px solid #e2e8f0; transition: all 0.3s ease;">
                    <div style="width: 60px; height: 60px; border-radius: 16px; background: linear-gradient(135deg, #00AACC, #0088aa); display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="bi bi-globe text-white fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-2" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'ច្បាប់អន្តរជាតិ' : 'International Law' }}</h5>
                    <p class="text-muted small mb-0">{{ app()->getLocale() === 'km' ? 'ច្បាប់អន្តរជាតិ និង ទំនាក់ទំនង' : 'International treaties, diplomacy, and cross-border regulations' }}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="p-4 h-100" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 20px; border: 1px solid #e2e8f0; transition: all 0.3s ease;">
                    <div style="width: 60px; height: 60px; border-radius: 16px; background: linear-gradient(135deg, #7c3aed, #5b21b6); display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="bi bi-people text-white fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-2" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'ច្បាប់សិទ្ធិ' : 'Human Rights Law' }}</h5>
                    <p class="text-muted small mb-0">{{ app()->getLocale() === 'km' ? 'ច្បាប់សិទ្ធិមនុស្ស និង សេចក្តីសម្រេច' : 'Human rights protection, advocacy, and constitutional law' }}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="p-4 h-100" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 20px; border: 1px solid #e2e8f0; transition: all 0.3s ease;">
                    <div style="width: 60px; height: 60px; border-radius: 16px; background: linear-gradient(135deg, #059669, #047857); display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="bi bi-house text-white fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-2" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'ច្បាប់អចិន្ត្រ' : 'Property Law' }}</h5>
                    <p class="text-muted small mb-0">{{ app()->getLocale() === 'km' ? 'ច្បាប់អចិន្ត្រ និង ការដ្ឋាន' : 'Real estate, property rights, and land registration' }}</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="p-4 h-100" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 20px; border: 1px solid #e2e8f0; transition: all 0.3s ease;">
                    <div style="width: 60px; height: 60px; border-radius: 16px; background: linear-gradient(135deg, #dc2626, #b91c1c); display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="bi bi-gavel text-white fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-2" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'ច្បាប់រដ្ឋបាល' : 'Administrative Law' }}</h5>
                    <p class="text-muted small mb-0">{{ app()->getLocale() === 'km' ? 'ច្បាប់រដ្ឋបាល និង បទបត្តិ' : 'Government regulations, administrative procedures, and appeals' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Experiential Learning -->
<section id="experience" class="py-5" style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="px-4 py-2 mb-3 d-inline-block" 
                      style="background: #003A46; color: white; border-radius: 50px; font-size: 0.875rem; font-weight: 600;">
                    <i class="bi bi-briefcase me-2"></i>{{ app()->getLocale() === 'km' ? 'បទពិសោធន៍' : 'Experiential Learning' }}
                </span>
                <h2 class="fw-bold mb-4" style="color: #003A46; font-size: 2rem;">
                    {{ app()->getLocale() === 'km' ? 'ការអនុវត្តជាក់ស្តែង' : 'Hands-On Legal Experience' }}
                </h2>
                <p class="text-muted mb-4" style="line-height: 1.8;">
                    {{ app()->getLocale() === 'km' ? 
                        'និស្សិតរៀនតែម្តងមេឃរដ្ឋ ប៉ុន្តែយើងផ្តល់ឱកាសជាក់ស្តែង ដើម្បីអនុវត្តច្បាប់ នៅក្នុងបរិយាយការណ៍ពិត ។' : 
                        'Gain real-world legal experience through our comprehensive experiential learning programs that prepare you for practice.' }}
                </p>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <div style="width: 40px; height: 40px; border-radius: 10px; background: #003A46; display: flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">
                                <i class="bi bi-hammer text-white"></i>
                            </div>
                            <div>
                                <div class="fw-bold" style="color: #003A46; font-size: 0.9rem;">{{ app()->getLocale() === 'km' ? 'តុក្កតារម្មយាក' : 'Moot Court' }}</div>
                                <small class="text-muted">{{ app()->getLocale() === 'km' ? 'ការប្រកួត' : 'Competitions' }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <div style="width: 40px; height: 40px; border-radius: 10px; background: #00AACC; display: flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">
                                <i class="bi bi-briefcase text-white"></i>
                            </div>
                            <div>
                                <div class="fw-bold" style="color: #003A46; font-size: 0.9rem;">{{ app()->getLocale() === 'km' ? 'ការហាត់' : 'Internships' }}</div>
                                <small class="text-muted">{{ app()->getLocale() === 'km' ? 'នៅតុលាការ' : 'Court & Firms' }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <div style="width: 40px; height: 40px; border-radius: 10px; background: #D4AF37; display: flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">
                                <i class="bi bi-clipboard-check text-white"></i>
                            </div>
                            <div>
                                <div class="fw-bold" style="color: #003A46; font-size: 0.9rem;">{{ app()->getLocale() === 'km' ? 'គ្លីនិក' : 'Clinics' }}</div>
                                <small class="text-muted">{{ app()->getLocale() === 'km' ? 'សេវកម្ម' : 'Legal Aid' }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <div style="width: 40px; height: 40px; border-radius: 10px; background: #7c3aed; display: flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">
                                <i class="bi bi-search text-white"></i>
                            </div>
                            <div>
                                <div class="fw-bold" style="color: #003A46; font-size: 0.9rem;">{{ app()->getLocale() === 'km' ? 'ស្រាវជ្រាវ' : 'Research' }}</div>
                                <small class="text-muted">{{ app()->getLocale() === 'km' ? 'ច្បាប់' : 'Legal Papers' }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=600&q=80" 
                         alt="Moot Court" 
                         class="img-fluid rounded-4 shadow-lg"
                         style="width: 100%;">
                    <div class="position-absolute bottom-0 start-0 end-0 p-4" style="background: linear-gradient(transparent, rgba(0,58,70,0.9)); border-radius: 0 0 1rem 1rem;">
                        <div class="text-white">
                            <i class="bi bi-trophy me-2" style="color: #D4AF37;"></i>
                            <span class="fw-bold">{{ app()->getLocale() === 'km' ? 'ជាង 20 ឆ្នាំនៃភាពជោគជ័យ' : '20+ Years of Moot Court Excellence' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Student Testimonial -->
<section id="testimonial" class="py-5" style="background: #ffffff;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5">
                    <span class="px-4 py-2 mb-3 d-inline-block" 
                          style="background: rgba(0,58,70,0.1); color: #003A46; border-radius: 50px; font-size: 0.875rem; font-weight: 600;">
                        <i class="bi bi-quote me-2"></i>{{ app()->getLocale() === 'km' ? ' មតិយោបល់' : 'Student Voices' }}
                    </span>
                </div>
                <div class="p-5" style="background: linear-gradient(135deg, #003A46 0%, #005f6b 100%); border-radius: 24px; position: relative;">
                    <i class="bi bi-quote" style="position: absolute; top: 20px; left: 30px; font-size: 4rem; color: rgba(255,255,255,0.1);"></i>
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <p class="text-white mb-4" style="font-size: 1.25rem; line-height: 1.8; font-style: italic;">
                                "{{ app()->getLocale() === 'km' ? 
                                    'កម្មវិធីច្បាប់នៅ NUMiLaw បានផ្តល់ឱកាសដ៏ល្អមួយ ដើម្បីអភិវឌ្ឍជំនាញ និង ទំនាក់ទំនង ។ គ្រូបង្រៀនមានបទពិសោធន៍ និង ផ្តល់ការណែនាំដ៏មានតម្លៃ ។' : 
                                    'The law program at NUMiLaw has provided me with excellent opportunities to develop my skills and network. The faculty are experienced and provide invaluable guidance for my future career in law.' }}"
                            </p>
                            <div class="d-flex align-items-center">
                                <div style="width: 50px; height: 50px; border-radius: 50%; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                    <i class="bi bi-person-fill text-white fs-5"></i>
                                </div>
                                <div>
                                    <div class="text-white fw-bold">{{ app()->getLocale() === 'km' ? 'និស្សិត' : 'Current Student' }}</div>
                                    <small class="text-white-50">LLB Batch 2024</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 d-none d-lg-block text-center">
                            <i class="bi bi-mortarboard-fill text-white" style="font-size: 6rem; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var popoverTriggerList = [].slice.call(document.querySelectorAll('.course-badge'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl, {
            trigger: 'hover',
            placement: 'top',
            html: true,
            template: '<div class="popover" role="tooltip"><div class="popover-arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
        });
    });
});

// Smooth scroll for section navigation
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

// Active section highlighting on scroll
const sections = document.querySelectorAll('section[id]');
const pageNavLinks = document.querySelectorAll('.page-nav a[href^="#"]');

window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        if (scrollY >= sectionTop - 150) {
            current = section.getAttribute('id');
        }
    });
    
    pageNavLinks.forEach(link => {
        link.style.color = '';
        if (link.getAttribute('href') === '#' + current) {
            link.style.color = '#003A46';
        }
    });
});
</script>
@endpush

@endsection
