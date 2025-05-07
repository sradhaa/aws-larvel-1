<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

     /**
     * Determine if the user is an admin.
     */
    public function isAdmin(User $user)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine if the user is an editor.
     */
    public function isEditor(User $user)
    {
        return $user->role === 'editor';
    }

    /**
     * Determine if the user is a normal user.
     */
    public function isUser(User $user)
    {
        return $user->role === 'user';
    }
}
