<?php

namespace App\Policies;

use App\Models\JobPosting;
use App\Models\User;
use App\Models\Alumni;
use Illuminate\Auth\Access\Response;

class JobPostingPolicy
{
    /**
     * Determine whether user can view any jobs.
     */
    public function viewAny(User $user): bool
    {
        return true; // Public can view active jobs
    }

    /**
     * Determine whether user can view job.
     */
    public function view(User $user, JobPosting $job): bool
    {
        // Admin can view any job
        if ($user->isAdmin()) {
            return true;
        }

        // Public can view active, non-expired jobs
        return $job->is_active && !$job->is_expired;
    }

    /**
     * Determine whether user can create jobs.
     */
    public function create(User $user): bool
    {
        // Admin can create jobs
        if ($user->isAdmin()) {
            return true;
        }

        // Approved alumni can create jobs
        $alumni = Alumni::where('user_id', $user->id)
            ->where('status', 'approved')
            ->first();

        return $alumni !== null;
    }

    /**
     * Determine whether user can update job.
     */
    public function update(User $user, JobPosting $job): bool
    {
        // Admin can update any job
        if ($user->isAdmin()) {
            return true;
        }

        // Alumni can update their own jobs
        $alumni = Alumni::where('user_id', $user->id)->first();
        return $alumni && $job->alumni_id === $alumni->id;
    }

    /**
     * Determine whether user can delete job.
     */
    public function delete(User $user, JobPosting $job): bool
    {
        // Admin can delete any job
        if ($user->isAdmin()) {
            return true;
        }

        // Alumni can delete their own jobs
        $alumni = Alumni::where('user_id', $user->id)->first();
        return $alumni && $job->alumni_id === $alumni->id;
    }

    /**
     * Determine whether user can restore job.
     */
    public function restore(User $user, JobPosting $job): bool
    {
        // Admin can restore any job
        if ($user->isAdmin()) {
            return true;
        }

        // Alumni can restore their own jobs
        $alumni = Alumni::where('user_id', $user->id)->first();
        return $alumni && $job->alumni_id === $alumni->id;
    }

    /**
     * Determine whether user can permanently delete job.
     */
    public function forceDelete(User $user, JobPosting $job): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can apply for job.
     */
    public function apply(User $user, JobPosting $job): bool
    {
        // Must be active and not expired
        if (!$job->is_active || $job->is_expired) {
            return false;
        }

        // Cannot apply for own job
        if ($user->isAuthenticated()) {
            $alumni = Alumni::where('user_id', $user->id)->first();
            if ($alumni && $job->alumni_id === $alumni->id) {
                return false;
            }
        }

        return true;
    }

    /**
     * Determine whether user can feature job (admin).
     */
    public function feature(User $user, JobPosting $job): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can manage job applications (admin).
     */
    public function manageApplications(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can view job statistics (admin).
     */
    public function viewStatistics(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can moderate job postings (admin).
     */
    public function moderate(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can export job data (admin).
     */
    public function export(User $user): bool
    {
        return $user->isAdmin();
    }
}