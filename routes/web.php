<?php

use App\Http\Controllers\Admin\AdminAdmissionsController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Public\AcademicCalendarController;
use App\Http\Controllers\Public\AcademicProgramController;
use App\Http\Controllers\Public\AdmissionController;
use App\Http\Controllers\Public\AdmissionsController;
use App\Http\Controllers\Public\AlumniController;
use App\Http\Controllers\Public\AlumniEventController;
use App\Http\Controllers\Public\ArticleController;
use App\Http\Controllers\Public\EventController;
use App\Http\Controllers\Public\FacultyController;
use App\Http\Controllers\Public\JobPostingController;
use App\Http\Controllers\Public\MootProgramController;
use App\Http\Controllers\Public\ProjectController;
use App\Http\Controllers\Public\StudentExperienceController;
use App\Http\Controllers\PublicAboutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $upcomingEvents = \App\Models\Event::upcoming()
        ->orderBy('start_datetime')
        ->take(3)
        ->get();

    return view('welcome', compact('upcomingEvents'));
})->name('home');

Route::get('/about', [PublicAboutController::class, 'index'])->name('public.about.index');
Route::get('/about/overview', [PublicAboutController::class, 'overview'])->name('public.about.overview');
Route::get('/about/mission', [PublicAboutController::class, 'mission'])->name('public.about.mission');
Route::get('/about/vision', [PublicAboutController::class, 'vision'])->name('public.about.vision');
Route::get('/about/leadership', [PublicAboutController::class, 'leadership'])->name('public.about.leadership');
Route::get('/about/{section}', [PublicAboutController::class, 'show'])->name('public.about.show');

Route::prefix('news')->name('news.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/{category:slug}', [ArticleController::class, 'byCategory'])->name('category');
    Route::get('/tag/{tag:slug}', [ArticleController::class, 'byTag'])->name('tag');
    Route::get('/article/{article:slug}', [ArticleController::class, 'show'])->name('show');
});

Route::get('/articles', [ArticleController::class, 'index'])->name('public.articles.index');
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('public.articles.show');

Route::get('/events', [EventController::class, 'index'])->name('public.events.index');
Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('public.events.show');
Route::get('/calendar', [EventController::class, 'calendar'])->name('public.events.calendar');

Route::get('/faculty', [FacultyController::class, 'index'])->name('public.faculty.index');
Route::get('/faculty/{faculty:id}', [FacultyController::class, 'show'])->name('public.faculty.show');

Route::get('/projects', [ProjectController::class, 'index'])->name('public.projects.index');
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('public.projects.show');

Route::get('/academic-programs', [AcademicProgramController::class, 'index'])->name('public.academic-programs.index');
Route::get('/academic-programs/{program:slug}', [AcademicProgramController::class, 'show'])->name('public.academic-programs.show');

Route::get('/academic-calendar', [AcademicCalendarController::class, 'index'])->name('public.academic-calendar.index');
Route::get('/academic-calendar/{event}', [AcademicCalendarController::class, 'show'])->name('public.academic-calendar.show');

Route::get('/moot-courts', [MootProgramController::class, 'index'])->name('public.moot-programs.index');
Route::post('/moot-courts/register', [MootProgramController::class, 'requestRegistration'])->name('public.moot-programs.register');
Route::get('/moot-courts/{moot:slug}', [MootProgramController::class, 'show'])->name('public.moot-programs.show');
Route::get('/moot-courts/{moot:slug}/{year}', [MootProgramController::class, 'showParticipation'])->name('public.moot-programs.participations.show')->where('year', '[0-9]{4}');

Route::prefix('admission')->name('public.admission.')->group(function () {
    Route::get('/', [AdmissionController::class, 'index'])->name('index');
    Route::get('/apply/{program:slug}', [AdmissionController::class, 'apply'])->name('apply');
    Route::post('/submit/{program:slug}', [AdmissionController::class, 'submitApplication'])->name('submit');
    Route::get('/success', [AdmissionController::class, 'success'])->name('success');
    Route::get('/program-detail/{slug}', [AdmissionController::class, 'programDetail'])->name('program-detail');
});

Route::prefix('alumni')->name('public.alumni.')->group(function () {
    Route::get('/', [AlumniController::class, 'index'])->name('index');
    Route::get('/register', [AlumniController::class, 'register'])->name('register');
    Route::get('/stories', [AlumniController::class, 'stories'])->name('stories');
    Route::get('/{alumnus}', [AlumniController::class, 'show'])->name('show');
});

Route::get('/alumni-events', [AlumniEventController::class, 'index'])->name('public.alumni-events.index');
Route::get('/alumni-events/{event:slug}', [AlumniEventController::class, 'show'])->name('public.alumni-events.show');

Route::get('/jobs', [JobPostingController::class, 'index'])->name('public.jobs.index');
Route::get('/jobs/{job:slug}', [JobPostingController::class, 'show'])->name('public.jobs.show');
Route::post('/jobs/{job}/apply', [JobPostingController::class, 'apply'])->name('public.jobs.apply');

use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PartnerUniversityController;

// Public Partner Routes
Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
Route::get('/partners/{partner}', [PartnerController::class, 'show'])->name('partners.show');

// Student Experience Public Routes
Route::get('/student-experience', [StudentExperienceController::class, 'index'])->name('student-experience.index');
Route::get('/student-experience/gallery', [StudentExperienceController::class, 'gallery'])->name('student-experience.gallery');
Route::get('/student-experience/clubs', [StudentExperienceController::class, 'clubs'])->name('student-experience.clubs');
Route::get('/student-experience/internships', [StudentExperienceController::class, 'internships'])->name('student-experience.internships');
Route::get('/student-experience/submit', [StudentExperienceController::class, 'submitExperience'])->name('student-experience.submit');
Route::post('/student-experience/submit', [StudentExperienceController::class, 'storeExperience'])->name('student-experience.store');
Route::get('/student-experience/internship/submit', [StudentExperienceController::class, 'submitInternship'])->name('student-experience.internship.submit');
Route::post('/student-experience/internship/submit', [StudentExperienceController::class, 'storeInternship'])->name('student-experience.internship.store');

// Admissions Routes
Route::prefix('admissions')->name('admissions.')->group(function () {
    Route::get('/', [AdmissionsController::class, 'index'])->name('index');
    Route::get('/programs', [AdmissionsController::class, 'programs'])->name('programs');
    Route::get('/programs/{id}', [AdmissionsController::class, 'programDetail'])->name('program.detail');
    Route::get('/apply', [AdmissionsController::class, 'apply'])->name('apply');
    Route::post('/apply', [AdmissionsController::class, 'store'])->name('store');
    Route::get('/track', [AdmissionsController::class, 'track'])->name('track');
    Route::post('/track', [AdmissionsController::class, 'trackResult'])->name('track.result');
});

// Admin Partner Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/partners/universities', [PartnerUniversityController::class, 'index'])->name('partners.universities.index');
    Route::get('/partners/universities/create', [PartnerUniversityController::class, 'create'])->name('partners.universities.create');
    Route::post('/partners/universities', [PartnerUniversityController::class, 'store'])->name('partners.universities.store');
    Route::get('/partners/universities/{partnerUniversity}', [PartnerUniversityController::class, 'show'])->name('partners.universities.show');
    Route::get('/partners/universities/{partnerUniversity}/edit', [PartnerUniversityController::class, 'edit'])->name('partners.universities.edit');
    Route::put('/partners/universities/{partnerUniversity}', [PartnerUniversityController::class, 'update'])->name('partners.universities.update');
    Route::delete('/partners/universities/{partnerUniversity}', [PartnerUniversityController::class, 'destroy'])->name('partners.universities.destroy');

    Route::get('/partners/{partnerUniversity}/activities', [PartnerUniversityController::class, 'activities'])->name('partners.activities.index');
    Route::get('/partners/{partnerUniversity}/activities/create', [PartnerUniversityController::class, 'createActivity'])->name('partners.activities.create');
    Route::post('/partners/{partnerUniversity}/activities', [PartnerUniversityController::class, 'storeActivity'])->name('partners.activities.store');
    Route::get('/partners/activities/{activity}/edit', [PartnerUniversityController::class, 'editActivity'])->name('partners.activities.edit');
    Route::put('/partners/activities/{activity}', [PartnerUniversityController::class, 'updateActivity'])->name('partners.activities.update');
    Route::delete('/partners/activities/{activity}', [PartnerUniversityController::class, 'destroyActivity'])->name('partners.activities.destroy');
});

Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

// TEMPORARY ROUTE - REMOVE AFTER USE
Route::get('/setup/{command}', function ($command) {
    $allowed = ['storage:link', 'cache:clear', 'db:seed'];
    if (! in_array($command, $allowed)) {
        abort(403, 'Command not allowed. Use: storage:link, cache:clear, or db:seed');
    }
    $kernel = app(Illuminate\Contracts\Console\Kernel::class);
    $kernel->call($command);

    return response('<pre>'.$kernel->output().'</pre>');
});

Route::get('/setup/seed/heroes', function () {
    $kernel = app(Illuminate\Contracts\Console\Kernel::class);
    $kernel->call('db:seed', ['--class' => 'HeroSlideSeeder']);

    return response('<pre>'.$kernel->output().'</pre>');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login/attempt', function (\Illuminate\Http\Request $request) {
    // Check for too many attempts
    $key = 'login_attempts:'.$request->ip();
    $attempts = \Illuminate\Support\Facades\Cache::get($key, 0);

    if ($attempts >= 5) {
        // Validate CAPTCHA
        $captchaAnswer = $request->input('captcha_answer');
        $captchaStored = $request->session()->get('captcha_answer');

        if (! $captchaAnswer || $captchaAnswer != $captchaStored) {
            // Generate new CAPTCHA
            $num1 = rand(1, 10);
            $num2 = rand(1, 10);
            $request->session()->put('captcha_answer', $num1 + $num2);
            $request->session()->put('captcha_question', $num1.' + '.$num2);

            return back()->withErrors(['captcha' => 'Incorrect answer. Please try again.'])->with('captcha_required', true);
        }
    }

    $credentials = $request->only('email', 'password');
    if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
        $request->session()->regenerate();
        // Reset attempts on success
        \Illuminate\Support\Facades\Cache::forget($key);
        $request->session()->forget(['captcha_answer', 'captcha_question']);

        return redirect()->intended('/admin/dashboard');
    }

    // Increment failed attempts
    \Illuminate\Support\Facades\Cache::put($key, $attempts + 1, now()->addMinutes(30));

    // Generate new CAPTCHA after failed attempt
    if ($attempts >= 4) {
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        $request->session()->put('captcha_answer', $num1 + $num2);
        $request->session()->put('captcha_question', $num1.' + '.$num2);
    }

    return back()->withErrors(['email' => 'Invalid email or password. You have '.(5 - $attempts - 1).' attempts remaining.'])->with('captcha_required', $attempts >= 4);
})->name('login.attempt');

Route::post('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();

    return redirect('/');
})->name('logout');

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Alumni Dashboard
    Route::get('/alumni/dashboard', [\App\Http\Controllers\Admin\AlumniController::class, 'dashboard'])->name('alumni.dashboard');

    // Alumni additional routes
    Route::get('/alumni/export', [\App\Http\Controllers\Admin\AlumniController::class, 'export'])->name('alumni.export');
    Route::post('/alumni/{alumnus}/approve', [\App\Http\Controllers\Admin\AlumniController::class, 'approve'])->name('alumni.approve');
    Route::post('/alumni/{alumnus}/reject', [\App\Http\Controllers\Admin\AlumniController::class, 'reject'])->name('alumni.reject');
    Route::post('/alumni/{alumnus}/toggle-featured', [\App\Http\Controllers\Admin\AlumniController::class, 'toggleFeatured'])->name('alumni.toggle-featured');
    Route::post('/alumni/{alumnus}/verify', [\App\Http\Controllers\Admin\AlumniController::class, 'verify'])->name('alumni.verify');

    // Alumni sub-resources (alias routes for views)
    Route::prefix('alumni/testimonials')->name('alumni.testimonials.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\AlumniTestimonialController::class, 'index'])->name('index');
    });
    Route::prefix('alumni/events')->name('alumni.events.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\AlumniEventController::class, 'index'])->name('index');
    });
    Route::prefix('alumni/job-postings')->name('alumni.job-postings.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\JobPostingController::class, 'index'])->name('index');
    });

    Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class);

    // Article additional routes
    Route::post('/articles/bulk-action', [\App\Http\Controllers\Admin\ArticleController::class, 'bulkAction'])->name('articles.bulk-action');
    Route::post('/articles/{article}/publish', [\App\Http\Controllers\Admin\ArticleController::class, 'publish'])->name('articles.publish');
    Route::post('/articles/{article}/unpublish', [\App\Http\Controllers\Admin\ArticleController::class, 'unpublish'])->name('articles.unpublish');
    Route::post('/articles/{article}/duplicate', [\App\Http\Controllers\Admin\ArticleController::class, 'duplicate'])->name('articles.duplicate');
    Route::post('/articles/{article}/toggle-featured', [\App\Http\Controllers\Admin\ArticleController::class, 'toggleFeatured'])->name('articles.toggle-featured');
    Route::get('/articles/preview/{article}', [\App\Http\Controllers\Admin\ArticleController::class, 'preview'])->name('articles.preview');
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('tags', \App\Http\Controllers\Admin\TagController::class);
    Route::resource('events', \App\Http\Controllers\Admin\EventController::class);
    Route::resource('faculty', \App\Http\Controllers\Admin\FacultyController::class);

    // Image upload for Summernote editor
    Route::post('/upload/image', [\App\Http\Controllers\Admin\ImageUploadController::class, 'upload'])->name('upload.image');

    // About Sections (custom routes)
    Route::get('/about/sections', [\App\Http\Controllers\Admin\AboutPageAdminController::class, 'sectionsIndex'])->name('about.sections.index');
    Route::get('/about/sections/create', [\App\Http\Controllers\Admin\AboutPageAdminController::class, 'sectionsCreate'])->name('about.sections.create');
    Route::post('/about/sections', [\App\Http\Controllers\Admin\AboutPageAdminController::class, 'sectionsStore'])->name('about.sections.store');
    Route::get('/about/sections/{section}/edit', [\App\Http\Controllers\Admin\AboutPageAdminController::class, 'sectionsEdit'])->name('about.sections.edit');
    Route::put('/about/sections/{section}', [\App\Http\Controllers\Admin\AboutPageAdminController::class, 'sectionsUpdate'])->name('about.sections.update');
    Route::delete('/about/sections/{section}', [\App\Http\Controllers\Admin\AboutPageAdminController::class, 'sectionsDestroy'])->name('about.sections.destroy');

    // Leadership (custom routes)
    Route::get('/about/leadership', [\App\Http\Controllers\Admin\AboutPageAdminController::class, 'leadershipIndex'])->name('about.leadership.index');
    Route::get('/about/leadership/create', [\App\Http\Controllers\Admin\AboutPageAdminController::class, 'leadershipCreate'])->name('about.leadership.create');
    Route::post('/about/leadership', [\App\Http\Controllers\Admin\AboutPageAdminController::class, 'leadershipStore'])->name('about.leadership.store');
    Route::get('/about/leadership/{leadership}/edit', [\App\Http\Controllers\Admin\AboutPageAdminController::class, 'leadershipEdit'])->name('about.leadership.edit');
    Route::put('/about/leadership/{leadership}', [\App\Http\Controllers\Admin\AboutPageAdminController::class, 'leadershipUpdate'])->name('about.leadership.update');
    Route::delete('/about/leadership/{leadership}', [\App\Http\Controllers\Admin\AboutPageAdminController::class, 'leadershipDestroy'])->name('about.leadership.destroy');
    Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);
    Route::resource('academic-programs', \App\Http\Controllers\Admin\AcademicProgramController::class);
    Route::resource('courses', \App\Http\Controllers\Admin\CourseController::class);
    Route::resource('academic-calendar', \App\Http\Controllers\Admin\AcademicCalendarController::class);

    // Moot Court Programs
    Route::resource('moot-programs', \App\Http\Controllers\Admin\MootProgramController::class)->parameters([
        'moot-programs' => 'moot',
    ]);

    // Moot Participation routes
    Route::get('/moot-programs/{moot}/participations/create', [\App\Http\Controllers\Admin\MootProgramController::class, 'createParticipation'])->name('moot-programs.participations.create');
    Route::post('/moot-programs/{moot}/participations', [\App\Http\Controllers\Admin\MootProgramController::class, 'storeParticipation'])->name('moot-programs.participations.store');
    Route::get('/moot-programs/{moot}/participations/{participation}', [\App\Http\Controllers\Admin\MootProgramController::class, 'showParticipation'])->name('moot-programs.participations.show');
    Route::get('/moot-programs/{moot}/participations/{participation}/edit', [\App\Http\Controllers\Admin\MootProgramController::class, 'editParticipation'])->name('moot-programs.participations.edit');
    Route::put('/moot-programs/{moot}/participations/{participation}', [\App\Http\Controllers\Admin\MootProgramController::class, 'updateParticipation'])->name('moot-programs.participations.update');
    Route::delete('/moot-programs/{moot}/participations/{participation}', [\App\Http\Controllers\Admin\MootProgramController::class, 'destroyParticipation'])->name('moot-programs.participations.destroy');
    Route::patch('/moot-programs/{moot}/participations/{participation}/toggle-publish', [\App\Http\Controllers\Admin\MootProgramController::class, 'togglePublishParticipation'])->name('moot-programs.participations.toggle-publish');
    Route::post('/moot-programs/{moot}/participations/{sourceParticipation}/clone', [\App\Http\Controllers\Admin\MootProgramController::class, 'cloneParticipation'])->name('moot-programs.participations.clone');

    // Moot Activity routes
    Route::get('/moot-programs/{moot}/participations/{participation}/activities/create', [\App\Http\Controllers\Admin\MootProgramController::class, 'createActivity'])->name('moot-programs.activities.create');
    Route::post('/moot-programs/{moot}/participations/{participation}/activities', [\App\Http\Controllers\Admin\MootProgramController::class, 'storeActivity'])->name('moot-programs.activities.store');
    Route::get('/moot-programs/{moot}/participations/{participation}/activities/{activity}/edit', [\App\Http\Controllers\Admin\MootProgramController::class, 'editActivity'])->name('moot-programs.activities.edit');
    Route::put('/moot-programs/{moot}/participations/{participation}/activities/{activity}', [\App\Http\Controllers\Admin\MootProgramController::class, 'updateActivity'])->name('moot-programs.activities.update');
    Route::delete('/moot-programs/{moot}/participations/{participation}/activities/{activity}', [\App\Http\Controllers\Admin\MootProgramController::class, 'destroyActivity'])->name('moot-programs.activities.destroy');
    Route::post('/moot-programs/{moot}/participations/{participation}/activities/reorder', [\App\Http\Controllers\Admin\MootProgramController::class, 'reorderActivities'])->name('moot-programs.activities.reorder');

    // Moot Team routes
    Route::get('/moot-programs/{moot}/participations/{participation}/teams/create', [\App\Http\Controllers\Admin\MootProgramController::class, 'createTeam'])->name('moot-programs.teams.create');
    Route::post('/moot-programs/{moot}/participations/{participation}/teams', [\App\Http\Controllers\Admin\MootProgramController::class, 'storeTeam'])->name('moot-programs.teams.store');
    Route::get('/moot-programs/{moot}/participations/{participation}/teams/{team}/edit', [\App\Http\Controllers\Admin\MootProgramController::class, 'editTeam'])->name('moot-programs.teams.edit');
    Route::put('/moot-programs/{moot}/participations/{participation}/teams/{team}', [\App\Http\Controllers\Admin\MootProgramController::class, 'updateTeam'])->name('moot-programs.teams.update');
    Route::delete('/moot-programs/{moot}/participations/{participation}/teams/{team}', [\App\Http\Controllers\Admin\MootProgramController::class, 'destroyTeam'])->name('moot-programs.teams.destroy');

    // Moot Team Member routes
    Route::get('/moot-programs/{moot}/participations/{participation}/teams/{team}/members/create', [\App\Http\Controllers\Admin\MootProgramController::class, 'createMember'])->name('moot-programs.team-members.create');
    Route::post('/moot-programs/{moot}/participations/{participation}/teams/{team}/members', [\App\Http\Controllers\Admin\MootProgramController::class, 'storeMember'])->name('moot-programs.team-members.store');
    Route::get('/moot-programs/{moot}/participations/{participation}/teams/{team}/members/{member}/edit', [\App\Http\Controllers\Admin\MootProgramController::class, 'editMember'])->name('moot-programs.team-members.edit');
    Route::put('/moot-programs/{moot}/participations/{participation}/teams/{team}/members/{member}', [\App\Http\Controllers\Admin\MootProgramController::class, 'updateMember'])->name('moot-programs.team-members.update');
    Route::delete('/moot-programs/{moot}/participations/{participation}/teams/{team}/members/{member}', [\App\Http\Controllers\Admin\MootProgramController::class, 'destroyMember'])->name('moot-programs.team-members.destroy');

    Route::resource('job-postings', \App\Http\Controllers\Admin\JobPostingController::class);
    Route::resource('applications', \App\Http\Controllers\Admin\ApplicationController::class);

    // Hero Images Management (Legacy - Single Image)
    Route::get('/hero-images', [\App\Http\Controllers\Admin\HeroImageController::class, 'index'])->name('hero-images.index');
    Route::get('/hero-images/{heroImage}/edit', [\App\Http\Controllers\Admin\HeroImageController::class, 'edit'])->name('hero-images.edit');
    Route::put('/hero-images/{heroImage}', [\App\Http\Controllers\Admin\HeroImageController::class, 'update'])->name('hero-images.update');
    Route::delete('/hero-images/{heroImage}/image', [\App\Http\Controllers\Admin\HeroImageController::class, 'destroyImage'])->name('hero-images.destroy-image');

    // Hero Slideshow Management
    Route::get('/hero-slides', [\App\Http\Controllers\Admin\HeroSlideController::class, 'index'])->name('hero-slides.index');
    Route::get('/hero-slides/create', [\App\Http\Controllers\Admin\HeroSlideController::class, 'create'])->name('hero-slides.create');
    Route::post('/hero-slides', [\App\Http\Controllers\Admin\HeroSlideController::class, 'store'])->name('hero-slides.store');
    Route::get('/hero-slides/{heroSlide}/edit', [\App\Http\Controllers\Admin\HeroSlideController::class, 'edit'])->name('hero-slides.edit');
    Route::get('/hero-slides/{heroSlide}', function (\App\Models\HeroSlide $heroSlide) {
        return redirect()->route('admin.hero-slides.index', ['page' => $heroSlide->slide_key]);
    });
    Route::put('/hero-slides/{heroSlide}', [\App\Http\Controllers\Admin\HeroSlideController::class, 'update'])->name('hero-slides.update');
    Route::delete('/hero-slides/{heroSlide}', [\App\Http\Controllers\Admin\HeroSlideController::class, 'destroy'])->name('hero-slides.destroy');
    Route::delete('/hero-slides/{heroSlide}/delete-image', [\App\Http\Controllers\Admin\HeroSlideController::class, 'destroyImage'])->name('hero-slides.destroy-image');
    Route::put('/hero-settings/{heroSettings}', [\App\Http\Controllers\Admin\HeroSlideController::class, 'updateSettings'])->name('hero-slides.update-settings');
    Route::post('/hero-slides/reorder', [\App\Http\Controllers\Admin\HeroSlideController::class, 'reorder'])->name('hero-slides.reorder');

    Route::resource('alumni', \App\Http\Controllers\Admin\AlumniController::class);
    Route::resource('alumni-events', \App\Http\Controllers\Admin\AlumniEventController::class);
    Route::resource('alumni-testimonials', \App\Http\Controllers\Admin\AlumniTestimonialController::class);

    Route::get('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');

    // Profile & Password Settings
    Route::get('/settings/profile', [\App\Http\Controllers\Admin\SettingsController::class, 'profile'])->name('settings.profile');
    Route::put('/settings/profile/update', [\App\Http\Controllers\Admin\SettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::put('/settings/password/update', [\App\Http\Controllers\Admin\SettingsController::class, 'updatePassword'])->name('settings.password.update');

    // User Management
    Route::get('/settings/users', [\App\Http\Controllers\Admin\SettingsController::class, 'users'])->name('settings.users');
    Route::get('/settings/users/create', [\App\Http\Controllers\Admin\SettingsController::class, 'createUserView'])->name('settings.users.create');
    Route::post('/settings/users', [\App\Http\Controllers\Admin\SettingsController::class, 'createUser'])->name('settings.users.store');
    Route::get('/settings/users/{id}/edit', [\App\Http\Controllers\Admin\SettingsController::class, 'editUser'])->name('settings.users.edit');
    Route::put('/settings/users/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'updateUser'])->name('settings.users.update');
    Route::delete('/settings/users/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'destroyUser'])->name('settings.users.destroy');

    // Student Experience Routes
    Route::get('/student-experience', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'index'])->name('student-experience.index');
    Route::get('/student-experience/experiences', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'experiences'])->name('student-experience.experiences');
    Route::get('/student-experience/experiences/{id}/edit', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'editExperience'])->name('student-experience.experiences.edit');
    Route::put('/student-experience/experiences/{id}', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'updateExperience'])->name('student-experience.experiences.update');
    Route::delete('/student-experience/experiences/{id}', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'deleteExperience'])->name('student-experience.experiences.destroy');
    Route::post('/student-experience/experiences/{id}/approve', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'approveExperience'])->name('student-experience.experiences.approve');
    Route::post('/student-experience/experiences/{id}/reject', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'rejectExperience'])->name('student-experience.experiences.reject');
    Route::post('/student-experience/experiences/{id}/feature', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'featureExperience'])->name('student-experience.experiences.feature');

    // Gallery routes
    Route::get('/student-experience/gallery', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'gallery'])->name('student-experience.gallery.index');
    Route::get('/student-experience/gallery/create', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'createGallery'])->name('student-experience.gallery.create');
    Route::post('/student-experience/gallery', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'storeGallery'])->name('student-experience.gallery.store');
    Route::get('/student-experience/gallery/{id}/edit', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'editGallery'])->name('student-experience.gallery.edit');
    Route::put('/student-experience/gallery/{id}', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'updateGallery'])->name('student-experience.gallery.update');
    Route::delete('/student-experience/gallery/{id}', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'deleteGallery'])->name('student-experience.gallery.destroy');

    // Clubs routes
    Route::get('/student-experience/clubs', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'clubs'])->name('student-experience.clubs.index');
    Route::get('/student-experience/clubs/create', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'createClub'])->name('student-experience.clubs.create');
    Route::post('/student-experience/clubs', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'storeClub'])->name('student-experience.clubs.store');
    Route::get('/student-experience/clubs/{id}/edit', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'editClub'])->name('student-experience.clubs.edit');
    Route::put('/student-experience/clubs/{id}', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'updateClub'])->name('student-experience.clubs.update');
    Route::post('/student-experience/clubs/{id}', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'deleteClub'])->name('student-experience.clubs.destroy');

    Route::get('/student-experience/internships', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'internships'])->name('student-experience.internships');
    Route::get('/student-experience/internships/{id}/edit', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'editInternship'])->name('student-experience.internships.edit');
    Route::put('/student-experience/internships/{id}', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'updateInternship'])->name('student-experience.internships.update');
    Route::delete('/student-experience/internships/{id}', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'deleteInternship'])->name('student-experience.internships.destroy');
    Route::post('/student-experience/internships/{id}/approve', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'approveInternship'])->name('student-experience.internships.approve');
    Route::post('/student-experience/internships/{id}/reject', [\App\Http\Controllers\Admin\StudentExperienceController::class, 'rejectInternship'])->name('student-experience.internships.reject');

    // AI Tools
    Route::get('/ai/content-generator', function () {
        return view('admin.ai.content-generator');
    })->name('ai.content-generator');

    // Admissions Management
    Route::get('/admissions/dashboard', [AdminAdmissionsController::class, 'dashboard'])->name('admissions.dashboard');
    Route::get('/admissions/applications', [AdminAdmissionsController::class, 'applications'])->name('admissions.applications');
    Route::get('/admissions/applications/{id}', [AdminAdmissionsController::class, 'showApplication'])->name('admissions.applications.show');
    Route::post('/admissions/applications/{id}/status', [AdminAdmissionsController::class, 'updateStatus'])->name('admissions.applications.status');
    Route::get('/admissions/applications/export', [AdminAdmissionsController::class, 'exportApplications'])->name('admissions.applications.export');
    Route::get('/admissions/programs', [AdminAdmissionsController::class, 'programs'])->name('admissions.programs.index');
    Route::get('/admissions/programs/create', [AdminAdmissionsController::class, 'createProgram'])->name('admissions.programs.create');
    Route::post('/admissions/programs', [AdminAdmissionsController::class, 'storeProgram'])->name('admissions.programs.store');
    Route::get('/admissions/programs/{id}/edit', [AdminAdmissionsController::class, 'editProgram'])->name('admissions.programs.edit');
    Route::put('/admissions/programs/{id}', [AdminAdmissionsController::class, 'updateProgram'])->name('admissions.programs.update');
    Route::delete('/admissions/programs/{id}', [AdminAdmissionsController::class, 'deleteProgram'])->name('admissions.programs.destroy');
    Route::get('/admissions/intakes', [AdminAdmissionsController::class, 'intakes'])->name('admissions.intakes.index');
    Route::get('/admissions/intakes/create', [AdminAdmissionsController::class, 'createIntake'])->name('admissions.intakes.create');
    Route::post('/admissions/intakes', [AdminAdmissionsController::class, 'storeIntake'])->name('admissions.intakes.store');
    Route::get('/admissions/intakes/{id}/edit', [AdminAdmissionsController::class, 'editIntake'])->name('admissions.intakes.edit');
    Route::put('/admissions/intakes/{id}', [AdminAdmissionsController::class, 'updateIntake'])->name('admissions.intakes.update');
    Route::post('/admissions/intakes/{id}/toggle', [AdminAdmissionsController::class, 'toggleIntake'])->name('admissions.intakes.toggle');
    Route::delete('/admissions/intakes/{id}', [AdminAdmissionsController::class, 'deleteIntake'])->name('admissions.intakes.destroy');
});

Route::get('/debug/articles', function () {
    $articles = \App\Models\Article::with(['category', 'tags'])->latest()->take(10)->get();

    return response()->json($articles);
});

Route::get('/debug/events', function () {
    $events = \App\Models\Event::latest()->take(10)->get();

    return response()->json($events);
});

Route::get('/debug/faculty', function () {
    $faculty = \App\Models\Faculty::latest()->take(10)->get();

    return response()->json($faculty);
});

Route::post('/debug/upload-test', function (\Illuminate\Http\Request $request) {
    \Log::info('=== DEBUG UPLOAD TEST ===');
    \Log::info('Has file: '.($request->hasFile('photo') ? 'YES' : 'NO'));
    \Log::info('All files: '.json_encode($request->allFiles()));
    \Log::info('All input: '.json_encode($request->all()));

    return response()->json([
        'has_file' => $request->hasFile('photo'),
        'files' => $request->allFiles(),
        'input' => $request->all(),
    ]);
});

Route::get('/debug/test-form', function () {
    return <<<'HTML'
<!DOCTYPE html>
<html>
<head>
    <title>Test Upload Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Test Upload Form</h1>
        <form action="/debug/upload-test" method="POST" enctype="multipart/form-data" id="testForm">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="Test">
            </div>
            <div class="mb-3">
                <label>Photo</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div id="result" class="mt-3"></div>
    </div>
    <script>
    document.getElementById('testForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('/debug/upload-test', {
            method: 'POST',
            body: formData
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('result').innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
        })
        .catch(err => {
            document.getElementById('result').innerHTML = '<div class="alert alert-danger">Error: ' + err + '</div>';
        });
    });
    </script>
</body>
</html>
HTML;
});

Route::get('/migrate', function () {
    \Artisan::call('migrate');

    return \Artisan::output();
});

Route::get('/clear-cache', function () {
    \Artisan::call('config:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('route:clear');

    return 'Cache cleared!';
});

Route::get('/storage-link', function () {
    $link = public_path('storage');
    $target = public_path('../storage/uploads');

    $output = [];
    $output[] = 'Link path: '.$link;
    $output[] = 'Target path: '.$target;
    $output[] = 'Target exists: '.(is_dir($target) ? 'Yes' : 'No');
    $output[] = 'Link exists: '.(file_exists($link) ? 'Yes' : 'No');

    // Remove existing broken link
    if (is_link($link)) {
        @unlink($link);
        $output[] = 'Removed existing symlink';
    }

    if (! is_dir($target)) {
        return 'Error: ../storage/uploads folder not found!<br>'.implode('<br>', $output);
    }

    try {
        symlink($target, $link);

        if (is_link($link)) {
            $output[] = 'SUCCESS: Storage link created!';
        } else {
            $output[] = 'ERROR: Link was not created';
        }
    } catch (\Exception $e) {
        $output[] = 'Error: '.$e->getMessage();
    }

    return implode('<br>', $output);
});

// Route to serve images directly
Route::get('/laravel-img/{path}', function ($path) {
    $filePath = public_path('images/'.$path);

    if (! file_exists($filePath)) {
        return 'Not found: '.$filePath;
    }

    return response()->file($filePath);
})->where('path', '.*');

Route::get('/drop-all-tables', function () {
    try {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $tables = \DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            $tableArray = (array) $table;
            $tableName = reset($tableArray);
            \DB::statement("DROP TABLE IF EXISTS `$tableName`");
        }
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

        return 'All tables dropped!';
    } catch (\Exception $e) {
        return 'Error: '.$e->getMessage();
    }
});

Route::get('/fresh', function () {
    try {
        \DB::table('migrations')->delete();
        \Artisan::call('migrate:fresh', ['--force' => true]);

        return \Artisan::output();
    } catch (\Exception $e) {
        return 'Error: '.$e->getMessage();
    }
});

Route::get('/migrate-skip', function () {
    try {
        // Drop all tables
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $tables = \DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            $tableArray = (array) $table;
            $tableName = reset($tableArray);
            \DB::statement("DROP TABLE IF EXISTS `$tableName`");
        }
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Clear migrations
        \DB::table('migrations')->delete();

        // Run migrations
        \Artisan::call('migrate', ['--force' => true]);

        return 'Done! Tables created. Some foreign keys may be missing.';
    } catch (\Exception $e) {
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

        return 'Error: '.$e->getMessage();
    }
});

Route::get('/build-tables', function () {
    try {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Drop all existing tables
        $tables = \DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            $tableArray = (array) $table;
            $tableName = reset($tableArray);
            \DB::statement("DROP TABLE IF EXISTS `$tableName`");
        }

        \Schema::create('users', function ($t) {
            $t->id();
            $t->string('name');
            $t->string('email')->unique();
            $t->string('password');
            $t->string('role')->default('user');
            $t->timestamps();
        });

        \Schema::create('categories', function ($t) {
            $t->id();
            $t->string('name_en');
            $t->string('name_km');
            $t->string('slug')->unique();
            $t->timestamps();
        });

        \Schema::create('articles', function ($t) {
            $t->id();
            $t->string('title_en');
            $t->string('title_km');
            $t->string('slug')->unique();
            $t->longText('content_en');
            $t->longText('content_km');
            $t->string('featured_image')->nullable();
            $t->string('status')->default('draft');
            $t->unsignedBigInteger('author_id')->nullable();
            $t->unsignedBigInteger('category_id')->nullable();
            $t->timestamps();
        });

        \Schema::create('events', function ($t) {
            $t->id();
            $t->string('title_en');
            $t->string('title_km');
            $t->string('slug')->unique();
            $t->longText('description_en');
            $t->longText('description_km');
            $t->datetime('start_datetime');
            $t->datetime('end_datetime')->nullable();
            $t->string('location')->nullable();
            $t->unsignedBigInteger('organizer_id')->nullable();
            $t->timestamps();
        });

        \Schema::create('academic_programs', function ($t) {
            $t->id();
            $t->string('title_en');
            $t->string('title_km');
            $t->string('slug')->unique();
            $t->longText('description_en');
            $t->longText('description_km');
            $t->integer('duration_years')->default(4);
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

        return 'Tables created!';
    } catch (\Exception $e) {
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

        return 'Error: '.$e->getMessage();
    }
});

Route::get('storage/{path}', function ($path) {
    $file = storage_path('app/public/'.$path);
    if (! file_exists($file)) {
        abort(404);
    }
    $mime = mime_content_type($file);

    return response()->file($file, ['Content-Type' => $mime]);
})->where('path', '.*');

Route::get('/clear-cache', function () {
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');

    return 'All caches cleared!';
});
