<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Job; // Add import for Job model
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Job $job): bool
    {
        // Only the user who created the job can update it
        return $user->id === $job->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Job $job): bool
    {
        // Only the user who created the job can delete it
        return $this->update($user, $job); // Reuse update logic for delete
    }

    // ... (potentially other policy methods like view, create, etc.)
} 