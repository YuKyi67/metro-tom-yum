<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // only the admin can view all users
    public function viewAny(User $user) {
        return $user->role === 'admin';
    }

    // only the admin can create
    public function create(User $user) {
        return $user->role === 'admin';
    }
}
