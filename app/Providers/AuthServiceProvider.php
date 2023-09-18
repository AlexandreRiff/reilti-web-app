<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Resource;
use App\Enums\Permission;
use App\Policies\ResourcePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Resource::class => ResourcePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::before(fn (User $user) => $user->hasRole('admin') ?: null);

        Gate::define('get_file', function (User $user, Resource $resource) {
            if ($user->can(Permission::GET_FILE_RESOURCE->value)) {
                if ($resource->visibility == 'private') {
                    if ($user->can(Permission::GET_PROTECTED_FILE_RESOURCE->value)) {
                        return true;
                    }
                    return $user->id == $resource->user_id;
                }
                return true;
            }
            return false;
        });

        Gate::define('download_file', function (User $user, Resource $resource) {
            if ($user->can(Permission::DOWNLOAD_FILE_RESOURCE->value)) {
                if ($resource->visibility == 'private') {
                    if ($user->can(Permission::DOWNLOAD_PROTECTED_FILE_RESOURCE->value)) {
                        return true;
                    }
                    return $user->id == $resource->user_id;
                }
                return true;
            }
            return false;
        });

        Gate::define('show_file', function (User $user, Resource $resource) {
            if ($user->can(Permission::SHOW_FILE_RESOURCE->value)) {
                if ($resource->visibility == 'private') {
                    if ($user->can(Permission::SHOW_PROTECTED_FILE_RESOURCE->value)) {
                        return true;
                    }
                    return $user->id == $resource->user_id;
                }
                return true;
            }
            return false;
        });
    }
}
