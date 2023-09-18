<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Resource;
use App\Enums\Permission;

class ResourcePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(Permission::VIEW_ANY_RESOURCE->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Resource $resource): bool
    {
        if ($user->can(Permission::VIEW_RESOURCE->value)) {

            if ($resource->visibility == 'private') {

                if ($user->can(Permission::VIEW_PROTECTED_RESOURCE->value)) {
                    return true;
                }

                return $resource->user_id == $user->id;
            }

            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(Permission::CREATE_RESOURCE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Resource $resource): bool
    {
        if ($user->can(Permission::UPDATE_RESOURCE->value)) {

            if ($user->can(Permission::UPDATE_PROTECTED_RESOURCE->value)) {
                return true;
            }

            return $resource->user_id == $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Resource $resource): bool
    {
        if ($user->can(Permission::DELETE_RESOURCE->value)) {

            if ($user->can(Permission::DELETE_PROTECTED_RESOURCE->value)) {
                return true;
            }

            return $resource->user_id == $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Resource $resource): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Resource $resource): bool
    {
        return false;
    }
}
