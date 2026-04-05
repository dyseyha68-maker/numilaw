@extends('admin.layouts.app')

@section('title', isset($club) ? 'Edit Club' : 'Add Club')

@push('styles')
<style>
    .form-floating label {
        color: #6b7280;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #003A46;
        box-shadow: 0 0 0 0.2rem rgba(0,58,70,0.15);
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 mb-0">{{ isset($club) ? 'Edit Club' : 'Add Club' }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ isset($club) ? route('admin.student-experience.clubs.update', $club->id) : route('admin.student-experience.clubs.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($club))
                        @method('PUT')
                        @endif
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name_en" name="name_en" 
                                           value="{{ isset($club) ? $club->name_en : old('name_en') }}" placeholder="Name (English)" required>
                                    <label for="name_en">Name (English) *</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name_kh" name="name_kh" 
                                           value="{{ isset($club) ? $club->name_kh : old('name_kh') }}" placeholder="Name (Khmer)" required>
                                    <label for="name_kh">Name (Khmer) *</label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="description_en" name="description_en" 
                                              placeholder="Description (English)" style="height: 120px" required>{{ isset($club) ? $club->description_en : old('description_en') }}</textarea>
                                    <label for="description_en">Description (English) *</label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="description_kh" name="description_kh" 
                                              placeholder="Description (Khmer)" style="height: 120px" required>{{ isset($club) ? $club->description_kh : old('description_kh') }}</textarea>
                                    <label for="description_kh">Description (Khmer) *</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Logo</label>
                                <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                                @if(isset($club) && $club->logo)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($club->logo) }}" alt="" style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">
                                    <small class="d-block text-muted">Current logo</small>
                                </div>
                                @endif
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="president_name" name="president_name" 
                                           value="{{ isset($club) ? $club->president_name : old('president_name') }}" placeholder="President Name">
                                    <label for="president_name">President Name</label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" 
                                           {{ (isset($club) && $club->is_active) || !isset($club) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-lg me-2"></i>
                                    {{ isset($club) ? 'Update' : 'Save' }}
                                </button>
                                <a href="{{ route('admin.student-experience.clubs.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
