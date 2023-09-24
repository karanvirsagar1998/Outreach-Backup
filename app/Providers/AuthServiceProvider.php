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

        Gate::define('check-if-candidate', function ($user) {
            return auth()->user()->user_type_id == 3;
        });

        Gate::define('check-authentication', function ($use) {
            return auth()->user();
        });
    }

  
}