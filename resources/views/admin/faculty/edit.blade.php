@extends('admin.layouts.app')

@section('title', 'Edit Faculty Member')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
.summernote { height: 150px; }
</style>
@endpush

@push('scripts')
<script>
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('photoPreview');
            const previewImg = document.getElementById('photoPreviewImg');
            if (preview && previewImg) {
                previewImg.src = e.target.result;
                preview.style.display = 'block';
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Initialize Summernote
document.addEventListener('DOMContentLoaded', function() {
    $('.summernote').summernote({
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['picture', 'link']],
            ['view', ['fullscreen', 'codeview']]
        ],
        callbacks: {
            onImageUpload: function(files) {
                for (let i = 0; i < files.length; i++) {
                    uploadImage(files[i]);
                }
            }
        }
    });
    
    function uploadImage(file) {
        const formData = new FormData();
        formData.append('image', file);
        formData.append('_token', '{{ csrf_token() }}');
        
        fetch('{{ route('admin.upload.image') }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.url) {
                const range = $('.summernote').summernote('createRange');
                $('.summernote').summernote('pasteHTML', '<img src="' + data.url + '" style="max-width: 100%;">');
            }
        })
        .catch(error => {
            console.error('Image upload failed:', error);
            alert('Image upload failed. Please try again.');
        });
    }
    
    const form = document.getElementById('facultyForm');
    if (form) {
        form.addEventListener('submit', function() {
            $('.summernote').each(function() {
                $(this).val($(this).summernote('code'));
            });
        });
    }
});
</script>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Edit Faculty Member</h1>
        <p class="text-muted mb-0">Update faculty information</p>
    </div>
    <div>
        <a href="{{ route('admin.faculty.show', $faculty) }}" class="btn btn-outline-secondary me-2">
            <i class="bi bi-eye me-2"></i>View
        </a>
        <a href="{{ route('admin.faculty.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Form -->
    <div class="col-lg-8">
        <form method="POST" action="{{ route('admin.faculty.update', $faculty) }}" enctype="multipart/form-data" id="facultyForm">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            
            <!-- Basic Info Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0"><i class="bi bi-person me-2"></i>Basic Information</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $faculty->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $faculty->title) }}" required
                                   placeholder="e.g., Professor, Dr., Mr.">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('department') is-invalid @enderror" 
                                   id="department" name="department" value="{{ old('department', $faculty->department) }}" required>
                            @error('department')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $faculty->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone', $faculty->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="office_location" class="form-label">Office Location</label>
                            <input type="text" class="form-control @error('office_location') is-invalid @enderror" 
                                   id="office_location" name="office_location" value="{{ old('office_location', $faculty->office_location) }}"
                                   placeholder="e.g., Room 201">
                            @error('office_location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="office_hours" class="form-label">Office Hours</label>
                            <input type="text" class="form-control @error('office_hours') is-invalid @enderror" 
                                   id="office_hours" name="office_hours" value="{{ old('office_hours', $faculty->office_hours) }}"
                                   placeholder="e.g., Mon-Wed 9:00-11:00">
                            @error('office_hours')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" name="sort_order" value="{{ old('sort_order', $faculty->sort_order) }}" min="0">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Lower numbers appear first</small>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="active" {{ old('status', $faculty->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $faculty->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Specialization Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0"><i class="bi bi-lightbulb me-2"></i>Specialization</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="specialization_en" class="form-label">English</label>
                            <textarea class="form-control @error('specialization_en') is-invalid @enderror" 
                                      id="specialization_en" name="specialization_en" rows="2">{{ old('specialization_en', $faculty->specialization_en) }}</textarea>
                            @error('specialization_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="specialization_km" class="form-label">Khmer</label>
                            <textarea class="form-control @error('specialization_km') is-invalid @enderror" 
                                      id="specialization_km" name="specialization_km" rows="2">{{ old('specialization_km', $faculty->specialization_km) }}</textarea>
                            @error('specialization_km')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Education Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0"><i class="bi bi-mortarboard me-2"></i>Education</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="education_en" class="form-label">English</label>
                            <textarea class="form-control @error('education_en') is-invalid @enderror" 
                                      id="education_en" name="education_en" rows="2">{{ old('education_en', $faculty->education_en) }}</textarea>
                            @error('education_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="education_km" class="form-label">Khmer</label>
                            <textarea class="form-control @error('education_km') is-invalid @enderror" 
                                      id="education_km" name="education_km" rows="2">{{ old('education_km', $faculty->education_km) }}</textarea>
                            @error('education_km')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Biography Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0"><i class="bi bi-card-text me-2"></i>Biography</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="bio_en" class="form-label">English <span class="text-danger">*</span></label>
                            <textarea class="form-control summernote @error('bio_en') is-invalid @enderror" 
                                      id="bio_en" name="bio_en" rows="4" required>{{ old('bio_en', $faculty->bio_en) }}</textarea>
                            @error('bio_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="bio_km" class="form-label">Khmer <span class="text-danger">*</span></label>
                            <textarea class="form-control summernote @error('bio_km') is-invalid @enderror" 
                                      id="bio_km" name="bio_km" rows="4" required>{{ old('bio_km', $faculty->bio_km) }}</textarea>
                            @error('bio_km')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Photo Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0"><i class="bi bi-camera me-2"></i>Photo</h5>
                </div>
                <div class="card-body text-center">
                    @if($faculty->photo)
                        @if(substr($faculty->photo, 0, 4) === 'http')
                            <img src="{{ $faculty->photo }}" 
                                 alt="Current photo" 
                                 class="rounded-3 shadow-sm mb-3" 
                                 style="width: 100%; max-width: 200px; height: auto;">
                        @else
                            <img src="{{ url('/laravel-img/' . $faculty->photo) }}" 
                                 alt="Current photo" 
                                 class="rounded-3 shadow-sm mb-3" 
                                 style="width: 100%; max-width: 200px; height: auto;">
                        @endif
                    @else
                        <div class="rounded-3 bg-light d-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width: 200px; height: 200px;">
                            <i class="bi bi-person text-muted" style="font-size: 4rem;"></i>
                        </div>
                    @endif
                    
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                           id="photo" name="photo" accept="image/*"
                           onchange="previewPhoto(this)">
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted d-block mt-2">Max size: 5MB. Formats: JPEG, PNG, JPG, GIF</small>
                    
                    <div id="photoPreview" class="mt-3" style="display: none;">
                        <img id="photoPreviewImg" class="rounded-3 shadow" style="width: 100%; max-width: 200px;">
                    </div>
                </div>
            </div>
            
            <!-- Submit -->
            <div class="d-flex justify-content-end gap-3">
                <a href="{{ route('admin.faculty.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-2"></i>Update Faculty
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
