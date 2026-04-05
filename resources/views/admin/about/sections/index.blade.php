@extends('admin.layouts.app')

@section('title', 'About Sections')

@section('content')
<div class="container-fluid py-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">About Sections</h1>
        <a href="{{ route('admin.about.sections.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Section
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">About Sections</h6>
        </div>
        <div class="card-body">
            @if($sections->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sections as $section)
                                <tr>
                                    <td>{{ $section->title }}</td>
                                    <td>
                                        <span class="badge badge-{{ $section->type == 'overview' ? 'info' : ($section->type == 'mission' ? 'success' : 'warning') }}">
                                            {{ ucfirst($section->type) }}
                                        </span>
                                    </td>
                                    <td>{{ $section->sort_order }}</td>
                                    <td>
                                        @if($section->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $section->created_at->format('M j, Y') }}</td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <div class="d-flex gap-1 justify-content-center">
                                            <a href="{{ route('admin.about.sections.edit', $section) }}" 
                                               class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.about.sections.destroy', $section) }}" 
                                                  method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                        onclick="return confirm('Are you sure you want to delete this section?')"
                                                        title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-gray-300 mb-3"></i>
                    <p class="text-gray-500">No about sections found.</p>
                    <a href="{{ route('admin.about.sections.create') }}" class="btn btn-primary">
                        Create First Section
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection