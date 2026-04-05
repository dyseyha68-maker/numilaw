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
