@extends('admin.layouts.app')

@section('title', 'Leadership Team')

@section('content')
<div class="container-fluid py-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Leadership Team</h1>
        <a href="{{ route('admin.about.leadership.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Team Member
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
            <h6 class="m-0 font-weight-bold text-primary">Leadership Members</h6>
        </div>
        <div class="card-body">
            @if($leadership->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Email</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leadership as $member)
                                <tr>
                                    <td>
                                        @if($member->photo)
                                            <img src="{{ asset($member->photo) }}" alt="{{ $member->name }}" 
                                                 class="img-thumbnail" style="max-width: 60px; max-height: 60px;">
                                        @else
                                            <div class="bg-gray-200 d-flex align-items-center justify-content-center" 
                                                 style="width: 60px; height: 60px; border-radius: 4px;">
                                                <i class="fas fa-user text-gray-400"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $member->name }}</strong>
                                        @if($member->bio_en)
                                            <br><small class="text-muted">{{ Str::limit($member->bio_en, 50) }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $member->position }}</td>
                                    <td>
                                        @if($member->email)
                                            <a href="mailto:{{ $member->email }}" class="text-decoration-none">
                                                {{ $member->email }}
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $member->sort_order }}</td>
                                    <td>
                                        @if($member->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <div class="d-flex gap-1 justify-content-center">
                                            <a href="{{ route('admin.about.leadership.edit', $member) }}" 
                                               class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.about.leadership.destroy', $member) }}" 
                                                  method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                        onclick="return confirm('Are you sure you want to delete this team member?')"
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
                    <i class="fas fa-users fa-3x text-gray-300 mb-3"></i>
                                            <p class="text-gray-500">No leadership team members found.</p>
                    <a href="{{ route('admin.about.leadership.create') }}" class="btn btn-primary">
                        Add First Team Member
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection