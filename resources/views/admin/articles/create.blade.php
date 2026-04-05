@extends('admin.layouts.app')

@section('title', 'Create Article')

@push('styles')
<style>
.image-preview-container {
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    padding: 1rem;
    text-align: center;
    background-color: #f8f9fa;
}
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Create Article</h1>
    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Articles
    </a>
</div>

<form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data" id="articleForm">
    @csrf

    <!-- Language Tabs -->
    <ul class="nav nav-pills mb-4" id="languageTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="en-tab" data-bs-toggle="tab" data-bs-target="#en" type="button" role="tab">
                <i class="bi bi-translate"></i> English Content
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="km-tab" data-bs-toggle="tab" data-bs-target="#km" type="button" role="tab">
                <i class="bi bi-translate"></i> Khmer Content
            </button>
        </li>
    </ul>
    
    <!-- Basic Information -->
    <div class="row">
        <div class="col-md-8">
            <div class="tab-content" id="languageTabsContent">
                <!-- English Content -->
                <div class="tab-pane fade show active" id="en" role="tabpanel">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">English Content</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="title_en" class="form-label">Title (English) *</label>
                                <input type="text" name="title_en" id="title_en" class="form-control" 
                                       value="{{ old('title_en') }}" required
                                       placeholder="Enter article title in English">
                                @error('title_en')  
                                    <div class="text-danger small mt-1">{{ $message }}</div>                     
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="content_en" class="form-label">Content (English) *</label>
                                <textarea name="content_en" id="content_en" class="form-control summernote" rows="15" required
                                          placeholder="Write your article content in English...">{{ old('content_en') }}</textarea>
                                @error('content_en')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="excerpt_en" class="form-label">Excerpt (English)</label>
                                <textarea name="excerpt_en" id="excerpt_en" class="form-control" rows="3" 
                                          placeholder="Brief summary for social media and search results (max 160 characters)">{{ old('excerpt_en') }}</textarea>
                                <div class="d-flex justify-content-between mt-1">
                                    <small class="text-muted">Brief summary (max 160 characters)</small>
                                    <small class="word-count" id="excerpt_en_count">0 / 160</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Khmer Content -->
                <div class="tab-pane fade" id="km" role="tabpanel">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Khmer Content</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="title_km" class="form-label">Title (Khmer) *</label>
                                <input type="text" name="title_km" id="title_km" class="form-control" 
                                       value="{{ old('title_km') }}" required
                                       placeholder="បញ្ចូលចំណងជើងអត្ថបទជាភាសាខ្មែរ">
                                @error('title_km')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="content_km" class="form-label">Content (Khmer) *</label>
                                <textarea name="content_km" id="content_km" class="form-control summernote" rows="15" required
                                          placeholder="សរសេរអត្ថបទរបស់ភាសាខ្មែរ...">{{ old('content_km') }}</textarea>
                                @error('content_km')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="excerpt_km" class="form-label">Excerpt (Khmer)</label>
                                <textarea name="excerpt_km" id="excerpt_km" class="form-control" rows="3" 
                                          placeholder="សង្ខេីខ្លីសម្រាប់បណ្ដាញសង្សាខ្មែរ និងលទ្ធផលស្វែងរក (អតិបរមា 160 តួអក្សរ)">{{ old('excerpt_km') }}</textarea>
                                <div class="d-flex justify-content-between mt-1">
                                    <small class="text-muted">សង្ខេីខ្លីសម្រាប់ (អតិបរមា 160 តួអក្សរ)</small>
                                    <small class="word-count" id="excerpt_km_count">0 / 160</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- Publication Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Publication Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status *</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input" 
                                   value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label for="is_featured" class="form-check-label">Featured Article</label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="published_at" class="form-label">Publish Date</label>
                        <input type="datetime-local" name="published_at" id="published_at" class="form-control" 
                               value="{{ old('published_at') }}">
                    </div>
                </div>
            </div>
            
            <!-- Featured Image -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Featured Image</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="featured_image" class="form-label">Upload Image</label>
                        <input type="file" name="featured_image" id="featured_image" class="form-control" 
                               accept="image/jpeg,image/png,image/jpg,image/gif" onchange="previewImage(this)">
                    </div>
                    
                    <div id="imagePreviewContainer" class="mb-3" style="display: none;">
                        <label class="form-label">Preview</label>
                        <img id="imagePreview" class="img-fluid rounded" style="max-height: 200px;">
                        <br>
                        <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="removeImage()">
                            <i class="bi bi-trash"></i> Remove Image
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Images -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Gallery Images</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="gallery_images" class="form-label">Upload Gallery Images</label>
                        <input type="file" name="gallery_images[]" id="gallery_images" class="form-control" 
                               accept="image/jpeg,image/png,image/jpg,image/gif" multiple onchange="previewGalleryImages(this)">
                        <small class="text-muted">Select multiple images (max 10 images, 5MB each)</small>
                    </div>
                    
                    <div id="galleryPreviewContainer" class="row g-2"></div>
                </div>
            </div>
            
            <!-- Categories & Tags -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Category</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Select Category</label>
                                <select name="category_id" id="category_id" class="form-select">
                                    <option value="">Select a category...</option>
                                    @foreach($categories ?? [] as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name_en ?? $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Project / Club</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="project_id" class="form-label">Related Project</label>
                                <select name="project_id" id="project_id" class="form-select">
                                    <option value="">Select a project...</option>
                                    @foreach($projects ?? [] as $project)
                                        <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                            {{ $project->name_en }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Link this article to a project/club</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tags</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="tags" class="form-label">Select Tags</label>
                                <select name="tags[]" id="tags" class="form-select" multiple size="5">
                                    @foreach($tags ?? [] as $tag)
                                        <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags') ?? []) ? 'selected' : '' }}>
                                            {{ $tag->name_en ?? $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Hold Ctrl/Cmd to select multiple tags</small>
                            </div>
                            
                            <!-- Add New Tag -->
                            <div class="mb-3">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#newTagForm">
                                    <i class="bi bi-plus-circle"></i> Add New Tag
                                </button>
                                
                                <div id="newTagForm" class="collapse mt-3">
                                    <div class="card card-body bg-light">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Tag Name (English)</label>
                                                <input type="text" id="newTagEn" class="form-control" placeholder="Enter tag name">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Tag Name (Khmer)</label>
                                                <input type="text" id="newTagKm" class="form-control" placeholder="បញ្ចូលចំណងជើងឈ្មោះ">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-success mt-2" onclick="addNewTag()">
                                            <i class="bi bi-check-circle"></i> Add Tag
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="d-flex gap-2">
                <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>             
                <button type="button" class="btn btn-info" onclick="previewArticle()">
                    <i class="bi bi-eye"></i> Preview
                </button>
                
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="bi bi-save"></i> Create Article
                </button>
            </div>
        </div>
    </div>
    
    <div id="modalBackdrop" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1040;" onclick="closeValidationModal()"></div>
</form>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
function uploadSummernoteImage(file, $editor) {
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
            $editor.summernote('insertImage', data.url, function($image) {
                $image.addClass('article-image article-image-full');
                $image.css({
                    'max-width': '100%',
                    'width': '100%',
                    'height': 'auto',
                    'cursor': 'pointer'
                });
            });
        } else if (data.error) {
            alert('Upload failed: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Image upload failed:', error);
        alert('Image upload failed. Please try again.');
    });
}

document.addEventListener('DOMContentLoaded', function() {
    $('.summernote').summernote({
        height: 400,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        callbacks: {
            onImageUpload: function(files) {
                const $editor = $(this);
                for (let i = 0; i < files.length; i++) {
                    uploadSummernoteImage(files[i], $editor);
                }
            }
        }
    });
    
    const form = document.getElementById('articleForm');
    const fields = [
        { id: 'title_en', name: 'English Title' },
        { id: 'content_en', name: 'English Content' },
        { id: 'title_km', name: 'Khmer Title' },
        { id: 'content_km', name: 'Khmer Content' }
    ];
    
    if (form) {
        form.addEventListener('submit', function(event) {
            $('.summernote').each(function() {
                $(this).val($(this).summernote('code'));
            });
            
            const emptyFields = [];
            
            for (const field of fields) {
                let el = document.getElementById(field.id);
                let value = el.value.trim();
                
                if ($(el).hasClass('summernote')) {
                    value = $(el).summernote('isEmpty') ? '' : el.value.trim();
                }
                
                if (!value) {
                    emptyFields.push(field.name);
                }
            }
            
            if (emptyFields.length > 0) {
                event.preventDefault();
                const list = document.getElementById('emptyFieldsList');
                list.innerHTML = emptyFields.map(f => '<li>' + f + '</li>').join('');
                document.getElementById('validationModal').style.display = 'block';
                document.getElementById('modalBackdrop').style.display = 'block';
                return false;
            }
        });
    }
    
    const excerptEn = document.getElementById('excerpt_en');
    const excerptKm = document.getElementById('excerpt_km');
    
    if (excerptEn) {
        excerptEn.addEventListener('input', function() {
            document.getElementById('excerpt_en_count').textContent = this.value.length + ' / 160';
        });
    }
    
    if (excerptKm) {
        excerptKm.addEventListener('input', function() {
            document.getElementById('excerpt_km_count').textContent = this.value.length + ' / 160';
        });
    }
});

function closeValidationModal() {
    document.getElementById('validationModal').style.display = 'none';
    document.getElementById('modalBackdrop').style.display = 'none';
}

function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
            document.getElementById('imagePreviewContainer').style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function removeImage() {
    document.getElementById('featured_image').value = '';
    document.getElementById('imagePreviewContainer').style.display = 'none';
}

function previewGalleryImages(input) {
    const container = document.getElementById('galleryPreviewContainer');
    container.innerHTML = '';
    
    if (input.files) {
        Array.from(input.files).forEach(function(file, index) {
            if (file.size > 5 * 1024 * 1024) {
                alert('File "' + file.name + '" is too large. Maximum size is 5MB.');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-4 col-md-3';
                col.innerHTML = `
                    <div class="position-relative" style="border-radius: 8px; overflow: hidden; border: 1px solid #dee2e6;">
                        <img src="${e.target.result}" class="img-fluid" style="height: 100px; width: 100%; object-fit: cover;">
                    </div>
                `;
                container.appendChild(col);
            };
            reader.readAsDataURL(file);
        });
    }
}

function addNewTag() {
    const nameEn = document.getElementById('newTagEn').value.trim();
    const nameKm = document.getElementById('newTagKm').value.trim();
    
    if (!nameEn) {
        alert('Please enter tag name in English');
        return;
    }
    
    const select = document.getElementById('tags');
    const option = new Option(nameEn + ' (' + nameKm + ')', 'new_' + Date.now());
    select.add(option);
    option.selected = true;
    
    document.getElementById('newTagEn').value = '';
    document.getElementById('newTagKm').value = '';
    
    const collapse = document.getElementById('newTagForm');
    if (collapse.classList.contains('show')) {
        collapse.classList.remove('show');
    }
}

function previewArticle() {
    const formData = new FormData(document.getElementById('articleForm'));
    const params = new URLSearchParams();
    
    for (let [key, value] of formData.entries()) {
        if (key !== '_token') {
            params.append(key, value);
        }
    }
    
    window.open('{{ route("admin.articles.preview", 0) }}?' + params.toString(), '_blank');
}


</script>
@endpush