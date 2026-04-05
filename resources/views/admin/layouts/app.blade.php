<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') - NUMiLaw Admin</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Kantumruy+Pro:wght@300;400;500;600;700&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #003A46;
            --primary-light: #005f6b;
            --sidebar-width: 260px;
            --header-height: 60px;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f3f4f6;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #003A46 0%, #002a34 100%);
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.3s ease;
        }
        
        .sidebar-brand {
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-brand img {
            height: 40px;
            width: auto;
        }
        
        .sidebar-brand span {
            color: #fff;
            font-weight: 700;
            font-size: 1.1rem;
        }
        
        .sidebar-menu {
            padding: 1rem 0;
        }
        
        .sidebar-menu-title {
            color: rgba(255,255,255,0.4);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 1rem 1.5rem 0.5rem;
            font-weight: 600;
        }
        
        .sidebar-item {
            margin: 0.25rem 0.75rem;
        }
        
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.2s ease;
            font-size: 0.9rem;
            font-weight: 500;
            width: 100%;
            box-sizing: border-box;
        }
        
        .sidebar-link i:first-child {
            font-size: 1.1rem;
            width: 20px;
            flex-shrink: 0;
        }
        
        .sidebar-link .chevron {
            margin-left: auto;
            font-size: 0.75rem;
            color: rgba(255,255,255,0.5);
            transition: transform 0.2s ease;
        }
        
        .sidebar-link[aria-expanded="true"] .chevron {
            transform: rotate(180deg);
        }
        
        .sidebar-link:hover {
            background: rgba(0, 58, 70, 0.5);
            color: #fff;
        }
        
        .sidebar-link.active {
            background: #003A46;
            color: #fff;
            font-weight: 600;
        }
        
        .sidebar-link i {
            font-size: 1.1rem;
            width: 24px;
            text-align: left;
        }
        
        .sidebar-dropdown {
            padding: 0 0.75rem;
        }
        
        .sidebar-dropdown-menu {
            background: rgba(0,0,0,0.2);
            border-radius: 10px;
            padding: 0.5rem;
            display: none;
        }
        
        .sidebar-dropdown-menu.show {
            display: block;
        }
        
        .sidebar-dropdown-item {
            display: flex;
            align-items: center;
            padding: 0.6rem 1rem 0.6rem 2.5rem;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
            font-size: 0.85rem;
            width: 100%;
            box-sizing: border-box;
        }
        
        .sidebar-dropdown-item:hover {
            background: rgba(0, 58, 70, 0.5);
            color: #fff;
        }
        
        .sidebar-dropdown-item.active {
            background: #003A46;
            color: #fff;
        }
        
        .sidebar-link[aria-expanded="true"] {
            background: rgba(0, 58, 70, 0.5);
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s ease;
        }
        
        /* Header */
        .main-header {
            background: #fff;
            height: var(--header-height);
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .header-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #374151;
            cursor: pointer;
        }
        
        .header-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1f2937;
        }
        
        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .header-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            background: #f9fafb;
            border-radius: 10px;
            text-decoration: none;
            color: #374151;
            transition: all 0.2s ease;
        }
        
        .header-user:hover {
            background: #f3f4f6;
        }
        
        .header-user-avatar {
            width: 32px;
            height: 32px;
            background: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
            font-size: 0.85rem;
        }
        
        .header-user-info {
            line-height: 1.3;
        }
        
        .header-user-name {
            font-size: 0.875rem;
            font-weight: 600;
            color: #1f2937;
        }
        
        .header-user-role {
            font-size: 0.75rem;
            color: #6b7280;
        }
        
        .dropdown-menu-custom {
            background: #fff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            padding: 0.5rem;
            min-width: 200px;
        }
        
        .dropdown-item-custom {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: #374151;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        .dropdown-item-custom:hover {
            background: #f3f4f6;
            color: var(--primary);
        }
        
        .dropdown-item-custom i {
            color: #6b7280;
        }
        
        /* Article Image Styles */
        .article-image {
            border-radius: 12px;
            margin: 1.5rem auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .article-image-full {
            width: 100%;
            max-width: 100%;
        }
        
        .article-image-medium {
            width: 75%;
            max-width: 75%;
        }
        
        .article-image-small {
            width: 50%;
            max-width: 50%;
        }
        
        .dropdown-divider-custom {
            height: 1px;
            background: #e5e7eb;
            margin: 0.5rem 0;
        }
        
        /* Page Content */
        .page-content {
            padding: 1.5rem;
        }
        
        /* Responsive */
        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .header-toggle {
                display: block;
            }
            
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                z-index: 999;
            }
            
            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    
    @stack('styles')
</head>
<body>
    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <img src="{{ url('/laravel-img/logo.png') }}" alt="NUMiLaw">
            <span>Admin</span>
        </div>
        
        <nav class="sidebar-menu">
            <div class="sidebar-menu-title">Main</div>
            <div class="sidebar-item">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
            </div>
            
            <div class="sidebar-menu-title">Options</div>
            
            <div class="sidebar-item sidebar-dropdown">
                <a href="#" class="sidebar-link" data-bs-toggle="collapse" data-bs-target="#contentMenu">
                    <i class="bi bi-newspaper"></i>
                    Content
                    <i class="bi bi-chevron-down chevron"></i>
                </a>
                <div class="sidebar-dropdown-menu collapse" id="contentMenu">
                    <a href="{{ route('admin.articles.index') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">Articles</a>
                    <a href="{{ route('admin.categories.index') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">Categories</a>
                    <a href="{{ route('admin.tags.index') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">Tags</a>
                </div>
            </div>
            
            <div class="sidebar-item sidebar-dropdown">
                <a href="#" class="sidebar-link" data-bs-toggle="collapse" data-bs-target="#academicMenu">
                    <i class="bi bi-mortarboard"></i>
                    Academic
                    <i class="bi bi-chevron-down chevron"></i>
                </a>
                <div class="sidebar-dropdown-menu collapse" id="academicMenu">
                    <a href="{{ route('admin.applications.index') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">Applications</a>
                    <a href="{{ route('admin.academic-programs.index') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.academic-programs.*') ? 'active' : '' }}">Programs</a>
                    <a href="{{ route('admin.courses.index') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">Courses</a>
                    <a href="{{ route('admin.academic-calendar.index') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.academic-calendar.*') ? 'active' : '' }}">Calendar</a>
                    <a href="{{ route('admin.moot-programs.index') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.moot-programs.*') ? 'active' : '' }}">Moot Courts</a>
                </div>
            </div>
           
            
            <div class="sidebar-item sidebar-dropdown">
                
                <a href="#" class="sidebar-link" data-bs-toggle="collapse" data-bs-target="#alumniMenu">
                    <i class="bi bi-mortarboard"></i>
                    Alumni
                    <i class="bi bi-chevron-down chevron"></i>
                </a>
                <div class="sidebar-dropdown-menu collapse" id="alumniMenu">
                    <a href="{{ route('admin.alumni.dashboard') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.alumni.dashboard') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('admin.alumni.index') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.alumni.index') ? 'active' : '' }}">Directory</a>
                    <a href="{{ route('admin.alumni.testimonials.index') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.alumni.testimonials*') ? 'active' : '' }}">Testimonials</a>
                    <a href="{{ route('admin.alumni.events.index') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.alumni.events*') ? 'active' : '' }}">Events</a>
                    <a href="{{ route('admin.alumni.job-postings.index') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.alumni.job-postings*') ? 'active' : '' }}">Job Postings</a>
                </div>
            </div>   
            
            
            <div class="sidebar-item">
                <a href="{{ route('admin.faculty.index') }}" class="sidebar-link {{ request()->routeIs('admin.faculty.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    Faculty & Staff
                </a>
            </div>
            <div class="sidebar-item">
                <a href="{{ route('admin.events.index') }}" class="sidebar-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event"></i>
                    Events
                </a>
            </div>
            
            <div class="sidebar-item">
                <a href="{{ route('admin.projects.index') }}" class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    <i class="bi bi-folder"></i>
                    Projects & Clubs
                </a>
            </div>

            <div class="sidebar-item sidebar-dropdown">
                <a href="#" class="sidebar-link {{ request()->routeIs('admin.student-experience.*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#studentExpMenu">
                    <i class="bi bi-mortarboard"></i>
                    Student Experience
                    <i class="bi bi-chevron-down chevron"></i>
                </a>
                <div class="sidebar-dropdown-menu collapse {{ request()->routeIs('admin.student-experience.*') ? 'show' : '' }}" id="studentExpMenu">
                    <a href="{{ route('admin.student-experience.index') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.student-experience.index') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.student-experience.experiences') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.student-experience.experiences') ? 'active' : '' }}">
                        <i class="bi bi-chat-quote"></i> Experiences
                    </a>
                    <a href="{{ route('admin.student-experience.internships') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.student-experience.internships') ? 'active' : '' }}">
                        <i class="bi bi-briefcase"></i> Internships
                    </a>
                    <a href="{{ route('admin.student-experience.gallery.index') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.student-experience.gallery.*') ? 'active' : '' }}">
                        <i class="bi bi-images"></i> Gallery
                    </a>
                    <a href="{{ route('admin.student-experience.clubs.index') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.student-experience.clubs.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i> Clubs
                    </a>
                </div>
            </div>

            <div class="sidebar-item">
                <a href="{{ route('admin.partners.universities.index') }}" class="sidebar-link {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}">
                    <i class="bi bi-building"></i>
                    Partner Universities
                </a>
            </div>

            <div class="sidebar-item sidebar-dropdown">
                <a href="#" class="sidebar-link" data-bs-toggle="collapse" data-bs-target="#appearanceMenu">
                    <i class="bi bi-palette"></i>
                    Appearance
                    <i class="bi bi-chevron-down chevron"></i>
                </a>
                <div class="sidebar-dropdown-menu collapse {{ request()->routeIs('admin.hero-slides.*') || request()->routeIs('admin.hero-images.*') || request()->routeIs('about.sections.*') || request()->routeIs('about.leadership.*') ? 'show' : '' }}" id="appearanceMenu">
                    <a href="{{ route('admin.hero-slides.index', ['page' => 'home']) }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.hero-slides.*') ? 'active' : '' }}">
                        <i class="bi bi-images"></i> Hero Slideshow
                    </a>
                    <a href="{{ route('admin.hero-images.index') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.hero-images.*') ? 'active' : '' }}">
                        <i class="bi bi-image"></i> Hero Images
                    </a>
                    <a href="{{ route('admin.about.sections.index') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.about.sections.*') ? 'active' : '' }}">
                        <i class="bi bi-file-text"></i> About Section
                    </a>
                    <a href="{{ route('admin.about.leadership.index') }}" class="sidebar-dropdown-item {{ request()->routeIs('admin.about.leadership.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i> About Leadership
                    </a>
                </div>
            </div>

        </nav>
    </aside>
    
    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="main-header">
            <div class="d-flex align-items-center gap-3">
                <button class="header-toggle" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="header-title">@yield('title', 'Dashboard')</h1>
            </div>
            
            <div class="header-actions">
                @auth
                <div class="dropdown">
                    <a href="#" class="header-user" data-bs-toggle="dropdown">
                        <div class="header-user-avatar">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="header-user-info d-none d-md-block">
                            <div class="header-user-name">{{ Auth::user()->name ?? 'Admin' }}</div>
                            <div class="header-user-role">{{ ucfirst(Auth::user()->role ?? 'user') }}</div>
                        </div>
                        <i class="bi bi-chevron-down d-none d-md-block" style="font-size: 0.75rem;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-custom">
                        <a href="{{ route('admin.settings.profile') }}" class="dropdown-item-custom">
                            <i class="bi bi-person"></i> My Profile
                        </a>
                        @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.settings.users') }}" class="dropdown-item-custom">
                            <i class="bi bi-people"></i> User Management
                        </a>
                        @endif
                        <div class="dropdown-divider-custom"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item-custom" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </div>
                </div>
                @endauth
            </div>
        </header>
        
        <!-- Page Content -->
        <div class="page-content">
            @yield('content')
        </div>
    </main>
    
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    
    <!-- Flash Messages -->
    @if(session()->has('success') || session()->has('error') || session()->has('warning') || session()->has('info'))
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
            @if(session('success'))
                <div class="toast show align-items-center text-white bg-success border-0" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            @endif
            @if(session('error'))
                <div class="toast show align-items-center text-white bg-danger border-0" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="bi bi-exclamation-circle-fill me-2"></i>
                            {{ session('error') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            @endif
        </div>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.querySelector('.sidebar-overlay').classList.toggle('show');
        }
        
        // Auto-hide toasts
        setTimeout(() => {
            document.querySelectorAll('.toast').forEach(toast => {
                toast.classList.remove('show');
            });
        }, 5000);

        // Summernote Image Upload Function
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
                            'height': 'auto'
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
    </script>
    @stack('scripts')
</body>
</html>
