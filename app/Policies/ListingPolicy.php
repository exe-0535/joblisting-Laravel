<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ListingPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Listing $listing): Response
    {
        return $user->id === $listing->user_id ? Response::allow() : abort(403, 'Unauthorized action');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function destroy(User $user, Listing $listing): bool
    {
        return $user->id === $listing->user_id;
    }
}
