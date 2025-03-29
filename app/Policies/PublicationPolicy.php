<?php
namespace App\Policies;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PublicationPolicy
{
    /**
     * Determine whether the user can view any models.
     * Allow anyone (even guests) to view the list - adjust if needed
     */
    public function viewAny(?User $user): bool
    {
         return true; // Or check for specific roles/permissions if needed
    }

    /**
     * Determine whether the user can view the model.
     * Allow anyone (even guests) to view a single one - adjust if needed
     */
    public function view(?User $user, Publication $publication): bool
    {
         return true; // Or check for specific roles/permissions if needed
    }

    /**
     * Determine whether the user can create models.
     * Only logged-in users can create.
     */
    public function create(User $user): bool
    {
        return $user !== null; // Or check roles: return $user->hasRole('editor');
    }

    /**
     * Determine whether the user can update the model.
     * Check if the user is associated with the publication via the pivot table.
     */
    public function update(User $user, Publication $publication): bool
    {
        // Check if a record exists in the pivot table for this user and publication
        return $publication->users()->where('user_id', $user->id)->exists();
    }

    /**
     * Determine whether the user can delete the model.
     * Same logic as update.
     */
    public function delete(User $user, Publication $publication): bool
    {
         // Check if a record exists in the pivot table for this user and publication
        return $publication->users()->where('user_id', $user->id)->exists();
    }

    /**
     * Determine whether the user can restore the model. (For soft deletes)
     */
    public function restore(User $user, Publication $publication): bool
    {
        // Add logic if using soft deletes, e.g., same as update
         return $this->update($user, $publication);
    }

    /**
     * Determine whether the user can permanently delete the model. (For soft deletes)
     */
    public function forceDelete(User $user, Publication $publication): bool
    {
        // Add logic if using soft deletes, e.g., same as update
         return $this->update($user, $publication);
    }
}