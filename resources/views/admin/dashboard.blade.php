@extends('admin.layouts.app')

@section('title', 'Dashboard')

@push('styles')
<style>
    .dashboard-header {
        background: linear-gradient(135deg, #003A46 0%, #005f6b 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: #fff;
        position: relative;
        overflow: hidden;
    }
    
    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    
    .dashboard-header h1 { font-size: 1.75rem; font-weight: 700; margin-bottom: 0.5rem; }
    .dashboard-header p { opacity: 0.9; margin: 0; }
    
    .stat-card {
        background: #fff;
        border: none;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); }
    
    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .stat-icon.primary { background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%); color: #0284c7; }
    .stat-icon.success { background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%); color: #16a34a; }
    .stat-icon.warning { background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #d97706; }
    .stat-icon.info { background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%); color: #4f46e5; }
    .stat-icon.moot { background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%); color: #db2777; }
    
    .stat-number { font-size: 2rem; font-weight: 700; color: #1e293b; line-height: 1; margin-bottom: 0.25rem; }
    .stat-label { font-size: 0.875rem; color: #64748b; font-weight: 500; }
    .stat-sublabel { font-size: 0.75rem; color: #94a3b8; margin-top: 0.25rem; }
    
    .dashboard-card {
        background: #fff;
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        height: 100%;
    }
    
    .dashboard-card .card-header {
        background: #fff;
        border-bottom: 1px solid #f1f5f9;
        padding: 1rem 1.25rem;
        font-weight: 600;
        color: #1e293b;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .dashboard-card .card-header i { color: #003A46; margin-right: 0.5rem; }
    .dashboard-card .card-body { padding: 0; }
    
    .activity-item {
        display: flex;
        align-items: center;
        padding: 0.85rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.2s ease;
    }
    
    .activity-item:last-child { border-bottom: none; }
    .activity-item:hover { background: #f8fafc; }
    
    .activity-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.85rem;
        flex-shrink: 0;
    }
    
    .activity-content { flex: 1; min-width: 0; }
    .activity-title { font-weight: 600; color: #1e293b; margin-bottom: 0.15rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: 0.9rem; }
    .activity-meta { font-size: 0.75rem; color: #94a3b8; }
    
    .activity-badge {
        padding: 0.3rem 0.6rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        flex-shrink: 0;
    }
    
    .badge-published { background: #dcfce7; color: #16a34a; }
    .badge-draft { background: #f1f5f9; color: #64748b; }
    .badge-active { background: #dcfce7; color: #16a34a; }
    .badge-upcoming { background: #e0f2fe; color: #0284c7; }
    
    .view-all-btn { font-size: 0.8rem; color: #003A46; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 0.25rem; transition: all 0.2s ease; }
    .view-all-btn:hover { color: #005f6b; gap: 0.4rem; }
    
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 0.75rem;
        padding: 1rem;
    }
    
    .quick-action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1rem 0.5rem;
        border-radius: 12px;
        border: 2px solid #f1f5f9;
        background: #fff;
        text-decoration: none;
        color: #64748b;
        transition: all 0.3s ease;
    }
    
    .quick-action-btn:hover { border-color: #003A46; color: #003A46; background: #f8fafc; }
    .quick-action-btn i { font-size: 1.25rem; margin-bottom: 0.4rem; }
    .quick-action-btn span { font-size: 0.7rem; font-weight: 500; text-align: center; }
    
    .empty-state { text-align: center; padding: 1.5rem; color: #94a3b8; }
    .empty-state i { font-size: 1.75rem; margin-bottom: 0.5rem; display: block; }
    
    @media (max-width: 1200px) {
        .quick-actions { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 768px) {
        .dashboard-header { padding: 1.5rem; }
        .stat-card { padding: 1.25rem; }
        .stat-number { font-size: 1.5rem; }
        .quick-actions { grid-template-columns: repeat(2, 1fr); }
    }
</style>
@endpush

@section('content')
<!-- Dashboard Header -->
<div class="dashboard-header">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1>Welcome back, {{ Auth::user()?->name ?? 'Admin' }}!</h1>
            <p>Here's what's happening with your website today.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <span class="badge bg-white bg-opacity-25 px-3 py-2">
                <i class="bi bi-calendar me-1"></i>
                {{ now()->format('F j, Y') }}
            </span>
        </div>
    </div>
</div>

<!-- Section Title -->
<div class="d-flex align-items-center mb-3">
    <h5 class="mb-0" style="color: #003A46;">Statistics Overview</h5>
</div>

<!-- Statistics Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-2 col-6">
        <div class="stat-card">
            <div class="stat-icon primary"><i class="bi bi-newspaper"></i></div>
            <div class="stat-number">{{ $stats['total_articles'] }}</div>
            <div class="stat-label">Articles</div>
        </div>
    </div>
    <div class="col-md-2 col-6">
        <div class="stat-card">
            <div class="stat-icon success"><i class="bi bi-calendar-event"></i></div>
            <div class="stat-number">{{ $stats['total_events'] }}</div>
            <div class="stat-label">Events</div>
        </div>
    </div>
    <div class="col-md-2 col-6">
        <div class="stat-card">
            <div class="stat-icon moot"><i class="bi bi-gavel"></i></div>
            <div class="stat-number">{{ $stats['total_moots'] }}</div>
            <div class="stat-label">Moots</div>
        </div>
    </div>
    <div class="col-md-2 col-6">
        <div class="stat-card">
            <div class="stat-icon warning"><i class="bi bi-folder"></i></div>
            <div class="stat-number">{{ $stats['total_projects'] }}</div>
            <div class="stat-label">Projects</div>
        </div>
    </div>
    <div class="col-md-2 col-6">
        <div class="stat-card">
            <div class="stat-icon info"><i class="bi bi-people"></i></div>
            <div class="stat-number">{{ $stats['total_faculty'] }}</div>
            <div class="stat-label">Faculty</div>
        </div>
    </div>
    <div class="col-md-2 col-6">
        <div class="stat-card" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);">
            <div class="stat-icon" style="background: linear-gradient(135deg, #86efac 0%, #4ade80 100%); color: #166534;">
                <i class="bi bi-send-check"></i>
            </div>
            <div class="stat-number" style="color: #166534;">{{ $stats['open_registrations'] }}</div>
            <div class="stat-label" style="color: #166534;">Open Registration</div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="dashboard-card">
            <div class="card-header">
                <span><i class="bi bi-lightning"></i> Quick Actions</span>
            </div>
            <div class="quick-actions">
                <a href="{{ route('admin.articles.create') }}" class="quick-action-btn">
                    <i class="bi bi-file-plus"></i>
                    <span>New Article</span>
                </a>
                <a href="{{ route('admin.events.create') }}" class="quick-action-btn">
                    <i class="bi bi-calendar-plus"></i>
                    <span>New Event</span>
                </a>
                <a href="{{ route('admin.moot-programs.create') }}" class="quick-action-btn">
                    <i class="bi bi-gavel"></i>
                    <span>Moot Program</span>
                </a>
                <a href="{{ route('admin.projects.create') }}" class="quick-action-btn">
                    <i class="bi bi-folder-plus"></i>
                    <span>New Project</span>
                </a>
                <a href="{{ route('admin.faculty.create') }}" class="quick-action-btn">
                    <i class="bi bi-person-plus"></i>
                    <span>Add Faculty</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Content: 3 Columns -->
<div class="row g-4">
    <!-- Column 1: Recent Articles -->
    <div class="col-lg-4">
        <div class="dashboard-card">
            <div class="card-header">
                <span><i class="bi bi-newspaper"></i> Recent Articles</span>
                <a href="{{ route('admin.articles.index') }}" class="view-all-btn">View <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="card-body">
                @forelse($recent_articles as $article)
                    <div class="activity-item">
                        <div class="activity-icon" style="background: #e0f2fe; color: #0284c7;">
                            <i class="bi bi-file-text"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">{{ Str::limit($article->title_en, 25) }}</div>
                            <div class="activity-meta">{{ $article->author->name ?? 'Unknown' }}</div>
                        </div>
                        <span class="activity-badge {{ $article->status === 'published' ? 'badge-published' : 'badge-draft' }}">{{ $article->status }}</span>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="bi bi-file-x"></i>
                        No articles yet
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    
    <!-- Column 2: Upcoming Events -->
    <div class="col-lg-4">
        <div class="dashboard-card">
            <div class="card-header">
                <span><i class="bi bi-calendar-event"></i> Upcoming Events</span>
                <a href="{{ route('admin.events.index') }}" class="view-all-btn">View <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="card-body">
                @forelse($upcoming_events as $event)
                    <div class="activity-item">
                        <div class="activity-icon" style="background: #dcfce7; color: #16a34a;">
                            <i class="bi bi-calendar"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">{{ Str::limit($event->title_en, 25) }}</div>
                            <div class="activity-meta">{{ $event->start_datetime->format('M j') }} • {{ Str::limit($event->location, 15) }}</div>
                        </div>
                        <span class="activity-badge badge-upcoming">{{ $event->type }}</span>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="bi bi-calendar-x"></i>
                        No upcoming events
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    
    <!-- Column 3: Moot Court Participations -->
    <div class="col-lg-4">
        <div class="dashboard-card">
            <div class="card-header">
                <span><i class="bi bi-gavel"></i> Moot Courts</span>
                <a href="{{ route('admin.moot-programs.index') }}" class="view-all-btn">View <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="card-body">
                @forelse($recent_participations as $participation)
                    <div class="activity-item">
                        <div class="activity-icon" style="background: #fce7f3; color: #db2777;">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">{{ Str::limit($participation->moot->name_en, 25) }}</div>
                            <div class="activity-meta">{{ $participation->year }}</div>
                        </div>
                        @switch($participation->status)
                            @case('completed')
                                <span class="activity-badge badge-published">Completed</span>
                                @break
                            @case('registration_open')
                                <span class="activity-badge badge-upcoming">Open</span>
                                @break
                            @case('ongoing')
                                <span class="activity-badge badge-active">Ongoing</span>
                                @break
                            @default
                                <span class="activity-badge badge-draft">{{ $participation->status }}</span>
                        @endswitch
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="bi bi-gavel"></i>
                        No participations yet
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Recent Projects -->
<div class="row g-4 mt-2">
    <div class="col-12">
        <div class="dashboard-card">
            <div class="card-header">
                <span><i class="bi bi-folder"></i> Recent Projects</span>
                <a href="{{ route('admin.projects.index') }}" class="view-all-btn">View <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse($recent_projects as $project)
                        <div class="col-md-4 col-sm-6">
                            <div class="activity-item">
                                <div class="activity-icon" style="background: #fef3c7; color: #d97706;">
                                    <i class="bi bi-folder2-open"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">{{ Str::limit($project->name_en, 25) }}</div>
                                    <div class="activity-meta">{{ $project->type }}</div>
                                </div>
                                <span class="activity-badge {{ $project->status === 'active' ? 'badge-active' : 'badge-draft' }}">{{ $project->status }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="empty-state">
                                <i class="bi bi-folder-x"></i>
                                No projects yet
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
