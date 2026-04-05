@extends('admin.layouts.app')

@section('title', __('partner.activities_title') . ' - ' . $partnerUniversity->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.partners.universities.index') }}" class="btn btn-outline-secondary btn-sm mb-2">
            <i class="bi bi-arrow-left me-1"></i> {{ __('partner.admin.title') }}
        </a>
        <h4 class="fw-bold mb-0">{{ __('partner.activities_title') }} - {{ $partnerUniversity->name }}</h4>
    </div>
    <a href="{{ route('admin.partners.activities.create', $partnerUniversity->id) }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> {{ __('partner.admin.add_activity') }}
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3">{{ __('partner.activity_date') }}</th>
                        <th class="py-3">{{ __('partner.activity_title') }}</th>
                        <th class="py-3">{{ __('partner.activity_type') }}</th>
                        <th class="py-3">{{ __('partner.location') }}</th>
                        <th class="py-3">{{ __('partner.visibility') }}</th>
                        <th class="py-3 text-end px-4">{{ __('partner.admin.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $activity)
                    <tr>
                        <td class="px-4">
                            {{ $activity->activity_date->format('M d, Y') }}
                        </td>
                        <td>
                            <a href="#" class="text-decoration-none fw-medium">
                                {{ $activity->title }}
                            </a>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">
                                {{ __('partner.activity_types.' . $activity->type) }}
                            </span>
                        </td>
                        <td>{{ $activity->location ?: '-' }}</td>
                        <td>
                            @if($activity->visibility === 'public')
                            <span class="badge bg-success">{{ __('partner.visibility.public') }}</span>
                            @else
                            <span class="badge bg-warning text-dark">{{ __('partner.visibility.internal') }}</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.partners.activities.edit', $activity->id) }}">
                                            <i class="bi bi-pencil me-2"></i> {{ __('partner.admin.edit') }}
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.partners.activities.destroy', $activity->id) }}" 
                                              method="POST" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-trash me-2"></i> {{ __('partner.admin.delete') }}
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="bi bi-calendar-event d-block mb-2" style="font-size: 2rem;"></i>
                            {{ __('partner.no_activities_admin') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($activities->hasPages())
    <div class="card-footer bg-white">
        {{ $activities->links() }}
    </div>
    @endif
</div>
@endsection
