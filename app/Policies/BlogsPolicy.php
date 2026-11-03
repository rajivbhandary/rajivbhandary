<?php

namespace App\Policies;

use App\Blog;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Blog  $blog
     * @return mixed
     */
    public function view(User $user, Blog $blog)
    {
        return $user->isSuperAdmin() || $user->isAdmin() || $blog->user_id == $user->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Blog  $blog
     * @return mixed
     */
    public function update(User $user, Blog $blog)
    {
        return $blog->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Blog  $blog
     * @return mixed
     */
    public function delete(User $user, Blog $blog)
    {
        return $user->id === $blog->user_id && !$blog->isApproved();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Blog  $blog
     * @return mixed
     */
    public function restore(User $user, Blog $blog)
    {
        return $user->id === $blog->user_id || $user->isAdmin() || $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Blog  $blog
     * @return mixed
     */
    public function forceDelete(User $user, Blog $blog)
    {
        return $user->isSuperAdmin();
    }

    public function approve(User $user, Blog $blog)
    {
        return ($user->isSuperAdmin() || $user->isAdmin()) && !$blog->isApproved();
    }

    public function disapprove(User $user, Blog $blog)
    {
        return ($user->isSuperAdmin() || $blog->approved_by === $user->id) && $blog->isApproved();
    }
}
