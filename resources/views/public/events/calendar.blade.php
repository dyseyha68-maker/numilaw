@extends('layouts.public')

@section('title', app()->getLocale() === 'km' ? 'ប្រតិទិនព្រឹត្តិការណ៍' : 'Event Calendar')

@push('styles')
<style>
    .event-cal-header {
        position: relative;
        overflow: hidden;
        background: #f5fff5;
        min-height: 280px;
        padding: 60px 0 40px;
    }

    .event-cal-header .blob-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .event-cal-header .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.038;
        mix-blend-mode: multiply;
    }

    .event-cal-header .b1 {
        width: 150%; height: 150%;
        top: -50px; left: -25%;
        animation: moveB1 14s ease-in-out infinite alternate, colorB1 10s ease-in-out infinite alternate;
    }
    .event-cal-header .b2 {
        width: 140%; height: 140%;
        top: -30px; left: -20%;
        animation: moveB2 17s ease-in-out infinite alternate, colorB2 13s ease-in-out infinite alternate;
    }
    .event-cal-header .b3 {
        width: 130%; height: 130%;
        top: -10px; left: -15%;
        animation: moveB3 20s ease-in-out infinite alternate, colorB3 8s ease-in-out infinite alternate;
    }
    .event-cal-header .b4 {
        width: 120%; height: 120%;
        top: 10px; left: -10%;
        animation: moveB4 11s ease-in-out infinite alternate, colorB4 16s ease-in-out infinite alternate;
    }
    .event-cal-header .b5 {
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

    .event-cal-header .fade-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(245,255,245,0) 0%, rgba(248,250,251,1) 100%);
        z-index: 1;
        pointer-events: none;
    }

    .event-cal-header .header-content {
        position: relative;
        z-index: 2;
        margin-top: 30px;
    }

    .event-cal-header .header-title {
        font-family: var(--current-font);
        font-size: 2.5rem;
        font-weight: 600;
        color: #003A46;
        margin: 0 0 8px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .event-cal-header .header-subtitle {
        font-family: var(--current-font);
        font-size: 1.1rem;
        color: #64748b;
        margin: 0;
    }

    :root {
        --primary: #003A46;
        --primary-light: #005f6b;
        --accent: #00a8cc;
        --shadow-soft: 0 8px 32px rgba(0, 58, 70, 0.12);
        --shadow-hover: 0 12px 40px rgba(0, 58, 70, 0.18);
        --cal-upcoming: #10b981;
        --cal-ongoing: #f59e0b;
        --cal-completed: #6b7280;
    }

    .calendar-wrapper {
        background: white;
        border-radius: 24px;
        box-shadow: var(--shadow-soft);
        overflow: hidden;
    }

    .calendar-header-modern {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 32px;
        color: white;
    }

    .month-nav-modern {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .month-nav-btn-modern {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        border: 2px solid rgba(255,255,255,0.3);
        background: rgba(255,255,255,0.1);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1.2rem;
    }

    .month-nav-btn-modern:hover {
        background: white;
        color: var(--primary);
        border-color: white;
        transform: translateY(-2px);
    }

    .current-month-modern h2 {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0;
    }

    .current-month-modern span {
        font-size: 0.95rem;
        opacity: 0.85;
    }

    .view-toggle-modern {
        display: flex;
        background: rgba(255,255,255,0.15);
        border-radius: 12px;
        padding: 4px;
        gap: 4px;
    }

    .view-toggle-btn-modern {
        padding: 10px 18px;
        border: none;
        background: transparent;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        color: rgba(255,255,255,0.8);
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .view-toggle-btn-modern.active {
        background: white;
        color: var(--primary);
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    .view-toggle-btn-modern:hover:not(.active) {
        background: rgba(255,255,255,0.2);
        color: white;
    }

    .today-btn-modern {
        padding: 10px 16px;
        border: 2px solid rgba(255,255,255,0.4);
        background: transparent;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .today-btn-modern:hover {
        background: white;
        color: var(--primary);
        border-color: white;
    }

    .calendar-grid-modern {
        padding: 24px;
    }

    .weekday-header-modern {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
        margin-bottom: 12px;
    }

    .weekday-modern {
        text-align: center;
        padding: 14px 8px;
        font-weight: 700;
        font-size: 0.8rem;
        color: var(--primary);
        text-transform: uppercase;
        letter-spacing: 1px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 10px;
    }

    .days-grid-modern {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
    }

    .calendar-day-modern {
        min-height: 100px;
        background: white;
        border-radius: 16px;
        padding: 12px;
        border: 2px solid #f1f5f9;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        position: relative;
    }

    .calendar-day-modern:hover {
        border-color: var(--accent);
        box-shadow: 0 8px 24px rgba(0, 58, 70, 0.12);
        transform: translateY(-3px);
    }

    .calendar-day-modern.other-month {
        background: #fafbfc;
        border-color: transparent;
    }

    .calendar-day-modern.other-month .day-number {
        color: #cbd5e1;
    }

    .calendar-day-modern.today-modern {
        border-color: var(--primary);
        background: linear-gradient(135deg, rgba(0,58,70,0.03) 0%, rgba(0,168,204,0.03) 100%);
    }

    .calendar-day-modern.today-modern::before {
        content: '';
        position: absolute;
        top: 8px;
        right: 8px;
        width: 8px;
        height: 8px;
        background: var(--primary);
        border-radius: 50%;
    }

    .day-number {
        font-size: 1rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 8px;
    }

    .day-events-modern {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .day-event-modern {
        font-size: 0.7rem;
        padding: 5px 8px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: all 0.2s ease;
    }

    .day-event-modern:hover {
        transform: translateX(2px);
    }

    .day-event-modern.upcoming {
        background: rgba(16, 185, 129, 0.12);
        color: #059669;
    }

    .day-event-modern.ongoing {
        background: rgba(245, 158, 11, 0.12);
        color: #d97706;
    }

    .day-event-modern.completed {
        background: rgba(107, 114, 128, 0.12);
        color: #6b7280;
    }

    .more-events-modern {
        font-size: 0.65rem;
        color: var(--primary);
        font-weight: 600;
        padding: 4px 8px;
        background: #f1f5f9;
        border-radius: 6px;
        text-align: center;
    }

    .legend-modern {
        display: flex;
        justify-content: center;
        gap: 32px;
        padding: 20px;
        background: #f8fafc;
        border-top: 1px solid #f1f5f9;
    }

    .legend-item-modern {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #64748b;
    }

    .legend-dot-modern {
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    .legend-dot-modern.upcoming { background: var(--cal-upcoming); }
    .legend-dot-modern.ongoing { background: var(--cal-ongoing); }
    .legend-dot-modern.completed { background: var(--cal-completed); }

    .events-section-modern {
        padding: 48px 0;
        background: #f8fafb;
    }

    .section-header-modern {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
    }

    .section-title-modern {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-title-modern i {
        font-size: 1.3rem;
        color: var(--accent);
    }

    .btn-modern {
        padding: 12px 24px;
        background: var(--primary);
        color: white;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-modern:hover {
        background: var(--primary-light);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0,58,70,0.25);
    }

    .event-card-modern {
        background: white;
        border-radius: 16px;
        padding: 20px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        display: block;
    }

    .event-card-modern:hover {
        border-color: var(--accent);
        box-shadow: 0 12px 32px rgba(0,58,70,0.12);
        transform: translateY(-4px);
    }

    .event-date-badge-modern {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        border-radius: 12px;
        padding: 12px 16px;
        text-align: center;
        min-width: 70px;
    }

    .event-date-badge-modern .month {
        display: block;
        font-size: 0.75rem;
        font-weight: 600;
        color: rgba(255,255,255,0.8);
        text-transform: uppercase;
    }

    .event-date-badge-modern .day {
        display: block;
        font-size: 1.5rem;
        font-weight: 800;
        color: white;
    }

    .event-card-content-modern h4 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--primary);
        margin: 0 0 8px 0;
        line-height: 1.4;
    }

    .event-meta-modern {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .event-meta-item-modern {
        font-size: 0.8rem;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .event-meta-item-modern i {
        color: var(--accent);
    }

    .empty-state-modern {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state-icon-modern {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 2rem;
        color: #94a3b8;
    }

    .empty-state-modern h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 8px;
    }

    .empty-state-modern p {
        color: #64748b;
    }

    @media (max-width: 992px) {
        .calendar-header-modern {
            flex-direction: column;
            gap: 16px;
        }
        
        .calendar-day-modern {
            min-height: 80px;
            padding: 8px;
        }
        
        .day-event-modern {
            font-size: 0.6rem;
            padding: 3px 5px;
        }
    }

    @media (max-width: 768px) {
        .calendar-grid-modern {
            padding: 12px;
        }
        
        .weekday-header-modern {
            display: none;
        }
        
        .days-grid-modern {
            grid-template-columns: repeat(7, 1fr);
            gap: 6px;
        }
        
        .calendar-day-modern {
            min-height: 60px;
            padding: 6px;
        }
        
        .day-number {
            font-size: 0.85rem;
        }
        
        .section-header-modern {
            flex-direction: column;
            gap: 16px;
            text-align: center;
        }
        
        .legend-modern {
            flex-wrap: wrap;
            gap: 16px;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="event-cal-header">
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
                    <li class="breadcrumb-item"><a href="{{ route('public.events.index') }}" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'ព្រឹត្តិការណ៍' : 'Events' }}</a></li>
                    <li class="breadcrumb-item active" style="color: #003A46;">{{ app()->getLocale() === 'km' ? 'ប្រតិទិន' : 'Calendar' }}</li>
                </ol>
            </nav>
            <h1 class="header-title">
                {{ app()->getLocale() === 'km' ? 'ប្រតិទិនព្រឹត្តិការណ៍' : 'Event Calendar' }}
            </h1>
            <p class="header-subtitle">
                {{ app()->getLocale() === 'km' ? 'មើលប្រតិទិនព្រឹត្តិការណ៍ និង សកម្មភាព' : 'View all events and activities in calendar view' }}
            </p>
        </div>
    </div>
</section>

<!-- Calendar Section -->
<div class="container py-5" style="background: #f8fafb;">
    <div class="calendar-wrapper">
        <!-- Calendar Header -->
        <div class="calendar-header-modern">
        <div class="month-nav-modern">
            @php
                $prevMonth = \Carbon\Carbon::createFromDate($year, $month)->subMonth();
                $nextMonth = \Carbon\Carbon::createFromDate($year, $month)->addMonth();
                $currentMonthName = \Carbon\Carbon::createFromDate($year, $month)->format('F Y');
            @endphp
            <a href="{{ route('public.events.calendar', ['month' => $prevMonth->month, 'year' => $prevMonth->year]) }}" class="month-nav-btn-modern">
                <i class="bi bi-chevron-left"></i>
            </a>
            
            <div class="current-month-modern text-center">
                <h2>{{ app()->getLocale() === 'km' ? \Carbon\Carbon::createFromDate($year, $month)->locale('km')->format('MMMM Y') : $currentMonthName }}</h2>
                <span>{{ \Carbon\Carbon::createFromDate($year, $month)->daysInMonth }} {{ app()->getLocale() === 'km' ? 'ថ្ងៃ' : 'days' }}</span>
            </div>
            
            <a href="{{ route('public.events.calendar', ['month' => $nextMonth->month, 'year' => $nextMonth->year]) }}" class="month-nav-btn-modern">
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-3">
            <div class="d-flex gap-2">
                <a href="{{ route('public.events.calendar', ['month' => now()->month, 'year' => now()->year]) }}" class="today-btn-modern">
                    <i class="bi bi-calendar-check"></i>
                    {{ app()->getLocale() === 'km' ? 'ថ្ងៃនេះ' : 'Today' }}
                </a>
            </div>
            <div class="view-toggle-modern">
                <a href="{{ route('public.events.index') }}" class="view-toggle-btn-modern">
                    <i class="bi bi-grid-3x3-gap"></i>
                    {{ app()->getLocale() === 'km' ? 'បញ្ជី' : 'List' }}
                </a>
                <a href="{{ route('public.events.calendar') }}" class="view-toggle-btn-modern active">
                    <i class="bi bi-calendar3"></i>
                    {{ app()->getLocale() === 'km' ? 'ប្រតិទិន' : 'Calendar' }}
                </a>
            </div>
        </div>
    </div>

    <!-- Calendar Grid -->
    <div class="calendar-grid-modern">
        <div class="weekday-header-modern">
            <div class="weekday-modern">{{ app()->getLocale() === 'km' ? 'អា' : 'Sun' }}</div>
            <div class="weekday-modern">{{ app()->getLocale() === 'km' ? 'ច' : 'Mon' }}</div>
            <div class="weekday-modern">{{ app()->getLocale() === 'km' ? 'អ' : 'Tue' }}</div>
            <div class="weekday-modern">{{ app()->getLocale() === 'km' ? 'ព' : 'Wed' }}</div>
            <div class="weekday-modern">{{ app()->getLocale() === 'km' ? 'ព្រ' : 'Thu' }}</div>
            <div class="weekday-modern">{{ app()->getLocale() === 'km' ? 'ស' : 'Fri' }}</div>
            <div class="weekday-modern">{{ app()->getLocale() === 'km' ? 'ស' : 'Sat' }}</div>
        </div>

        <div class="days-grid-modern">
            @php
                $currentMonth = \Carbon\Carbon::createFromDate($year, $month);
                $daysInMonth = $currentMonth->daysInMonth;
                $firstDayOfMonth = $currentMonth->copy()->startOfMonth()->dayOfWeek;
                
                $eventsByDate = [];
                foreach($events as $event) {
                    $eventDate = $event->start_datetime->format('Y-m-d');
                    if (!isset($eventsByDate[$eventDate])) {
                        $eventsByDate[$eventDate] = [];
                    }
                    $eventsByDate[$eventDate][] = $event;
                }
                
                $today = now()->format('Y-m-d');
            @endphp

            <!-- Previous month days -->
            @for($i = 0; $i < $firstDayOfMonth; $i++)
                @php
                    $prevDate = $currentMonth->copy()->subMonth()->daysInMonth - $firstDayOfMonth + $i + 1;
                @endphp
                <div class="calendar-day-modern other-month">
                    <span class="day-number">{{ $prevDate }}</span>
                </div>
            @endfor

            <!-- Current month days -->
            @for($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $currentDate = Carbon\Carbon::createFromDate($year, $month, $day)->format('Y-m-d');
                    $isToday = $today === $currentDate;
                    $dayEvents = $eventsByDate[$currentDate] ?? [];
                @endphp

                <div class="calendar-day-modern @if($isToday) today-modern @endif">
                    <span class="day-number">{{ $day }}</span>
                    
                    @if(count($dayEvents) > 0)
                        <div class="day-events-modern">
                            @foreach(array_slice($dayEvents, 0, 2) as $event)
                                @php
                                    $status = 'upcoming';
                                    if ($event->status === 'completed') {
                                        $status = 'completed';
                                    } elseif ($event->start_datetime->isPast()) {
                                        $status = 'ongoing';
                                    }
                                @endphp
                                <a href="{{ route('public.events.show', $event->slug) }}" 
                                   class="day-event-modern {{ $status }}"
                                   title="{{ $event->title }}">
                                    {{ Str::limit($event->title, 12) }}
                                </a>
                            @endforeach
                            @if(count($dayEvents) > 2)
                                <span class="more-events-modern">+{{ count($dayEvents) - 2 }}</span>
                            @endif
                        </div>
                    @endif
                </div>
            @endfor

            <!-- Next month days to complete grid -->
            @php
                $totalCells = $firstDayOfMonth + $daysInMonth;
                $remainingCells = (7 - ($totalCells % 7)) % 7;
                if ($totalCells % 7 == 0) $remainingCells = 0;
            @endphp
            
            @for($i = 1; $i <= $remainingCells; $i++)
                <div class="calendar-day-modern other-month">
                    <span class="day-number">{{ $i }}</span>
                </div>
            @endfor
        </div>
    </div>

    <!-- Legend -->
    <div class="legend-modern">
        <div class="legend-item-modern">
            <span class="legend-dot-modern upcoming"></span>
            {{ app()->getLocale() === 'km' ? 'នាពេលខាងមុខ' : 'Upcoming' }}
        </div>
        <div class="legend-item-modern">
            <span class="legend-dot-modern ongoing"></span>
            {{ app()->getLocale() === 'km' ? 'កំពុងប្រព្រឹត្ត' : 'Ongoing' }}
        </div>
        <div class="legend-item-modern">
            <span class="legend-dot-modern completed"></span>
            {{ app()->getLocale() === 'km' ? 'បានបញ្ចប់' : 'Completed' }}
        </div>
    </div>
</div>
</div>

<!-- Events List Section -->
<section class="events-section-modern">
    <div class="container">
        <div class="section-header-modern">
            <h3 class="section-title-modern">
                <i class="bi bi-calendar-event"></i>
                {{ app()->getLocale() === 'km' ? 'ព្រឹត្តិការណ៍នៅខែនេះ' : 'Events This Month' }}
            </h3>
            <a href="{{ route('public.events.index') }}" class="btn-modern">
                <i class="bi bi-arrow-right"></i>
                {{ app()->getLocale() === 'km' ? 'មើលទាំងអស់' : 'View All' }}
            </a>
        </div>

        @if($events->count() > 0)
            <div class="row g-4">
                @foreach($events as $event)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('public.events.show', $event->slug) }}" class="event-card-modern">
                            <div class="d-flex gap-3 align-items-start">
                                <div class="event-date-badge-modern">
                                    <span class="month">{{ $event->start_datetime->format('M') }}</span>
                                    <span class="day">{{ $event->start_datetime->format('j') }}</span>
                                </div>
                                <div class="event-card-content-modern flex-grow-1">
                                    <h4>{{ Str::limit($event->title, 50) }}</h4>
                                    <div class="event-meta-modern">
                                        <span class="event-meta-item-modern">
                                            <i class="bi bi-clock"></i>
                                            {{ $event->start_datetime->format('g:i A') }}
                                        </span>
                                        @if($event->location)
                                            <span class="event-meta-item-modern">
                                                <i class="bi bi-geo-alt"></i>
                                                {{ Str::limit($event->location, 25) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state-modern">
                <div class="empty-state-icon-modern">
                    <i class="bi bi-calendar-x"></i>
                </div>
                <h3>{{ app()->getLocale() === 'km' ? 'គ្មានព្រឹត្តិការណ៍' : 'No Events This Month' }}</h3>
                <p>{{ app()->getLocale() === 'km' ? 'សូមមកម្សាន្តពេលក្រោយ' : 'Check back later for upcoming events' }}</p>
            </div>
        @endif
    </div>
</section>
@endsection
