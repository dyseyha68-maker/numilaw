<?php

namespace App\Policies;

use App\Models\Alumni;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AlumniPolicy
{
    /**
     * Determine whether user can view any alumni (admin).
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can view alumni profile.
     */
    public function view(User $user, Alumni $alumni): bool
    {
        // Admin can view any alumni
        if ($user->isAdmin()) {
            return true;
        }

        // Users can view their own profile
        if ($user->id === $alumni->user_id) {
            return true;
        }

        // Public can view approved alumni with contact consent
        if ($alumni->status === 'approved' && $alumni->contact_consent) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether user can create alumni records (admin).
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can update alumni profile.
     */
    public function update(User $user, Alumni $alumni): bool
    {
        // Admin can update any alumni
        if ($user->isAdmin()) {
            return true;
        }

        // Alumni can update their own profile
        return $user->id === $alumni->user_id;
    }

    /**
     * Determine whether user can delete alumni records (admin).
     */
    public function delete(User $user, Alumni $alumni): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can restore alumni records (admin).
     */
    public function restore(User $user, Alumni $alumni): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can permanently delete alumni records (admin).
     */
    public function forceDelete(User $user, Alumni $alumni): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can approve alumni (admin).
     */
    public function approve(User $user, Alumni $alumni): bool
    {
        return $user->isAdmin() && $alumni->status === 'pending';
    }

    /**
     * Determine whether user can reject alumni (admin).
     */
    public function reject(User $user, Alumni $alumni): bool
    {
        return $user->isAdmin() && $alumni->status === 'pending';
    }

    /**
     * Determine whether user can verify alumni (admin).
     */
    public function verify(User $user, Alumni $alumni): bool
    {
        return $user->isAdmin() && $alumni->status === 'approved';
    }

    /**
     * Determine whether user can toggle featured status (admin).
     */
    public function toggleFeatured(User $user, Alumni $alumni): bool
    {
        return $user->isAdmin() && $alumni->status === 'approved';
    }

    /**
     * Determine whether user can export alumni data (admin).
     */
    public function export(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can connect with alumni.
     */
    public function connect(User $user, Alumni $alumni): bool
    {
        // Cannot connect with yourself
        if ($user->id === $alumni->user_id) {
            return false;
        }

        // Must be authenticated
        if (!$user->isAuthenticated()) {
            return false;
        }

        // Both users must be approved alumni
        $currentUserAlumni = Alumni::where('user_id', $user->id)
            ->where('status', 'approved')
            ->first();

        if (!$currentUserAlumni) {
            return false;
        }

        // Target alumni must be approved and allow contact
        if ($alumni->status !== 'approved' || !$alumni->contact_consent) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether user can view alumni statistics (admin).
     */
    public function viewStatistics(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can manage testimonials (admin).
     */
    public function manageTestimonials(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can manage events (admin).
     */
    public function manageEvents(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can manage job postings (admin).
     */
    public function manageJobPostings(User $user): bool
    {
        return $user->isAdmin();
    }
}