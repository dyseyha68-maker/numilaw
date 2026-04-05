<?php

namespace App\Policies;

use App\Models\AlumniEvent;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AlumniEventPolicy
{
    /**
     * Determine whether user can view any events.
     */
    public function viewAny(User $user): bool
    {
        return true; // Public can view active events
    }

    /**
     * Determine whether user can view event.
     */
    public function view(User $user, AlumniEvent $event): bool
    {
        // Admin can view any event
        if ($user->isAdmin()) {
            return true;
        }

        // Public can view active events
        return $event->is_active;
    }

    /**
     * Determine whether user can create events (admin).
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can update event (admin).
     */
    public function update(User $user, AlumniEvent $event): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can delete event (admin).
     */
    public function delete(User $user, AlumniEvent $event): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can restore event (admin).
     */
    public function restore(User $user, AlumniEvent $event): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can permanently delete event (admin).
     */
    public function forceDelete(User $user, AlumniEvent $event): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can register for event.
     */
    public function register(User $user, AlumniEvent $event): bool
    {
        // Must be active
        if (!$event->is_active) {
            return false;
        }

        // Cannot register for cancelled events
        if ($event->status === 'cancelled') {
            return false;
        }

        // Cannot register for past events
        if ($event->start_datetime->isPast()) {
            return false;
        }

        // Check if event has availability
        if ($event->max_attendees && $event->current_attendees >= $event->max_attendees) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether user can manage event registrations (admin).
     */
    public function manageRegistrations(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can feature event (admin).
     */
    public function feature(User $user, AlumniEvent $event): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether user can cancel event (admin).
     */
    public function cancel(User $user, AlumniEvent $event): bool
    {
        return $user->isAdmin() && $event->status !== 'completed';
    }

    /**
     * Determine whether user can update event status (admin).
     */
    public function updateStatus(User $user, AlumniEvent $event): bool
    {
        return $user->isAdmin();
    }
}