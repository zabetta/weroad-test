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
         'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
     
        Gate::define('update-travel', function ($user) {
            return in_array($user->getRole()->name, ['admin','editor']);            
        });
        Gate::define('edit-travel', function ($user) {
            return in_array($user->getRole()->name, ['admin','editor']);            
        });
        Gate::define('user-create', function ($user) {
            return in_array($user->getRole()->name, ['admin']);            
        });

    }
}
