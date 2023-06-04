<?php

namespace App\Policies;

use App\Models\Url;
use App\Models\User;

class UrlPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given url can be updated by the user.
     */
    public function update(User $user, Url $url): bool
    {
        return $user->id === $url->user_id;
    }

    /**
     * Determine if the given url can be deleted by the user.
     */
    public function destroy(User $user, Url $url): bool
    {
        return $user->id === $url->user_id;
    }
}
