@extends('admin.layouts.app')

@section('title', __('partner.admin.title'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">{{ __('partner.admin.title') }}</h4>
    <a href="{{ route('admin.partners.universities.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> {{ __('partner.admin.add_university') }}
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3">{{ __('partner.admin.logo') }}</th>
                        <th class="py-3">{{ __('partner.admin.university_name') }}</th>
                        <th class="py-3">{{ __('partner.admin.country') }}</th>
                        <th class="py-3">{{ __('partner.admin.faculty_school') }}</th>
                        <th class="py-3">{{ __('partner.activities') }}</th>
                        <th class="py-3">{{ __('partner.admin.status') }}</th>
                        <th class="py-3 text-end px-4">{{ __('partner.admin.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($universities as $university)
                    <tr>
                        <td class="px-4">
                            @if($university->logo)
                            <img src="{{ asset($university->logo) }}" alt="{{ $university->name }}" 
                                 style="width: 50px; height: 50px; object-fit: contain; border-radius: 8px;">
                            @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                 style="width: 50px; height: 50px;">
                                <i class="bi bi-building text-muted"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.partners.universities.show', $university->id) }}" 
                               class="text-decoration-none fw-medium">
                                {{ $university->name }}
                            </a>
                        </td>
                        <td>{{ $university->country }}</td>
                        <td>{{ $university->faculty_or_school }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ $university->activities_count }}</span>
                        </td>
                        <td>
                            @if($university->status === 'active')
                            <span class="badge bg-success">{{ __('partner.status.active') }}</span>
                            @else
                            <span class="badge bg-secondary">{{ __('partner.status.inactive') }}</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.partners.universities.show', $university->id) }}">
                                            <i class="bi bi-eye me-2"></i> {{ __('partner.admin.view') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.partners.universities.edit', $university->id) }}">
                                            <i class="bi bi-pencil me-2"></i> {{ __('partner.admin.edit') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.partners.activities.index', $university->id) }}">
                                            <i class="bi bi-calendar-event me-2"></i> {{ __('partner.activities_title') }}
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.partners.universities.destroy', $university->id) }}" 
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
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="bi bi-building d-block mb-2" style="font-size: 2rem;"></i>
                            {{ __('partner.admin.no_universities') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($universities->hasPages())
    <div class="card-footer bg-white">
        {{ $universities->links() }}
    </div>
    @endif
</div>
@endsection
