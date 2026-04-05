<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0" style="color: #003A46;">
        {{ app()->getLocale() === 'km' ? 'ព្រឹត្9ិការណ៍ទាំងអស់' : 'All Events' }}
    </h4>
    <button onclick="switchView('calendar')" class="btn btn-sm" style="background: #003A46; color: white; border-radius: 8px;">
        <i class="bi bi-grid-3x3-gap me-1"></i> Calendar
    </button>
</div>

<style>
    .events-container {
        display: grid;
        gap: 15px;
    }
    .event-card {
        background: white;
        border-radius: 12px;
        padding: 16px 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        transition: all 0.2s ease;
        border: 1px solid #e2e8f0;
    }
    .event-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        border-color: #003A46;
    }
    .event-card .date-info {
        font-size: 0.85rem;
        color: #64748b;
        font-weight: 500;
    }
    .event-card .event-title {
        font-size: 1rem;
        font-weight: 600;
        color: #003A46;
        margin: 6px 0;
    }
    .event-card .event-title:hover {
        color: #005f6b;
    }
    .event-card .event-type-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 500;
        color: white;
    }
    .event-card .program-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 8px;
        background: #f1f5f9;
        border-radius: 6px;
        font-size: 0.75rem;
        color: #64748b;
    }
    .event-card .meta-info {
        font-size: 0.8rem;
        color: #94a3b8;
        margin-top: 8px;
    }
    .event-card .meta-info i {
        margin-right: 4px;
    }
    .pagination-container {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }
    .pagination-custom .page-item .page-link {
        color: #003A46;
        border: 1px solid #e2e8f0;
        padding: 8px 14px;
        margin: 0 3px;
        border-radius: 8px;
        font-weight: 500;
    }
    .pagination-custom .page-item.active .page-link {
        background: linear-gradient(135deg, #003A46, #005f6b);
        border-color: #003A46;
        color: white;
    }
    .pagination-custom .page-item .page-link:hover {
        background: #f1f5f9;
    }
</style>

<div class="events-container">
@if($events->count() > 0)
    @foreach($events as $event)
        <?php
            $evtColor = $event->color_code ?: '#003A46';
        $eventTypeIcon = match ($event->event_type) {
            'academic_deadline' => 'bi-flag',
            'exam_period' => 'bi-pencil-square',
            'holiday' => 'bi-calendar holiday',
            'registration' => 'bi-clipboard-check',
            'orientation' => 'bi-person-plus',
            'graduation' => 'bi-mortarboard',
            'semester_start' => 'bi-play-circle',
            'semester_end' => 'bi-stop-circle',
            default => 'bi-calendar-event'
        };
        ?>
        <div class="event-card">
            <div class="d-flex justify-content-between align-items-start">
                <div class="flex-grow-1">
                    <div class="date-info">
                        <i class="bi bi-calendar3"></i>
                        {{ $event->formatted_date_range }}
                    </div>
                    <a href="{{ route('public.academic-calendar.show', $event->id) }}" class="event-title d-block text-decoration-none">
                        {{ $event->title }}
                    </a>
                    <div class="d-flex flex-wrap gap-2 mt-2">
                        <span class="event-type-badge" style="background: {{ $evtColor }}">
                            <i class="bi {{ $eventTypeIcon }}"></i>
                            {{ $event->event_type_display }}
                        </span>
                        @if($event->program)
                        <span class="program-badge">
                            <i class="bi bi-mortarboard"></i>
                            {{ $event->program->title }}
                        </span>
                        @endif
                    </div>
                    @if($event->location)
                    <div class="meta-info">
                        <i class="bi bi-geo-alt"></i>{{ $event->location }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    
    @if($events->hasPages())
    <div class="pagination-container">
        <nav>
            <ul class="pagination pagination-custom">
                @php
                    $currentPage = $events->currentPage();
                    $lastPage = $events->lastPage();
                    $startPage = max(1, $currentPage - 2);
                    $endPage = min($lastPage, $currentPage + 2);
                @endphp
                
                @if($currentPage > 1)
                <li class="page-item">
                    <a href="javascript:void(0)" class="page-link" onclick="loadPage({{ $currentPage - 1 }})">‹</a>
                </li>
                @endif
                
                @for($i = $startPage; $i <= $endPage; $i++)
                <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="page-link" onclick="loadPage({{ $i }})">{{ $i }}</a>
                </li>
                @endfor
                
                @if($currentPage < $lastPage)
                <li class="page-item">
                    <a href="javascript:void(0)" class="page-link" onclick="loadPage({{ $currentPage + 1 }})">›</a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
    @endif
@else
    <div class="text-center py-5">
        <i class="bi bi-calendar-x" style="font-size: 3rem; color: #94a3b8;"></i>
        <p class="text-muted mt-3">{{ app()->getLocale() === 'km' ? 'មិនមានព្រឹត្តិការណ៍ទេ' : 'No events found' }}</p>
    </div>
@endif
</div>

<script>
function loadPage(page) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('view', 'list');
    urlParams.set('page', page);
    
    fetch('{{ route("public.academic-calendar.index") }}?' + urlParams.toString() + '&ajax=1')
        .then(response => response.json())
        .then(data => {
            if (data.eventsList) {
                document.getElementById('listView').innerHTML = data.eventsList;
                window.history.pushState({}, '', '{{ route("public.academic-calendar.index") }}?' + urlParams.toString());
            }
        })
        .catch(error => console.error('Error:', error));
}
</script>
