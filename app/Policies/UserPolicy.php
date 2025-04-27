<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

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
        return $user->role === 'admin' || $user->role === 'staff' ? Response::allow() : Response::deny('Permisson denied');
    }

    // only the admin can create
    public function create(User $user) {
        return $user->role === 'admin';
      
    }
}
