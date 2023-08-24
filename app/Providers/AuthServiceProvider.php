<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->registerAppPolicies();
    }

    public function registerAppPolicies()
    {
        Gate::define('assign-roles', function($user) {
            return $user->hasAccess(['assign-roles']);
        });

        Gate::define('create-user', function($user) {
            return $user->hasAccess(['create-user']);
        });

        Gate::define('create-complaint', function($user) {
            return $user->hasAccess(['create-complaint']);
        });

        Gate::define('create-vendor', function($user) {
            return $user->hasAccess(['create-vendor']);
        });

        Gate::define('edit-vendor', function($user) {
            return $user->hasAccess(['edit-vendor']);
        });

        Gate::define('delete-vendor', function($user) {
            return $user->hasAccess(['delete-vendor']);
        });
    }
}
