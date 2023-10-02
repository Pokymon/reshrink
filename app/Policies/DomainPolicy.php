<?php

namespace App\Policies;

use App\Models\Domain;
use App\Models\User;

class DomainPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given domain can be updated by the user.
     */
    public function update(User $user, Domain $domain): bool
    {
        return $user->id === $domain->user_id;
    }

    /**
     * Determine if the given domain can be deleted by the user.
     */
    public function destroy(User $user, Domain $domain): bool
    {
        return $user->id === $domain->user_id;
    }
}
