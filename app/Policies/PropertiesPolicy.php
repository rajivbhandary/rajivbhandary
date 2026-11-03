<?php

namespace App\Policies;

use App\Property;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertiesPolicy
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
        return $user->isAdmin() || $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Property  $property
     * @return mixed
     */
    public function view(User $user, Property $property)
    {
        return $user->isAdmin() || $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin() || $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Property  $property
     * @return mixed
     */
    public function update(User $user, Property $property)
    {
        return $user->isAdmin() || $user->isSuperAdmin(); 
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Property  $property
     * @return mixed
     */
    public function delete(User $user, Property $property)
    {
        return $user->isAdmin() || $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Property  $property
     * @return mixed
     */
    public function restore(User $user, Property $property)
    {
        return $user->isAdmin() || $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Property  $property
     * @return mixed
     */
    public function forceDelete(User $user, Property $property)
    {
        return $user->isSuperAdmin();
    }
}
