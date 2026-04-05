@extends('admin.layouts.app')

@section('title', 'Test CRUD')

@section('content')
<div class="container-fluid py-4">
    <h1>CRUD Functionality Test</h1>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Basic Tests</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('admin.articles.index') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-list"></i> Article Index
                        </a>
                        <a href="{{ route('admin.articles.create') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-plus"></i> Create Article
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-tags"></i> Categories
                        </a>
                        <a href="{{ route('admin.tags.index') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-tag"></i> Tags
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Database Status</h5>
                </div>
                <div class="card-body">
                    @php
                        $articleCount = \App\Models\Article::count();
                        $categoryCount = \App\Models\Category::count();
                        $tagCount = \App\Models\Tag::count();
                        $userCount = \App\Models\User::count();
                    @endphp
                    
                    <div class="mb-3">
                        <strong>Articles:</strong> {{ $articleCount }}
                    </div>
                    <div class="mb-3">
                        <strong>Categories:</strong> {{ $categoryCount }}
                    </div>
                    <div class="mb-3">
                        <strong>Tags:</strong> {{ $tagCount }}
                    </div>
                    <div class="mb-3">
                        <strong>Users:</strong> {{ $userCount }}
                    </div>
                    
                    <div class="alert alert-info">
                        <small>
                            If you see counts above, your database connection is working.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Quick Article Test</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="quick_title_en" class="form-label">English Title</label>
                                    <input type="text" name="title_en" id="quick_title_en" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="quick_title_km" class="form-label">Khmer Title</label>
                                    <input type="text" name="title_km" id="quick_title_km" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="quick_content_en" class="form-label">English Content</label>
                                    <textarea name="content_en" id="quick_content_en" class="form-control" rows="4" required>Test article content in English.</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="quick_content_km" class="form-label">Khmer Content</label>
                                    <textarea name="content_km" id="quick_content_km" class="form-control" rows="4" required>មាតិកាអត្ថបទសាក្រ</textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="quick_status" class="form-label">Status</label>
                                    <select name="status" id="quick_status" class="form-select">
                                        <option value="draft">Draft</option>
                                        <option value="published">Published</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <div class="form-check mt-4">
                                        <input type="checkbox" name="is_featured" id="quick_featured" class="form-check-input">
                                        <label for="quick_featured" class="form-check-label">Featured</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-save"></i> Create Test Article
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection