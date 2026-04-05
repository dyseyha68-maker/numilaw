@extends('admin.layouts.app')

@section('title', 'Add Faculty Member')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
.summernote { height: 150px; }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Add Faculty Member</h1>
        <p class="text-muted mb-0">Create a new faculty profile</p>
    </div>
    <a href="{{ route('admin.faculty.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="row g-4">
    <!-- Form -->
    <div class="col-lg-8">
        <form method="POST" action="{{ route('admin.faculty.store') }}" enctype="multipart/form-data" id="facultyForm">
            @csrf
            
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
                                   id="name" name="name" value="{{ old('name') }}" required
                                   placeholder="e.g., Dr. John Smith">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required
                                   placeholder="e.g., Professor, Dr., Mr.">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('department') is-invalid @enderror" 
                                   id="department" name="department" value="{{ old('department') }}" required>
                            @error('department')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="office_location" class="form-label">Office Location</label>
                            <input type="text" class="form-control @error('office_location') is-invalid @enderror" 
                                   id="office_location" name="office_location" value="{{ old('office_location') }}"
                                   placeholder="e.g., Room 201">
                            @error('office_location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="office_hours" class="form-label">Office Hours</label>
                            <input type="text" class="form-control @error('office_hours') is-invalid @enderror" 
                                   id="office_hours" name="office_hours" value="{{ old('office_hours') }}"
                                   placeholder="e.g., Mon-Wed 9:00-11:00">
                            @error('office_hours')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Lower numbers appear first</small>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
                                      id="specialization_en" name="specialization_en" rows="2">{{ old('specialization_en') }}</textarea>
                            @error('specialization_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="specialization_km" class="form-label">Khmer</label>
                            <textarea class="form-control @error('specialization_km') is-invalid @enderror" 
                                      id="specialization_km" name="specialization_km" rows="2">{{ old('specialization_km') }}</textarea>
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
                                      id="education_en" name="education_en" rows="2">{{ old('education_en') }}</textarea>
                            @error('education_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="education_km" class="form-label">Khmer</label>
                            <textarea class="form-control @error('education_km') is-invalid @enderror" 
                                      id="education_km" name="education_km" rows="2">{{ old('education_km') }}</textarea>
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
                                      id="bio_en" name="bio_en" rows="4" required>{{ old('bio_en') }}</textarea>
                            @error('bio_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="bio_km" class="form-label">Khmer <span class="text-danger">*</span></label>
                            <textarea class="form-control summernote @error('bio_km') is-invalid @enderror" 
                                      id="bio_km" name="bio_km" rows="4" required>{{ old('bio_km') }}</textarea>
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
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                                   id="photo" name="photo" accept="image/*"
                                   onchange="previewPhoto(this)">
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-2">Max size: 5MB. Formats: JPEG, PNG, JPG, GIF</small>
                        </div>
                        <div class="col-md-4 text-end">
                            <div id="photoPreview" class="mt-2" style="display: none;">
                                <img id="photoPreviewImg" class="rounded-3 shadow" style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Submit -->
            <div class="d-flex justify-content-end gap-3">
                <a href="{{ route('admin.faculty.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-2"></i>Create Faculty
                </button>
            </div>
        </form>
    </div>
    
    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Help Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Help</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled small text-muted mb-0">
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Fields marked * are required</li>
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Active members show on public site</li>
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Lower sort order = higher priority</li>
                    <li><i class="bi bi-check-circle text-success me-2"></i>Use Summernote for rich text in bio</li>
                </ul>
            </div>
        </div>
        
        <!-- Tips Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0"><i class="bi bi-lightbulb me-2"></i>Tips</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled small text-muted mb-0">
                    <li class="mb-2"><i class="bi bi-arrow-right text-primary me-2"></i>Upload a clear professional photo</li>
                    <li class="mb-2"><i class="bi bi-arrow-right text-primary me-2"></i>Use full name with title</li>
                    <li><i class="bi bi-arrow-right text-primary me-2"></i>Add detailed bio for better SEO</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photoPreviewImg').src = e.target.result;
            document.getElementById('photoPreview').style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

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
