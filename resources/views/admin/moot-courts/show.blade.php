@extends('admin.layouts.app')

@section('title', 'Moot Court Details')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Moot Court Details</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.moot-courts.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
        <a href="{{ route('admin.moot-courts.edit', $mootCourt->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Edit
        </a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5>Moot Court Information</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Title (EN):</strong> {{ $mootCourt->title_en }}</p>
                <p><strong>Title (KM):</strong> {{ $mootCourt->title_km }}</p>
                <p><strong>Organizer:</strong> {{ $mootCourt->organizer_name ?? 'N/A' }}</p>
                <p><strong>Status:</strong> 
                    @switch($mootCourt->status)
                        @case('upcoming')
                            <span class="badge bg-primary">Upcoming</span>
                            @break
                        @case('ongoing')
                            <span class="badge bg-success">Ongoing</span>
                            @break
                        @case('completed')
                            <span class="badge bg-secondary">Completed</span>
                            @break
                        @case('cancelled')
                            <span class="badge bg-danger">Cancelled</span>
                            @break
                    @endswitch
                </p>
            </div>
            <div class="col-md-6">
                <p><strong>Competition Date:</strong> {{ $mootCourt->competition_date ? \Carbon\Carbon::parse($mootCourt->competition_date)->format('M d, Y') : '-' }}</p>
                <p><strong>Registration Deadline:</strong> {{ $mootCourt->registration_deadline ? \Carbon\Carbon::parse($mootCourt->registration_deadline)->format('M d, Y H:i') : '-' }}</p>
                <p><strong>Location:</strong> {{ $mootCourt->location }}</p>
                <p><strong>Created:</strong> {{ $mootCourt->created_at->format('M d, Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>

@if($mootCourt->featured_image)
<div class="card mb-4">
    <div class="card-header">
        <h5>Featured Image</h5>
    </div>
    <div class="card-body">
        <img src="{{ Storage::url($mootCourt->featured_image) }}" alt="Featured Image" class="img-fluid" style="max-height: 300px;">
    </div>
</div>
@endif

<div class="card mb-4">
    <div class="card-header">
        <h5>Case Summary (English)</h5>
    </div>
    <div class="card-body">
        {!! $mootCourt->case_summary_en ?? '-' !!}
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5>Case Summary (Khmer)</h5>
    </div>
    <div class="card-body">
        {!! $mootCourt->case_summary_km ?? '-' !!}
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5>Case Details (English)</h5>
    </div>
    <div class="card-body">
        {!! $mootCourt->case_details_en ?? '-' !!}
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5>Case Details (Khmer)</h5>
    </div>
    <div class="card-body">
        {!! $mootCourt->case_details_km ?? '-' !!}
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5>Rules (English)</h5>
    </div>
    <div class="card-body">
        {!! $mootCourt->rules_en ?? '-' !!}
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5>Rules (Khmer)</h5>
    </div>
    <div class="card-body">
        {!! $mootCourt->rules_km ?? '-' !!}
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.moot-courts.destroy', $mootCourt->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this moot court?')">
                <i class="bi bi-trash"></i> Delete Moot Court
            </button>
        </form>
    </div>
</div>
@endsection
