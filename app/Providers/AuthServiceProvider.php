<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Article;
use App\Models\Event;
use App\Models\Project;
use App\Models\Alumni;
use App\Models\AlumniEvent;
use App\Models\JobPosting;
use App\Policies\ArticlePolicy;
use App\Policies\EventPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\AlumniPolicy;
use App\Policies\AlumniEventPolicy;
use App\Policies\JobPostingPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Event::class => EventPolicy::class,
        Project::class => ProjectPolicy::class,
        Alumni::class => AlumniPolicy::class,
        AlumniEvent::class => AlumniEventPolicy::class,
        JobPosting::class => JobPostingPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Implicit Gates for role-based access
        Gate::define('admin', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('faculty', function (User $user) {
            return $user->isFaculty();
        });

        Gate::define('staff', function (User $user) {
            return $user->isStaff();
        });

        // Content management gates
        Gate::define('manage-content', function (User $user) {
            return $user->isAdmin() || $user->isFaculty();
        });

        Gate::define('manage-users', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-events', function (User $user) {
            return $user->isAdmin() || $user->isFaculty() || $user->isStaff();
        });

        Gate::define('manage-projects', function (User $user) {
            return $user->isAdmin() || $user->isFaculty();
        });

        // Alumni management gates
        Gate::define('manage-alumni', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-alumni-events', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-job-postings', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('connect-alumni', function (User $user) {
            return $user->isAlumni();
        });

        Gate::define('post-jobs', function (User $user) {
            return $user->isAlumni();
        });
    }
}
