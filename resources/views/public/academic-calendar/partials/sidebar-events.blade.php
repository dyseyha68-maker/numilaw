<div class="modern-card p-4 sticky-top" style="top: 100px;">
    <h5 class="fw-bold mb-4" style="color: #003A46;">
        <i class="bi bi-calendar-check me-2"></i>
        {{ app()->getLocale() === 'km' ? 'ព្រឹត្តិការណ៍' : 'Events' }}
    </h5>
    
    @if($events->count() > 0)
        @foreach($events->take(5) as $event)
            <?php 
                $evtColor = $event->color_code ?: '#003A46';
                $eventMonth = $event->start_date instanceof \Carbon\Carbon ? $event->start_date->format('M') : date('M', strtotime($event->start_date));
                $eventDay = $event->start_date instanceof \Carbon\Carbon ? $event->start_date->format('j') : date('j', strtotime($event->start_date));
            ?>
            <div class="mb-3 pb-3" style="border-bottom: 1px solid #e2e8f0;">
                <div class="d-flex gap-2">
                    <div style="width: 40px; height: 40px; background: {{ $evtColor }}; border-radius: 8px; display: flex; flex-direction: column; align-items: center; justify-content: center; color: white;">
                        <span style="font-size: 0.65rem; font-weight: 600;">{{ $eventMonth }}</span>
                        <span style="font-size: 1rem; font-weight: 700; line-height: 1;">{{ $eventDay }}</span>
                    </div>
                    <div>
                        <a href="{{ route('public.academic-calendar.show', $event->id) }}" 
                           class="fw-bold text-decoration-none" 
                           style="color: #003A46; font-size: 0.85rem; display: block;">
                            {{ Str::limit($event->title, 30) }}
                        </a>
                        <span style="font-size: 0.75rem; color: #64748b;">
                            {{ $event->event_type_display }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-muted">{{ app()->getLocale() === 'km' ? 'មិនមានព្រឹត្តិការណ៍' : 'No events' }}</p>
    @endif
</div>
