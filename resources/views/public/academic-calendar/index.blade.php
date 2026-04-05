@extends('layouts.public')

@section('title', app()->getLocale() === 'km' ? 'ប្រតិទិនសិក្សា' : 'Academic Calendar')

@push('styles')
<style>
    .calendar-header-animated {
        position: relative;
        overflow: hidden;
        background: #f5fff5;
        min-height: 280px;
        padding: 65px 0;
    }

    .calendar-header-animated .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .calendar-header-animated .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .calendar-header-animated .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .calendar-header-animated .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .calendar-header-animated .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .calendar-header-animated .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .calendar-header-animated .b5 {
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

    .calendar-header-animated .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,255,245,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .calendar-header-animated .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .calendar-header-animated .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .calendar-header-animated .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }
    .modern-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        border: none;
        transition: all 0.4s ease;
    }
    .modern-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    .filter-dropdown {
        background: white;
        border: 2px solid rgba(255,255,255,0.3);
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-weight: 500;
        color: #fff;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .filter-dropdown:hover, .filter-dropdown:focus {
        background: rgba(255,255,255,0.2);
        border-color: #fff;
    }
    .filter-dropdown option {
        color: #003A46;
        background: white;
    }
    .view-btn {
        padding: 8px 24px;
        border: 0;
        border-radius: 100px;
        background-color: rgba(255,255,255,0.15);
        color: #fff;
        font-weight: 600;
        transition: all 0.5s;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }
    .view-btn:hover, .view-btn.active {
        background-color: #fff;
        color: #003A46;
    }
    .modern-calendar {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    .calendar-week-header {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        background: linear-gradient(135deg, #003A46 0%, #005f6b 100%);
    }
    .calendar-week-header > div {
        padding: 1rem;
        text-align: center;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        background: #e2e8f0;
        gap: 1px;
    }
    .calendar-day {
        background: white;
        min-height: 110px;
        padding: 0.5rem;
        position: relative;
        transition: all 0.2s ease;
    }
    .calendar-day:hover {
        background: #f8fafc;
    }
    .calendar-day.other-month {
        background: #f8fafc;
    }
    .calendar-day.other-month .day-number {
        color: #94a3b8;
    }
    .calendar-day.today {
        background: linear-gradient(135deg, #e0f2fe 0%, #fef3c7 100%);
    }
    .calendar-day.today::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #003A46, #00AACC);
    }
    .day-number {
        font-size: 1rem;
        font-weight: 700;
        color: #003A46;
        margin-bottom: 0.5rem;
    }
    .calendar-day.today .day-number {
        color: #003A46;
        background: white;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0,58,70,0.2);
    }
    .event-dot {
        display: block;
        padding: 0.3rem 0.5rem;
        border-radius: 6px;
        font-size: 0.7rem;
        font-weight: 600;
        color: white;
        margin-bottom: 0.25rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: all 0.2s ease;
        cursor: pointer;
        text-decoration: none;
    }
    .event-dot:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .event-more {
        font-size: 0.7rem;
        color: #64748b;
        font-weight: 500;
        cursor: pointer;
    }
    .event-more:hover {
        color: #003A46;
    }
    .legend-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.4rem 0.8rem;
        background: white;
        border-radius: 20px;
        font-size: 0.8rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .legend-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }
    .nav-btn {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        border: 2px solid #e2e8f0;
        background: white;
        color: #003A46;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    .nav-btn:hover {
        background: #003A46;
        color: white;
        border-color: #003A46;
    }
    .nav-btn.current {
        background: linear-gradient(135deg, #003A46, #005f6b);
        color: white;
        border-color: transparent;
    }
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-slide-up { animation: slideUp 0.6s ease-out; }
    @media (max-width: 768px) {
        .calendar-day { min-height: 80px; padding: 0.3rem; }
        .day-number { font-size: 0.85rem; }
        .event-dot { font-size: 0.6rem; padding: 0.2rem 0.4rem; }
        .calendar-week-header > div { padding: 0.5rem; font-size: 0.75rem; }
    }
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="calendar-header-animated">
    <div class="blob-wrapper">
        <div class="blob b1"></div>
        <div class="blob b2"></div>
        <div class="blob b3"></div>
        <div class="blob b4"></div>
        <div class="blob b5"></div>
    </div>
    <div class="fade-bottom"></div>
    <div class="container">
        <div class="header-content">
            <nav aria-label="breadcrumb" style="position: relative; z-index: 10;">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #003A46;">{{ __('navigation.home') }}</a></li>
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'ប្រតិទិនសិក្សា' : 'Academic Calendar' }}</li>
                </ol>
            </nav>
            <h1 class="header-title">
                {{ app()->getLocale() === 'km' ? 'ប្រតិទិនសិក្សា' : 'Academic Calendar' }}
            </h1>
            <p class="header-subtitle">
                {{ app()->getLocale() === 'km' ? 'ពិនិត្9មើលព្រឹត្9ការណ៍សិក្សា និងកាលបរិច្ឆេទសំខាន់ៗ' : 'View academic events, deadlines, and important dates' }}
            </p>
        </div>
    </div>
</section>

<!-- Filters Section -->
<section id="filtersSection" class="py-4" style="background: #f8fafb;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="d-flex gap-3 flex-wrap">
                    <select class="filter-dropdown" onchange="filterByProgram(this.value)" style="background: white; border: 2px solid #e2e8f0; border-radius: 12px; padding: 0.75rem 1rem; font-weight: 500; color: #003A46; cursor: pointer;">
                        <option value="">{{ app()->getLocale() === 'km' ? 'គ្រប់កម្មវិធី' : 'All Programs' }}</option>
                        @foreach($programs as $program)
                            <option value="{{ $program->id }}" {{ $programId == $program->id ? 'selected' : '' }}>
                                {{ $program->title }}
                            </option>
                        @endforeach
                    </select>
                    <select class="filter-dropdown" onchange="filterByType(this.value)" style="background: white; border: 2px solid #e2e8f0; border-radius: 12px; padding: 0.75rem 1rem; font-weight: 500; color: #003A46; cursor: pointer;">
                        <option value="">{{ app()->getLocale() === 'km' ? 'គ្រប់ប្រភេទ' : 'All Event Types' }}</option>
                        @foreach($eventTypes as $typeKey => $label)
                            <option value="{{ $typeKey }}" {{ $type == $typeKey ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <a href="{{ route('public.admission.index') }}" class="btn" style="background: #003A46; color: white; border-radius: 10px; padding: 0.75rem 1.5rem; font-weight: 600; text-decoration: none;">
                    <i class="bi bi-mortarboard me-2"></i>
                    {{ app()->getLocale() === 'km' ? 'ដាក់ពាក្យ' : 'Apply Now' }}
                </a>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-9 main-content">
            <!-- Calendar View -->
            <div id="calendarView" style="display: {{ $view === 'list' ? 'none' : 'block' }};">
                <div class="modern-card p-4">
                    <!-- Calendar Navigation -->
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2" style="background: #003A46; padding: 15px; border-radius: 10px;">
                        <div class="d-flex gap-2">
                            <button onclick="navigateCalendar({{ $year - 1 }}, {{ $month }})" class="nav-btn" title="Previous Year">
                                <i class="bi bi-chevron-double-left"></i>
                            </button>
                            <button onclick="navigateCalendar({{ $prevYear }}, {{ $prevMonth }})" class="nav-btn" title="Previous Month">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button onclick="navigateCalendar({{ date('Y') }}, {{ date('m') }})" class="nav-btn" title="Today">
                                <i class="bi bi-calendar-check"></i>
                            </button>
                        </div>
                        
                        <h3 class="mb-0 fw-bold" style="color: #fff;" id="calendarMonthYear">
                            {{ \Carbon\Carbon::createFromDate($year, $month, 1)->format('F Y') }}
                        </h3>
                        
                        <div class="d-flex gap-2">
                            <button onclick="switchView('list')" class="view-btn {{ $view === 'list' ? 'active' : '' }}" data-view="list" title="List View">
                                <i class="bi bi-list me-1"></i> List
                            </button>
                            <button onclick="switchView('calendar')" class="view-btn {{ $view !== 'list' ? 'active' : '' }}" data-view="calendar" title="Calendar View">
                                <i class="bi bi-grid-3x3-gap me-1"></i> Calendar
                            </button>
                            <button onclick="navigateCalendar({{ $nextYear }}, {{ $nextMonth }})" class="nav-btn" title="Next Month">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                            <button onclick="navigateCalendar({{ $nextMonthYear }}, {{ $nextMonthSame }})" class="nav-btn" title="Same Month Next Year">
                                <i class="bi bi-chevron-double-right"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Calendar Grid -->
                    <div class="modern-calendar">
                        <div class="calendar-week-header">
                            <div>{{ app()->getLocale() === 'km' ? 'អាទិត្យ' : 'Sun' }}</div>
                            <div>{{ app()->getLocale() === 'km' ? 'ចន្ទ' : 'Mon' }}</div>
                            <div>{{ app()->getLocale() === 'km' ? 'អង្គ' : 'Tue' }}</div>
                            <div>{{ app()->getLocale() === 'km' ? 'ពុធ' : 'Wed' }}</div>
                            <div>{{ app()->getLocale() === 'km' ? 'ព្រហស្បតិ៍' : 'Thu' }}</div>
                            <div>{{ app()->getLocale() === 'km' ? 'សុក្រ' : 'Fri' }}</div>
                            <div>{{ app()->getLocale() === 'km' ? 'សៅរ៍' : 'Sat' }}</div>
                        </div>
                        <div class="calendar-grid">
                            @foreach($calendarData as $week)
                                @foreach($week as $day)
                                    @if($day)
                                        <div class="calendar-day @if($day['is_today']) today @endif @if(!$day['is_current_month']) other-month @endif">
                                            <div class="day-number">{{ $day['day'] }}</div>
                                            @if($day['events']->count() > 0)
                                                @foreach($day['events']->take(2) as $event)
                                                    <?php $evtBg = $event->color_code ?: '#003A46'; ?>
                                                    <a href="{{ route('public.academic-calendar.show', $event->id) }}" 
                                                       class="event-dot"
                                                       style="background: {{ $evtBg }}"
                                                       title="{{ $event->title }}">
                                                        {{ Str::limit($event->title, 12) }}
                                                    </a>
                                                @endforeach
                                                @if($day['events']->count() > 2)
                                                    <span class="event-more">+{{ $day['events']->count() - 2 }} {{ app()->getLocale() === 'km' ? 'បន្ថែម' : 'more' }}</span>
                                                @endif
                                            @endif
                                        </div>
                                    @else
                                        <div class="calendar-day other-month"></div>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Legend -->
                    <div class="mt-4 pt-4" style="border-top: 1px solid #e2e8f0;">
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            <span class="legend-pill">
                                <span class="legend-dot" style="background: #dc3545"></span>
                                Deadlines
                            </span>
                            <span class="legend-pill">
                                <span class="legend-dot" style="background: #fd7e14"></span>
                                Exams
                            </span>
                            <span class="legend-pill">
                                <span class="legend-dot" style="background: #28a745"></span>
                                Holidays
                            </span>
                            <span class="legend-pill">
                                <span class="legend-dot" style="background: #007bff"></span>
                                Registration
                            </span>
                            <span class="legend-pill">
                                <span class="legend-dot" style="background: #6610f2"></span>
                                Other
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- List View -->
            <div id="listView" style="display: {{ $view === 'list' ? 'block' : 'none' }};">
                <div class="modern-card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0 fw-bold" style="color: #003A46;">
                            <i class="bi bi-list me-2"></i>{{ app()->getLocale() === 'km' ? 'បញ្ជីព្រឹត្តិការណ៍' : 'Events List' }}
                        </h4>
                        <button onclick="switchView('calendar')" class="view-btn" title="Calendar View">
                            <i class="bi bi-grid-3x3-gap me-1"></i> Calendar
                        </button>
                    </div>
                    @include('public.academic-calendar.partials.events-list', ['events' => $allEvents, 'year' => $year, 'month' => $month])
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-3 mt-4 mt-lg-0">
            <div class="sidebar-events">
                @include('public.academic-calendar.partials.sidebar-events', ['events' => $upcomingEvents])
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function navigateCalendar(year, month) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('year', year);
    urlParams.set('month', month);
    urlParams.set('view', 'calendar');
    
    // Use AJAX to load calendar without page refresh
    fetch('{{ route("public.academic-calendar.index") }}?' + urlParams.toString() + '&ajax=1')
        .then(response => response.json())
        .then(data => {
            // Update entire calendar (week header + grid)
            const oldCalendar = document.querySelector('.modern-calendar');
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = data.calendarGrid;
            const newCalendar = tempDiv.querySelector('.modern-calendar');
            if (oldCalendar && newCalendar) {
                oldCalendar.parentNode.replaceChild(newCalendar, oldCalendar);
            }
            // Update month/year
            document.getElementById('calendarMonthYear').textContent = data.monthYear;
            // Update navigation buttons
            updateNavigation(data.navigation);
            // Update sidebar events
            if (data.sidebarEvents) {
                const sidebarContainer = document.querySelector('.sidebar-events');
                if (sidebarContainer) {
                    sidebarContainer.innerHTML = data.sidebarEvents;
                }
            }
            // Update URL without refresh
            window.history.pushState({}, '', '{{ route("public.academic-calendar.index") }}?' + urlParams.toString());
        })
        .catch(error => {
            console.error('Error:', error);
            // Fallback to page refresh
            window.location.search = urlParams.toString();
        });
}

function updateNavigation(nav) {
    const buttons = document.querySelectorAll('.nav-btn');
    if (buttons[0]) buttons[0].setAttribute('onclick', 'navigateCalendar(' + nav.prevYear + ', ' + nav.month + ')');
    if (buttons[1]) buttons[1].setAttribute('onclick', 'navigateCalendar(' + nav.prevYear + ', ' + nav.prevMonth + ')');
    if (buttons[2]) buttons[2].setAttribute('onclick', 'navigateCalendar(' + nav.todayYear + ', ' + nav.todayMonth + ')');
    if (buttons[3]) buttons[3].setAttribute('onclick', 'navigateCalendar(' + nav.nextYear + ', ' + nav.nextMonth + ')');
    if (buttons[4]) buttons[4].setAttribute('onclick', 'navigateCalendar(' + nav.nextMonthYear + ', ' + nav.nextMonthSame + ')');
}

function switchView(view) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('view', view);
    
    // Toggle sidebar visibility
    const sidebar = document.querySelector('.sidebar-events');
    if (sidebar) {
        sidebar.style.display = view === 'calendar' ? 'block' : 'none';
    }
    
    // Toggle filters visibility
    const filters = document.getElementById('filtersSection');
    if (filters) {
        filters.style.display = view === 'list' ? 'block' : 'none';
    }
    
    // Toggle main content width
    const mainContent = document.querySelector('.main-content');
    if (mainContent) {
        mainContent.className = view === 'list' ? 'col-12 main-content' : 'col-lg-9 main-content';
    }
    
    // Use AJAX to load view without page refresh
    fetch('{{ route("public.academic-calendar.index") }}?' + urlParams.toString() + '&ajax=1')
        .then(response => response.json())
        .then(data => {
            if (view === 'list') {
                // Update list view content
                document.getElementById('listView').innerHTML = data.eventsList;
            }
            // Toggle view visibility
            document.getElementById('calendarView').style.display = view === 'calendar' ? 'block' : 'none';
            document.getElementById('listView').style.display = view === 'list' ? 'block' : 'none';
            
            // Update button styles
            document.querySelectorAll('[data-view]').forEach(btn => {
                if (btn.dataset.view === view) {
                    btn.style.background = 'linear-gradient(135deg, #003A46, #005f6b)';
                    btn.style.color = 'white';
                    btn.classList.add('active');
                } else {
                    btn.style.background = '#e2e8f0';
                    btn.style.color = '#003A46';
                    btn.classList.remove('active');
                }
            });
            
            // Update URL without refresh
            window.history.pushState({}, '', '{{ route("public.academic-calendar.index") }}?' + urlParams.toString());
        })
        .catch(error => {
            console.error('Error:', error);
            // Fallback to page refresh
            window.location.search = urlParams.toString();
        });
}

function initViewToggle() {
    const urlParams = new URLSearchParams(window.location.search);
    const view = urlParams.get('view') || 'calendar';
    
    // Toggle sidebar visibility
    const sidebar = document.querySelector('.sidebar-events');
    if (sidebar) {
        sidebar.style.display = view === 'calendar' ? 'block' : 'none';
    }
    
    // Toggle filters visibility
    const filters = document.getElementById('filtersSection');
    if (filters) {
        filters.style.display = view === 'list' ? 'block' : 'none';
    }
    
    // Toggle main content width
    const mainContent = document.querySelector('.main-content');
    if (mainContent) {
        mainContent.className = view === 'list' ? 'col-12 main-content' : 'col-lg-9 main-content';
    }
    
    document.querySelectorAll('[data-view]').forEach(btn => {
        if (btn.dataset.view === view) {
            btn.style.background = 'linear-gradient(135deg, #003A46, #005f6b)';
            btn.style.color = 'white';
            btn.classList.add('active');
        } else {
            btn.style.background = '#e2e8f0';
            btn.style.color = '#003A46';
            btn.classList.remove('active');
        }
    });
    
    document.getElementById('calendarView').style.display = view === 'calendar' ? 'block' : 'none';
    document.getElementById('listView').style.display = view === 'list' ? 'block' : 'none';
}

function filterByProgram(programId) {
    const urlParams = new URLSearchParams(window.location.search);
    const currentView = urlParams.get('view') || 'calendar';
    
    urlParams.set('view', currentView);
    if (programId) {
        urlParams.set('program_id', programId);
    } else {
        urlParams.delete('program_id');
    }
    
    applyFilter(urlParams, currentView);
}

function filterByType(type) {
    const urlParams = new URLSearchParams(window.location.search);
    const currentView = urlParams.get('view') || 'calendar';
    
    urlParams.set('view', currentView);
    if (type) {
        urlParams.set('type', type);
    } else {
        urlParams.delete('type');
    }
    
    applyFilter(urlParams, currentView);
}

function applyFilter(urlParams, currentView) {
    fetch('{{ route("public.academic-calendar.index") }}?' + urlParams.toString() + '&ajax=1')
        .then(response => response.json())
        .then(data => {
            if (currentView === 'list') {
                document.getElementById('listView').innerHTML = data.eventsList;
            } else {
                // Update calendar
                const oldCalendar = document.querySelector('.modern-calendar');
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = data.calendarGrid;
                const newCalendar = tempDiv.querySelector('.modern-calendar');
                if (oldCalendar && newCalendar) {
                    oldCalendar.parentNode.replaceChild(newCalendar, oldCalendar);
                }
                document.getElementById('calendarMonthYear').textContent = data.monthYear;
            }
            
            // Update URL without refresh
            window.history.pushState({}, '', '{{ route("public.academic-calendar.index") }}?' + urlParams.toString());
        })
        .catch(error => {
            console.error('Error:', error);
            window.location.search = urlParams.toString();
        });
}

document.addEventListener('DOMContentLoaded', function() {
    initViewToggle();
});
</script>
@endpush

@endsection
