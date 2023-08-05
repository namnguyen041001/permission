<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            Gate::define($permission->slug, function (User $user) use ($permission) { //$user là user đang true cập, tham số mặc định phải có
                return $user->hasPermission($permission->slug);
            });
        }
    }
}
